<?php

namespace Chipmunk\Helper;

use Chipmunk\Helper\HelpersTrait;
use function Chipmunk\config;

/**
 * Provides methods to run file-related tasks
 */
trait TransientsTrait {

	use HelpersTrait;

	/**
	 * Retrieves the value of a transient.
	 *
	 * @param string $transient Transient name.
	 *
	 * @return mixed Value of transient
	 */
	public function getTransient( string $transient ) {
		return unserialize( get_transient( $this->getThemeSlug( $transient ) ) );
	}

	/**
	 * Sets/updates the value of a transient.
	 *
	 * @param string $transient Transient name.
	 * @param mixed $value Transient value. Must be serializable if non-scalar.
	 * @param int $expiration Time until expiration in seconds. Default 0 (no expiration).
	 *
	 * @return bool True if the value was set, false otherwise.
	 */
	public function setTransient( string $transient, $value, int $expiration = 0 ): bool {
		return set_transient( $this->getThemeSlug( $transient ), serialize( $value ), $expiration );
	}
}
