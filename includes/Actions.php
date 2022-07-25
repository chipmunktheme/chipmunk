<?php

namespace Chipmunk;

use WP_Query;
use Timber\Timber;
use Chipmunk\Extensions\Bookmarks;
use Chipmunk\Extensions\Submissions;
use Chipmunk\Extensions\Upvotes;

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
	public function __construct() {
		// Lazy loading posts
		add_action( 'wp_ajax_chipmunk_load_posts', [ $this, 'loadPosts' ] );
		add_action( 'wp_ajax_nopriv_chipmunk_load_posts', [ $this, 'loadPosts' ] );

		// Submissions
		add_action( 'wp_ajax_chipmunk_submit_resource', [ $this, 'submitResource' ] );
		add_action( 'wp_ajax_nopriv_chipmunk_submit_resource', [ $this, 'submitResource' ] );

		// Bookmarks
		add_action( 'wp_ajax_chipmunk_toggle_bookmark', [ $this, 'toggleBookmark' ] );
		add_action( 'wp_ajax_nopriv_chipmunk_toggle_bookmark', [ $this, 'toggleBookmark' ] );

		// Upvotes
		add_action( 'wp_ajax_chipmunk_toggle_upvote', [ $this, 'toggleUpvote' ] );
		add_action( 'wp_ajax_nopriv_chipmunk_toggle_upvote', [ $this, 'toggleUpvote' ] );
	}

	/**
	 * Process lazy loading posts
	 */
	public static function loadPosts() {
		$context            = Timber::context();
		$queryVars          = json_decode( stripslashes( $_REQUEST['queryVars'] ), true );
		$queryVars['paged'] = $_REQUEST['page'];

		$query               = new WP_Query( $queryVars );
		$GLOBALS['wp_query'] = $query;

		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) :
				$query->the_post();
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
	 * Process submission callback
	 */
	public static function submitResource() {
		// Validate nonce token.
		check_ajax_referer( 'submit_resource', 'nonce' );

		$submissions = new Submissions( $_REQUEST );
		$submissions->process();
	}

	/**
	 * Process bookmark callback
	 */
	public static function toggleBookmark() {
		$bookmarks = new Bookmarks( $_REQUEST['actionPostId'] );
		$bookmarks->process();
	}

	/**
	 * Process upvote callback
	 */
	public static function toggleUpvote() {
		$upvotes = new Upvotes( $_REQUEST['actionPostId'] );
		$upvotes->process();
	}
}
