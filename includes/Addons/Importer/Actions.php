<?php

namespace Chipmunk\Addons\Importer;

use \Chipmunk\Settings;
use \Chipmunk\Errors;
use \Chipmunk\FileHandler;

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
		add_action( 'admin_init', [ $this, 'maybe_import' ], 1 );
	}

	/**
	 * Checks if a import action was submitted.
	 */
	public function maybe_import() {
		if ( isset( $_POST[ THEME_SLUG . '_import' ] ) ) {
			$this->import( 'resource' );
		}
	}

	/**
	 * Imports the CSV file to the database
	 */
	private function import( $type ) {
		check_admin_referer( THEME_SLUG . '_import_nonce' );

		$handler = new FileHandler();
		$handler->handleFile( $_FILES[ THEME_SLUG . '_import_csv' ], [ 'text/csv' ] );
		$file = $handler->getUploadedFilePath();
		var_dump( $file );
	}
}
