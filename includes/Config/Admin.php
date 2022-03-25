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
	 *
	 * @return void
	 */
	function __construct() {
		add_action( 'admin_notices', array( $this, 'display_admin_notices' ) );
		add_action( 'admin_init', array( $this, 'add_resource_permalink_setting' ) );
		add_action( 'admin_init', array( $this, 'add_collection_permalink_setting' ) );
		add_action( 'admin_init', array( $this, 'add_tag_permalink_setting' ) );
	}

	/**
	 * Displays admin notices if there are any
	 *
	 * @return void
	 */
	public static function display_admin_notices() {
		$notices = apply_filters( 'chipmunk_admin_notices', Helpers::check_requirements() );

		foreach ( $notices as $notice ) { ?>
			<div class="notice notice-<?php echo esc_attr( $notice['type'] ?? 'error' ); ?>">
				<p><?php echo esc_html( $notice['message'] ); ?></p>
			</div>
		<?php }
	}

	/**
	 * Add extra option to Permalinks settings page
	 *
	 * @return void
	 */
	public static function add_resource_permalink_setting() {
		if ( isset( $_POST['chipmunk_resource_cpt_base'] ) ) {
			update_option( 'chipmunk_resource_cpt_base', $_POST['chipmunk_resource_cpt_base'] );
		}

		add_settings_field(
			'chipmunk_resource_cpt_base',
			__('Resource base', 'chipmunk'),
			array( self::class, 'add_resource_permalink_setting_callback' ),
			'permalink',
			'optional'
		);
	}

	public static function add_resource_permalink_setting_callback() {
		$value = get_option( 'chipmunk_resource_cpt_base' );
		echo '<input type="text" value="' . esc_attr( $value ) . '" name="chipmunk_resource_cpt_base" id="chipmunk_resource_cpt_base" class="regular-text code" />';
	}

	/**
	 * Add extra option to Permalinks settings page
	 *
	 * @return void
	 */
	public static function add_collection_permalink_setting() {
		if ( isset( $_POST['chipmunk_collection_cpt_base'] ) ) {
			update_option( 'chipmunk_collection_cpt_base', $_POST['chipmunk_collection_cpt_base'] );
		}

		add_settings_field(
			'chipmunk_collection_cpt_base',
			__('Collection base', 'chipmunk'),
			array( self::class, 'add_collection_permalink_setting_callback' ),
			'permalink',
			'optional'
		);
	}

	public static function add_collection_permalink_setting_callback() {
		$value = get_option( 'chipmunk_collection_cpt_base' );
		echo '<input type="text" value="' . esc_attr( $value ) . '" name="chipmunk_collection_cpt_base" id="chipmunk_collection_cpt_base" class="regular-text code" />';
	}

	/**
	 * Add extra option to Permalinks settings page
	 *
	 * @return void
	 */
	public static function add_tag_permalink_setting() {
		if ( isset( $_POST['chipmunk_tag_cpt_base'] ) ) {
			update_option( 'chipmunk_tag_cpt_base', $_POST['chipmunk_tag_cpt_base'] );
		}

		add_settings_field(
			'chipmunk_tag_cpt_base',
			__('Resource tag base', 'chipmunk'),
			array( self::class, 'add_tag_permalink_setting_callback' ),
			'permalink',
			'optional'
		);
	}

	public static function add_tag_permalink_setting_callback() {
		$value = get_option( 'chipmunk_tag_cpt_base' );
		echo '<input type="text" value="' . esc_attr( $value ) . '" name="chipmunk_tag_cpt_base" id="chipmunk_tag_cpt_base" class="regular-text code" />';
	}
}
