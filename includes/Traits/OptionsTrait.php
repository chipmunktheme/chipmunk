<?php

namespace Chipmunk\Traits;

// use Dashifen\Transformer\TransformerException;
// use Dashifen\WPHandler\Handlers\HandlerException;
// use Dashifen\Transformer\StorageTransformer\StorageTransformerInterface;

/**
 *
 */
trait OptionsTrait {

	private array $optionsCache   = [];
	private bool $useOptionsCache = true;

	/**
	 * Does a little extra work before retrieving our option value from the
	 * database.
	 *
	 * @param string $option
	 * @param mixed  $default
	 *
	 * @return mixed
	 * @throws HandlerException
	 */
	public function getOption( string $option, $default = '' ) {
		if ( $this->isOptionCached( $option ) ) {
			return $this->getCachedOption( $option );
		}

		// it's hard to make a trait know about the methods that are available
		// in the classes in which it might be used.  so, we won't use the
		// isDebug method here, we'll just execute the same command that it
		// does.

		if ( $this->isOptionValid( $option, defined( 'WP_DEBUG' ) && WP_DEBUG ) ) {
			$fullOptionName = $this->getFullOptionName( $option );
			$value          = $this->retrieveOption( $fullOptionName, $default );
		}

		// here, if we didn't set $value in our if-block, we'll do so here with
		// the null coalescing operator.  then, if we're using the cache we
		// want to remember it for next time.

		$value = $value ?? $default;
		$this->maybeCacheOption( $option, $value );
		return $value;
	}

	/**
	 * Given the name of an option, determines if a value for it exists in
	 * the cache.
	 *
	 * @param string $option
	 *
	 * @return bool
	 */
	protected function isOptionCached( string $option ): bool {
		return $this->useOptionsCache && ! empty( $this->optionsCache[ $option ] );
	}

	/**
	 * Given the name of the option, returns the value for it in the cache.
	 * Assumes that isOptionCached() has been previously called but uses the
	 * null coalescing operator to return null if a mistake was made.
	 *
	 * @param string $option
	 *
	 * @return mixed
	 */
	protected function getCachedOption( string $option ) {
		return $this->optionsCache[ $option ] ?? null;
	}

	/**
	 * Handles the prefixing of our $option parameter so that other methods of
	 * this trait don't have to.
	 *
	 * @param string $option
	 *
	 * @return string
	 */
	protected function getFullOptionName( string $option ): string {
		$option = trim( $option );

		// if the first character of our option's name is an underscore, we move it
		// to the beginning of the return value.  options aren't hidden in the same
		// way as post meta, but this allows us to mark an option with a leading
		// prefix if we need to for some reason.

		return substr( $option, 0, 1 ) === '_'
		? '_' . $this->getOptionNamePrefix() . substr( $option, 1 )
		: $this->getOptionNamePrefix() . $option;
	}

	/**
	 * Returns true if the option we're working with is valid with respect to
	 * this handler's sphere of influence.  if it's not, it'll either return
	 * false or throw a HandlerException based on the value of $throw.
	 *
	 * @param string $option
	 * @param bool   $throw
	 *
	 * @return bool
	 * @throws HandlerException
	 */
	protected function isOptionValid( string $option, bool $throw = true ): bool {
		$isValid = in_array( $option, $this->getValidOptionNames() );

		if ( ! $isValid && $throw ) {
			throw new HandlerException(
				'Unknown option:' . $option,
				HandlerException::UNKNOWN_OPTION
			);
		}

		return $isValid;
	}

	/**
	 * The full set of options names include the custom options managed by the
	 * handler or agent using this trait and the name of the options snapshot
	 * identified herein.  This method just makes sure to add the latter to the
	 * former.
	 *
	 * @return array
	 */
	protected function getValidOptionNames(): array {
		$options   = $this->getOptionNames();
		$options[] = $this->getOptionSnapshotName();
		return $options;
	}

	/**
	 * Returns an array of valid option names for use within the isOptionValid
	 * method.
	 *
	 * @return array
	 */
	abstract protected function getOptionNames(): array;

	/**
	 * Returns the prefix that that is used to differentiate the options for
	 * this handler's sphere of influence from others.  By default, we return
	 * an empty string, but we assume that this will likely get overridden.
	 * Public in case an agent needs to ask their handler what prefix to use.
	 *
	 * @return string
	 */
	public function getOptionNamePrefix(): string {
		return '';
	}

	/**
	 * Retrieves an option from the database.  Separated from its surrounding
	 * scope so we can override this, e.g. for network options.
	 *
	 * @param string $option
	 * @param mixed  $default
	 *
	 * @return mixed
	 */
	protected function retrieveOption( string $option, $default = '' ) {
		return get_option( $option, $default );
	}

	/**
	 * If we're using the cache, we add this option/value pair to it.
	 *
	 * @param string $option
	 * @param mixed  $value
	 *
	 * @return void
	 */
	protected function maybeCacheOption( string $option, $value ): void {
		if ( $this->useOptionsCache ) {
			$this->optionsCache[ $option ] = $value;
		}
	}

