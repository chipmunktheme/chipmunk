<?php

namespace Chipmunk;

use Timber\Timber;
use Chipmunk\Customizer;
use Chipmunk\Settings\Addons;

/**
 * Theme specific helpers.
 *
 * @package WordPress
 * @subpackage Chipmunk
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
	 * Retrieves the server param if not empty
	 *
	 * @param string $key Key of the param
	 *
	 * @return ?string
	 */
	public static function getParam( $key ) {
		return $_REQUEST[ $key ] ?? null;
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
	 * Get resource links
	 *
	 * @param int $postId ID of the resource
	 *
	 * @return ?string
	 */
	public static function getResourceLinks( $postId ) {
		$keyPrefix = '_' . THEME_SLUG . '_resource_';
		$links     = [];

		$metaWebsite = get_post_meta( $postId, $keyPrefix . 'website', true );
		$metaLinks   = get_field( $keyPrefix . 'links', $postId );

		if ( ! empty( $metaWebsite ) ) {
			$links[] = [
				'title'  => apply_filters( 'chipmunk_submission_website_label', __( 'Visit website', 'chipmunk' ) ),
				'url'    => $metaWebsite,
				'target' => '_blank',
			];
		}

		if ( ! empty( $metaLinks ) ) {
			$links = array_merge( $links, array_column( $metaLinks, 'link' ) );
		}

		return $links;
	}

	/**
	 * Add post meta from the array
	 *
	 * @param int   $postId       ID of the post
	 * @param array $meta       Array of key => value pairs of meta to add to the post
	 * @param array $allowed    Array of allowed post types
	 * @param bool  $unique      Optional. Whether the same key should not be added.
	 *
	 * @return int
	 */
	public static function addPostMeta( $postId, $meta, $allowed, $unique = true ) {
		if ( ! in_array( get_post_type( $postId ), $allowed ) ) {
			return $postId;
		}

		foreach ( $meta as $key => $value ) {
			add_post_meta( $postId, $key, $value, $unique );
		}

		return $postId;
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

	/**
	 * Retrieves user's IP address
	 *
	 * @return string
	 */
	public static function getIp(): string {
		if ( isset( $_SERVER['HTTP_CLIENT_IP'] ) && ! empty( $_SERVER['HTTP_CLIENT_IP'] ) ) {
			$ip = $_SERVER['HTTP_CLIENT_IP'];
		} elseif ( isset( $_SERVER['HTTP_X_FORWARDED_FOR'] ) && ! empty( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) {
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else {
			$ip = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
		}

		$ip = filter_var( $ip, FILTER_VALIDATE_IP );
		$ip = ( $ip === false ) ? '0.0.0.0' : $ip;

		return $ip;
	}

	/**
	 * Utility function to format the numbers,
	 * appending "K" if one thousand or greater,
	 * "M" if one million or greater,
	 * and "B" if one billion or greater (unlikely).
	 *
	 * @param int $number       Number to format
	 * @param int $precision    How many decimal points to display (1.25K)
	 *
	 * @return string
	 */
	public static function formatNumber( int $number, int $precision = 1 ): string {
		if ( $number >= 1000 && $number < 1000000 ) {
			$formatted = number_format( $number / 1000, $precision ) . 'K';
		} elseif ( $number >= 1000000 && $number < 1000000000 ) {
			$formatted = number_format( $number / 1000000, $precision ) . 'M';
		} elseif ( $number >= 1000000000 ) {
			$formatted = number_format( $number / 1000000000, $precision ) . 'B';
		} else {
			$formatted = $number; // Number is less than 1000
		}

		return preg_replace( '/\.[0]+([KMB]?)$/i', '$1', $formatted );
	}
}
