<?php

namespace Chipmunk\Extensions;

use Timber\Timber;

/**
 * Bookmarks class
 *
 * @package WordPress
 * @subpackage Chipmunk
 */
class Bookmarks {

	/**
	 * Database meta key
	 *
	 * @var string
	 */
	public static $dbKey = '_chipmunk_bookmark';

	/**
	 * Create a new bookmarks object
	 *
	 * @param  object $postId
	 */
	public function __construct( $postId ) {
		global $current_user;

		$this->postId = intval( wp_filter_kses( $postId ) );
		$this->userId = $current_user->ID;
	}

	/**
	 * Output the bookmark button
	 *
	 * @param  string $class
	 *
	 * @return string
	 */
	public function getButton( $action, $class = '' ) {
		$bookmarked = $this->isBookmarked();
		$content    = $this->getContent( $bookmarked );

		if ( $bookmarked ) {
			$class .= ' is-active';
			$title  = esc_html__( 'Remove bookmark', 'chipmunk' );
		} else {
			$title = esc_html__( 'Bookmark', 'chipmunk' );
		}

		return "<span class='$class' title='$title' data-action='$action' data-action-event='click' data-action-post-id='$this->postId'>$content</span>";
	}

	/**
	 * Toggles post bookmark status
	 *
	 * @return object
	 */
	private function toggleBookmark() {
		$bookmarked = $this->isBookmarked();

		// Remove bookmark from the post
		if ( $bookmarked ) {
			delete_post_meta( $this->postId, self::$dbKey, $this->userId );
			$response['status'] = 'remove';
		}

		// Bookmark the post
		else {
			add_post_meta( $this->postId, self::$dbKey, $this->userId );
			$response['status'] = 'add';
		}

		$response['post']    = $this->postId;
		$response['content'] = $this->getContent( ! $bookmarked );

		return $response;
	}

	/**
	 * Tests if the post is already bookmarked
	 *
	 * @return bool
	 */
	private function isBookmarked() {
		return in_array( $this->userId, get_post_meta( $this->postId, self::$dbKey ) );
	}

	/**
	 * Retrieves proper content template
	 *
	 * @param  bool $active
	 *
	 * @return string
	 */
	private function getContent( $active ) {
		$icon  = Timber::compile( 'partials/icon.twig', [ 'icon' => 'bookmark' ] );
		$label = $active ? __( 'Bookmarked', 'chipmunk' ) : __( 'Bookmark', 'chipmunk' );

		return '<span>' . $icon . $label . '</span>';
	}

	/**
	 * Processes the bookmark request
	 */
	public function process() {
		// Check required attributes
		if ( ! $this->postId || ! $this->userId ) {
			wp_send_json_error( __( 'Not permitted.', 'chipmunk' ) );
		}

		// Set proper Post meta values
		$params = $this->toggleBookmark();

		// Return success response
		wp_send_json_success( $params );
	}
}
