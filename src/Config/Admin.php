<?php

namespace Chipmunk\Config;

use Piotrkulpinski\Framework\Helper\HelperTrait;
use Chipmunk\Theme;

use function Chipmunk\config;

/**
 * Admin config hooks
 */
class Admin extends Theme {

	use HelperTrait;

	/**
	 * A list of type for adding custom permalink settings
	 *
	 * @var array
	 */
	private array $permalinkTypes;

	/**
	 * Class constructor
	 */
	public function __construct() {
		$this->permalinkTypes = [
			'resource'   => __( 'Resource base', 'chipmunk' ),
			'collection' => __( 'Collection base', 'chipmunk' ),
			'tag'        => __( 'Collection base', 'chipmunk' ),
		];
	}

	/**
	 * Hooks methods of this object into the WordPress ecosystem
	 *
	 * @return void
	 */
	public function initialize(): void {
		$this->addAction( 'admin_notices', [ $this, 'displayAdminNotices' ] );
		$this->addAction( 'admin_init', [ $this, 'addPermalinkSettings' ] );
		$this->addAction( 'admin_init', [ $this, 'addCollectionPermalinkSetting' ] );
		$this->addAction( 'admin_init', [ $this, 'addTagPermalinkSetting' ] );
	}

	/**
	 * Displays admin notices if there are any
	 */
	public function displayAdminNotices() {
		$notices = $this->applyFilter( 'admin_notices', $this->checkRequirements() );

		foreach ( $notices as $notice ) {
			$type    = esc_attr( $notice['type'] ?? 'error' );
			$message = esc_html( $notice['message'] );

			echo "<div class='notice notice-$type'><p>$message</p></div>";
		}
	}

	/**
	 * Add extra option to Permalinks settings page
	 */
	public function addPermalinkSettings() {
		foreach ( $this->permalinkTypes as $type => $label ) {
			$this->addPermalinkSetting( $type, $label );
		}
	}

	/**
	 * Add extra option to Permalinks settings page
	 */
	public function addPermalinkSetting( string $type, string $label ) {
		// TODO: Finish settings up permalink settings
		$settingName = $this->getThemeSlug( [ $type, 'cpt_base' ] );

		if ( isset( $_POST[ $settingName ] ) ) {
			update_option( $settingName, $_POST[ $settingName ] );
		}

		add_settings_field(
			$settingName,
			$label,
			[ $this, 'addPermalinkSettingCallback' ],
			'permalink',
			'optional'
		);
	}

	/**
	 * Add extra option to Permalinks settings page
	 */
	public function addResourcePermalinkSetting() {
		if ( isset( $_POST['chipmunk_resource_cpt_base'] ) ) {
			update_option( 'chipmunk_resource_cpt_base', $_POST['chipmunk_resource_cpt_base'] );
		}

		add_settings_field(
			'chipmunk_resource_cpt_base',
			__( 'Resource base', 'chipmunk' ),
			[ $this, 'add_resource_permalink_setting_callback' ],
			'permalink',
			'optional'
		);
	}

	public function addPermalinkSettingCallback() {
		$value = get_option( 'chipmunk_resource_cpt_base' );
		echo '<input type="text" value="' . esc_attr( $value ) . '" name="chipmunk_resource_cp t_base" id="chipmunk_resource_cpt_base" class="regular-text code" />';
	}

	/**
	 * Add extra option to Permalinks settings page
	 */
	public function addCollectionPermalinkSetting() {
		if ( isset( $_POST['chipmunk_collection_cpt_base'] ) ) {
			update_option( 'chipmunk_collection_cpt_base', $_POST['chipmunk_collection_cpt_base'] );
		}

		add_settings_field(
			'chipmunk_collection_cpt_base',
			__( 'Collection base', 'chipmunk' ),
			[ $this, 'add_collection_permalink_setting_callback' ],
			'permalink',
			'optional'
		);
	}

	public function addCollectionPermalinkSettingCallback() {
		$value = get_option( 'chipmunk_collection_cpt_base' );
		echo '<input type="text" value="' . esc_attr( $value ) . '" name="chipmunk_collection_cpt_base" id="chipmunk_collection_cpt_base" class="regular-text code" />';
	}

	/**
	 * Add extra option to Permalinks settings page
	 */
	public function addTagPermalinkSetting() {
		if ( isset( $_POST['chipmunk_tag_cpt_base'] ) ) {
			update_option( 'chipmunk_tag_cpt_base', $_POST['chipmunk_tag_cpt_base'] );
		}

		add_settings_field(
			'chipmunk_tag_cpt_base',
			__( 'Resource tag base', 'chipmunk' ),
			[ $this, 'add_tag_permalink_setting_callback' ],
			'permalink',
			'optional'
		);
	}

	public static function addTagPermalinkSettingCallback() {
		$value = get_option( 'chipmunk_tag_cpt_base' );
		echo '<input type="text" value="' . esc_attr( $value ) . '" name="chipmunk_tag_cpt_base" id="chipmunk_tag_cpt_base" class="regular-text code" />';
	}

	/**
	 * Checks if the technical requirements are met.
	 *
	 * @param array $notices
	 *
	 * @return array
	 */
	private function checkRequirements( array $notices = [] ): array {
		if ( version_compare( config()->getMinPHPVersion(), phpversion(), '>' ) ) {
			$notices[] = [
				'type'    => 'error',
				'message' => sprintf(
					__( 'Chipmunk requires PHP %1$s or greater. You have %2$s.', 'chipmunk' ),
					config()->getMinPHPVersion()
				),
			];
		}

		if ( version_compare( config()->getMinWPVersion(), get_bloginfo( 'version' ), '>' ) ) {
			$notices[] = [
				'type'    => 'error',
				'message' => sprintf(
					__( 'Chipmunk requires WordPress %1$s or greater. You have %2$s.', 'chipmunk' ),
					config()->getMinWPVersion()
				),
			];
		}

		return $notices;
	}
}
