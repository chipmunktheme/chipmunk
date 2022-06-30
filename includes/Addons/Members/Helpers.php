<?php

namespace Chipmunk\Addons\Members;

/**
 * Plugin specific helpers.
 *
 * @package WordPress
 * @subpackage Chipmunk
 */
class Helpers {

	/**
	 * Retrieve options array from a specific section
	 *
	 * @param string $section Section slug.
	 * @param mixed $default Default value
	 *
	 * @return array
	 */
	public static function get_options( $section, $default = false ) {
		$options = get_option( THEME_SLUG . '_members_' . $section, $default );

		return is_array( $options ) ? $options : [];
	}

	/**
	 * Set options array from a specific section
	 *
	 * @param string $section Section slug.
	 * @param mixed $valur Vaule to set
	 *
	 * @return array
	 */
	public static function set_options( $section, $value ) {
		return update_option( THEME_SLUG . '_members_' . $section, $value );
	}

	/**
	 * Retrieve page ids - used for login, register, lost_password, reset_password and dashboard.
	 * returns -1 if no page is found.
	 *
	 * @param string $page Page slug.
	 * @return int
	 */
	public static function get_page_id( $page ) {
		$options = self::get_options( 'pages' );

		if ( isset( $options['chipmunk_' . $page . '_page_id'] ) ) {
			$page_id = apply_filters( 'chipmunk_get_' . $page . '_page_id', $options['chipmunk_' . $page . '_page_id'] );
		}

		return isset( $page_id ) ? absint( $page_id ) : null;
	}

	/**
	 * Retrieve page permalink.
	 *
	 * @param string      $page page slug.
	 * @param string|bool $fallback Fallback URL if page is not set. Defaults to home URL.
	 * @return string
	 */
	public static function get_page_permalink( $page, $fallback = null ) {
		$page_id   = self::get_page_id( $page );
		$permalink = $page_id ? get_permalink( $page_id ) : null;

		if ( empty( $permalink ) ) {
			$permalink = empty( $fallback ) ? get_home_url() : $fallback;
		}

		return apply_filters( 'chipmunk_get_' . $page . '_page_permalink', $permalink );
	}

	/**
	 * Retrieve possible errors from request parameters
	 */
	public static function retrieve_request_errors() {
		$errors = [];

		if ( isset( $_REQUEST['errors'] ) ) {
			$error_codes = explode( ',', $_REQUEST['errors'] );

			foreach ( $error_codes as $error_code ) {
				$errors[] = self::get_error_message( $error_code );
			}
		}

		return $errors;
	}

	/**
	 * Retrieve possible alerts from request parameters
	 */
	public static function retrieve_request_alerts() {
		$possible_alerts = [
			'logged_out',
			'registered',
			'lost_password_sent',
			'password_changed',
			'profile_updated',
		];

		$alerts = [];

		foreach ( $possible_alerts as $possible_alert ) {
			if ( isset( $_REQUEST[ $possible_alert ] ) ) {
				$alerts[] = self::get_alert_message( $possible_alert );
			}
		}

		return $alerts;
	}

	/**
	 * Retrieve possible blockers from request parameters
	 */
	public static function retrieve_request_blockers( $blockers ) {
		if ( ! is_array( $blockers ) ) {
			return null;
		}

		foreach ( $blockers as $blocker ) {
			if ( 'guest_required' == $blocker && is_user_logged_in() ) {
				return self::get_blocker_message( $blocker );
			}

			if ( 'user_required' == $blocker && ! is_user_logged_in() ) {
				return self::get_blocker_message( $blocker );
			}

			if ( 'registration_closed' == $blocker && ! get_option( 'users_can_register' ) ) {
				return self::get_blocker_message( $blocker );
			}

			if ( 'invalid_link' == $blocker && ( ! isset( $_REQUEST['login'] ) || ! isset( $_REQUEST['key'] ) ) ) {
				return self::get_blocker_message( $blocker );
			}
		}
	}

	/**
	 * Finds and returns a matching error message for the given error code.
	 *
	 * @param string $error_code    The error code to look up.
	 *
	 * @return string               An error message.
	 */
	public static function get_error_message( $error_code ) {
		switch ( $error_code ) {
			case 'empty_username':
			case 'empty_email':
				return __( 'You need to enter your username or email address to continue.', 'chipmunk' );

			case 'invalid_username':
			case 'invalid_email':
			case 'invalidcombo':
				return __('There is no account with that username or email address.', 'chipmunk' );

			case 'empty_password':
				return __( 'You need to enter a password to login.', 'chipmunk' );

			case 'incorrect_password':
				return __('The password you entered wasn\'t quite right. Did you forget your password?', 'chipmunk' );

			case 'email':
				return __( 'The email address you entered is not valid.', 'chipmunk' );

			case 'existing_user_email':
				return __( 'An account exists with this email address. Please choose a different one.', 'chipmunk' );

			case 'existing_user_login':
				return __('An account exists with this username. Please choose a different one.', 'chipmunk' );

			case 'closed':
				return __( 'Registering new users is currently not allowed.', 'chipmunk' );

			case 'captcha':
				return __( 'Please verify that you are not a robot.', 'chipmunk' );

			case 'expiredkey':
			case 'invalidkey':
				return __( 'The password reset link you used is not valid anymore.', 'chipmunk' );

			case 'password_mismatch':
				return __( 'The two passwords you entered don\'t match.', 'chipmunk' );

			case 'reset_password_empty':
				return __( 'Sorry, we don\'t accept empty passwords.', 'chipmunk' );

			case 'login_required':
				return __( 'You have to be signed in to view this page.', 'chipmunk' );

			default:
				return __( 'An unknown error occurred. Please try again later.', 'chipmunk' );
				break;
		}
	}

	/**
	 * Finds and returns a matching alert message for the given alert code.
	 *
	 * @param string $alert_code    The alert code to look up.
	 *
	 * @return string               An alert message.
	 */
	private static function get_alert_message( $alert_code ) {
		switch ( $alert_code ) {
			case 'logged_out':
				return [
					'type' => 'warning',
					'message' => __( 'You have signed out. Would you like to sign in again?', 'chipmunk' ),
				];

			case 'registered':
				return [
					'type' => 'success',
					'message' => __( 'You have successfully registered your account. You can login now.', 'chipmunk' ),
				];

			case 'lost_password_sent':
				return [
					'type' => 'warning',
					'message' => __( 'Check your email for a link to reset your password.', 'chipmunk' ),
				];

			case 'password_changed':
				return [
					'type' => 'success',
					'message' => __( 'Your password has been changed. You can sign in now.', 'chipmunk' ),
				];

			case 'profile_updated':
				return [
					'type' => 'success',
					'message' => __( 'Your profile has been updated successfully.', 'chipmunk' ),
				];

			default:
				break;
		}
	}

	/**
	 * Finds and returns a matching blocker message for the given blocker code.
	 *
	 * @param string $blocker    The blocker code to look up.
	 *
	 * @return string               An blocker message.
	 */
	private static function get_blocker_message( $blocker ) {
		switch ( $blocker ) {
			case 'guest_required':
				return __( 'You are already signed in.', 'chipmunk' );

			case 'user_required':
				return __( 'You have to be signed in to view this page.', 'chipmunk' );

			case 'registration_closed':
				return __( 'Registering new users is currently not allowed.', 'chipmunk' );

			case 'invalid_link':
				return __( 'Invalid password reset link.', 'chipmunk' );

			default:
				break;
		}
	}
}
