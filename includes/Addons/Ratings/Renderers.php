<?php

namespace Chipmunk\Addons\Ratings;

use Timber\Timber;
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
		if ( Helpers::isOptionEnabled( 'ratings', 'resource', false ) ) {
			add_action( 'chipmunk_resource_extras', [ $this, 'render_rating_form' ] );
		}

		if ( Helpers::isOptionEnabled( 'ratings', 'post', false ) ) {
			add_action( 'chipmunk_post_extras', [ $this, 'render_rating_form' ] );
		}
	}

	/**
	 * A function for rendering the rating form.
	 *
	 * @return string  The template output
	 */
	public function render_rating_form() {
		$context = Timber::context();
		$ratings = new Ratings( get_the_ID() );

		$context['ratings'] 	= $ratings->get_ratings();
		$context['summary'] 	= $ratings->get_ratings_summary();
		$context['max_rating'] 	= $ratings->get_max_rating();

		// Render form template
		Timber::render( 'addons/ratings/rating-form.twig', $context );
	}
}
