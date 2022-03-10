<?php

namespace Chipmunk\Plugins\ThemeUpdater;

/**
 * Theme updater admin page and functions.
 *
 * @package WordPress
 * @subpackage Chipmunk
 */
class Admin {
	/**
	 * Initialize the class.
	 *
	 * @since 1.0.0
	 */
	function __construct( $config = array(), $strings = array() ) {
		$config = wp_parse_args( $config, array(
			'remote_api_url'    => '',
			'item_id'           => '',
			'item_name'         => '',
			'item_slug'         => '',
			'version'           => '',
			'author'            => '',
			'download_id'       => '',
			'renew_url'         => '',
			'beta'              => false,
		) );

		// Strings passed in from the updater config
		$this->strings = $strings;

		// Set config arguments
		foreach ( $config as $key => $value ) {
			$this->$key = $value;
		}

		// Updater
		add_action( 'init', array( $this, 'updater' ) );
		add_filter( 'http_request_args', array( $this, 'disable_wporg_request' ), 5, 2 );
	}

	/**
	 * Creates the updater class.
	 */
	function updater() {
		if ( ! current_user_can( 'update_themes' ) ) {
			return false;
		}

		/* If there is no valid license key status, don't allow updates. */
		if ( get_option( $this->item_slug . '_license_key_status', false ) != 'valid' ) {
			return false;
		}

		new Updater(
			array(
				'remote_api_url'    => $this->remote_api_url,
				'version'           => $this->version,
				'license'           => get_option( $this->item_slug . '_license_key' ),
				'item_id'           => $this->item_id,
				'item_name'         => $this->item_name,
				'item_slug'         => $this->item_slug,
				'author'            => $this->author,
				'beta'              => $this->beta,
			),

			$this->strings
		);
	}

	/**
	 * Disable requests to wp.org repository for this theme.
	 *
	 * @since 1.0.0
	 */
	function disable_wporg_request( $r, $url ) {
		// If it's not a theme update request, bail.
		if ( 0 !== strpos( $url, 'https://api.wordpress.org/themes/update-check/1.1/' ) ) {
 			return $r;
 		}

 		// Decode the JSON response
 		$themes = json_decode( $r['body']['themes'] );

 		// Remove the active parent and child themes from the check
 		$parent = get_option( 'template' );
 		$child = get_option( 'stylesheet' );
 		unset( $themes->themes->$parent );
 		unset( $themes->themes->$child );

 		// Encode the updated JSON response
 		$r['body']['themes'] = json_encode( $themes );

 		return $r;
	}

}
