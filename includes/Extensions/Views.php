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
	public static function getViews( $id ) {
		$dbKey = '_chipmunk_post_view_count';
		$count = get_post_meta( $id, $dbKey, true );

		if ( $count == '' ) {
			delete_post_meta( $id, $dbKey );
			add_post_meta( $id, $dbKey, '0' );
			return 0;
		}

		return $count;
	}

	/**
	 * Increase the view counter
	 *
	 * @param $id Post ID number
	 */
	public static function setViews( $id ) {
		$dbKey = '_chipmunk_post_view_count';
		$count = get_post_meta( $id, $dbKey, true );

		if ( $count == '' ) {
			$count = 0;
			delete_post_meta( $id, $dbKey );
			add_post_meta( $id, $dbKey, 0 );
		} else {
			if ( ! isset( $_COOKIE[ $dbKey . '-' . $id ] ) ) {
				$count++;
				update_post_meta( $id, $dbKey, $count );

				if ( ! Helpers::getOption( 'disable_cookies' ) ) {
					setcookie( $dbKey . '-' . $id, true );
				}
			}
		}
	}
}
