<?php
/**
 * View count functionality
 *
 * @package WordPress
 * @subpackage Chipmunk
 */

if ( ! function_exists( 'chipmunk_get_views' ) ) :
	/**
	 * Retrieve current view counter
	 */
	function chipmunk_get_views( $id ) {
		$db_key = '_chipmunk_post_view_count';
		$count = get_post_meta( $id, $db_key, true );

		if ( $count == '' ) {
			delete_post_meta( $id, $db_key );
			add_post_meta( $id, $db_key, '0' );
			return 0;
		}

		return $count;
	}
endif;


if ( ! function_exists( 'chipmunk_set_views' ) ) :
	/**
	 * Increase the view counter
	 */
	function chipmunk_set_views( $id ) {
		$db_key = '_chipmunk_post_view_count';
		$count = get_post_meta( $id, $db_key, true );

		if ( $count == '' ) {
			$count = 0;
			delete_post_meta( $id, $db_key );
			add_post_meta( $id, $db_key, 0 );
		}
		else {
			if ( ! isset( $_COOKIE[$db_key . '-' . $id] ) ) {
				$count++;
				update_post_meta( $id, $db_key, $count );

				if ( ! chipmunk_theme_option( 'disable_cookies' ) ) {
					setcookie( $db_key . '-' . $id, true );
				}
			}
		}
	}
endif;
