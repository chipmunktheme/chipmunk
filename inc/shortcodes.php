<?php
/**
 * Shortcode functionality
 *
 * @package WordPress
 * @subpackage Chipmunk
 */

if ( ! function_exists( 'chipmunk_render_curators' ) ) :
	/**
	 * Render the curators list
	 */
	function chipmunk_render_curators( $atts, $content = null ) {
		// Parse shortcode attributes
		$attributes = shortcode_atts( array(
			'title' => '',
		), $atts );

		// Render the login form using an external template
		return chipmunk_get_shortcode_template( 'curators', $attributes );
	}
endif;
add_shortcode( 'chipmunk-curators', 'chipmunk_render_curators' );


if ( ! function_exists( 'chipmunk_render_submit' ) ) :
	/**
	 * Render the submit list
	 */
	function chipmunk_render_submit( $atts, $content = null ) {
		// Parse shortcode attributes
		$attributes = shortcode_atts( array(
			'title' => '',
		), $atts );

		// Render the login form using an external template
		return chipmunk_get_shortcode_template( 'submit', $attributes );
	}
endif;
add_shortcode( 'chipmunk-submit', 'chipmunk_render_submit' );


if ( ! function_exists( 'chipmunk_get_shortcode_template' ) ) :
	/**
	 * Renders the contents of the given template to a string and returns it.
	 *
	 * @param string $template_name The name of the template to render (without .php)
	 * @param array  $attributes    The PHP variables for the template
	 *
	 * @return string               The contents of the template.
	 */
	function chipmunk_get_shortcode_template( $template_name, $attributes = null ) {
		if ( ! $attributes ) {
			$attributes = array();
		}

		ob_start();

		do_action( 'chipmunk_shortcode_template_before_' . $template_name );

		chipmunk_get_template( 'shortcodes/' . $template_name, array( 'attributes' => $attributes ) );

		do_action( 'chipmunk_shortcode_template_after_' . $template_name );

		return ob_get_clean();
	}
endif;
