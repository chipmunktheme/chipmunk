<?php
/**
 * Custom config actions
 *
 * @package WordPress
 * @subpackage Chipmunk
 */

if ( ! function_exists( 'chipmunk_acf_settings_url' ) ) :
	/**
	 * Customize the url setting to fix incorrect asset URLs.
	 */
	function chipmunk_acf_settings_url( $url ) {
		return CHIPMUNK_ACF_URL;
	}
endif;
add_filter( 'acf/settings/url', 'chipmunk_acf_settings_url' );


if ( ! function_exists( 'chipmunk_acf_settings_show_admin' ) ) :
	/**
	 * Hide the ACF admin menu item.
	 */
	function chipmunk_acf_settings_show_admin( $show_admin ) {
		return true;
	}
endif;
add_filter( 'acf/settings/show_admin', 'chipmunk_acf_settings_show_admin' );
