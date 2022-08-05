<?php

namespace Chipmunk\Extension;

use Exception;
use Timber\Timber;
use Timber\Post;
use MadeByLess\Lessi\Helper\HookTrait;

use Chipmunk\Core\Submitter;
use Chipmunk\Helper\CaptchaTrait;
use Chipmunk\Helper\OptionTrait;

/**
 * Submission extension class
 */
class SubmissionExtension {
    use HookTrait;
    use CaptchaTrait;
    use OptionTrait;

	/**
	 * @var SubmissionExtension The one true SubmissionExtension
	 */
	private static $instance;

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
	private $requiredEmpty = [ 'filter' ];

	/**
	 * Class constructor.
	 */
	public function __construct() {
		$this->submitter = new Submitter( 'resource' );
	}

	/**
	 * Insures that only one instance of SubmissionExtension exists in memory at any one
	 * time. Also prevents needing to define globals all over the place.
	 *
	 * @return SubmissionExtension
	 */
	public static function getInstance() {
		if ( ! isset( self::$instance ) && ! ( self::$instance instanceof SubmissionExtension ) ) {
			self::$instance = new SubmissionExtension();
		}

		return self::$instance;
	}

	/**
	 * Validate form fields and make sure spam filter is empty
	 *
	 * @param object data
	 */
	public function setData( object $data ) {
		$this->data = $data;
    }

	/**
	 * Validate form fields and make sure spam filter is empty
	 *
	 * @return bool
     *
     * @throws Exception
	 */
	private function validate(): bool {
        $recaptchaResponse = $this->data->{'g-recaptcha-response'};

		if ( isset( $recaptchaResponse ) && ! $this->verifyRecaptcha( $recaptchaResponse ) ) {
			throw new Exception( esc_html__( 'Please verify that you are not a robot.', 'chipmunk' ) );
		}

		foreach ( apply_filters( 'chipmunk_submission_required_fields', $this->required ) as $field ) {
			if ( empty( $this->data->{$field} ) ) {
				throw new Exception( esc_html__( 'Please fill out required fields.', 'chipmunk' ) );
				return false;
			}
		}

		foreach ( $this->requiredEmpty as $field ) {
			if ( ! empty( $this->data->{$field} ) ) {
				throw new Exception( esc_html__( 'Your request could not be processed.', 'chipmunk' ) );
				return false;
			}
		}

		return true;
	}

	/**
	 * Send email to website owner after resource is submitted
	 */
	private function informAdmin( $postId ) {
		$post    = new Post( $postId );
		$name    = get_bloginfo( 'name' );
		$admin   = get_bloginfo( 'admin_email' );
		$headers = [ 'Content-Type: text/html; charset=UTF-8' ];

		$subject  = sprintf( esc_html__( '%s: New user submission', 'chipmunk' ), $name );
		$template = Timber::compile(
			'emails/submission.twig',
			[
				'subject' => $subject,
				'post'    => $post,
			]
		);

		wp_mail( $admin, $subject, $template, $headers );
	}

	/**
	 * Submit an post into the database
     *
     * @throws Exception
	 */
	private function submit() {
		$data = [
			'name'           => wp_filter_nohtml_kses( $this->data->name ),
			'content'        => wp_kses_post( wpautop( $this->data->content ) ),
			'url'            => wp_filter_nohtml_kses( $this->data->url ),
			'status'         => $this->applyFilter( 'submission_post_status', 'pending' ),
			'collections'    => wp_filter_nohtml_kses( $this->data->collection ),
			'submitterEmail' => wp_filter_nohtml_kses( $this->data->submitterEmail ),
			'submitterName'  => wp_filter_nohtml_kses( $this->data->submitterName ),
		];

		if ( $postId = $this->submitter->submit( (object) $data ) ) {
			// Send email to website admin
			if ( $this->getOption( 'inform_about_submissions' ) ) {
				$this->informAdmin( $postId );
			}
		}

		// Failure during wp_insert_post
		else {
			throw new Exception( $this->getOption( 'submission_failure' ) );
		}
	}

	/**
	 * Submit a post into the database and sends info messages
	 */
	public function process() {
		try {
            if ( empty( $this->data ) ) {
                wp_send_json_error( __( 'Not permitted.', 'chipmunk' ) );
            }

			// Validate the form first
			$this->validate();

			// If validated, submit a post...
			$this->submit();

			// Return success message
			wp_send_json_success( $this->getOption( 'submission_thanks' ) );

		} catch ( Exception $e ) {

			// Return exception message
			wp_send_json_error( $e->getMessage() );
		}
	}
}
