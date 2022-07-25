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
	 * @param mixed  $default Default value
	 *
	 * @return array
	 */
	public static function getOptions( $section, $default = false ) {
		$options = get_option( THEME_SLUG . '_members_' . $section, $default );

		return is_array( $options ) ? $options : [];
	}

	/**
	 * Set options array from a specific section
	 *
	 * @param string $section Section slug.
	 * @param mixed  $value Vaule to set
	 *
	 * @return array
	 */
	public static function setOptions( $section, $value ) {
		return update_option( THEME_SLUG . '_members_' . $section, $value );
	}

	/**
	 * Retrieve page ids - used for login, register, lost_password, reset_password and dashboard.
	 * returns -1 if no page is found.
	 *
	 * @param string $page Page slug.
	 * @return int
	 */
	public static function getPageId( $page ) {
		$options = self::getOptions( 'pages' );

		if ( isset( $options[ "chipmunk_{$page}_page_id" ] ) ) {
			$pageId = apply_filters( "chipmunk_get_{$page}_page_id", $options[ "chipmunk_{$page}_page_id" ] );
		}

		return isset( $pageId ) ? absint( $pageId ) : null;
	}

	/**
	 * Retrieve page permalink.
	 *
	 * @param string      $page page slug.
	 * @param string|bool $fallback Fallback URL if page is not set. Defaults to home URL.
	 * @return string
	 */
	public static function getPagePermalink( $page, $fallback = null ) {
		$pageId    = self::getPageId( $page );
		$permalink = $pageId ? get_permalink( $pageId ) : null;

		if ( empty( $permalink ) ) {
			$permalink = empty( $fallback ) ? get_home_url() : $fallback;
		}

		return apply_filters( "chipmunk_get_{$page}_page_permalink", $permalink );
	}

	/**
	 * Retrieve possible errors from request parameters
	 */
	public static function retrieveRequestErrors() {
		$errors = [];

		if ( isset( $_REQUEST['errors'] ) ) {
			$errorCodes = explode( ',', $_REQUEST['errors'] );

			foreach ( $errorCodes as $errorCode ) {
				$errors[] = self::getErrorMessage( $errorCode );
			}
		}

		return $errors;
	}

	/**
	 * Retrieve possible alerts from request parameters
	 */
	public static function retrieveRequestAlerts() {
		$possibleAlerts = [
			'logged_out',
			'registered',
			'lost_password_sent',
			'password_changed',
			'profile_updated',
		];

		$alerts = [];

		foreach ( $possibleAlerts as $possibleAlert ) {
			if ( isset( $_REQUEST[ $possibleAlert ] ) ) {
				$alerts[] = self::getAlertMessage( $possibleAlert );
			}
		}

		return $alerts;
	}

	/**
	 * Retrieve possible blockers from request parameters
	 */
	public static function retrieveRequestBlockers( $blockers ) {
		if ( ! is_array( $blockers ) ) {
			return null;
		}

		foreach ( $blockers as $blocker ) {
			if ( 'guest_required' == $blocker && is_user_logged_in() ) {
				return self::getErrorMessage( $blocker );
			}

			if ( 'user_required' == $blocker && ! is_user_logged_in() ) {
				return self::getErrorMessage( $blocker );
			}

			if ( 'registration_closed' == $blocker && ! get_option( 'users_can_register' ) ) {
				return self::getErrorMessage( $blocker );
			}

			if ( 'invalid_link' == $blocker && ( ! isset( $_REQUEST['login'] ) || ! isset( $_REQUEST['key'] ) ) ) {
				return self::getErrorMessage( $blocker );
			}
		}
	}

	/**
	 * Finds and returns a matching error message for the given error code.
	 *
	 * @param string $errorCode    The error code to look up.
	 *
	 * @return array               An error object.
	 */
	public static function getErrorMessage( $errorCode ) {
		switch ( $errorCode ) {
			case 'empty_username':
			case 'empty_email':
				$error = __( 'You need to enter your username or email address to continue.', 'chipmunk' );
				break;

			case 'invalid_username':
			case 'invalid_email':
			case 'invalidcombo':
				$error = __( 'There is no account with that username or email address.', 'chipmunk' );
				break;

			case 'empty_password':
				$error = __( 'You need to enter a password to login.', 'chipmunk' );
				break;

			case 'incorrect_password':
				$error = __( 'The password you entered wasn\'t quite right. Did you forget your password?', 'chipmunk' );
				break;

			case 'email':
				$error = __( 'The email address you entered is not valid.', 'chipmunk' );
				break;

			case 'existing_user_email':
				$error = __( 'An account exists with this email address. Please choose a different one.', 'chipmunk' );
				break;

			case 'existing_user_login':
				$error = __( 'An account exists with this username. Please choose a different one.', 'chipmunk' );
				break;

			case 'closed':
				$error = __( 'Registering new users is currently not allowed.', 'chipmunk' );
				break;

			case 'captcha':
				$error = __( 'Please verify that you are not a robot.', 'chipmunk' );
				break;

			case 'expiredkey':
			case 'invalidkey':
				$error = __( 'The password reset link you used is not valid anymore.', 'chipmunk' );
				break;

			case 'password_mismatch':
				$error = __( 'The two passwords you entered don\'t match.', 'chipmunk' );
				break;

			case 'reset_password_empty':
				$error = __( 'Sorry, we don\'t accept empty passwords.', 'chipmunk' );
				break;

			case 'login_required':
				$error = __( 'You have to be signed in to view this page.', 'chipmunk' );
				break;

			case 'guest_required':
				$error = __( 'You are already signed in.', 'chipmunk' );
				break;

			case 'user_required':
				$error = __( 'You have to be signed in to view this page.', 'chipmunk' );
				break;

			case 'registration_closed':
				$error = __( 'Registering new users is currently not allowed.', 'chipmunk' );
				break;

			case 'invalid_link':
				$error = __( 'Invalid password reset link.', 'chipmunk' );
				break;

			default:
				$error = __( 'An unknown error occurred. Please try again later.', 'chipmunk' );
		}

		return [
			'type'    => 'error',
			'message' => $error,
		];
	}

	/**
	 * Finds and returns a matching alert message for the given alert code.
	 *
	 * @param string $alertCode    The alert code to look up.
	 *
	 * @return string               An alert message.
	 */
	private static function getAlertMessage( $alertCode ) {
		switch ( $alertCode ) {
			case 'logged_out':
				return [
					'type'    => 'warning',
					'message' => __( 'You have signed out. Would you like to sign in again?', 'chipmunk' ),
				];
				break;

			case 'registered':
				return [
					'type'    => 'success',
					'message' => __( 'You have successfully registered your account. You can login now.', 'chipmunk' ),
				];
				break;

			case 'lost_password_sent':
				return [
					'type'    => 'warning',
					'message' => __( 'Check your email for a link to reset your password.', 'chipmunk' ),
				];
				break;

			case 'password_changed':
				return [
					'type'    => 'success',
					'message' => __( 'Your password has been changed. You can sign in now.', 'chipmunk' ),
				];
				break;

			case 'profile_updated':
				return [
					'type'    => 'success',
					'message' => __( 'Your profile has been updated successfully.', 'chipmunk' ),
				];
				break;
		}
	}
}
