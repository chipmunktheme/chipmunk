<?php

namespace Chipmunk\Plugins\ThemeUpdater;

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
			// Config settings
			array(
				'remote_api_url' => THEME_SHOP_URL,
				'item_id'        => THEME_ITEM_ID,
				'item_name'      => THEME_TITLE,
				'item_slug'      => THEME_ITEM_SLUG,
				'version'        => THEME_VERSION,
				'author'         => THEME_AUTHOR,
			),

			// Strings
			array(
				'update-notice'     => __( 'Updating this theme may lose the customizations you have made directly in the source code.', 'chipmunk' ),
				'update-available'  => __( '<strong>%1$s %2$s</strong> is available. <a href="%3$s" class="thickbox" title="%4s">Check out what\'s new</a> or <a href="%5$s"%6$s>update now</a>.', 'chipmunk' ),
			)
		);

		// Initialize theme licenser
		new Licenser(
			// Config settings
			array(
				'menu_url'       => admin_url( 'admin.php?page=' . THEME_SLUG . '_licenses' ),
				'remote_api_url' => THEME_SHOP_URL,
				'item_id'        => THEME_ITEM_ID,
				'item_name'      => THEME_TITLE,
				'item_slug'      => THEME_ITEM_SLUG,
			),

			// Strings
			array(
				'enter-key'                 => __( 'To receive updates, please enter your valid license key.', 'chipmunk' ),
				'license-key'               => __( 'License Key', 'chipmunk' ),
				'license-action'            => __( 'License Action', 'chipmunk' ),
				'deactivate-license'        => __( 'Deactivate License', 'chipmunk' ),
				'activate-license'          => __( 'Activate License', 'chipmunk' ),
				'status-unknown'            => __( 'License status is unknown.', 'chipmunk' ),
				'renew'                     => __( 'Renew?', 'chipmunk' ),
				'unlimited'                 => __( 'unlimited', 'chipmunk' ),
				'license-key-is-active'     => __( 'License key is active.', 'chipmunk' ),
				'expires%s'                 => __( 'Expires %s.', 'chipmunk' ),
				'expires-never'             => __( 'Lifetime License.', 'chipmunk' ),
				'%1$s/%2$-sites'            => __( 'You have %1$s / %2$s sites activated.', 'chipmunk' ),
				'license-key-expired-%s'    => __( 'License key expired %s.', 'chipmunk' ),
				'license-key-expired'       => __( 'License key has expired.', 'chipmunk' ),
				'license-keys-do-not-match' => __( 'License keys do not match.', 'chipmunk' ),
				'license-is-invalid'        => __( 'License is invalid.', 'chipmunk' ),
				'license-is-inactive'       => __( 'License is inactive.', 'chipmunk' ),
				'license-key-is-disabled'   => __( 'License key is disabled.', 'chipmunk' ),
				'site-is-inactive'          => __( 'Site is inactive.', 'chipmunk' ),
				'license-status-unknown'    => __( 'License status is unknown.', 'chipmunk' ),
			),

			// Errors
			array(
				'license-expired'           => __( 'Your license key expired on %s.', 'chipmunk' ),
				'license-disabled'          => __( 'Your license key has been disabled.', 'chipmunk' ),
				'license-missing'           => __( 'Your license is invalid.', 'chipmunk' ),
				'license-invalid'           => __( 'Your license is not active for this URL.', 'chipmunk' ),
				'license-name-mismatch'     => __( 'This appears to be an invalid license key for %s.', 'chipmunk' ),
				'license-exceeded'          => __( 'Your license key has reached its activation limit.', 'chipmunk' ),
				'license-unknown'           => __( 'An error occurred, please try again.', 'chipmunk' ),
			)
		);
	}
}
