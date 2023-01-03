<?php

namespace Chipmunk\Addons\Ratings;

use Timber\Timber;
use Chipmunk\Helpers;

/**
 * Initializes the plugin renderers.
 */
class Renderers {

	/**
	 * Class constructor
	 */
	public function __construct() {
		if ( Helpers::isOptionEnabled( 'ratings', 'resource', false ) ) {
			add_action( 'chipmunk_resource_extras', [ $this, 'renderRatingForm' ] );
		}

		if ( Helpers::isOptionEnabled( 'ratings', 'post', false ) ) {
			add_action( 'chipmunk_post_extras', [ $this, 'renderRatingForm' ] );
		}
	}

	/**
	 * A function for rendering the rating form.
	 *
	 * @return string  The template output
	 */
	public function renderRatingForm() {
		$context = Timber::context();
		$ratings = new Ratings( get_the_ID() );

		$context['ratings']    = $ratings->getRatings();
		$context['summary']    = $ratings->getRatingsSummary();
		$context['max_rating'] = $ratings->getMaxRating();

		// Render form template
		Timber::render( 'addons/ratings/rating-form.twig', $context );
	}
}
