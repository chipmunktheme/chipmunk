<?php

namespace Chipmunk\Config;

use Chipmunk\Helpers;

/**
 * Admin config hooks
 *
 * @package WordPress
 * @subpackage Chipmunk
 */
class Admin {

	/**
 	 * Used to register custom hooks
	 */
	function __construct() {
		add_action( 'admin_notices', [ $this, 'displayAdminNotices' ] );
		add_action( 'admin_init', [ $this, 'addResourcePermalinkSetting' ] );
		add_action( 'admin_init', [ $this, 'addCollectionPermalinkSetting' ] );
		add_action( 'admin_init', [ $this, 'addTagPermalinkSetting' ] );
	}

	/**
	 * Displays admin notices if there are any
	 */
	public static function displayAdminNotices() {
		$notices = apply_filters( 'chipmunk_admin_notices', Helpers::checkRequirements() );

		foreach ( $notices as $notice ) { ?>
			<div class="notice notice-<?php echo esc_attr( $notice['type'] ?? 'error' ); ?>">
				<p><?php echo esc_html( $notice['message'] ); ?></p>
			</div>
		<?php }
	}

	/**
	 * Add extra option to Permalinks settings page
	 */
	public static function addResourcePermalinkSetting() {
		if ( isset( $_POST['chipmunk_resource_cpt_base'] ) ) {
			update_option( 'chipmunk_resource_cpt_base', $_POST['chipmunk_resource_cpt_base'] );
		}

		add_settings_field(
			'chipmunk_resource_cpt_base',
			__('Resource base', 'chipmunk'),
			[ self::class, 'add_resource_permalink_setting_callback' ],
			'permalink',
			'optional'
		);
	}

	public static function addResourcePermalinkSettingCallback() {
		$value = get_option( 'chipmunk_resource_cpt_base' );
		echo '<input type="text" value="' . esc_attr( $value ) . '" name="chipmunk_resource_cpt_base" id="chipmunk_resource_cpt_base" class="regular-text code" />';
	}

	/**
	 * Add extra option to Permalinks settings page
	 */
	public static function addCollectionPermalinkSetting() {
		if ( isset( $_POST['chipmunk_collection_cpt_base'] ) ) {
			update_option( 'chipmunk_collection_cpt_base', $_POST['chipmunk_collection_cpt_base'] );
		}

		add_settings_field(
			'chipmunk_collection_cpt_base',
			__('Collection base', 'chipmunk'),
			[ self::class, 'add_collection_permalink_setting_callback' ],
			'permalink',
			'optional'
		);
	}

	public static function addCollectionPermalinkSettingCallback() {
		$value = get_option( 'chipmunk_collection_cpt_base' );
		echo '<input type="text" value="' . esc_attr( $value ) . '" name="chipmunk_collection_cpt_base" id="chipmunk_collection_cpt_base" class="regular-text code" />';
	}

	/**
	 * Add extra option to Permalinks settings page
	 */
	public static function addTagPermalinkSetting() {
		if ( isset( $_POST['chipmunk_tag_cpt_base'] ) ) {
			update_option( 'chipmunk_tag_cpt_base', $_POST['chipmunk_tag_cpt_base'] );
		}

		add_settings_field(
			'chipmunk_tag_cpt_base',
			__('Resource tag base', 'chipmunk'),
			[ self::class, 'add_tag_permalink_setting_callback' ],
			'permalink',
			'optional'
		);
	}

	public static function addTagPermalinkSettingCallback() {
		$value = get_option( 'chipmunk_tag_cpt_base' );
		echo '<input type="text" value="' . esc_attr( $value ) . '" name="chipmunk_tag_cpt_base" id="chipmunk_tag_cpt_base" class="regular-text code" />';
	}
}
