<?php

namespace Chipmunk;

use Piotrkulpinski\Framework\Handler\ThemeHandler;
use Chipmunk\Templates;

/**
 * Main theme setup class
 *
 * @package Chipmunk
 */
class Theme extends ThemeHandler {

	/**
	 * Theme constructor.
	 */
	public function __construct() {
		parent::__construct();
	}

	/**
	 * initialize
	 *
	 * Hooks methods of this object into the WordPress ecosystem
	 *
	 * @return void
	 * @throws HandlerException
	 */
	public function initialize(): void {
		if ( ! $this->isInitialized() ) {
			( new Templates() )->initialize();
			( new Assets() )->initialize();
		}
	}

	/**
	 * Throw error on object clone.
	 *
	 * The whole idea of the singleton design pattern is that there is a single
	 * object therefore, we don't want the object to be cloned.
	 *
	 * @since 2.0
	 * @access protected
	 * @return void
	 */
	public function __clone() {
		// Cloning instances of the class is forbidden.
		_doing_it_wrong( __FUNCTION__, esc_html__( 'Cheatin&#8217; huh?', 'chipmunk' ), '2.0' );
	}

	/**
	 * Disable unserializing of the class.
	 *
	 * @since 2.0
	 * @access protected
	 * @return void
	 */
	public function __wakeup() {
		// Unserializing instances of the class is forbidden.
		_doing_it_wrong( __FUNCTION__, esc_html__( 'Cheatin&#8217; huh?', 'chipmunk' ), '2.0' );
	}
}
