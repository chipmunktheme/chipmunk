<?php
/**
 * Menus
 *
 * @package WordPress
 * @subpackage Chipmunk
 */

if ( current_theme_supports( 'menus' ) ) {
	$menus = get_theme_support( 'menus' );

	// if some parameters have been added to the menus
	if ( is_array( $menus[0] ) ) {
		$menus = $menus[0];
	}

	register_nav_menus( $menus );
	add_theme_support( 'menus' );
}
