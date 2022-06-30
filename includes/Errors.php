<?php

namespace Chipmunk;

use WP_Error;

/**
 * Encapsulates WP_Error class. Should be used to globally store application errors.
 *
 * @package WordPress
 * @subpackage Chipmunk
 */
class Errors {
	/**
	 * Stores global instance of WP_Error
	 */
	private static WP_Error $instance;

	/**
	 * Returns global instance of WP_Error.
	 */
	public static function getInstance(): WP_Error {
		if ( ! self::$instance ) {
			self::$instance = new WP_Error();
		}

		return self::$instance;
	}
}
