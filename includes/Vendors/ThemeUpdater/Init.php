<?php

namespace Chipmunk\Vendors\ThemeUpdater;

/**
 * Easy Digital Downloads Theme Updater
 *
 * @package WordPress
 * @subpackage Chipmunk
 */
class Init {

	/**
	 * Initiate the Theme Updater classes
	 */
	public function __construct() {
		// Initialize theme updater
		new Admin(
			[
				'remote_api_url' => THEME_SHOP_URL,
				'item_id'        => THEME_ITEM_ID,
				'item_name'      => THEME_TITLE,
				'item_slug'      => THEME_ITEM_SLUG,
				'version'        => THEME_VERSION,
				'author'         => THEME_AUTHOR,
			]
		);
	}
}
