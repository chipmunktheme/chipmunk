<?php
/**
 * Upvotes class
 *
 * @package WordPress
 * @subpackage Chipmunk
 */

if ( ! class_exists( 'ChipmunkUpvotes' ) ) :
	class ChipmunkUpvotes {
		/**
		 * Database meta key
		 *
		 * @var string
		 */
		public static $db_key = '_chipmunk_upvote';
		public static $db_old_key = '_chipmunk_post_upvote_count';

		/**
		 * Create a new upvotes object
		 *
		 * @param  object $post_id
		 *
		 * @return void
		 */
		function __construct( $post_id ) {
			global $current_user;

			$this->post_id = intval( wp_filter_kses( $post_id ) );
			$this->user_id = ! empty( $current_user->ID ) ? $current_user->ID : chipmunk_get_ip();
		}

		/**
		 * Output the upvote button
		 *
		 * @param  string $class
		 *
		 * @return string
		 */
		public function get_button( $action, $class = '' ) {
			$upvoted = $this->is_upvoted();
			$content = $this->get_content( $upvoted );

			if ( $upvoted ) {
				$class = $class . ' is-active';
				$title = esc_html__( 'Remove upvote', 'chipmunk' );
			}
			else {
				$title = esc_html__( 'Upvote', 'chipmunk' );
			}

			$button = "<button type='button' class='$class' title='$title' data-action='$action' data-action-event='click' data-action-post-id='$this->post_id'>$content</button>";
			return $button;
		}

		/**
		 * Retrieves proper content template
		 *
		 * @return string
		 */
		public function get_content() {
			$icon = chipmunk_get_template( 'partials/icon', array( 'icon' => 'arrow-up' ), false );

			$count = $this->get_upvote_count();
			$label = ( is_numeric( $count ) && $count > 0 ) ? chipmunk_format_number( $count ) : 0;

			return '<span>' . $icon . $label . '</span>';
		}

		/**
		 * Toggles post upvote status
		 *
		 * @return object
		 */
		private function toggle_upvote() {
			$upvoted = $this->is_upvoted();

			// Remove upvote from the post
			if ( $upvoted ) {
				delete_post_meta( $this->post_id, self::$db_key, $this->user_id );
				$response['status'] = 'remove';
			}

			// Upvote the post
			else {
				add_post_meta( $this->post_id, self::$db_key, $this->user_id );
				$response['status'] = 'add';
			}

			$response['post'] = $this->post_id;
			$response['content'] = $this->get_content( ! $upvoted );

			return $response;
		}

		/**
		 * Tests if the post is already upvoted
		 *
		 * @return boolean
		 */
		private function is_upvoted() {
			return in_array( $this->user_id, get_post_meta( $this->post_id, self::$db_key ) );
		}

		/**
		 * Utility retrieves upvote count for post,
		 * returns appropriate number
		 *
		 * @return integer
		 */
		private function get_upvote_count() {
			$old_count = (int) get_post_meta( $this->post_id, self::$db_old_key, true );
			$old_count = ( isset( $old_count ) && is_numeric( $old_count ) ) ? $old_count : 0;

			return count( get_post_meta( $this->post_id, self::$db_key ) ) + $old_count;
		}

		/**
		 * Processes the upvote request
		 *
		 * @return void
		 */
		public function process() {
			// Check required attributes
			if ( ! $this->post_id || ! $this->user_id ) {
				wp_send_json_error( __( 'Not permitted.', 'chipmunk' ) );
			}

			// Set proper Post meta values
			$params = $this->toggle_upvote();

			// Return success response
			wp_send_json_success( $params );
		}
	}
endif;
