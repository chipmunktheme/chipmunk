<?php

namespace Chipmunk\Addons\Members;

/**
 * Main plugin configuration
 *
 * @package WordPress
 * @subpackage Chipmunk
 */
class Config {

	/**
 	 * Class constructor
	 *
	 * @return void
	 */
	public function __construct() {
		// Custom URL
		add_filter( 'login_url', array( $this, 'custom_login_page' ), 10, 3 );

		// Custom login redirect
		add_filter( 'login_redirect', array( $this, 'custom_login_redirect' ), 10, 3 );

		// Other customizations
		add_filter( 'retrieve_password_message', array( $this, 'replace_retrieve_password_message' ), 10, 4 );

		// Remove the admin bar on the frontend
		add_action( 'wp', array( $this, 'remove_admin_bar' ) );

		// Disable the admin email address verification
		add_filter( 'admin_email_check_interval', '__return_zero' );

	}

	/**
	 * Removes admin bar for non-admin users
	 */
	public function remove_admin_bar() {
		if ( ! current_user_can( 'edit_posts' ) && ! is_admin() ) {
			show_admin_bar( false );
		}
	}

	/**
	 * Change default login url to My Account
	 */
	public function custom_login_page( $login_url, $redirect, $force_reauth ) {
		return Helpers::get_page_permalink( 'login' ) . '?redirect_to=' . $redirect;
	}

	/**
	 * Set custom login redirect URL
	 */
	public function custom_login_redirect( $redirect_to, $request, $user ) {
		if ( ! empty( $_REQUEST['redirect_to'] ) ) {
			$redirect_to = $_REQUEST['redirect_to'];
		} else if ( ! is_super_admin( $user->ID ) && ! wp_doing_ajax() ) {
			$redirect_to = Helpers::get_page_permalink( 'dashboard' );
		} else {
			$redirect_to = get_admin_url();
		}

		return $redirect_to;
	}

	/**
	 * Returns the message body for the password reset mail.
	 * Called through the retrieve_password_message filter.
	 *
	 * @param string  $message    Default mail message.
	 * @param string  $key        The activation key.
	 * @param string  $user_login The username for the user.
	 * @param WP_User $user_data  WP_User object.
	 *
	 * @return string   The mail message to send.
	 */
	public function replace_retrieve_password_message( $message, $key, $user_login, $user_data ) {
		$reset_url = Helpers::get_page_permalink( 'reset_password' );
		$reset_url = add_query_arg( 'action', 'rp', $reset_url );
		$reset_url = add_query_arg( 'key', $key, $reset_url );
		$reset_url = add_query_arg( 'login', rawurlencode( $user_login ), $reset_url );

		// Create new message
		$msg  = __( 'Hello!', 'chipmunk' ) . "\r\n\r\n";
		$msg .= sprintf( __( 'You asked us to reset your password for your account using the email address %s.', 'chipmunk' ), $user_login ) . "\r\n\r\n";
		$msg .= __( "If this was a mistake, or you didn't ask for a password reset, just ignore this email and nothing will happen.", 'chipmunk' ) . "\r\n\r\n";
		$msg .= __( 'To reset your password, visit the following address:', 'chipmunk' ) . "\r\n\r\n";
		$msg .= $reset_url . "\r\n\r\n";
		$msg .= __( 'Thanks!', 'chipmunk' ) . "\r\n";

		return $msg;
	}
}
