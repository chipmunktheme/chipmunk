<?php

namespace Chipmunk\Addons\Importer;

/**
 * Initializes the plugin renderers.
 *
 * @package WordPress
 * @subpackage Chipmunk
 */
class Renderers {

	/**
 	 * Class constructor
	 *
	 * @return void
	 */
	public function __construct() {
		// Shortcodes
		add_shortcode( 'chipmunk-login-form', array( $this, 'render_login_form' ) );
		add_shortcode( 'chipmunk-register-form', array( $this, 'render_register_form' ) );
		add_shortcode( 'chipmunk-lost-password-form', array( $this, 'render_lost_password_form' ) );
		add_shortcode( 'chipmunk-reset-password-form', array( $this, 'render_reset_password_form' ) );
		add_shortcode( 'chipmunk-profile-form', array( $this, 'render_profile_form' ) );
		add_shortcode( 'chipmunk-dashboard', array( $this, 'render_dashboard' ) );
	}

	/**
	 * A shortcode for rendering the login form.
	 *
	 * @param  array   $atts        Shortcode attributes.
	 * @param  string  $content     The text content for shortcode. Not used.
	 *
	 * @return string  The shortcode output
	 */
	public function render_login_form( $atts, $content = null ) {
		// Parse shortcode attributes
		$attributes = shortcode_atts( array(
			'show_title' => false,
			'errors'     => array(),
		), $atts );

		$attributes['blocker'] = Helpers::retrieve_request_blockers( array(
			'guest_required',
		) );

		if ( empty( $attributes['blocker'] ) ) {
			$attributes['redirect_to'] = wp_validate_redirect( $_REQUEST['redirect_to'] ?? '' );

			// Retrieve possible errors/alerts from request parameters
			$attributes['errors'] = Helpers::retrieve_request_errors();
			$attributes['alerts'] =  Helpers::retrieve_request_alerts();
		}

		// Render form template
		return \Chipmunk\Helpers::get_template_part( 'addons/members/login-form', $attributes );
	}

	/**
	 * A shortcode for rendering the register form.
	 *
	 * @param  array   $atts        Shortcode attributes.
	 * @param  string  $content     The text content for shortcode. Not used.
	 *
	 * @return string  The shortcode output
	 */
	public function render_register_form( $atts, $content = null ) {
		// Parse shortcode attributes
		$attributes = shortcode_atts( array(
			'show_title' => false,
			'errors'     => array(),
		), $atts );

		$attributes['blocker'] = Helpers::retrieve_request_blockers( array(
			'guest_required',
			'registration_closed',
		) );

		if ( empty( $attributes['blocker'] ) ) {
			// Retrieve possible errors/alerts from request parameters
			$attributes['errors'] = Helpers::retrieve_request_errors();
			$attributes['alerts'] =  Helpers::retrieve_request_alerts();
		}

		// Render form template
		return \Chipmunk\Helpers::get_template_part( 'addons/members/register-form', $attributes );
	}

	/**
	 * A shortcode for rendering the form used to initiate the password reset.
	 *
	 * @param  array   $atts        Shortcode attributes.
	 * @param  string  $content     The text content for shortcode. Not used.
	 *
	 * @return string  The shortcode output
	 */
	public function render_lost_password_form( $atts, $content = null ) {
		// Parse shortcode attributes
		$attributes = shortcode_atts( array(
			'show_title' => false,
		), $atts );

		$attributes['blocker'] = Helpers::retrieve_request_blockers( array(
			'guest_required',
		) );

		if ( empty( $attributes['blocker'] ) ) {
			$attributes['redirect_to'] = wp_validate_redirect( $_REQUEST['redirect_to'] ?? '' );

			// Retrieve possible errors/alerts from request parameters
			$attributes['errors'] = Helpers::retrieve_request_errors();
			$attributes['alerts'] =  Helpers::retrieve_request_alerts();
		}

		// Render form template
		return \Chipmunk\Helpers::get_template_part( 'addons/members/lost-password-form', $attributes );
	}

	/**
	 * A shortcode for rendering the form used to reset a user's password.
	 *
	 * @param  array   $atts        Shortcode attributes.
	 * @param  string  $content     The text content for shortcode. Not used.
	 *
	 * @return string  The shortcode output
	*/
	public function render_reset_password_form( $atts, $content = null ) {
		// Parse shortcode attributes
		$attributes = shortcode_atts( array(
			'show_title' => false,
		), $atts );

		$attributes['blocker'] = Helpers::retrieve_request_blockers( array(
			'guest_required',
			'invalid_link',
		) );

		if ( empty( $attributes['blocker'] ) ) {
			$attributes['action'] = $_REQUEST['action'];
			$attributes['key'] = $_REQUEST['key'];
			$attributes['login'] = $_REQUEST['login'];

			// Retrieve possible errors/alerts from request parameters
			$attributes['errors'] = Helpers::retrieve_request_errors();
			$attributes['alerts'] =  Helpers::retrieve_request_alerts();
		}

		// Render form template
		return \Chipmunk\Helpers::get_template_part( 'addons/members/reset-password-form', $attributes );
	}

	/**
	 * A shortcode for rendering the form used to update user's profile.
	 *
	 * @param  array   $atts        Shortcode attributes.
	 * @param  string  $content     The text content for shortcode. Not used.
	 *
	 * @return string  The shortcode output
	*/
	public function render_profile_form( $atts, $content = null ) {
		// Parse shortcode attributes
		$attributes = shortcode_atts( array(
			'show_title' => false,
		), $atts );

		$attributes['blocker'] = Helpers::retrieve_request_blockers( array(
			'user_required',
		) );

		if ( empty( $attributes['blocker'] ) ) {
			// Retrieve user meta and data
			$user_id = get_current_user_id();
			$user_data = get_userdata( $user_id );
			$user_meta = array_map( function( $a ) { return $a[0]; }, get_user_meta( $user_id ) );
			$user_socials = wp_get_user_contact_methods();

			$attributes['usermeta'] = $user_meta;
			$attributes['userdata'] = $user_data;
			$attributes['usersocials'] = $user_socials;

			// Retrieve possible errors/alerts from request parameters
			$attributes['errors'] = Helpers::retrieve_request_errors();
			$attributes['alerts'] =  Helpers::retrieve_request_alerts();
		}

		// Render form template
		return \Chipmunk\Helpers::get_template_part( 'addons/members/profile-form', $attributes );
	}

	/**
	 * A shortcode for rendering the dashboard page.
	 *
	 * @param  array   $atts        Shortcode attributes.
	 * @param  string  $content     The text content for shortcode. Not used.
	 *
	 * @return string  The shortcode output
	*/
	public function render_dashboard( $atts, $content = null ) {
		// Parse shortcode attributes
		$attributes = shortcode_atts( array(
			'show_title' => false,
		), $atts );

		$attributes['blocker'] = Helpers::retrieve_request_blockers( array(
			'user_required',
		) );

		// Render form template
		return \Chipmunk\Helpers::get_template_part( 'addons/members/dashboard', $attributes );
	}
}
