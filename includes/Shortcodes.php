<?php

namespace Chipmunk;

use Timber\Timber;

/**
 * Custom shortcodes
 *
 * @package WordPress
 * @subpackage Chipmunk
 */
class Shortcodes {

	/**
	 * Used to register custom hooks
	 */
	function __construct() {
		add_shortcode( 'chipmunk-counter', array( $this, 'renderCounter' ) );
		add_shortcode( 'chipmunk-submit', array( $this, 'renderSubmit' ) );
	}

	/**
	 * Render the total count of resources
	 *
	 * @return string
	 */
	public function renderCounter( $atts, $content = null ) {
		// Parse shortcode attributes
		$atts = shortcode_atts(
			array(
				'type'   => 'resource',
				'status' => 'publish',
			),
			$atts
		);

		return Timber::compile( 'shortcodes/counter.twig', array_merge( Timber::context(), $atts ) );
	}

	/**
	 * Render the submit template
	 *
	 * @return string
	 */
	public function renderSubmit( $atts, $content = null ) {
		// Parse shortcode attributes
		$atts = shortcode_atts(
			array(
				'title' => '',
			),
			$atts
		);

		return Timber::compile( 'shortcodes/counter.twig', array_merge( Timber::context(), $atts ) );
	}
}
