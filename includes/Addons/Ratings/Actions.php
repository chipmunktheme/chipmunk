<?php

namespace Chipmunk\Addons\Ratings;

/**
 * AJAX action callbacks
 *
 * @package WordPress
 * @subpackage Chipmunk
 */
class Actions {

	/**
	 * Class constructor
	 */
	function __construct() {
		// Handlers for ajax actions
		add_action( 'wp_ajax_chipmunk_submit_rating', array( $this, 'submitRating' ) );
		add_action( 'wp_ajax_nopriv_chipmunk_submit_rating', array( $this, 'submitRating' ) );
	}

	/**
	 * Process rating submission callback
	 */
	public function submitRating() {
		$ratings = new Ratings( $_REQUEST['actionPostId'], $_REQUEST['actionRating'] );
		$ratings->process();
	}
}
