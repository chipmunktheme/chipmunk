<?php

namespace Chipmunk\Extensions;

use Chipmunk\Helpers;
use Chipmunk\Customizer;

/**
 * View count functionality
 *
 * @package WordPress
 * @subpackage Chipmunk
 */
class Views {

	/**
	 * Retrieve current view counter
	 *
	 * @param $id Post ID number
	 *
	 * @return int
	 */
	public static function get_views( $id ) {
		$db_key = '_chipmunk_post_view_count';
		$count = get_post_meta( $id, $db_key, true );

		if ( $count == '' ) {
			delete_post_meta( $id, $db_key );
			add_post_meta( $id, $db_key, '0' );
			return 0;
		}

		return $count;
	}

	/**
	 * Increase the view counter
	 *
	 * @param $id Post ID number
	 *
	 * @return void
	 */
	public static function set_views( $id ) {
		$db_key = '_chipmunk_post_view_count';
		$count = get_post_meta( $id, $db_key, true );

		if ( $count == '' ) {
			$count = 0;
			delete_post_meta( $id, $db_key );
			add_post_meta( $id, $db_key, 0 );
		}
		else {
			if ( ! isset( $_COOKIE[ $db_key . '-' . $id ] ) ) {
				$count++;
				update_post_meta( $id, $db_key, $count );

				if ( ! Helpers::get_theme_option( 'disable_cookies' ) ) {
					setcookie( $db_key . '-' . $id, true );
				}
			}
		}
	}
}
