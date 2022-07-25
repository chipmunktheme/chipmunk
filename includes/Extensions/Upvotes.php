<?php

namespace Chipmunk\Extensions;

use Timber\Timber;
use Chipmunk\Helpers;

/**
 * Upvotes class
 *
 * @package WordPress
 * @subpackage Chipmunk
 */
class Upvotes {

	/**
	 * Database meta key
	 *
	 * @var string
	 */
	public static $dbKey      = '_' . THEME_SLUG . '_upvote';
	public static $dbKeyCount = '_' . THEME_SLUG . '_upvote_count';
	public static $dbOldKey   = '_' . THEME_SLUG . '_post_upvote_count';

	/**
	 * Create a new upvotes object
	 *
	 * @param  object $postId
	 */
	function __construct( $postId ) {
		global $current_user;

		$this->postId = intval( wp_filter_kses( $postId ) );
		$this->userId = $current_user->ID ?? ( Helpers::isAddonEnabled( 'members' ) && Helpers::getOption( 'restrict_guest_upvotes' ) ? null : Helpers::getIp() );
	}

	/**
	 * Output the upvote button
	 *
	 * @param  string $class
	 *
	 * @return string
	 */
	public function getButton( $action, $class = '' ) {
		$upvoted = $this->isUpvoted();
		$content = $this->getContent( $upvoted );

		if ( $upvoted ) {
			$class .= ' is-active';
			$title  = esc_html__( 'Remove upvote', 'chipmunk' );
		} else {
			$title = esc_html__( 'Upvote', 'chipmunk' );
		}

		return "<span class='$class' title='$title' data-action='$action' data-action-event='click' data-action-post-id='$this->postId'>$content</span>";
	}

	/**
	 * Retrieves proper content template
	 *
	 * @return string
	 */
	public function getContent() {
		$icon  = Timber::compile( 'partials/icon.twig', array( 'icon' => 'thumbs-up' ) );
		$label = Helpers::formatNumber( $this->getUpvoteCount() ?? 0 );

		return '<span>' . $icon . $label . '</span>';
	}

	/**
	 * Toggles post upvote status
	 *
	 * @return object
	 */
	private function toggleUpvote() {
		$upvoted         = $this->isUpvoted();
		$current_counter = (int) get_post_meta( $this->postId, self::$dbKeyCount, true );

		// Remove upvote from the post
		if ( $upvoted ) {
			delete_post_meta( $this->postId, self::$dbKey, $this->userId );
			update_post_meta( $this->postId, self::$dbKeyCount, ( $current_counter == 0 ? 0 : $current_counter - 1 ) );

			$response['status'] = 'remove';
		}

		// Upvote the post
		else {
			add_post_meta( $this->postId, self::$dbKey, $this->userId );
			update_post_meta( $this->postId, self::$dbKeyCount, ( $current_counter + 1 ) );

			$response['status'] = 'add';
		}

		// Set proper resounse params
		$response['post']    = $this->postId;
		$response['content'] = $this->getContent( ! $upvoted );

		return $response;
	}

	/**
	 * Tests if the post is already upvoted
	 *
	 * @return boolean
	 */
	private function isUpvoted() {
		return in_array( $this->userId, get_post_meta( $this->postId, self::$dbKey ) );
	}

	/**
	 * Utility retrieves upvote count for post,
	 * returns appropriate number
	 *
	 * @return integer
	 */
	private function getUpvoteCount() {
		$old_count = (int) get_post_meta( $this->postId, self::$dbOldKey, true ) ?? 0;
		$count     = (int) get_post_meta( $this->postId, self::$dbKeyCount, true ) ?? 0;

		return $count + $old_count;
	}

	/**
	 * Processes the upvote request
	 */
	public function process() {
		// Check required attributes
		if ( ! $this->postId || ! $this->userId ) {
			wp_send_json_error( __( 'Not permitted.', 'chipmunk' ) );
		}

		// Set proper Post meta values
		$params = $this->toggleUpvote();

		// Return success response
		wp_send_json_success( $params );
	}
}
