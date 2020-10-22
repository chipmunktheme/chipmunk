<?php
/**
 * AJAX Callbacks
 *
 * @package WordPress
 * @subpackage Chipmunk
 */

if ( ! function_exists( 'chipmunk_submit_resource' ) ) :
	/**
	 * Submit resource callback
	 */
	function chipmunk_submit_resource() {
		// Validate nonce token.
		check_ajax_referer( 'submit_resource', 'nonce' );

		$submission_form = new SubmissionForm( $_REQUEST );
		$submission_form->submit();
	}
endif;
add_action( 'wp_ajax_chipmunk_submit_resource', 'chipmunk_submit_resource' );
add_action( 'wp_ajax_nopriv_chipmunk_submit_resource', 'chipmunk_submit_resource' );


if ( ! function_exists( 'chipmunk_load_posts' ) ) :
	/**
	 * Form callback
	 */
	function chipmunk_load_posts() {
		$template = '';

		$query_vars = json_decode( stripslashes( $_REQUEST['queryVars'] ), true );
		$query_vars['paged'] = $_REQUEST['page'];

		$query = new WP_Query( $query_vars );
		$GLOBALS['wp_query'] = $query;

		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) : $query->the_post();
				if ( isset( $query->query['s'] ) ) {
					$template .= chipmunk_get_template_part( array( 'sections/entry', 'resource' ), array(), false );
				}
				else {
					$template .= chipmunk_get_template_part( 'sections/' . get_post_type(). '-tile', array(), false );
				}
			endwhile;
		}

		if ( ! empty( $template ) ) {
			wp_send_json_success( $template );
		}

		wp_send_json_error( __( 'No more results found.', 'chipmunk' ) );
	}
endif;
add_action( 'wp_ajax_chipmunk_load_posts', 'chipmunk_load_posts' );
add_action( 'wp_ajax_nopriv_chipmunk_load_posts', 'chipmunk_load_posts' );


if ( ! function_exists( 'chipmunk_toggle_bookmark' ) ) :
    /**
     * Process bookmark callback
     */
    function chipmunk_toggle_bookmark() {
        $bookmarks = new ChipmunkBookmarks( $_REQUEST['actionPostId'] );
        $bookmarks->process();
    }
endif;
add_action( 'wp_ajax_chipmunk_toggle_bookmark', 'chipmunk_toggle_bookmark' );
add_action( 'wp_ajax_nopriv_chipmunk_toggle_bookmark', 'chipmunk_toggle_bookmark' );


if ( ! function_exists( 'chipmunk_toggle_upvote' ) ) :
	/**
	 * Process upvote callback
	 */
	function chipmunk_toggle_upvote() {
        $upvotes = new ChipmunkUpvotes( $_REQUEST['actionPostId'] );
		$upvotes->process();
	}
endif;
add_action( 'wp_ajax_chipmunk_toggle_upvote', 'chipmunk_toggle_upvote' );
add_action( 'wp_ajax_nopriv_chipmunk_toggle_upvote', 'chipmunk_toggle_upvote' );
