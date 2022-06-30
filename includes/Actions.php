<?php

namespace Chipmunk;

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
		// Lazy loading posts
		add_action( 'wp_ajax_chipmunk_load_posts', [ $this, 'load_posts' ] );
		add_action( 'wp_ajax_nopriv_chipmunk_load_posts', [ $this, 'load_posts' ] );

		// Submissions
		add_action( 'wp_ajax_chipmunk_submit_resource', [ $this, 'submit_resource' ] );
		add_action( 'wp_ajax_nopriv_chipmunk_submit_resource', [ $this, 'submit_resource' ] );

		// Bookmarks
		add_action( 'wp_ajax_chipmunk_toggle_bookmark', [ $this, 'toggle_bookmark' ] );
		add_action( 'wp_ajax_nopriv_chipmunk_toggle_bookmark', [ $this, 'toggle_bookmark' ] );

		// Upvotes
		add_action( 'wp_ajax_chipmunk_toggle_upvote', [ $this, 'toggle_upvote' ] );
		add_action( 'wp_ajax_nopriv_chipmunk_toggle_upvote', [ $this, 'toggle_upvote' ] );
	}

	/**
	 * Process lazy loading posts
	 */
	public static function load_posts() {
		$template = '';

		$query_vars = json_decode( stripslashes( $_REQUEST['queryVars'] ), true );
		$query_vars['paged'] = $_REQUEST['page'];

		$query = new \WP_Query( $query_vars );
		$GLOBALS['wp_query'] = $query;

		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) : $query->the_post();
				if ( isset( $query->query['s'] ) ) {
					$template .= Helpers::get_template_part( [ 'sections/entry', 'resource' ], [], false );
				}
				else {
					$template .= Helpers::get_template_part( 'sections/tile-' . get_post_type(), [], false );
				}
			endwhile;
		}

		if ( ! empty( $template ) ) {
			wp_send_json_success( $template );
		}

		wp_send_json_error( __( 'No more results found.', 'chipmunk' ) );
	}

	/**
	 * Process submission callback
	 */
	public static function submit_resource() {
		// Validate nonce token.
		check_ajax_referer( 'submit_resource', 'nonce' );

		$submissions = new Extensions\Submissions( $_REQUEST );
		$submissions->process();
	}

	/**
	 * Process bookmark callback
	 */
	public static function toggle_bookmark() {
        $bookmarks = new Extensions\Bookmarks( $_REQUEST['actionPostId'] );
        $bookmarks->process();
	}

	/**
	 * Process upvote callback
	 */
	public static function toggle_upvote() {
        $upvotes = new Extensions\Upvotes( $_REQUEST['actionPostId'] );
		$upvotes->process();
	}
}
