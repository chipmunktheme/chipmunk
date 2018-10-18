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
        chipmunk_verify_nonce();

        $submission_form = new SubmissionForm( $_REQUEST );
        $submission_form->submit();
    }
endif;
add_action( 'wp_ajax_submit_resource', 'chipmunk_submit_resource' );
add_action( 'wp_ajax_nopriv_submit_resource', 'chipmunk_submit_resource' );


if ( ! function_exists( 'chipmunk_submit_upvote' ) ) :
    /**
     * Process upvote callback
     */
    function chipmunk_submit_upvote() {
        // Get post ID
        $post_id = ( isset( $_REQUEST['postId'] ) && is_numeric( $_REQUEST['postId'] ) ) ? intval( wp_filter_kses( $_REQUEST['postId'] ) ) : null;

        if ( $post_id ) {
            // Process the user upvote
            chipmunk_process_upvote( $post_id );
        }
    }
endif;
add_action( 'wp_ajax_submit_upvote', 'chipmunk_submit_upvote' );
add_action( 'wp_ajax_nopriv_submit_upvote', 'chipmunk_submit_upvote' );


if ( ! function_exists( 'chipmunk_load_posts' ) ) :
    /**
     * Form callback
     */
    function chipmunk_load_posts() {
        $template = '';

        $query = new WP_Query( array(
            'posts_per_page'      => $_REQUEST['limit'],
            'paged'               => $_REQUEST['page'],
            'post_type'           => $_REQUEST['postType'],
            'post_status'         => 'publish',
            'post__not_in'        => array( $_REQUEST['exclude'] ),
            'ignore_sticky_posts' => true,
        ) );

        if ( $query->have_posts() ) {
            while ( $query->have_posts() ) : $query->the_post();
                $template .= chipmunk_get_template( "sections/{$_REQUEST['postType']}-tile", array(), false );
            endwhile;

            if ( ! empty( $template ) ) {
                wp_send_json_success( $template );
            }
        }

        wp_send_json_error( __( 'No more results found.', 'chipmunk' ) );
    }
endif;
add_action( 'wp_ajax_load_posts', 'chipmunk_load_posts' );
add_action( 'wp_ajax_nopriv_load_posts', 'chipmunk_load_posts' );


if ( ! function_exists( 'chipmunk_verify_nonce' ) ) :
    /**
     * Secure callbacks by verifying WP Nonce
     */
    function chipmunk_verify_nonce() {
        $nonce = isset( $_REQUEST['nonce'] ) ? sanitize_text_field( $_REQUEST['nonce'] ) : null;

        if ( ! $nonce || ! wp_verify_nonce( $nonce, $_REQUEST['action'] ) ) {
            wp_send_json_error( esc_html__( 'Not permitted.', 'chipmunk' ) );
        }
    }
endif;
