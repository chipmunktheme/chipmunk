<?php

namespace Chipmunk;

/**
 * Custom shortcodes
 *
 * @package WordPress
 * @subpackage Chipmunk
 */
class Shortcodes {

	/**
 	 * Used to register custom hooks
	 *
	 * @return void
	 */
	function __construct() {
		add_shortcode( 'chipmunk-counter', array( $this, 'render_counter' ) );
		add_shortcode( 'chipmunk-submit', array( $this, 'render_submit' ) );
	}

	/**
	 * Render the total count of resources
	 *
	 * @return string
	 */
	public static function render_counter( $atts, $content = null ) {
		// Parse shortcode attributes
		$attributes = shortcode_atts( array(
			'type'      => 'resource',
			'status'    => 'publish',
		), $atts );

		// Render the login form using an external template
		return self::get_shortcode_template( 'counter', $attributes );
	}

	/**
	 * Render the submit template
	 *
	 * @return string
	 */
	public static function render_submit( $atts, $content = null ) {
		// Parse shortcode attributes
		$attributes = shortcode_atts( array(
			'title' => '',
			'align' => '',
		), $atts );

		// Render the login form using an external template
		return self::get_shortcode_template( 'submit', $attributes );
	}

	/**
	 * Renders the contents of the given template to a string and returns it.
	 *
	 * @param string $template_name The name of the template to render (without .php)
	 * @param array  $attributes    The PHP variables for the template
	 *
	 * @return string               The contents of the template.
	 */
	private static function get_shortcode_template( $template_name, $attributes = null ) {
		if ( ! $attributes ) {
			$attributes = array();
		}

		ob_start();

		do_action( 'chipmunk_shortcode_template_before_' . $template_name );

		Helpers::get_template_part( 'shortcodes/' . $template_name, array( 'attributes' => $attributes ) );

		do_action( 'chipmunk_shortcode_template_after_' . $template_name );

		return trim( ob_get_clean() );
	}
}
