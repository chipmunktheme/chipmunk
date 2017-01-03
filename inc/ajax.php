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

	// If the reCAPTCHA is configured prevent autosubmission
	if ( ChipmunkCustomizer::theme_option( 'recaptcha_site_key' ) ) {
		if ( isset($_REQUEST['g-recaptcha-response'] ) and empty( $_REQUEST['g-recaptcha-response']) ) {
			// Failure due to incorrect captcha validation
			wp_send_json_error( __( 'Please verify that you are not a robot.', 'chipmunk' ) );
		}
	}

	if ( !empty( $_REQUEST['name'] ) ) {
		$meta_prefix = '_' . CHIPMUNK_THEME_SLUG.'_resource';
		$meta_input = array();

		$meta_input[$meta_prefix . '_website'] = esc_url( wp_filter_nohtml_kses( $_REQUEST['website'] ) );
		$collection = intval( wp_filter_kses( $_REQUEST['collection'] ) );

		if ( !ChipmunkCustomizer::theme_option( 'disable_submitter_info', true ) ) {
			$meta_input[$meta_prefix . '_submitter_name'] = wp_filter_nohtml_kses( $_REQUEST['submitter_name'] );
			$meta_input[$meta_prefix . '_submitter_email'] = wp_filter_nohtml_kses( $_REQUEST['submitter_email'] );
		}

		$post_object = array(
			'post_type'     => 'resource',
			'post_title'    => wp_filter_nohtml_kses( $_REQUEST['name'] ),
			'post_content'  => wp_filter_kses( $_REQUEST['content'] ),
			'meta_input'    => $meta_input,
		);

		if ( $post_id = wp_insert_post( $post_object) ) {
			// Insert taxonomy information
			wp_set_object_terms( $post_id, $collection, 'resource-collection' );

			// Send email to website admin
			if ( ChipmunkCustomizer::theme_option( 'inform_about_submissions' ) ) {
				chipmunk_inform_admin( $post_id );
			}

			// Success
			wp_send_json_success( ChipmunkCustomizer::theme_option( 'submission_thanks' ) );
		}
		// Failure during wp_insert_post
		else wp_send_json_error( ChipmunkCustomizer::theme_option( 'submission_failure' ) );
	}
	// Failure due to incorrect nonce verification
	else wp_send_json_error( ChipmunkCustomizer::theme_option( 'submission_failure' ) );

	die;
}
endif;
add_action( 'wp_ajax_submit_resource', 'chipmunk_submit_resource' );
add_action( 'wp_ajax_nopriv_submit_resource', 'chipmunk_submit_resource' );


if ( ! function_exists( 'chipmunk_process_upvote' ) ) :
/**
 * Process upvote callback
 */
function chipmunk_process_upvote() {
	chipmunk_verify_nonce();

	// Get post ID
	$post_id = ( isset( $_REQUEST['postId'] ) && is_numeric( $_REQUEST['postId'] ) ) ? $_REQUEST['postId'] : null;

	if ( $post_id ) {
		// Process the user upvote
		ChipmunkUpvotes::process_upvote( $post_id );
	}
}
endif;
add_action( 'wp_ajax_process_upvote', 'chipmunk_process_upvote' );
add_action( 'wp_ajax_nopriv_process_upvote', 'chipmunk_process_upvote' );


if ( ! function_exists( 'chipmunk_inform_admin' ) ) :
/**
 * Send email to website owner after resource is submitted
 */
function chipmunk_inform_admin( $post_id ) {
	$to       = get_bloginfo( 'admin_email' );
	$from     = 'admin@'.$_SERVER['SERVER_NAME'];
	$name     = get_bloginfo( 'name' );
	$subject  = get_bloginfo( 'name' ) . ': ' . __( 'New user submission', 'chipmunk' );
	$post_url = admin_url( 'post.php?post=' . $post_id . '&action=edit' ) . '">' . __( 'Review submission', 'chipmunk' );

	$headers  = array(
		"Content-Type: text/html; charset=UTF-8;",
		"From: $name <$from>",
	);

	wp_mail( $to, $subject, '<a href="' . $post_url . '</a>', implode( "\n", $headers ) );
}
endif;


if ( ! function_exists( 'chipmunk_verify_nonce' ) ) :
/**
 * Secure callbacks by verifying WP Nonce
 */
function chipmunk_verify_nonce() {
	$nonce = isset( $_REQUEST['nonce'] ) ? sanitize_text_field( $_REQUEST['nonce'] ) : null;

	if ( !$nonce || !wp_verify_nonce( $nonce, $_REQUEST['action'] ) ) {
		wp_send_json_error( __( 'Not permitted.', 'chipmunk' ) );
		die;
	}
}
endif;
