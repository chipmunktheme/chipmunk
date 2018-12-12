<?php
/**
 * Sidebars
 *
 * @package WordPress
 * @subpackage Murisor
 */

if ( current_theme_supports( 'sidebars' ) ) {
	$sidebars = get_theme_support( 'sidebars' );

	// if some parameters have been added to the sidebars
	if ( is_array( $sidebars[0] ) ) {
		$sidebars = $sidebars[0];

		$defaults = array(
			'before_widget' => '<div class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget__title">',
			'after_title'   => '</h3>'
		);

		// iterate through the sidebars array and register specific sidebar
		foreach ( $sidebars as $key => $sidebar ) {
			$args = wp_parse_args( $sidebar, $defaults );

			register_sidebar( wp_parse_args( array( 'id' => $key ), $args ) );
		}
	}
}
