<?php

namespace Chipmunk\Extension;

use Timber\Timber;
use MadeByLess\Lessi\Factory\Singleton;
use MadeByLess\Lessi\Helper\HelperTrait;

/**
 * Bookmark extension class
 */
class BookmarkExtension extends Singleton {
    use HelperTrait;

	/**
	 * Database key name for bookmarks
	 *
	 * @var string
	 */
	private string $dbKey;

	/**
	 * Current post ID
	 *
	 * @var int|null
	 */
	private ?int $postId;

	/**
	 * Currently logged in user or IP address
	 *
	 * @var ?int
	 */
	private ?int $userId;

	/**
	 * Class constructor.
	 */
	public function __construct() {
		$this->dbKey = $this->buildPrefixedThemeSlug( 'bookmark' );
		$this->userId = get_current_user_id();
	}

	/**
	 * Sets the post ID for the class
	 *
	 * @param int $postId
	 */
	public function setPostId( int $postId ) {
		$this->postId = intval( wp_filter_kses( $postId ) );
	}

	/**
	 * Output the bookmark button
	 *
	 * @param string $action
	 * @param string $class
	 *
	 * @return string
	 */
	public function getButton( string $action, string $class = '' ): string {
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
	 * Retrieves proper content template
	 *
	 * @param  bool $active
	 *
	 * @return string
	 */
	private function getContent( $active ): string {
		$icon  = Timber::compile( 'partials/icon.twig', [ 'icon' => 'bookmark' ] );
		$label = $active ? __( 'Bookmarked', 'chipmunk' ) : __( 'Bookmark', 'chipmunk' );

		return "<span>{$icon}{$label}</span>";
	}

	/**
	 * Toggles post bookmark status
	 *
	 * @return array
	 */
	private function toggleBookmark(): array {
		$bookmarked = $this->isBookmarked();

		// Remove bookmark from the post
		if ( $bookmarked ) {
			delete_post_meta( $this->postId, $this->dbKey, $this->userId );
			$response['status'] = 'remove';
		}

		// Bookmark the post
		else {
			add_post_meta( $this->postId, $this->dbKey, $this->userId );
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
	private function isBookmarked(): bool {
		return in_array( $this->userId, get_post_meta( $this->postId, $this->dbKey ) );
	}

	/**
	 * Processes the bookmark request
	 */
	public function process() {
		// Check required attributes
		if ( empty( $this->postId ) || empty( $this->userId ) ) {
			wp_send_json_error( __( 'Not permitted.', 'chipmunk' ) );
		}

		// Set proper Post meta values
		$params = $this->toggleBookmark();

		// Return success response
		wp_send_json_success( $params );
	}
}
