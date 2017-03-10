<?php
/**
 * Upvote functionality
 *
 * @package WordPress
 * @subpackage Chipmunk
 */
$db_post_key 	= '_chipmunk_post_upvote_count';
$db_user_ip_key = '_chipmunk_user_ip';

if ( ! function_exists( 'chipmunk_upvote_button' ) ) :
/**
 * Output the upvote button
 */
function chipmunk_upvote_button( $post_id, $class = '' ) {
	$action = 'submit_upvote';
	$nonce = wp_create_nonce( $action );

	$count = chipmunk_get_upvote_count( $post_id );
	$counter = chipmunk_get_upvote_counter( $count );

	if ( chipmunk_already_upvoted( $post_id ) ) {
		$class = $class . ' is-active';
		$title = esc_html__( 'Remove Upvote', 'chipmunk' );
	}
	else {
		$title = esc_html__( 'Upvote', 'chipmunk' );
	}

	$counter = "<span class='$class' title='$title' data-action='$action' data-nonce='$nonce' data-post-id='$post_id'>$counter</span>";
	return $counter;
}
endif;


if ( ! function_exists( 'chipmunk_upvote_counter' ) ) :
/**
 * Output the upvote counter
 */
function chipmunk_upvote_counter( $post_id ) {
	$count = chipmunk_get_upvote_count( $post_id );
	$counter = chipmunk_get_upvote_counter( $count );

	return $counter;
}
endif;


if ( ! function_exists( 'chipmunk_process_upvote' ) ) :
/**
 * Processes upvotes
 */
function chipmunk_process_upvote( $post_id ) {
	global $db_post_key, $db_user_ip_key;

	$count = chipmunk_get_upvote_count( $post_id );
	$user_ip = chipmunk_get_ip();
	$post_users = chipmunk_get_upvote_ips( $user_ip, $post_id );

	// Upvote the post
	if ( ! chipmunk_already_upvoted( $post_id ) ) {
		if ( $post_users ) {
			// Update Post
			update_post_meta( $post_id, $db_user_ip_key, $post_users );
		}

		$count += 1;
		$response['status'] = 'upvoted';
	}

	// Remove upvote from the post
	else {
		if ( $post_users ) {
			$uip_key = array_search( $user_ip, $post_users );
			unset( $post_users[$uip_key] );

			// Update Post
			update_post_meta( $post_id, $db_user_ip_key, $post_users );
		}

		$count = ( $count > 0 ) ? --$count : 0; // Prevent negative number
		$response['status'] = 'removed';
	}


	update_post_meta( $post_id, $db_post_key, $count );

	$response['post'] = $post_id;
	$response['counter'] = chipmunk_get_upvote_counter( $count );

	wp_send_json( $response );
}
endif;


if ( ! function_exists( 'chipmunk_already_upvoted' ) ) :
/**
 * Utility to test if the post is already unvoted
 */
function chipmunk_already_upvoted( $post_id ) {
	global $db_user_ip_key;

	$post_users = NULL;
	$user_ip = NULL;

	$user_ip = chipmunk_get_ip();
	$post_meta_users = get_post_meta( $post_id, $db_user_ip_key );

	// meta exists, set up values
	if ( count( $post_meta_users ) != 0 ) {
		$post_users = $post_meta_users[0];
	}

	if ( is_array( $post_users ) && in_array( $user_ip, $post_users ) ) {
		return true;
	}
	else {
		return false;
	}
}
endif;


if ( ! function_exists( 'chipmunk_get_upvote_ips' ) ) :
/**
 * Utility retrieves post meta ip upvotes (ip array),
 * then adds new ip to retrieved array
 */
function chipmunk_get_upvote_ips( $user_ip, $post_id ) {
	global $db_user_ip_key;

	$post_users = '';
	$post_meta_users = get_post_meta( $post_id, $db_user_ip_key );

	// Retrieve post information
	if ( count( $post_meta_users ) != 0 ) {
		$post_users = $post_meta_users[0];
	}

	if ( ! is_array( $post_users ) ) {
		$post_users = array();
	}

	if ( ! in_array( $user_ip, $post_users ) ) {
		$post_users['ip-' . $user_ip] = $user_ip;
	}

	return $post_users;
}
endif;


if ( ! function_exists( 'chipmunk_get_upvote_count' ) ) :
/**
 * Utility retrieves upvote count for post,
 * returns appropriate number
 */
function chipmunk_get_upvote_count( $post_id ) {
	global $db_post_key;

	$count = get_post_meta( $post_id, $db_post_key, true );
	$count = ( isset( $count ) && is_numeric( $count ) ) ? $count : 0;

	return $count;
}
endif;


if ( ! function_exists( 'chipmunk_get_upvote_counter' ) ) :
/**
 * Utility retrieves count plus count options,
 * returns appropriate format based on options
 */
function chipmunk_get_upvote_counter( $count ) {
	$counter = ( is_numeric( $count ) && $count > 0 ) ? chipmunk_format_number( $count ) : 0;
	$counter = "<i class='icon icon_arrow-up'></i> $counter";

	return $counter;
}
endif;
