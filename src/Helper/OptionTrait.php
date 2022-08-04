<?php

namespace Chipmunk\Helper;

use MadeByLess\Lessi\Helper\HelperTrait;
use MadeByLess\Lessi\Helper\HookTrait;
use Chipmunk\Core\Options;

/**
 * Provides methods to retrieve theme options in a better way
 */
trait OptionTrait {
	use HelperTrait;
	use HookTrait;

	/**
	 * Options cache object
	 *
	 * @var array
	 */
	private array $optionsCache = [];

	/**
	 * Determines whether or not to use cache
	 *
	 * @var bool
	 */
	private bool $useOptionsCache = true;

	/**
	 * The key to find object in the global scope
	 *
	 * @var string
	 */
	private string $optionsPath = '*.fields.name';

	/**
	 * Does a little extra work before retrieving our option value from the
	 * database.
	 *
	 * @param string     $option
	 * @param mixed|null $default
	 *
	 * @return ?mixed
	 */
	public function getOption( string $option, $default = null ) {
		$option = trim( $option );

		if ( $this->isOptionCached( $option ) ) {
			return $this->getCachedOption( $option );
		}

		if ( ! $this->isOptionValid( $option ) ) {
			return null;
		}

		$value = $this->retrieveOption( $option );
		$value = $value ?? $default ?? $this->getDefaultOption( $option );
		$value = $this->applyFilter( config()->getSettingsName() . '_' . $option, $value, false );

		// If we're using the cache, we add this option/value pair to it.
		$this->maybeCacheOption( $option, $value );

		return $value;
	}

	/**
	 * Checks if option is enabled
	 *
	 * @param string $feature
	 * @param string $type
	 * @param bool   $checkType
	 *
	 * @return bool
	 */
	public function isOptionEnabled( string $feature, string $type, bool $checkType = true ) {
		return ! $this->getOption( "disable_{$type}_{$feature}" ) && ( $checkType ? get_post_type() === $type : true );
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
	 */
	private function isOptionValid( string $option, bool $throw = true ): bool {
		$isValid = ! ! $this->getOptionObject( $option );

		if ( ! $isValid && $throw ) {
			// TODO: Implement a proper error logging here
			return false;
		}

		return $isValid;
	}

	/**
	 * Given the name of an option, determines if a value for it exists in
	 * the cache.
	 *
	 * @param string $option
	 *
	 * @return bool
	 */
	private function isOptionCached( string $option ): bool {
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
	private function getCachedOption( string $option ) {
		return $this->optionsCache[ $option ] ?? null;
	}

	/**
	 * Retrieves an option from the database.
	 *
	 * @param string $option
	 *
	 * @return mixed
	 */
	private function retrieveOption( string $option ) {
		$settingsName = config()->getSettingsName();
		$options      = get_option( $settingsName ) ?? [];

		return $options[ $option ] ?? null;
	}

	/**
	 * If we're using the cache, we add this option/value pair to it.
	 *
	 * @param string $option
	 * @param mixed  $value
	 *
	 * @return void
	 */
	private function maybeCacheOption( string $option, $value ): void {
		if ( $this->useOptionsCache ) {
			$this->optionsCache[ $option ] = $value;
		}
	}

	/**
	 * Retrieves the option object from the global array
	 *
	 * @param string $option
	 *
	 * @return mixed|null
	 */
	private function getOptionObject( string $option ) {
		$sections = Options::instance()->getSections();
		$option   = $this->findByProperty( $sections, $this->optionsPath, $option );

		return $option ?? null;
	}

	/**
	 * Search for field by given name
	 *
	 * @param string $option
	 *
	 * @return mixed|null
	 */
	private function getDefaultOption( string $option ) {
		$option = $this->getOptionObject( $option );

		return $option['default'] ?? null;
	}
}
