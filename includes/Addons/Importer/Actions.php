<?php

namespace Chipmunk\Addons\Importer;

use \Chipmunk\Settings;

/**
 * AJAX action callbacks
 *
 * @package WordPress
 * @subpackage Chipmunk
 */
class Actions {

	/**
 	 * Class constructor
	 */
	public function __construct() {
		add_action( 'admin_init', [ $this, 'maybe_import' ] );
	}

	/**
	 * Checks if a import action was submitted.
	 */
	public function maybe_import() {
		if ( isset( $_POST[THEME_SLUG . '_import'] ) ) {
			self::import( 'resource', $_FILES[THEME_SLUG . '_import_csv'] );
		}
	}

	/**
	 * Imports the CSV file to the database
	 */
	private function import( $type, $csv_file ) {
		check_admin_referer( THEME_SLUG . '_import_nonce' );

		if ( empty( $csv_file ) ) {
			Settings::add_settings_error( $this->slug, __( 'You have to provide a valid CSV file!', 'chipmunk' ) );
			return null;
		}
	}
}