	/**
	 * Loops over the array of option names and returns their values as an
	 * array.
	 *
	 * @return array
	 * @throws HandlerException
	 */
	public function getAllOptions(): array {
		foreach ( $this->getOptionNames() as $optionName ) {
			// we don't have to worry about accessing the cache here because,
			// if we're using it, the getOption method will use it internally.

			$options[ $optionName ] = $this->getOption( $optionName, '' );
		}

		// just in case someone calls this function on a handler that doesn't
		// have any options to retrieve, we'll need to use the null coalescing
		// operator to ensure that we return an empty array in the event that
		// $options is not defined in the above loop.

		return $options ?? [];
	}

	/**
	 * Ensures that we save this option's value using this plugin's option
	 * prefix before calling the storeOption method and returning its results.
	 *
	 * @param string $option
	 * @param mixed  $value
	 *
	 * @return bool
	 * @throws HandlerException
	 * @throws TransformerException
	 */
	public function updateOption( string $option, $value ): bool {
		// since we transform our $value before we cram it in the database,
		// it's easier for us to ( maybe ) add it to our cache first.  that way,
		// we have the value the visitor sent us in memory and we don't have to
		// remember to transform it before using it elsewhere.

		$this->maybeCacheOption( $option, $value );

		if ( $this->isOptionValid( $option ) ) {
			$fullOptionName = $this->getFullOptionName( $option );
			return $this->storeOption( $fullOptionName, $value );
		}

		return false;
	}

	/**
	 * Stores a value in the database.  Separated from other scopes so this
	 * behavior can be overridden, e.g. for the storage of network options.
	 *
	 * @param string $option
	 * @param mixed  $value
	 *
	 * @return bool
	 */
	protected function storeOption( string $option, $value ): bool {
		return update_option( $option, $value );
	}

	/**
	 * Like the getAllOptions method above, this saves all of our information
	 * in one call based on the mapping of option names to values represented
	 * by the first parameter.
	 *
	 * @param array $values
	 * @param bool  $transform
	 *
	 * @return bool
	 * @throws HandlerException
	 * @throws TransformerException
	 */
	public function updateAllOptions( array $values ): bool {
		$success = true;
		foreach ( $values as $option => $value ) {

			// the updateOption method returns true when it updates our option.
			// we Boolean AND that value with the current value of $success
			// which starts as true.  so, as long as updateOption return true,
			// $success will remain set.  but, the first time we hit a problem,
			// it'll be reset and will remain so because false AND anything is
			// false.

			$success = $success && $this->updateOption( $option, $value, $transform );
		}

		return $success;
	}

	/**
	 * Returns true if the $option's value in the database matches $value.
	 * This is useful when determining whether or not an update to this option
	 * is necessary.
	 *
	 * @param string $option
	 * @param mixed  $value
	 *
	 * @return bool
	 * @throws HandlerException
	 * @throws TransformerException
	 */
	public function optionValueMatches( string $option, $value ): bool {
		// we don't want our handler to transform the value of $field as it
		// comes out of the database.  doing so would likely mean that it would
		// become different from $value causing the system to try and update
		// things even if it doesn't have to.  hence, we pass a false-flag to
		// the getOption method which prevents it from performing its
		// transformations.

		return $this->getOption( $option ) === $value;
	}

	/**
	 * If our option parameter specifies a valid option for this object, then
	 * we delete it.
	 *
	 * @param string $option
	 *
	 * @return bool|null
	 * @throws HandlerException
	 */
	public function deleteOption( string $option ): ?bool {
		// as in getOption above, it's hard to rely on other object methods
		// within Traits even if we're pretty sure they're going to have them.
		// so, instead of accessing the isDebug method of our handlers/agents,
		// we'll simply do it's expected work here re: determining the value
		// of the throw argument for isOptionValid

		if ( $this->isOptionValid( $option, defined( 'WP_DEBUG' ) && WP_DEBUG ) ) {
			$this->maybeDeleteCachedOption( $option );
			$fullOptionName = $this->getFullOptionName( $option );
			return $this->removeOption( $fullOptionName );
		}

		// if our option wasn't valid, then we definitely didn't remove
		// anything from the database, but we want to separate this from a
		// failure to delete a valid one.  so, we return null which would
		// evaluate to false if used in a conditional statement anyway.

		return null;
	}

	/**
	 * If we're using the object option value cache, unset the $option index
	 * of it to delete it from that cache.
	 *
	 * @param string $option
	 */
	protected function maybeDeleteCachedOption( string $option ): void {
		if ( $this->isOptionCached( $option ) ) {
			unset( $this->optionsCache[ $option ] );
		}
	}

	/**
	 * Deletes an option from the database.  It's separated from its
	 * surrounding context so that we can alter this method, e.g. for deleting
	 * network options.
	 *
	 * @param string $option
	 *
	 * @return bool
	 */
	protected function removeOption( string $option ): bool {
		return delete_option( $option );
	}
}
