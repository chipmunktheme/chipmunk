<?php

namespace Chipmunk\Addons\Ratings;

use Chipmunk\Helpers;

/**
 * Initializes the plugin renderers.
 *
 * @package WordPress
 * @subpackage Chipmunk
 */
class Renderers {

	/**
 	 * Class constructor
	 */
	public function __construct() {
		if ( Helpers::is_feature_enabled( 'ratings', 'resource', false ) ) {
			add_action( 'chipmunk_resource_extras', [ $this, 'render_rating_form' ] );
		}

		if ( Helpers::is_feature_enabled( 'ratings', 'post', false ) ) {
			add_action( 'chipmunk_post_extras', [ $this, 'render_rating_form' ] );
		}
	}

	/**
	 * A function for rendering the rating form.
	 *
	 * @return string  The template output
	 */
	public function render_rating_form() {
		$ratings = new Ratings( get_the_ID() );

		// Render form template
		Helpers::get_template_part( 'addons/ratings/rating-form', [
			'ratings'    => $ratings->get_ratings(),
			'summary'    => $ratings->get_ratings_summary(),
			'max_rating' => $ratings->get_max_rating(),
		], true );
	}
}
