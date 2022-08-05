<?php

namespace Chipmunk\Core;

use WP_Query;
use Timber\Timber;
use MadeByLess\Lessi\Helper\HelperTrait;
use Chipmunk\Theme;
use Chipmunk\Extension\BookmarkExtension;
use Chipmunk\Extension\SubmissionExtension;
use Chipmunk\Extension\UpvoteExtension;

/**
 * Theme AJAX callbacks.
 */
class Actions extends Theme {
    use HelperTrait;

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
	 */
	public function loadPosts() {
		$context            = Timber::context();
		$queryVars          = json_decode( stripslashes( $this->getParam( 'queryVars' ) ), true );
		$queryVars['paged'] = $this->getParam( 'page' );

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
	 */
	public function submitResource() {
		// Validate nonce token.
		check_ajax_referer( 'submit_resource', 'nonce' );

		$submission = SubmissionExtension::getInstance();
		$submission->setData( $this->getParams() );
		$submission->process();
	}

	/**
	 * Processes bookmark callback.
	 */
	public function toggleBookmark() {
		$bookmark = BookmarkExtension::getInstance();
        $bookmark->setPostId( $this->getParam( 'actionPostId' ) );
		$bookmark->process();
	}

	/**
	 * Processes upvote callback.
	 */
	public function toggleUpvote() {
		$upvote = UpvoteExtension::getInstance();
        $upvote->setPostId( $this->getParam( 'actionPostId' ) );
		$upvote->process();
	}
}
