<?php

namespace Chipmunk;

use Timber\Timber;
use Chipmunk\Customizer;
use Chipmunk\Settings\Addons;

/**
 * Theme specific helpers.
 */
class Helpers {

	/**
	 * Check if Chipmunk plugin is enabled
	 *
	 * @param string $addon Addon name
	 *
	 * @return bool
	 */
	public static function isAddonEnabled( $addon ) {
		return Addons::isAddonEnabled( $addon );
	}

	/**
	 * Checks that the reCAPTCHA parameter sent with the registration
	 * request is valid.
	 *
	 * @param string $response Recaptcha response
	 *
	 * @return bool True if the CAPTCHA is OK, otherwise false.
	 */
	public static function verifyRecaptcha( $response ) {
		$enabled   = self::getOption( 'recaptcha_enabled' );
		$siteKey   = self::getOption( 'recaptcha_site_key' );
		$secretKey = self::getOption( 'recaptcha_secret_key' );

		// Verify if user is logged in
		if ( is_user_logged_in() ) {
			return true;
		}

		// Verify if recaptcha is disabled
		if ( ! $enabled or ! $siteKey ) {
			return true;
		}

		if ( ! isset( $response ) or empty( $response ) ) {
			return false;
		}

		if ( $secretKey ) {
			// Verify the captcha response from Google
			$remoteResponse = wp_remote_post(
				'https://www.google.com/recaptcha/api/siteverify',
				[
					'body' => [
						'secret'   => $secretKey,
						'response' => $response,
					],
				]
			);

			$success = false;

			if ( $remoteResponse && is_array( $remoteResponse ) ) {
				$decodedResponse = json_decode( $remoteResponse['body'] );
				$success         = $decodedResponse->success;
			}

			return $success;
		}

		return true;
	}

	/**
	 * Gets the array of socials
	 *
	 * @return array
	 */
	public static function getSocials() {
		$socials = [];

		foreach ( Customizer::getSocials() as $social ) {
			$value = self::getOption( strtolower( $social ) );

			if ( $value ) {
				$socials[ $social ] = $value;
			}
		}

		return $socials;
	}

	/**
	 * Creates a title for post and pages OG tags
	 *
	 * @return string
	 */
	public static function getOgTitle() {
		if ( ! self::getOption( 'disable_og_branding' ) ) {
			return sprintf( esc_html__( '%1$s on %2$s', 'chipmunk' ), get_the_title(), get_bloginfo( 'name' ) );
		}

		return get_the_title();
	}

	/**
	 * Get a list of registered menus
	 *
	 * @return array
	 */
	public static function getRegisteredMenus() {
		$menus = [];

		// Set all nav menus in context.
		foreach ( array_keys( get_registered_nav_menus() ) as $location ) {
			// Bail out if menu has no location.
			if ( $menu = Timber::get_menu( $location ) ) {
				$menus[ str_replace( 'nav-', '', $location ) ] = $menu;
			}
		}

		return $menus;
	}

	/**
	 * Get current page attribute
	 *
	 * @return int
	 */
	public static function getCurrentPage(): int {
		if ( get_query_var( 'paged' ) ) {
			return get_query_var( 'paged' );
		} elseif ( get_query_var( 'page' ) ) {
			return get_query_var( 'page' );
		} else {
			return 1;
		}
	}

	/**
	 * Get related posts query
	 *
	 * @param array $args   Arguments to pass to the query
	 *
	 * @return array
	 */
	public static function getRelatedPosts( array $args = [] ) {
		global $post;

		$defaults = [
			'post_type'    => $post->post_type,
			'post__not_in' => [ $post->ID ],
			'orderby'      => 'rand',
			'related'      => true,
		];

		return Timber::get_posts( wp_parse_args( $args, $defaults ) );
	}
}
