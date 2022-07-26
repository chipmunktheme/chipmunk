<?php

namespace Piotrkulpinski\Framework\Handler;

use Closure;
use Throwable;
use ReflectionClass;
use ReflectionException;
use Piotrkulpinski\Framework\Hook\HookFactory;
use Piotrkulpinski\Framework\Hook\HookCollection;
use Piotrkulpinski\Framework\Exception\HookException;
use Piotrkulpinski\Framework\Exception\HandlerException;

/**
 * Class AbstractThemeHandler
 */
abstract class ThemeHandler implements HandlerInterface {

	/**
	 * Checks if the theme was already initialized
	 *
	 * @var bool
	 */
	protected bool $initialized = false;

	protected HookFactory $hookFactory;
	protected HookCollection $hookCollection;
	protected ReflectionClass $handlerReflection;

	/**
	 * AbstractThemeHandler constructor.
	 */
	public function __construct() {
		$this->hookFactory       = new HookFactory();
		$this->hookCollection    = new HookCollection();
		$this->handlerReflection = new ReflectionClass( $this );
	}

	/**
	 * Checks to see if the method being called is in the $hooked
	 * property, and if so, calls it passing the $arguments to it.
	 *
	 * @param string $method
	 * @param array  $arguments
	 *
	 * @return mixed
	 * @throws HandlerException
	 */
	public function __call( string $method, array $arguments ) {
		// getting here should only happen via WordPress callbacks and only for
		// MethodHooks;  closures aren't a part of an object so they won't ever get
		// called like this.  once we get here, we want to see if there's a method
		// in our hook collection that corresponds to this action and priority.

		$action = current_action();

		if ( empty( $action ) ) {
			throw new HandlerException(
				"Unable to determine action/filter at which $method was called",
				HandlerException::INAPPROPRIATE_CALL
			);
		}

		$priority  = has_filter( $action, [ $this, $method ] );
		$hookIndex = $this->hookFactory->produceHookIndex( $action, $this, $method, $priority );
		if ( ! $this->hookCollection[ $hookIndex ] ) {
			// if we're in here, then we don't have a Hook that exactly matches
			// this method, action, and priority combination.  since we're about
			// to crash out of things anyway, we'll see if we can help the
			// programmer identify the problem.

			foreach ( $this->hookCollection as $hook ) {
				if ( $hook->method === $method ) {
					// well, we just found a hook using this method, so the problem
					// must be that we're at the wrong action or priority.  let's see
					// if which it is.

					if ( $hook->hook !== $action ) {
						throw new HandlerException(
							"$method is hooked but not via $action",
							HandlerException::INAPPROPRIATE_CALL
						);
					}

					if ( $hook->priority !== $priority ) {
						throw new HandlerException(
							"$method is hooked but not at $priority",
							HandlerException::INAPPROPRIATE_CALL
						);
					}
				}

				// if we looped over all of our hooked methods and never threw any of
				// the above exceptions, then the only remaining option is that the
				// method was never hooked the first place.  we have an exception for
				// that, too.

				throw new HandlerException(
					"Unhooked method: $method.",
					HandlerException::UNHOOKED_METHOD
				);
			}
		}

		// in keeping with WP Core's WP_Hook::apply_filters method, we want to
		// remove any extra arguments before passing them over.  this is not
		// likely too problematic unless we have a variadic method that might
		// do something to/with unexpected parameters.  so, before we call our
		// method, we use array_slice to remove extra arguments.

		$hook      = $this->hookCollection[ $hookIndex ];
		$arguments = array_slice( $arguments, 0, $hook->argumentCount );
		return $this->{$method}( ...$arguments );
	}

	/**
	 * Returns the name of this object using the late-static binding so it'll
	 * return the name of the concrete handler, not simply "AbstractThemeHandler".
	 *
	 * @return string
	 */
	public function __toString(): string {
		return static::class;
	}

	/**
	 * Uses addAction and/or addFilter to attach protected methods of this object
	 * to the ecosystem of WordPress action and filter hooks.
	 *
	 * @return void
	 */
	abstract public function initialize(): void;

