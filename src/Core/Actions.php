<?php

namespace Chipmunk\Core;

use WP_Query;
use Timber\Timber;
use Chipmunk\Theme;
use Chipmunk\Extensions\Bookmarks;
use Chipmunk\Extensions\Submissions;
use Chipmunk\Extensions\Upvotes;

/**
 * Theme AJAX callbacks.
 */
class Actions extends Theme {

	/**
	 * Class constructor.
	 */
	public function __construct() {}

	/**
	 * Hooks methods of this object into the WordPress ecosystem.
	 */
	public function initialize() {
		$this->addAjaxAction( 'load_posts', [ $this, 'loadPosts' ] );
		$this->addAjaxAction( 'submit_resource', [ $this, 'submitResource' ] );
		$this->addAjaxAction( 'toggle_bookmark', [ $this, 'toggleBookmark' ] );
		$this->addAjaxAction( 'toggle_upvote', [ $this, 'toggleUpvote' ] );
	}

	/**
	 * Processes lazy loading posts.
	 *
	 * @see https://developer.wordpress.org/reference/hooks/load_posts
	 */
	public function loadPosts() {
		$context            = Timber::context();
		$queryVars          = json_decode( stripslashes( $_REQUEST['queryVars'] ), true );
		$queryVars['paged'] = $_REQUEST['page'];

		$query               = new WP_Query( $queryVars );
		$GLOBALS['wp_query'] = $query;

		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) :
				$query->the_post();

				// TODO: Make sure it returns correct template based on the query params
				if ( isset( $query->query['s'] ) ) {
					wp_send_json_success( Timber::compile( 'entry/' . get_post_type() . '.twig', $context ) );
				} else {
					wp_send_json_success( Timber::compile( 'tile/' . get_post_type() . '.twig', $context ) );
				}
			endwhile;
		}

		wp_send_json_error( __( 'No more results found.', 'chipmunk' ) );
	}

	/**
	 * Processes submission callback.
	 *
	 * @see https://developer.wordpress.org/reference/hooks/submit_resource
	 */
	public function submitResource() {
		// Validate nonce token.
		check_ajax_referer( 'submit_resource', 'nonce' );

		$submissions = new Submissions( $_REQUEST );
		$submissions->process();
	}

	/**
	 * Processes bookmark callback.
	 *
	 * @see https://developer.wordpress.org/reference/hooks/toggle_bookmark
	 */
	public function toggleBookmark() {
		$bookmarks = new Bookmarks( $_REQUEST['actionPostId'] );
		$bookmarks->process();
	}

	/**
	 * Processes upvote callback.
	 *
	 * @see https://developer.wordpress.org/reference/hooks/toggle_upvote
	 */
	public function toggleUpvote() {
		$upvotes = new Upvotes( $_REQUEST['actionPostId'] );
		$upvotes->process();
	}
}
