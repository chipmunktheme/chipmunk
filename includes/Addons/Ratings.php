<?php

namespace Chipmunk\Addons;

use Chipmunk\Helpers;

/**
 * Adds a 5-star rating system to the theme
 *
 * @package WordPress
 * @subpackage Chipmunk
 */
class Ratings {

	/**
	 *
	 * @since 1.4
	 * @var string
	 */
	private static $init_transient = 'chipmunk_ratings_init';

	/**
	 * Allowed post types supporting the addon
	 *
	 * @var array
	 */
	static $allowed_types = array( 'post', 'resource' );

	/**
	 * Initializes the addon.
	 *
	 * To keep the initialization fast, only add filter and action
	 * hooks in the constructor.
	 *
	 * @return void
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'setup_addon' ) );
	}

	/**
	 * Page initialization
	 *
	 * Generates default post meta for all posts
	 */
	private function register_post_meta() {
		$posts = get_posts( array(
			'posts_per_page' => -1,
			'post_type'      => self::$allowed_types,
		) );

		foreach ( $posts as $post ) {
			$this->add_default_meta( $post->ID, self::$allowed_types );
		}
	}

	/**
	 * Sets the default values for posts
	 *
	 * @param string $post_id Post ID
	 *
	 * @return array
	*/
	private function add_default_meta( $post_ID, $allowed_types ) {
		$defaut_values = array(
			'_' . THEME_SLUG . '_rating_count'   => 0,
			'_' . THEME_SLUG . '_rating_average' => 0,
			'_' . THEME_SLUG . '_rating_rank'    => 0,
		);

		return \Chipmunk\Helpers::add_post_meta( $post_ID, $defaut_values, $allowed_types );
	}

	/**
 	 * Setup main components and features of the addon
	 *
	 * @return void
	 */
	public function setup_addon() {
		if ( ! Helpers::has_addon( 'ratings' ) ) {
			return;
		}

		if ( ! get_transient( self::$init_transient ) ) {
			// Register post meta
			$this->register_post_meta();

			// Set transient
			set_transient( self::$init_transient, true );
		}

		new Ratings\Actions();
		new Ratings\Renderers();
	}
}
