<?php

namespace Chipmunk\Addons\Members;

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
	public function __construct() {
		// Redirects
		add_action( 'login_form_login', [ $this, 'redirect_to_login_form' ] );
		add_action( 'login_form_register', [ $this, 'redirect_to_register_form' ] );
		add_action( 'login_form_lostpassword', [ $this, 'redirect_to_lost_password_form' ] );
		add_action( 'login_form_rp', [ $this, 'redirect_to_reset_password_form' ] );
		add_action( 'login_form_resetpass', [ $this, 'redirect_to_reset_password_form' ] );

		add_filter( 'login_redirect', [ $this, 'redirect_after_login' ], 1, 3 );
		add_action( 'wp_logout', [ $this, 'redirect_after_logout' ] );

		// Authentication
		add_filter( 'authenticate', [ $this, 'redirect_at_authenticate_errors' ], 101, 3 );
	}

	/**
	 * Redirect the user to the custom login page instead of
	 * wp-login.php.
	 */
	public function redirect_to_login_form() {
		if ( $_SERVER['REQUEST_METHOD'] == 'GET' ) {
			$redirect_to = $_REQUEST['redirect_to'] ?? null;

			if ( is_user_logged_in() ) {
				$this->redirect_logged_in_user( $redirect_to );
				exit;
			}

			// The rest are redirected to the login page
			$login_url = Helpers::get_page_permalink( 'login' );

			if ( ! empty( $redirect_to ) ) {
				$login_url = add_query_arg( 'redirect_to', $redirect_to, $login_url );
			}

			wp_safe_redirect( $login_url );
			exit;
		}
	}

	/**
	 * Redirects the user to the custom registration page instead of
	 * wp-login.php?action=register.
	 */
	public function redirect_to_register_form() {
		if ( 'GET' == $_SERVER['REQUEST_METHOD'] ) {
			if ( is_user_logged_in() ) {
				$this->redirect_logged_in_user();
				exit;
			}

			wp_safe_redirect( Helpers::get_page_permalink( 'register' ) );
			exit;
		}
	}

	/**
	 * Redirects the user to the custom "Forgot your password?" page instead of
	 * wp-login.php?action=lostpassword.
	 */
	public function redirect_to_lost_password_form() {
		if ( 'GET' == $_SERVER['REQUEST_METHOD'] ) {
			$redirect_to = $_REQUEST['redirect_to'] ?? null;

			if ( is_user_logged_in() ) {
				$this->redirect_logged_in_user( $redirect_to );
				exit;
			}

			// The rest are redirected to the lost password page
			$pass_url = Helpers::get_page_permalink( 'lost_password' );

			if ( ! empty( $redirect_to ) ) {
				$pass_url = add_query_arg( 'redirect_to', $redirect_to, $pass_url );
			}

			wp_safe_redirect( $pass_url );
			exit;
		}
	}

	/**
	 * Redirects to the custom password reset page, or the login page
	 * if there are errors.
	 */
	public function redirect_to_reset_password_form() {
		if ( 'GET' == $_SERVER['REQUEST_METHOD'] ) {
			// Verify key / login combo
			$user = check_reset_password_key( $_REQUEST['key'], $_REQUEST['login'] );

			if ( ! $user || is_wp_error( $user ) ) {
				$redirect_url = Helpers::get_page_permalink( 'login' );
				$redirect_url = add_query_arg( 'errors', $user->get_error_code(), $redirect_url );

				wp_safe_redirect( $redirect_url );
				exit;
			}

			$redirect_url = Helpers::get_page_permalink( 'reset_password' );
			$redirect_url = add_query_arg( 'login', esc_attr( $_REQUEST['login'] ), $redirect_url );
			$redirect_url = add_query_arg( 'key', esc_attr( $_REQUEST['key'] ), $redirect_url );

			wp_safe_redirect( $redirect_url );
			exit;
		}
	}

	/**
	 * Returns the URL to which the user should be redirected after the (successful) login.
	 *
	 * @param string           $redirect_to           The redirect destination URL.
	 * @param string           $requested_redirect_to The requested redirect destination URL passed as a parameter.
	 * @param WP_User|WP_Error $user                  WP_User object if login was successful, WP_Error object otherwise.
	 *
	 * @return string Redirect URL
	 */
	public function redirect_after_login( $redirect_to, $requested_redirect_to, $user ) {
		// Get the redirect path for logged in user
		$redirect_url = $this->get_login_redirect_path( $user, $_REQUEST['redirect_to'] );

		// Return updated redirect path
		return $redirect_url;
	}

	/**
	 * Redirect to custom login page after the user has been logged out.
	 */
	public function redirect_after_logout() {
		$login_url = Helpers::get_page_permalink( 'login' );
		$login_url = add_query_arg( 'logged_out', true, $login_url );

		wp_safe_redirect( $login_url );
		exit;
	}

	/**
	 * Redirects the user to the correct page depending on whether he / she
	 * is an admin or not.
	 *
	 * @param string $redirect_to   An optional redirect_to URL for admin users
	 */
	private function redirect_logged_in_user( $redirect_to = null ) {
		wp_safe_redirect( $this->get_login_redirect_path( wp_get_current_user(), $redirect_to ) );
	}

	/**
	 * Get proper redirect path for logged in users
	 *
	 * @param Wp_User|Wp_Error  $user          The signed in user, or the errors that have occurred during login.
	 * @param string            $redirect_to   An optional redirect_to URL for admin users
	 *
	 * @return string           The redirect path
	 */
	public function get_login_redirect_path( $user, $redirect_to = null ) {
		if ( ! empty( $redirect_to ) ) {
			return $redirect_to;
		}

		if ( ! isset( $user->ID ) ) {
			return home_url();
		}

		if ( user_can( $user, 'administrator' ) ) {
			return admin_url();
		}

		return Helpers::get_page_permalink( 'dashboard' );
	}

	/**
	 * Redirect the user after authentication if there were any errors.
	 *
	 * @param Wp_User|Wp_Error  $user       The signed in user, or the errors that have occurred during login.
	 * @param string            $username   The user name used to log in.
	 * @param string            $password   The password used to log in.
	 *
	 * @return Wp_User|Wp_Error The logged in user, or error information if there were errors.
	 */
	public function redirect_at_authenticate_errors( $user, $username, $password ) {
		// Check if the earlier authenticate filter (most likely,
		// the default WordPress authentication) functions have found errors
		if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) {
			if ( is_wp_error( $user ) ) {
				$error_codes = join( ',', $user->get_error_codes() );

				$login_url = Helpers::get_page_permalink( 'login' );
				$login_url = add_query_arg( 'errors', $error_codes, $login_url );

				wp_safe_redirect( $login_url );
				exit;
			}
		}

		return $user;
	}
}
