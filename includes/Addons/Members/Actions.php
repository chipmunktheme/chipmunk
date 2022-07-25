<?php

namespace Chipmunk\Addons\Members;

use Chipmunk\Helpers;
use Chipmunk\Addons\Members\Helpers as MembersHelpers;

/**
 * AJAX action callbacks
 *
 * @package WordPress
 * @subpackage Chipmunk
 */
class Actions {

	/**
	 * Class constructor
	 */
	function __construct() {
		// Handlers for form posting actions
		add_action( 'login_form_register', array( $this, 'doRegisterUser' ) );
		add_action( 'login_form_lostpassword', array( $this, 'doLostPassword' ) );
		add_action( 'login_form_rp', array( $this, 'doResetPassword' ) );
		add_action( 'login_form_resetpass', array( $this, 'doResetPassword' ) );

		// Custom user account handles
		add_action( 'wp_loaded', array( $this, 'doUpdateUser' ) );
	}

	/**
	 * Handles the registration of a new user.
	 *
	 * Used through the action hook "login_form_register" activated on wp-login.php
	 * when accessed through the registration action.
	 */
	public function doRegisterUser() {
		if ( 'POST' == $_SERVER['REQUEST_METHOD'] ) {
			$redirectUrl = MembersHelpers::getPagePermalink( 'register' );

			if ( ! get_option( 'users_can_register' ) ) {
				// Registration closed, display error
				$redirectUrl = add_query_arg( 'errors', 'closed', $redirectUrl );
			} elseif ( ! $this->verifyRecaptcha() ) {
				// Recaptcha check failed, display error
				$redirectUrl = add_query_arg( 'errors', 'captcha', $redirectUrl );
			} else {
				$username = $_POST['username'];
				$email    = $_POST['email'];

				$password  = esc_attr( $_POST['password'] );
				$password2 = esc_attr( $_POST['password2'] );

				if ( empty( $password ) || ( $password !== $password2 ) ) {
					// Password empty or don't match confirmation
					$redirectUrl = add_query_arg( 'errors', 'password_mismatch', $redirectUrl );
				} else {
					$result = $this->registerUser( $username, $email, $password );

					if ( is_wp_error( $result ) ) {
						// Parse errors into a string and append as parameter to redirect
						$errors      = join( ',', $result->get_error_codes() );
						$redirectUrl = add_query_arg( 'errors', $errors, $redirectUrl );
					} else {
						// Success, redirect to login page.
						$redirectUrl = MembersHelpers::getPagePermalink( 'login' );
						$redirectUrl = add_query_arg( 'registered', true, $redirectUrl );

						// Rewrite rules
						flush_rewrite_rules();
					}
				}
			}

			wp_safe_redirect( $redirectUrl );
			exit;
		}
	}

	/**
	 * Initiates password reset.
	 */
	public function doLostPassword() {
		if ( 'POST' == $_SERVER['REQUEST_METHOD'] ) {
			$result = retrieve_password();

			if ( is_wp_error( $result ) ) {
				// Errors found
				$errors      = join( ',', $result->get_error_codes() );
				$redirectUrl = MembersHelpers::getPagePermalink( 'lost_password' );
				$redirectUrl = add_query_arg( 'errors', $errors, $redirectUrl );
			} else {
				// Email sent
				$redirectUrl = MembersHelpers::getPagePermalink( 'login' );
				$redirectUrl = add_query_arg( 'lost_password_sent', true, $redirectUrl );
			}

			wp_safe_redirect( $redirectUrl );
			exit;
		}
	}

	/**
	 * Resets the user's password if the password reset form was submitted.
	 */
	public function doResetPassword() {
		if ( 'POST' == $_SERVER['REQUEST_METHOD'] ) {
			$rpKey   = $_REQUEST['rp_key'];
			$rpLogin = $_REQUEST['rp_login'];

			$user = check_password_reset_key( $rpKey, $rpLogin );

			if ( ! $user || is_wp_error( $user ) ) {
				$redirectUrl = MembersHelpers::getPagePermalink( 'login' );
				$redirectUrl = add_query_arg( 'errors', $user->get_error_code(), $redirectUrl );

				wp_safe_redirect( $redirectUrl );
				exit;
			}

			if ( isset( $_POST['pass1'] ) ) {
				if ( $_POST['pass1'] != $_POST['pass2'] ) {
					// Passwords don't match
					$redirectUrl = MembersHelpers::getPagePermalink( 'reset_password' );

					$redirectUrl = add_query_arg( 'key', $rpKey, $redirectUrl );
					$redirectUrl = add_query_arg( 'login', $rpLogin, $redirectUrl );
					$redirectUrl = add_query_arg( 'errors', 'reset_password_mismatch', $redirectUrl );

					wp_safe_redirect( $redirectUrl );
					exit;
				}

				if ( empty( $_POST['pass1'] ) ) {
					// Password is empty
					$redirectUrl = MembersHelpers::getPagePermalink( 'reset_password' );

					$redirectUrl = add_query_arg( 'key', $rpKey, $redirectUrl );
					$redirectUrl = add_query_arg( 'login', $rpLogin, $redirectUrl );
					$redirectUrl = add_query_arg( 'errors', 'reset_password_empty', $redirectUrl );

					wp_safe_redirect( $redirectUrl );
					exit;
				}

				// Parameter checks OK, reset password
				reset_password( $user, $_POST['pass1'] );

				$redirectUrl = MembersHelpers::getPagePermalink( 'login' );
				$redirectUrl = add_query_arg( 'password_changed', true, $redirectUrl );

				wp_safe_redirect( $redirectUrl );
				exit;
			}

			exit( __( 'Invalid request.', 'chipmunk' ) );
		}
	}

