<?php
/**
 * Easy Digital Downloads Theme Updater
 *
 * @package WordPress
 * @subpackage Chipmunk
 */

// Includes the files needed for the theme updater
if ( ! class_exists( 'Chipmunk_Theme_Updater_Admin' ) ) {
	require_once dirname( __FILE__ ) . '/theme-updater-admin.php';
}

if ( ! class_exists( 'Chipmunk_Licenser' ) ) {
	require_once dirname( __FILE__ ) . '/theme-licenser.php';
}

// Initialize theme updater
new Chipmunk_Theme_Updater_Admin(

	// Config settings
	array(
		'remote_api_url' => THEME_SHOP_URL,
		'item_id'        => THEME_ITEM_ID,
		'item_name'      => THEME_TITLE,
		'item_slug'      => THEME_SLUG,
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
new Chipmunk_Licenser(

	// Config settings
	array(
		'menu_url'       => admin_url( 'admin.php?page=' . THEME_SLUG . '_licenses' ),
		'remote_api_url' => THEME_SHOP_URL,
		'item_id'        => THEME_ITEM_ID,
		'item_name'      => THEME_TITLE,
		'item_slug'      => THEME_SLUG,
		'version'        => THEME_VERSION,
		'author'         => THEME_AUTHOR,
	),

	// Strings
	array(
		'enter-key'                 => __( 'Enter your license key.', 'chipmunk' ),
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
		'license-expired'           => __( 'Your license key expired on %s.' ),
		'license-disabled'          => __( 'Your license key has been disabled.' ),
		'license-missing'           => __( 'Your license is invalid.' ),
		'license-invalid'           => __( 'Your license is not active for this URL.' ),
		'license-name-mismatch'     => __( 'This appears to be an invalid license key for %s.' ),
		'license-exceeded'          => __( 'Your license key has reached its activation limit.' ),
		'license-unknown'           => __( 'An error occurred, please try again.' ),
	)
);
