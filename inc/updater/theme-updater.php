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

// Loads the updater classes
new Chipmunk_Theme_Updater_Admin(

	// Config settings
	array(
		'menu_url'       => admin_url( 'admin.php?page=' . THEME_SLUG ),
		'remote_api_url' => THEME_URL,
		'item_slug'      => THEME_SLUG,
		'item_name'      => THEME_TITLE,
		'version'        => THEME_VERSION,
		'author'         => 'Made by Less',
	),

	// Strings
	array(
		'licenses'                  => __( 'Licenses', 'chipmunk' ),
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
		'license-is-inactive'       => __( 'License is inactive.', 'chipmunk' ),
		'license-key-is-disabled'   => __( 'License key is disabled.', 'chipmunk' ),
		'site-is-inactive'          => __( 'Site is inactive.', 'chipmunk' ),
		'license-status-unknown'    => __( 'License status is unknown.', 'chipmunk' ),
		'update-notice'             => __( "Updating this theme may lose the customizations you have made directly in the source code.", 'chipmunk' ),
		'update-available'          => __( '<strong>%1$s %2$s</strong> is available. <a href="%3$s" class="thickbox" title="%4s">Check out what\'s new</a> or <a href="%5$s"%6$s>update now</a>.', 'chipmunk' ),
	)

);
