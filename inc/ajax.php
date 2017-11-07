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

	// If the reCAPTCHA is configured and not verified, prevent autosubmission
	if ( ! chipmunk_verify_recaptcha( $_REQUEST['g-recaptcha-response'] ) ) {
		wp_send_json_error( esc_html__( 'Please verify that you are not a robot.', 'chipmunk' ) );
	}

	if ( ! empty( $_REQUEST['name'] ) ) {
		$meta_prefix = '_' . THEME_SLUG . '_resource';
		$meta_input = array();

		$meta_input[$meta_prefix . '_website'] = esc_url( wp_filter_nohtml_kses( $_REQUEST['website'] ) );
		$collection = intval( wp_filter_kses( $_REQUEST['collection'] ) );

		if ( ! chipmunk_theme_option( 'disable_submitter_info' ) ) {
			$submitter_name = wp_filter_nohtml_kses( $_REQUEST['submitter_name'] );
			$submitter_email = wp_filter_nohtml_kses( $_REQUEST['submitter_email'] );

			if ( ! empty( $submitter_name ) && ! empty( $submitter_email ) ) {
				$meta_input[$meta_prefix . '_submitter'] = "{$submitter_name} <{$submitter_email}>";
			}
		}

		$post_object = array(
			'post_type'     => 'resource',
			'post_status'   => 'pending',
			'post_title'    => wp_filter_nohtml_kses( $_REQUEST['name'] ),
			'post_content'  => wp_kses_post( wpautop( $_REQUEST['content'] ) ),
			'meta_input'    => $meta_input,
		);

		if ( $post_id = wp_insert_post( $post_object) ) {
			// Insert taxonomy information
			wp_set_object_terms( $post_id, $collection, 'resource-collection' );

			// Send email to website admin
			if ( chipmunk_theme_option( 'inform_about_submissions' ) ) {
				chipmunk_inform_admin( $post_id );
			}

			// Success
			wp_send_json_success( chipmunk_theme_option( 'submission_thanks' ) );
		}

		// Failure during wp_insert_post
		else wp_send_json_error( chipmunk_theme_option( 'submission_failure' ) );
	}

	// Failure due to incorrect nonce verification
	else wp_send_json_error( chipmunk_theme_option( 'submission_failure' ) );
}
endif;
add_action( 'wp_ajax_submit_resource', 'chipmunk_submit_resource' );
add_action( 'wp_ajax_nopriv_submit_resource', 'chipmunk_submit_resource' );


if ( ! function_exists( 'chipmunk_submit_upvote' ) ) :
/**
 * Process upvote callback
 */
function chipmunk_submit_upvote() {
	chipmunk_verify_nonce();

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


if ( ! function_exists( 'chipmunk_inform_admin' ) ) :
/**
 * Send email to website owner after resource is submitted
 */
function chipmunk_inform_admin( $post_id ) {
	$to       = get_bloginfo( 'admin_email' );
	$from     = 'admin@'.$_SERVER['SERVER_NAME'];
	$name     = get_bloginfo( 'name' );
	$subject  = get_bloginfo( 'name' ) . ': ' . esc_html__( 'New user submission', 'chipmunk' );
	$post_url = admin_url( 'post.php?post=' . $post_id . '&action=edit' );
	$template = '<a href="' . $post_url . '">' . esc_html__( 'Review submission', 'chipmunk' ) . '</a>';

	$headers  = array(
		"Content-Type: text/html; charset=UTF-8;",
		"From: $name <$from>",
	);

	wp_mail( $to, $subject, $template, implode( "\n", $headers ) );
}
endif;


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
