<?php
/**
 * Threaded comments
 *
 * @package WordPress
 * @subpackage Chipmunk
 */

if ( current_theme_supports( 'threaded-comments' ) ) {
	/**
	 * Theme configuration setup
	 * Load comment reply link in case of page and post pages
	 * if threaded comments are enabled
	 *
	 * @hook after_setup_theme
	 */
	function chipmunk_setup_comments() {
		// add threaded comments
		if ( ! is_admin() ) {
			if ( is_singular() && get_option( 'thread_comments' ) ) {
				wp_enqueue_script( 'comment-reply' );
			}
		}
	}

	add_action( 'after_setup_theme', 'chipmunk_setup_comments' );
}