	/**
	 * Returns the value of the initialized property at the start of the method
	 * but also sets that value to true.  This function should be called when
	 * initializing handlers if you need to avoid re-initialization problems.
	 *
	 * @return bool
	 */
	final protected function isInitialized(): bool {
		$returnValue       = $this->initialized;
		$this->initialized = true;

		return $returnValue;
	}

	/**
	 * Passes its arguments to add_action() and adds a Hook to our collection.
	 *
	 * @param string         $hook
	 * @param string|Closure $callback
	 * @param int            $priority
	 * @param int            $arguments
	 *
	 * @return string
	 * @throws HandlerException
	 */
	protected function addAction( string $hook, $callback, int $priority = 10, int $arguments = 1 ): string {
		if ( ! $this->isValidCallback( $callback ) ) {
			throw new HandlerException(
				$this->getInvalidCallbackMessage( $callback ),
				HandlerException::INVALID_CALLBACK
			);
		}

		$this->addHookToCollection( $hook, $callback, $priority, $arguments );

		// if $callback is a string, then we need to add our action to WP using
		// the array syntax for method calls.  otherwise, we can just pass it
		// over to add_action since it is, itself, callable.

		return is_string( $callback )
			? add_action( $hook, [ $this, $callback ], $priority, $arguments )
			: add_action( $hook, $callback, $priority, $arguments );
	}

	/**
	 * Given a callback, returns true if it's valid, false otherwise.
	 *
	 * @param string|Closure $callback
	 *
	 * @return bool
	 */
	protected function isValidCallback( $callback ): bool {
		// if $callback is a Closure, we're fine.  it's the string case that's
		// more difficult so we'll bug out before worrying about anything else
		// here.

		if ( $callback instanceof Closure ) {
			return true;
		}

		// now, if we're here, then $callback better be a string and, if so, it
		// also has to be a non-private method of this object.  we can use our
		// reflection to handle these tests.

		try {
			if ( ! isset( $this->reflectionMethods[ $callback ] ) ) {
				$this->reflectionMethods[ $callback ] = $this->handlerReflection->getMethod( $callback );
			}

			return ! $this->reflectionMethods[ $callback ]->isPrivate();
		} catch ( ReflectionException $e ) {

			// the getMethod method throws an exception when the requested
			// method doesn't exist.  if it doesn't exist, then it can't be a
			// callback, so we can just return false here.

			return false;
		}
	}

	/**
	 * Returns an exception message based on the type of $callback.
	 *
	 * @param string|object $callback
	 *
	 * @return string
	 */
	private function getInvalidCallbackMessage( $callback ): string {
		// like the isValidCallback method above, this one uses the type of
		// $callback to return an exception message about it's invalidity.

		if ( is_string( $callback ) ) {

			// if it's a string, then either (a) it wasn't a method of our
			// object or (b) it was private.  we'll return a message based on
			// which it was here.

			return $this->handlerReflection->hasMethod( $callback )
				? $callback . ' must be public or protected'
				: 'Method not found: ' . $callback;
		}

		// if $callback wasn't a string, it must be an object, but that object
		// must not have been a Closure or it would have been valid.  so, we'll
		// simply request a method or Closure here.

		return 'Callbacks must be a handler method or Closure';
	}

	/**
	 * Given data about a hook, produces one and add it to our collection.
	 *
	 * @param string         $hook
	 * @param string|Closure $callback
	 * @param int            $priority
	 * @param int            $arguments
	 *
	 * @return void
	 * @throws HandlerException
	 */
	private function addHookToCollection( string $hook, $callback, int $priority, int $arguments ): void {
		try {
			// to add a hook to our collection, we need the index it'll use therein
			// and the actually HookInterface implementation that we store.  we make
			// those and then pass them to our collection's set method.

			$hookIndex  = $this->hookFactory->produceHookIndex( $hook, $this, $callback, $priority );
			$hookObject = $this->hookFactory->produceHook( $hook, $this, $callback, $priority, $arguments );

			$this->hookCollection[ $hookIndex ] = $hookObject;
		} catch ( HookException $exception ) {
			// to make things easier on the calling scope, we'll "merge" the two
			// types of exceptions thrown by the hook collection here into a single
			// type:  our HandlerException.

			throw new HandlerException(
				$exception->getMessage(),
				HandlerException::FAILURE_TO_HOOK,
				$exception
			);
		}
	}

