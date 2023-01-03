<?php

namespace Chipmunk\Addons\Members;

use Timber\Timber;
use Chipmunk\Addons\Members\Helpers as MembersHelpers;

/**
 * Initializes the plugin renderers.
 */
class Renderers {

	/**
	 * Class constructor
	 */
	public function __construct() {
		// Shortcodes
		add_shortcode( 'chipmunk-login-form', [ $this, 'renderLoginForm' ] );
		add_shortcode( 'chipmunk-register-form', [ $this, 'renderRegisterForm' ] );
		add_shortcode( 'chipmunk-lost-password-form', [ $this, 'renderLostPasswordForm' ] );
		add_shortcode( 'chipmunk-reset-password-form', [ $this, 'renderResetPasswordForm' ] );
		add_shortcode( 'chipmunk-profile-form', [ $this, 'renderProfileForm' ] );
		add_shortcode( 'chipmunk-dashboard', [ $this, 'renderDashboard' ] );
	}

	/**
	 * A shortcode for rendering the login form.
	 *
	 * @param  array  $atts        Shortcode attributes.
	 * @param  string $content     The text content for shortcode. Not used.
	 *
	 * @return string  The shortcode output
	 */
	public function renderLoginForm( $atts, $content = null ) {
		// Parse shortcode attributes
		$atts = shortcode_atts(
			[
				'show_title' => false,
			],
			$atts
		);

		$atts['blocker'] = MembersHelpers::retrieveRequestBlockers(
			[
				'guest_required',
			]
		);

		if ( empty( $atts['blocker'] ) ) {
			$atts['redirect_to'] = wp_validate_redirect( $_REQUEST['redirect_to'] ?? '' );

			// Retrieve possible errors/alerts from request parameters
			$atts['alerts'] = array_merge(
				MembersHelpers::retrieveRequestErrors(),
				MembersHelpers::retrieveRequestAlerts()
			);
		}

		// Render form template
		return Timber::compile( 'addons/members/login-form.twig', array_merge( Timber::context(), $atts ) );
	}

	/**
	 * A shortcode for rendering the register form.
	 *
	 * @param  array  $atts        Shortcode attributes.
	 * @param  string $content     The text content for shortcode. Not used.
	 *
	 * @return string  The shortcode output
	 */
	public function renderRegisterForm( $atts, $content = null ) {
		// Parse shortcode attributes
		$atts = shortcode_atts(
			[
				'show_title' => false,
			],
			$atts
		);

		$atts['blocker'] = MembersHelpers::retrieveRequestBlockers(
			[
				'guest_required',
				'registration_closed',
			]
		);

		if ( empty( $atts['blocker'] ) ) {
			// Retrieve possible errors/alerts from request parameters
			$atts['alerts'] = array_merge(
				MembersHelpers::retrieveRequestErrors(),
				MembersHelpers::retrieveRequestAlerts()
			);
		}

		// Render form template
		return Timber::compile( 'addons/members/register-form.twig', array_merge( Timber::context(), $atts ) );
	}

	/**
	 * A shortcode for rendering the form used to initiate the password reset.
	 *
	 * @param  array  $atts        Shortcode attributes.
	 * @param  string $content     The text content for shortcode. Not used.
	 *
	 * @return string  The shortcode output
	 */
	public function renderLostPasswordForm( $atts, $content = null ) {
		// Parse shortcode attributes
		$atts = shortcode_atts(
			[
				'show_title' => false,
			],
			$atts
		);

		$atts['blocker'] = MembersHelpers::retrieveRequestBlockers(
			[
				'guest_required',
			]
		);

		if ( empty( $atts['blocker'] ) ) {
			$atts['action']      = 'lostpassword';
			$atts['redirect_to'] = wp_validate_redirect( $_REQUEST['redirect_to'] ?? '' );

			// Retrieve possible errors/alerts from request parameters
			$atts['alerts'] = array_merge(
				MembersHelpers::retrieveRequestErrors(),
				MembersHelpers::retrieveRequestAlerts()
			);
		}

		// Render form template
		return Timber::compile( 'addons/members/lost-password-form.twig', array_merge( Timber::context(), $atts ) );
	}

	/**
	 * A shortcode for rendering the form used to reset a user's password.
	 *
	 * @param  array  $atts        Shortcode attributes.
	 * @param  string $content     The text content for shortcode. Not used.
	 *
	 * @return string  The shortcode output
	 */
	public function renderResetPasswordForm( $atts, $content = null ) {
		// Parse shortcode attributes
		$atts = shortcode_atts(
			[
				'show_title' => false,
			],
			$atts
		);

		$atts['blocker'] = MembersHelpers::retrieveRequestBlockers(
			[
				'guest_required',
				'invalid_link',
			]
		);

		if ( empty( $atts['blocker'] ) ) {
			$atts['action'] = $_REQUEST['action'];
			$atts['key']    = $_REQUEST['key'];
			$atts['login']  = $_REQUEST['login'];

			// Retrieve possible errors/alerts from request parameters
			$atts['alerts'] = array_merge(
				MembersHelpers::retrieveRequestErrors(),
				MembersHelpers::retrieveRequestAlerts()
			);
		}

		// Render form template
		return Timber::compile( 'addons/members/reset-password-form.twig', array_merge( Timber::context(), $atts ) );
	}

	/**
	 * A shortcode for rendering the form used to update user's profile.
	 *
	 * @param  array  $atts        Shortcode attributes.
	 * @param  string $content     The text content for shortcode. Not used.
	 *
	 * @return string  The shortcode output
	 */
	public function renderProfileForm( $atts, $content = null ) {
		// Parse shortcode attributes
		$atts = shortcode_atts(
			[
				'show_title' => false,
			],
			$atts
		);

		$atts['blocker'] = MembersHelpers::retrieveRequestBlockers(
			[
				'user_required',
			]
		);

		if ( empty( $atts['blocker'] ) ) {
			// Retrieve user meta and data
			$user_id      = get_current_user_id();
			$user_data    = get_userdata( $user_id );
			$user_meta    = array_map(
				function( $a ) {
					return $a[0];
				},
				get_user_meta( $user_id )
			);
			$user_socials = wp_get_user_contact_methods();

			$atts['usermeta']    = $user_meta;
			$atts['userdata']    = $user_data;
			$atts['usersocials'] = $user_socials;

			// Retrieve possible errors/alerts from request parameters
			$atts['alerts'] = array_merge(
				MembersHelpers::retrieveRequestErrors(),
				MembersHelpers::retrieveRequestAlerts()
			);
		}

		// Render form template
		return Timber::compile( 'addons/members/profile-form.twig', array_merge( Timber::context(), $atts ) );
	}

	/**
	 * A shortcode for rendering the dashboard page.
	 *
	 * @param  array  $atts        Shortcode attributes.
	 * @param  string $content     The text content for shortcode. Not used.
	 *
	 * @return string  The shortcode output
	 */
	public function renderDashboard( $atts, $content = null ) {
		// Parse shortcode attributes
		$atts = shortcode_atts(
			[
				'show_title' => false,
			],
			$atts
		);

		$atts['blocker'] = MembersHelpers::retrieveRequestBlockers(
			[
				'user_required',
			]
		);

		// Render form template
		return Timber::compile( 'addons/members/dashboard.twig', array_merge( Timber::context(), $atts ) );
	}
}
