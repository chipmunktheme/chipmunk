<?php

namespace Chipmunk\Addons\Ratings;

use Chipmunk\Helpers;

/**
 * Adds a 5-star rating system to the theme
 *
 * @package WordPress
 * @subpackage Chipmunk
 */
class Init {

	/**
	 * Allowed post types supporting ChipmunkRatings
	 *
	 * @since 1.0
	 * @var array
	 */
	private $allowedTypes = array( 'post', 'resource' );

	/**
	 * Initializes the addon.
	 *
	 * To keep the initialization fast, only add filter and action
	 * hooks in the constructor.
	 */
	function __construct( $config = array() ) {
		// Set config defaults
		$this->config = wp_parse_args(
			$config,
			array(
				'name'    => '',
				'slug'    => '',
				'excerpt' => '',
				'url'     => '',
			)
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
		add_action( 'init', array( $this, 'setupAddon' ) );
		add_filter( 'chipmunk_settings_addons', array( $this, 'addSettingsAddon' ) );
	}

	/**
	 * Page initialization
	 *
	 * Generates default post meta for all posts
	 */
	private function registerPostMeta() {
		$posts = get_posts(
			array(
				'posts_per_page' => -1,
				'post_type'      => $this->allowedTypes,
			)
		);

		foreach ( $posts as $post ) {
			$this->addDefaultMeta( $post->ID, $this->allowedTypes );
		}
	}

	/**
	 * Sets the default values for posts
	 *
	 * @param string $postId Post ID
	 *
	 * @return array
	 */
	private function addDefaultMeta( $postId, $allowedTypes ) {
		$defaut = array(
			'_' . THEME_SLUG . '_rating_count'   => 0,
			'_' . THEME_SLUG . '_rating_average' => 0,
			'_' . THEME_SLUG . '_rating_rank'    => 0,
		);

		return Helpers::addPostMeta( $postId, $defaut, $allowedTypes );
	}

	/**
	 * Setup main components and features of the addon
	 */
	public function setupAddon() {
		if ( ! Helpers::isAddonEnabled( $this->config['slug'] ) ) {
			return null;
		}

		if ( ! get_transient( $this->transient ) ) {
			// Register post meta
			$this->registerPostMeta();

			// Set transient
			set_transient( $this->transient, true );
		}

		new Actions();
		new Renderers();
	}

	/**
	 * Add settings addon component
	 *
	 * @return array
	 */
	public function addSettingsAddon( $addons ) {
		$addons[] = $this->config;

		return $addons;
	}
}
