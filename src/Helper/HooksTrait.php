<?php

namespace Chipmunk\Helper;

use function Chipmunk\config;

/**
 * Provides methods to register new hooks in the theme
 */
trait HooksTrait {

	/**
	 * Passes its arguments to add_action() and adds a Hook to our collection.
	 *
	 * @param string         $hook
	 * @param string|Closure $callback
	 * @param int            $priority
	 * @param int            $arguments
	 *
	 * @return bool
	 */
	public function addAction( string $hook, $callback, int $priority = 10, int $arguments = 1 ): string {
		return is_string( $callback )
			? add_action( $hook, [ $this, $callback ], $priority, $arguments )
			: add_action( $hook, $callback, $priority, $arguments );
	}

	/**
	 * Passes its arguments to add_filter and adds a Hook to our collection.
	 *
	 * @param string         $hook
	 * @param string|Closure $callback
	 * @param int            $priority
	 * @param int            $arguments
	 *
	 * @return bool
	 */
	public function addFilter( string $hook, $callback, int $priority = 10, int $arguments = 1 ): string {
		return is_string( $callback )
			? add_filter( $hook, [ $this, $callback ], $priority, $arguments )
			: add_filter( $hook, $callback, $priority, $arguments );
	}

	/**
	 * Passes its arguments to add_filter and adds a Hook to our collection.
	 *
	 * @param string $hook
	 * @param mixed  $value
	 * @param mixed  $args
	 *
	 * @return mixed
	 */
	public function applyFilter( string $hook, $value, ...$args ) {
		return apply_filters( join( '_', [ config()->getSlug(), $hook ] ), $value, ...$args );
	}
}
