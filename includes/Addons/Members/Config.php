<?php

namespace Chipmunk\Addons\Members;

use Chipmunk\Addons\Members\Helpers as MembersHelpers;

/**
 * Main plugin configuration
 *
 * @package WordPress
 * @subpackage Chipmunk
 */
class Config {

	/**
	 * Class constructor
	 */
	function __construct() {
		// Custom URL
		add_filter( 'login_url', array( $this, 'customLoginPage' ), 10, 3 );

		// Custom login redirect
		add_filter( 'login_redirect', array( $this, 'customLoginRedirect' ), 10, 3 );

		// Other customizations
		add_filter( 'retrieve_password_message', array( $this, 'replaceRetrievePasswordMessage' ), 10, 4 );

		// Remove the admin bar on the frontend
		add_action( 'wp', array( $this, 'removeAdminBar' ) );

		// Disable the admin email address verification
		add_filter( 'admin_email_check_interval', '__return_zero' );

	}

	/**
	 * Removes admin bar for non-admin users
	 */
	public function removeAdminBar() {
		if ( ! current_user_can( 'edit_posts' ) && ! is_admin() ) {
			show_admin_bar( false );
		}
	}

	/**
	 * Change default login url to My Account
	 */
	public function customLoginPage( $loginUrl, $redirect, $forceReauth ) {
		return MembersHelpers::getPagePermalink( 'login' ) . '?redirect_to=' . $redirect;
	}

	/**
	 * Set custom login redirect URL
	 */
	public function customLoginRedirect( $redirectTo, $request, $user ) {
		if ( ! empty( $_REQUEST['redirect_to'] ) ) {
			$redirectTo = $_REQUEST['redirect_to'];
		} elseif ( ! is_super_admin( $user->ID ) && ! wp_doing_ajax() ) {
			$redirectTo = MembersHelpers::getPagePermalink( 'dashboard' );
		} else {
			$redirectTo = get_admin_url();
		}

		return $redirectTo;
	}

	/**
	 * Returns the message body for the password reset mail.
	 * Called through the retrieve_password_message filter.
	 *
	 * @param string  $message    Default mail message.
	 * @param string  $key        The activation key.
	 * @param string  $userLogin  The username for the user.
	 * @param WP_User $userData   WP_User object.
	 *
	 * @return string   The mail message to send.
	 */
	public function replaceRetrievePasswordMessage( $message, $key, $userLogin, $userData ) {
		$resetUrl = MembersHelpers::getPagePermalink( 'reset_password' );
		$resetUrl = add_query_arg( 'action', 'rp', $resetUrl );
		$resetUrl = add_query_arg( 'key', $key, $resetUrl );
		$resetUrl = add_query_arg( 'login', rawurlencode( $userLogin ), $resetUrl );

		// Create new message
		$msg  = __( 'Hello!', 'chipmunk' ) . "\r\n\r\n";
		$msg .= sprintf( __( 'You asked us to reset your password for your account using the email address %s.', 'chipmunk' ), $userLogin ) . "\r\n\r\n";
		$msg .= __( "If this was a mistake, or you didn't ask for a password reset, just ignore this email and nothing will happen.", 'chipmunk' ) . "\r\n\r\n";
		$msg .= __( 'To reset your password, visit the following address:', 'chipmunk' ) . "\r\n\r\n";
		$msg .= $resetUrl . "\r\n\r\n";
		$msg .= __( 'Thanks!', 'chipmunk' ) . "\r\n";

		return $msg;
	}
}
