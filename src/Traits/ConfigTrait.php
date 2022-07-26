<?php

namespace Chipmunk\Traits;

use Dashifen\WPHandler\Handlers\HandlerException;

/**
 * Provides methods for the getting config options
 */
trait ConfigTrait {

	/**
	 * Does a little extra work before retrieving our config value from the
	 * database.
	 *
	 * @param string $config
	 *
	 * @return mixed
	 * @throws HandlerException
	 */
	public function getConfig( string $config ) {
		if ( $this->isConfigValid( $config, defined( 'WP_DEBUG' ) && WP_DEBUG ) ) {
			return $this->config[ $config ];
		}

		return null;
	}

	/**
	 * Returns true if the option we're working with is valid with respect to
	 * this handler's sphere of influence.  if it's not, it'll either return
	 * false or throw a HandlerException based on the value of $throw.
	 *
	 * @param string $config
	 * @param bool   $throw
	 *
	 * @return bool
	 * @throws HandlerException
	 */
	protected function isConfigValid( string $config, bool $throw = true ): bool {
		$isValid = in_array( $config, $this->config );

		if ( ! $isValid && $throw ) {
			throw new HandlerException(
				'Unknown config:' . $config,
				HandlerException::UNKNOWN_OPTION
			);
		}

		return $isValid;
	}
}