	/**
	 * Removes a hooked method from WP core and the record of the hook from our
	 * collection.  Note:  closures cannot be removed at this time because they
	 * cannot be removed using WP's remove_action.
	 *
	 * @param string $hook
	 * @param string $method
	 * @param int    $priority
	 *
	 * @return bool
	 */
	protected function removeAction( string $hook, string $method, int $priority = 10 ): bool {
		$this->removeHookFromCollection( $hook, $method, $priority );
		return remove_action( $hook, [ $this, $method ], $priority );
	}

	/**
	 * Given the information about a hook in our collection, removes it.
	 *
	 * @param string $hook
	 * @param string $method
	 * @param int    $priority
	 *
	 * @return void
	 */
	private function removeHookFromCollection( string $hook, string $method, int $priority ): void {
		$hookIndex = $this->hookFactory->produceHookIndex( $hook, $this, $method, $priority );
		unset( $this->hookCollection[ $hookIndex ] );
	}

	/**
	 * Passes its arguments to add_filter and adds a Hook to our collection.
	 *
	 * @param string         $hook
	 * @param string|Closure $callback
	 * @param int            $priority
	 * @param int            $arguments
	 *
	 * @return string
	 * @throws HandlerException
	 */
	protected function addFilter( string $hook, $callback, int $priority = 10, int $arguments = 1 ): string {
		if ( ! $this->isValidCallback( $callback ) ) {
			throw new HandlerException(
				$this->getInvalidCallbackMessage( $callback ),
				HandlerException::INVALID_CALLBACK
			);
		}

		$this->addHookToCollection( $hook, $callback, $priority, $arguments );

		// based on the type of $callback, we can handle the arguments to the WP
		// add_filter function like we did in addAction above.

		return is_string( $callback )
			? add_filter( $hook, [ $this, $callback ], $priority, $arguments )
			: add_filter( $hook, $callback, $priority, $arguments );
	}

	/**
	 * Removes a filter from WP and the record of the Hook from our collection.
	 * Note:  closures cannot be removed at this time because closures cannot be
	 * removed using WP's remove_filter.
	 *
	 * @param string $hook
	 * @param string $method
	 * @param int    $priority
	 *
	 * @return bool
	 */
	protected function removeFilter( string $hook, string $method, int $priority = 10 ): bool {
		$this->removeHookFromCollection( $hook, $method, $priority );
		return remove_filter( $hook, [ $this, $method ], $priority );
	}

	/**
	 * Given stuff, print information about it and then die() if the $die flag is
	 * set.  Typically, this only works when the isDebug() method returns true,
	 * but the $force parameter will override this behavior.
	 *
	 * @param mixed $stuff
	 * @param bool  $die
	 * @param bool  $force
	 *
	 * @return void
	 */
	public static function debug( $stuff, bool $die = false, bool $force = false ): void {
		if ( self::isDebug() || $force ) {
			$message = '<pre>' . print_r( $stuff, true ) . '</pre>';

			if ( $die ) {
				die( $message );
			}

			echo $message;
		}
	}

	/**
	 * Returns true when WP_DEBUG exists and is set.
	 *
	 * @return bool
	 */
	public static function isDebug(): bool {
		return defined( 'WP_DEBUG' ) && WP_DEBUG;
	}

	/**
	 * Calling this method should write $data to the WordPress debug.log file.
	 *
	 * @param mixed $data
	 *
	 * @return void
	 */
	public static function writeLog( $data ): void {
		// source:  https://www.elegantthemes.com/blog/tips-tricks/using-the-wordpress-debug-log
		// accessed:  2018-07-09

		if ( ! function_exists( 'write_log' ) ) {
			function write_log( $log ) {
				if ( is_array( $log ) || is_object( $log ) ) {
					error_log( print_r( $log, true ) );
				} else {
					error_log( $log );
				}
			}
		}

		write_log( $data );
	}

	/**
	 * This serves as a general-purpose Exception handler which displays
	 * the caught object when we're debugging and writes it to the log when
	 * we're not.
	 *
	 * @param Throwable $thrown
	 *
	 * @return void
	 */
	public static function catcher( Throwable $thrown ): void {
		self::isDebug() ? self::debug( $thrown, true ) : self::writeLog( $thrown );
	}
}
