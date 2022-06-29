<?php

namespace Chipmunk\Addons\Importer;

use Chipmunk\Helpers as ChipmunkHelpers;

/**
 * Imports a large amount of resources from a CSV file.
 *
 * @package WordPress
 * @subpackage Chipmunk
 */
class Init {

	/**
	 * Initializes the addon.
	 *
	 * To keep the initialization fast, only add filter and action
	 * hooks in the constructor.
	 *
	 * @return void
	 */
	public function __construct( $config = array() ) {
		// Set config defaults
		$this->config = wp_parse_args( $config, array(
			'name'         => '',
			'slug'         => '',
			'excerpt'      => '',
			'url'          => '',
		) );

		$this->transient = THEME_SLUG . '_' . $this->config['slug'] . '_init';

		// Set hooks
		$this->hooks();
	}

	/**
	 * Setup hooks
	 *
	 * @return  void
	 */
	private function hooks() {
		add_action( 'init', array( $this, 'setup_addon' ) );
		add_filter( 'chipmunk_settings_addons', array( $this, 'add_settings_addon' ) );
	}

	/**
	 * Page initialization
	 *
	 * Creates all WordPress pages needed by the addon.
	 */
	private function register_pages() {
	}

	/**
 	 * Setup main components and features of the addon
	 *
	 * @return void
	 */
	public function setup_addon() {
		if ( ! ChipmunkHelpers::is_addon_enabled( $this->config['slug'] ) ) {
			return;
		}

		if ( ! get_transient( $this->transient ) ) {
			// Register post meta
			$this->register_pages();

			// Set transient
			set_transient( $this->transient, true );
		}

		new Actions();
		new Config();
		new Redirects();
		new Renderers();
		new Settings( $this->config );
	}

	/**
 	 * Add settings addon component
	 *
	 * @return array
	 */
	public function add_settings_addon( $addons ) {
		$addons[] = $this->config;

		return $addons;
	}
}
