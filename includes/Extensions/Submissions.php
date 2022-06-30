<?php

namespace Chipmunk\Extensions;

use Chipmunk\Helpers;
use Chipmunk\Submitter;

/**
 * Submission form class
 *
 * @package WordPress
 * @subpackage Chipmunk
 */
class Submissions {

	/**
	 * Required fields from the form
	 *
	 * @var array
	 */
	private $required = [ 'name', 'collection', 'url' ];

	/**
	 * Required fields to be left empty
	 *
	 * @var array
	 */
	private $required_empty = [ 'filter' ];

	/**
	 * Create a new submission form object
	 *
	 * @param  array $data
	 * @return void
	 */
	function __construct( $data ) {
		$this->data = (object) $data;
		$this->submitter = new Submitter( 'resource' );
	}

	/**
	 * Validate form fields and make sure spam filter is empty
	 *
	 * @return bool
	 */
	private function validate() {
		if ( isset( $this->data->{'g-recaptcha-response'} ) && ! Helpers::verify_recaptcha( $this->data->{'g-recaptcha-response'} ) ) {
			throw new \Exception( esc_html__( 'Please verify that you are not a robot.', 'chipmunk' ) );
		}

		foreach ( apply_filters( 'chipmunk_submission_required_fields', $this->required ) as $field ) {
			if ( empty( $this->data->{$field} ) ) {
				throw new \Exception( esc_html__( 'Please fill out required fields.', 'chipmunk' ) );
				return false;
			}
		}

		foreach ( $this->required_empty as $field ) {
			if ( ! empty( $this->data->{$field} ) ) {
				throw new \Exception( esc_html__( 'Your request could not be processed.', 'chipmunk' ) );
				return false;
			}
		}

		return true;
	}

	/**
	 * Send email to website owner after resource is submitted
	 */
	private function inform_admin( $post_id ) {
		$post       = get_post( $post_id );
		$name       = get_bloginfo( 'name' );
		$admin      = get_bloginfo( 'admin_email' );
		$headers    = [ 'Content-Type: text/html; charset=UTF-8' ];

		$subject    = sprintf( esc_html__( '%s: New user submission', 'chipmunk' ), $name );
		$template   = Helpers::get_template_part( 'emails/submission', [ 'subject' => $subject, 'post' => $post ], false );

		wp_mail( $admin, $subject, $template, $headers );
	}

	/**
	 * Submit an post into the database
	 *
	 * @return void
	 */
	private function submit() {
		$data = [
			'name' 				=> wp_filter_nohtml_kses( $this->data->name ),
			'content' 			=> wp_kses_post( wpautop( $this->data->content ) ),
			'url' 				=> wp_filter_nohtml_kses( $this->data->url ),
			'status' 			=> apply_filters( 'chipmunk_submission_post_status', 'pending' ),
			'collections' 		=> wp_filter_nohtml_kses( $this->data->collection ),
			'submitter_email'   => wp_filter_nohtml_kses( $this->data->submitter_email ),
			'submitter_name'    => wp_filter_nohtml_kses( $this->data->submitter_name ),
		];

		if ( $post_id = $this->submitter->submit( (object) $data ) ) {
			// Send email to website admin
			if ( Helpers::get_theme_option( 'inform_about_submissions' ) ) {
				$this->inform_admin( $post_id );
			}
		}

		// Failure during wp_insert_post
		else throw new \Exception( Helpers::get_theme_option( 'submission_failure' ) );
	}

	/**
	 * Submit a post into the database and sends info messages
	 *
	 * @return void
	 */
	public function process() {
		try {
			// Validate the form first
			$this->validate();

			// If validated, submit a post...
			$this->submit();

			// Return success message
			wp_send_json_success( Helpers::get_theme_option( 'submission_thanks' ) );

		} catch ( \Exception $e ) {

			// Return exception message
			wp_send_json_error( $e->getMessage() );
		}
	}
}