	/**
	 * Updates user data & meta values
	 */
	public function doUpdateUser() {
		if ( 'POST' == $_SERVER['REQUEST_METHOD'] && isset( $_POST['action'] ) && $_POST['action'] == 'chipmunk_update_user' ) {
			if ( isset( $_POST['user_id'] ) ) {
				$redirectUrl = MembersHelpers::getPagePermalink( 'profile' );
				$userSocials = wp_get_user_contact_methods();

				$userId      = sanitize_text_field( $_POST['user_id'] ?? '' );
				$email       = sanitize_text_field( wp_unslash( $_POST['email'] ?? '' ) );
				$firstName   = sanitize_text_field( $_POST['first_name'] ?? '' );
				$lastName    = sanitize_text_field( $_POST['last_name'] ?? '' );
				$url         = sanitize_text_field( $_POST['url'] ?? '' );
				$description = sanitize_text_field( $_POST['description'] ?? '' );

				$result = $this->updateUser( $userId, $email, $firstName, $lastName, $url, $description );

				if ( is_wp_error( $result ) ) {
					$errors      = join( ',', $result->get_error_codes() );
					$redirectUrl = add_query_arg( 'errors', $errors, $redirectUrl );
				} else {
					foreach ( $userSocials as $key => $value ) {
						if ( isset( $_POST[ $key ] ) ) {
							update_user_meta( $userId, $key, sanitize_text_field( $_POST[ $key ] ) );
						}
					}

					$redirectUrl = add_query_arg( 'profile_updated', true, $redirectUrl );
				}

				wp_safe_redirect( $redirectUrl );
				exit;
			}

			exit( __( 'Invalid request.', 'chipmunk' ) );
		}
	}

	/**
	 * Validates and then completes the new user signup process if all went well.
	 *
	 * @param string $username      The new user's name
	 * @param string $email         The new user's email address
	 * @param string $password      The new user's password
	 *
	 * @return int|WP_Error         The id of the user that was created, or error if failed.
	 */
	private function registerUser( $username, $email, $password ) {
		$errors = new \WP_Error();

		// Email address is used as both username and email. It is also the only
		// parameter we need to validate
		if ( ! is_email( $email ) ) {
			$errors->add( 'email', MembersHelpers::getErrorMessage( 'email' ) );
			return $errors;
		}

		if ( email_exists( $email ) ) {
			$errors->add( 'existing_user_email', MembersHelpers::getErrorMessage( 'existing_user_email' ) );
			return $errors;
		}

		if ( username_exists( $username ) ) {
			$errors->add( 'existing_user_login', MembersHelpers::getErrorMessage( 'existing_user_login' ) );
			return $errors;
		}

		$userData = array(
			'user_email' => $email,
			'user_login' => $username,
			'user_pass'  => $password,
		);

		$userId = wp_insert_user( $userData );
		// wp_new_user_notification( $userId, $password );

		return $userId;
	}

	/**
	 * Validates and then completes the user account data
	 *
	 * @param string $userId        The user's ID
	 * @param string $email         The user's new email address
	 * @param string $firstName     The user's new first name
	 * @param string $lastName      The user's new last name
	 * @param string $url           The user's website URL
	 * @param string $description   The user's description
	 *
	 * @return int|WP_Error         The id of the user that was created, or error if failed.
	 */
	private function updateUser( $userId, $email, $firstName, $lastName, $url, $description ) {
		$errors = new \WP_Error();

		// Email address is used as both username and email. It is also the only
		// parameter we need to validate
		if ( ! is_email( $email ) ) {
			$errors->add( 'email', MembersHelpers::getErrorMessage( 'email' ) );
			return $errors;
		}

		if ( ! empty( $firstName ) || ! empty( $lastName ) ) {
			$displayName = join( ' ', array_filter( array( $firstName, $lastName ) ) );
		}

		return wp_update_user(
			array(
				'ID'           => $userId,
				'user_email'   => $email,
				'first_name'   => $firstName,
				'last_name'    => $lastName,
				'display_name' => $displayName,
				'nickname'     => $firstName,
				'user_url'     => $url,
				'description'  => $description,
			)
		);
	}

	/**
	 * Checks that the reCAPTCHA parameter sent with the registration
	 * request is valid.
	 *
	 * @return bool True if the CAPTCHA is OK, otherwise false.
	 */
	private function verifyRecaptcha() {
		if ( isset( $_REQUEST['g-recaptcha-response'] ) ) {
			return Helpers::verifyRecaptcha( $_REQUEST['g-recaptcha-response'] );
		}

		return true;
	}
}
