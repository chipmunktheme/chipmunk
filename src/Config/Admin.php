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
	 * A list of technical requirements of the theme
	 *
	 * @var array
	 */
	private array $requirements;

	/**
	 * A list of types that supports permalink settings
	 *
	 * @var array
	 */
	private array $permalinkTypes;

	/**
	 * Class constructor
	 */
	public function __construct() {
		$this->requirements = [
			'PHP'   => [
				'required' => config()->getMinPHPVersion(),
				'current' => phpversion(),
			],
			'WordPress'   => [
				'required' => config()->getMinWPVersion(),
				'current' => get_bloginfo( 'version' ),
			],
		];

		$this->permalinkTypes = [
			'resource'   => __( 'Resource base', 'chipmunk' ),
			'collection' => __( 'Collection base', 'chipmunk' ),
			'tag'        => __( 'Tag base', 'chipmunk' ),
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
	}

	/**
	 * Displays admin notices if there are any
	 *
	 * @return void
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
	 * Loops through supported types and adds settings page
	 *
	 * @return void
	 */
	public function addPermalinkSettings() {
		foreach ( $this->permalinkTypes as $type => $label ) {
			$this->addPermalinkSetting( $type, $label );
		}
	}

	/**
	 * Add extra option to permalinks settings page
	 *
	 * @param string $type
	 * @param string $label
	 *
	 * @return void
	 */
	private function addPermalinkSetting( string $type, string $label ) {
		$settingName = $this->getThemeSlug( [ $type, 'cpt_base' ] );

		if ( isset( $_POST[ $settingName ] ) ) {
			update_option( $settingName, $_POST[ $settingName ] );
		}

		$callback = function() use ( $settingName ) {
			$value = esc_attr( get_option( $settingName ) );
			echo "<input type='text' value='$value' name='$settingName' class='regular-text code' />";
		};

		add_settings_field( $settingName, $label, $callback, 'permalink', 'optional' );
	}

	/**
	 * Checks if the technical requirements are met.
	 *
	 * @param array $notices
	 *
	 * @return array
	 */
	private function checkRequirements( array $notices = [] ): array {
		foreach ( $this->requirements as $key => $requirement ) {
			if ( version_compare( $requirement['required'], $requirement['current'], '>' ) ) {
				$notices[] = [
					'type'    => 'error',
					'message' => sprintf(
						__( 'Chipmunk requires %1$s %2$s or greater. You have %3$s.', 'chipmunk' ),
						$key,
						$requirement['required'],
						$requirement['current'],
					),
				];
			}
		}

		return $notices;
	}
}
