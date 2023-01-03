<?php

namespace Chipmunk\Addons\Ratings;

/**
 * AJAX action callbacks
 */
class Actions {

	/**
	 * Class constructor
	 */
	public function __construct() {
		// Handlers for ajax actions
		add_action( 'wp_ajax_chipmunk_submit_rating', [ $this, 'submitRating' ] );
		add_action( 'wp_ajax_nopriv_chipmunk_submit_rating', [ $this, 'submitRating' ] );
	}

	/**
	 * Process rating submission callback
	 */
	public function submitRating() {
		$ratings = new Ratings( $_REQUEST['actionPostId'], $_REQUEST['actionRating'] );
		$ratings->process();
	}
}
