<?php

namespace Chipmunk\Config;

use Chipmunk\Customizer;
use Chipmunk\Helpers;

/**
 * Miscellaneous config hooks
 *
 * @package WordPress
 * @subpackage Chipmunk
 */
class Misc {

	/**
 	 * Used to register custom hooks
	 */
	function __construct() {
		add_action( 'wp_insert_post', [ $this, 'addDefaultMeta' ] );
		add_action( 'after_setup_theme', [ $this, 'setupComments' ] );
		add_filter( 'the_content', [ $this, 'normalizeContentWhitespace' ], 10, 1 );
		add_filter( 'user_contactmethods', [ $this, 'addContactMethods' ], 99, 2 );
	}

	/**
	 * Set default meta values for likes, upvotes and ratings
	 *
	 * @return mixed
	 */
	public static function addDefaultMeta( $postId ) {
		$defaut = [
			'_' . THEME_SLUG . '_post_view_count'   => 0,
			'_' . THEME_SLUG . '_upvote_count'      => 0,
		];

		if ( Helpers::isAddonEnabled( 'ratings' ) ) {
			$defaut = array_merge( $defaut, [
				'_' . THEME_SLUG . '_rating_count'   => 0,
				'_' . THEME_SLUG . '_rating_average' => 0,
				'_' . THEME_SLUG . '_rating_rank'    => 0,
			] );
		}

		return Helpers::addPostMeta( $postId, $defaut, [ 'post', 'resource' ] );
	}

	/**
	 * Theme configuration setup
	 * Load comment reply link in case of page and post pages
	 * if threaded comments are enabled
	 *
	 * @hook after_setup_theme
	 */
	public static function setupComments() {
		// add threaded comments
		if ( ! is_admin() ) {
			if ( is_singular() && get_option( 'thread_comments' ) ) {
				wp_enqueue_script( 'comment-reply' );
			}
		}
	}

	/**
	 * Normalize EOL characters and strip duplicate whitespace.
	 *
	 * @return string
	 */
	public static function normalizeContentWhitespace( $content ) {
		return normalize_whitespace( $content );
	}

	/**
	 * Changes the user contact methods
	 *
	 * @return array
	 */
	public static function addContactMethods() {
		$socials = Customizer::getSocials();
		$socials = array_filter( $socials, fn( $el ) => $el != 'Email' );
		$socialKeys = array_map( fn( $el ) => sanitize_title( $socials[ $el ] ), array_keys( $socials ) );

		return array_combine( $socialKeys, $socials );
	}
}
