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
	 */
	public function __construct( $config = [] ) {
		// Set config defaults
		$this->config = wp_parse_args(
			$config,
			[
				'name'    => '',
				'slug'    => '',
				'excerpt' => '',
				'url'     => '',
			]
		);

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
		add_action( 'init', [ $this, 'setup_addon' ] );
		add_filter( 'chipmunk_settings_addons', [ $this, 'add_settings_addon' ] );
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
	 */
	public function setup_addon() {
		if ( ! ChipmunkHelpers::isAddonEnabled( $this->config['slug'] ) ) {
			return null;
		}

		if ( ! get_transient( $this->transient ) ) {
			// Register post meta
			$this->register_pages();

			// Set transient
			set_transient( $this->transient, true );
		}

		new Actions();
		new Config();
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
