<?php
/**
 * Submission form class
 *
 * @package WordPress
 * @subpackage Chipmunk
 */

if ( ! class_exists( 'SubmissionForm' ) ) :
	class SubmissionForm {
		/**
		 * Required fields from the form
		 *
		 * @var array
		 */
		private $required = array( 'name', 'collection', 'website' );

		/**
		 * Required fields to be left empty
		 *
		 * @var array
		 */
		private $required_empty = array( 'filter' );

		/**
		 * Create a new submission form object
		 *
		 * @param  object $data
		 * @return void
		 */
		function __construct( $data ) {
			$this->data = $data;
		}

		/**
		 * Validate form fields and make sure spam filter is empty
		 *
		 * @return bool
		 */
		private function validate() {
			if ( ! chipmunk_verify_recaptcha( $this->data['g-recaptcha-response'] ) ) {
				throw new Exception( esc_html__( 'Please verify that you are not a robot.', 'chipmunk' ) );
			}

			foreach ( apply_filters( 'chipmunk_submission_required_fields', $this->required ) as $field ) {
				if ( empty( $this->data[$field] ) ) {
					throw new Exception( esc_html__( 'Please fill out required fields.', 'chipmunk' ) );
					return false;
				}
			}

			foreach ( $this->required_empty as $field ) {
				if ( ! empty( $this->data[$field] ) ) {
					throw new Exception( esc_html__( 'Your request could not be processed.', 'chipmunk' ) );
					return false;
				}
			}

			return true;
		}

		/**
		 * Get submitter user ID
		 *
		 * @param  string $email
		 * @return integer
		 */
		private function get_submitter_id( $email ) {
			if ( is_user_logged_in() ) {
				return get_current_user_id();
			}

			if ( $user = get_user_by( 'email', $email ) ) {
				return $user->ID;
			}

			return null;
		}

		/**
		 * Attach post thumbnail
		 *
		 * @param  integer $post_id
		 * @param  string $website
		 * @return integer
		 */
		private function attach_post_thumbnail( $post_id, $website ) {
			if ( ! empty( $website ) ) {
				$og_data = OpenGraph::fetch( $website );

				if ( ! empty( $og_data ) && ! empty( $og_data->image ) ) {
					if ( $attachment_id = chipmunk_upload_attachment( $og_data->image ) ) {
						return set_post_thumbnail( $post_id, $attachment_id );
					}
				}
			}

			return false;
		}

		/**
		 * Submit an post into the database
		 *
		 * @return void
		 */
		private function submit_post() {
			$meta_prefix        = '_' . THEME_SLUG . '_resource';
			$meta_input         = array();

			$name               = wp_filter_nohtml_kses( $_REQUEST['name'] );
			$website            = wp_filter_nohtml_kses( $_REQUEST['website'] );
			$collection         = wp_filter_kses( $_REQUEST['collection'] );
			$content            = wp_kses_post( wpautop( $_REQUEST['content'] ) );
			$submitter_email    = wp_filter_nohtml_kses( $this->data['submitter_email'] );
			$submitter_name     = wp_filter_nohtml_kses( $this->data['submitter_name'] );

			$author_id          = $this->get_submitter_id( $submitter_email, $submitter_name );

			if ( empty( $author_id ) ) {
				if ( ! empty( $submitter_email ) && ! empty( $submitter_name ) ) {
					$meta_input[$meta_prefix . '_submitter'] = "{$submitter_name} <{$submitter_email}>";
				}
			}

			$meta_input[$meta_prefix . '_website'] = esc_url( $website );

			$post_object = array(
				'post_type'     => 'resource',
				'post_status'   => apply_filters( 'chipmunk_submission_post_status', 'pending' ),
				'post_title'    => $name,
				'post_content'  => $content,
				'post_author'   => $author_id,
				'meta_input'    => $meta_input,
			);

			if ( $post_id = wp_insert_post( $post_object) ) {
				// Insert taxonomy information
				wp_set_object_terms( $post_id, (int) $collection, 'resource-collection' );

				// Attach post thumbnail
				if ( ! chipmunk_theme_option( 'disable_submission_image_fetch' ) ) {
					$this->attach_post_thumbnail( $post_id, $website );
				}

				// Send email to website admin
				if ( chipmunk_theme_option( 'inform_about_submissions' ) ) {
					chipmunk_inform_admin( $post_id );
				}
			}

			// Failure during wp_insert_post
			else throw new Exception( chipmunk_theme_option( 'submission_failure' ) );
		}

		/**
		 * Submit a post into the database and sends info messages
		 *
		 * @return void
		 */
		public function submit() {
			try {
				// Validate the form first
				$this->validate();

				// If validated, submit a post...
				$this->submit_post();

				// Return success message
				wp_send_json_success( chipmunk_theme_option( 'submission_thanks' ) );

			} catch ( Exception $e ) {

				// Return exception message
				wp_send_json_error( $e->getMessage() );
			}
		}
	}
endif;
