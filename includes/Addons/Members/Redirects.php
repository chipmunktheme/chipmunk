<?php

namespace Chipmunk\Addons\Members;

use Chipmunk\Addons\Members\Helpers as MembersHelpers;

/**
 * Initializes the plugin redirects.
 *
 * @package WordPress
 * @subpackage Chipmunk
 */
class Redirects {

	/**
	 * Class constructor
	 */
	function __construct() {
		// Redirects
		add_action( 'login_form_login', array( $this, 'redirectToLoginForm' ) );
		add_action( 'login_form_register', array( $this, 'redirectToRegisterForm' ) );
		add_action( 'login_form_lostpassword', array( $this, 'redirectToLostPasswordForm' ) );
		add_action( 'login_form_rp', array( $this, 'redirectToResetPasswordForm' ) );
		add_action( 'login_form_resetpass', array( $this, 'redirectToResetPasswordForm' ) );

		add_filter( 'login_redirect', array( $this, 'redirectAfterLogin' ), 1, 3 );
		add_action( 'wp_logout', array( $this, 'redirectAfterLogout' ) );

		// Authentication
		add_filter( 'authenticate', array( $this, 'redirectAtAuthenticateErrors' ), 101, 3 );
	}

	/**
	 * Redirect the user to the custom login page instead of
	 * wp-login.php.
	 */
	public function redirectToLoginForm() {
		if ( $_SERVER['REQUEST_METHOD'] == 'GET' ) {
			$redirectTo = $_REQUEST['redirect_to'] ?? null;

			if ( is_user_logged_in() ) {
				$this->redirectLoggedInUser( $redirectTo );
				exit;
			}

			// The rest are redirected to the login page
			$loginUrl = MembersHelpers::getPagePermalink( 'login' );

			if ( ! empty( $redirectTo ) ) {
				$loginUrl = add_query_arg( 'redirect_to', $redirectTo, $loginUrl );
			}

			wp_safe_redirect( $loginUrl );
			exit;
		}
	}

	/**
	 * Redirects the user to the custom registration page instead of
	 * wp-login.php?action=register.
	 */
	public function redirectToRegisterForm() {
		if ( 'GET' == $_SERVER['REQUEST_METHOD'] ) {
			if ( is_user_logged_in() ) {
				$this->redirectLoggedInUser();
				exit;
			}

			wp_safe_redirect( MembersHelpers::getPagePermalink( 'register' ) );
			exit;
		}
	}

	/**
	 * Redirects the user to the custom "Forgot your password?" page instead of
	 * wp-login.php?action=lostpassword.
	 */
	public function redirectToLostPasswordForm() {
		if ( 'GET' == $_SERVER['REQUEST_METHOD'] ) {
			$redirectTo = $_REQUEST['redirect_to'] ?? null;

			if ( is_user_logged_in() ) {
				$this->redirectLoggedInUser( $redirectTo );
				exit;
			}

			// The rest are redirected to the lost password page
			$passUrl = MembersHelpers::getPagePermalink( 'lost_password' );

			if ( ! empty( $redirectTo ) ) {
				$passUrl = add_query_arg( 'redirect_to', $redirectTo, $passUrl );
			}

			wp_safe_redirect( $passUrl );
			exit;
		}
	}

	/**
	 * Redirects to the custom password reset page, or the login page
	 * if there are errors.
	 */
	public function redirectToResetPasswordForm() {
		if ( 'GET' == $_SERVER['REQUEST_METHOD'] ) {
			// Verify key / login combo
			$user = check_password_reset_key( $_REQUEST['key'], $_REQUEST['login'] );

			if ( ! $user || is_wp_error( $user ) ) {
				$redirectUrl = MembersHelpers::getPagePermalink( 'login' );
				$redirectUrl = add_query_arg( 'errors', $user->get_error_code(), $redirectUrl );

				wp_safe_redirect( $redirectUrl );
				exit;
			}

			$redirectUrl = MembersHelpers::getPagePermalink( 'reset_password' );
			$redirectUrl = add_query_arg( 'login', esc_attr( $_REQUEST['login'] ), $redirectUrl );
			$redirectUrl = add_query_arg( 'key', esc_attr( $_REQUEST['key'] ), $redirectUrl );

			wp_safe_redirect( $redirectUrl );
			exit;
		}
	}

	/**
	 * Returns the URL to which the user should be redirected after the (successful) login.
	 *
	 * @param string           $redirectTo      The redirect destination URL.
	 * @param string           $request         The requested redirect destination URL passed as a parameter.
	 * @param WP_User|WP_Error $user            WP_User object if login was successful, WP_Error object otherwise.
	 *
	 * @return string Redirect URL
	 */
	public function redirectAfterLogin( $redirectTo, $request, $user ) {
		// Get the redirect path for logged in user
		$redirectUrl = $this->getLoginRedirectPath( $user, $_REQUEST['redirect_to'] );

		// Return updated redirect path
		return $redirectUrl;
	}

	/**
	 * Redirect to custom login page after the user has been logged out.
	 */
	public function redirectAfterLogout() {
		$loginUrl = MembersHelpers::getPagePermalink( 'login' );
		$loginUrl = add_query_arg( 'logged_out', true, $loginUrl );

		wp_safe_redirect( $loginUrl );
		exit;
	}

	/**
	 * Redirects the user to the correct page depending on whether he / she
	 * is an admin or not.
	 *
	 * @param string $redirectTo   An optional redirect_to URL for admin users
	 */
	private function redirectLoggedInUser( $redirectTo = null ) {
		wp_safe_redirect( $this->getLoginRedirectPath( wp_get_current_user(), $redirectTo ) );
	}

	/**
	 * Get proper redirect path for logged in users
	 *
	 * @param Wp_User|Wp_Error $user          The signed in user, or the errors that have occurred during login.
	 * @param string           $redirectTo   An optional redirect_to URL for admin users
	 *
	 * @return string           The redirect path
	 */
	public function getLoginRedirectPath( $user, $redirectTo = null ) {
		if ( ! empty( $redirectTo ) ) {
			return $redirectTo;
		}

		if ( ! isset( $user->ID ) ) {
			return home_url();
		}

		if ( user_can( $user, 'administrator' ) ) {
			return admin_url();
		}

		return MembersHelpers::getPagePermalink( 'dashboard' );
	}

	/**
	 * Redirect the user after authentication if there were any errors.
	 *
	 * @param Wp_User|Wp_Error $user       The signed in user, or the errors that have occurred during login.
	 * @param string           $username   The user name used to log in.
	 * @param string           $password   The password used to log in.
	 *
	 * @return Wp_User|Wp_Error The logged in user, or error information if there were errors.
	 */
	public function redirectAtAuthenticateErrors( $user ) {
		// Check if the earlier authenticate filter (most likely,
		// the default WordPress authentication) functions have found errors
		if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) {
			if ( is_wp_error( $user ) ) {
				$errorCodes = join( ',', $user->get_error_codes() );

				$loginUrl = MembersHelpers::getPagePermalink( 'login' );
				$loginUrl = add_query_arg( 'errors', $errorCodes, $loginUrl );

				wp_safe_redirect( $loginUrl );
				exit;
			}
		}

		return $user;
	}
}
