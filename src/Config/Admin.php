<?php

namespace Chipmunk\Config;

use MadeByLess\Lessi\Helper\FileTrait;
use MadeByLess\Lessi\Helper\HelperTrait;
use MadeByLess\Lessi\Helper\ThemeTrait;
use MadeByLess\Lessi\Helper\TransientTrait;
use Chipmunk\Theme;

/**
 * Admin config hooks.
 */
class Admin extends Theme {
	use FileTrait;
	use HelperTrait;
	use ThemeTrait;
	use TransientTrait;

	/**
	 * A list of technical requirements of the theme.
	 *
	 * @var array
	 */
	private array $requirements;

	/**
	 * A list of types that supports permalink settings.
	 *
	 * @var array
	 */
	private array $permalinkTypes;

	/**
	 * A list of theme plugins that are deprecated and should be removed.
	 *
	 * @var array
	 */
	private array $deprecatedPlugins;

	/**
	 * Class constructor
	 */
	public function __construct() {
		$this->requirements = [
			'PHP'       => [
				'required' => config()->getMinPHPVersion(),
				'current'  => phpversion(),
			],
			'WordPress' => [
				'required' => config()->getMinWPVersion(),
				'current'  => get_bloginfo( 'version' ),
			],
		];

		$this->permalinkTypes = [
			'resource'   => __( 'Resource base', 'chipmunk' ),
			'collection' => __( 'Collection base', 'chipmunk' ),
			'tag'        => __( 'Tag base', 'chipmunk' ),
		];

		$this->deprecatedPlugins = [
			'members' => __( 'Members', 'chipmunk' ),
			'ratings' => __( 'Ratings', 'chipmunk' ),
		];
	}

	/**
	 * Hooks methods of this object into the WordPress ecosystem.
	 */
	public function initialize() {
		$this->addAction( 'admin_notices', [ $this, 'displayAdminNotices' ] );
		$this->addAction( 'admin_init', [ $this, 'addPermalinkSettings' ] );

		// Add theme related notices
		$this->addFilter( $this->buildThemeSlug( 'admin_notices' ), [ $this, 'checkRequirements' ] );
		$this->addFilter( $this->buildThemeSlug( 'admin_notices' ), [ $this, 'checkUpdate' ] );
		$this->addFilter( $this->buildThemeSlug( 'admin_notices' ), [ $this, 'checkDeprecatedPlugins' ] );
	}

	/**
	 * Displays admin notices if there are any.
	 *
	 * @see https://developer.wordpress.org/reference/hooks/admin_notices
	 */
	public function displayAdminNotices() {
		$notices = $this->applyFilter( 'admin_notices', [] );

		foreach ( $notices as $notice ) {
			$type    = esc_attr( $notice['type'] ?? 'error' );
			$message = $notice['message'];

			echo "<div class='notice notice-$type'><p>$message</p></div>";
		}
	}

	/**
	 * Loops through supported types and adds settings page.
	 *
	 * @see https://developer.wordpress.org/reference/hooks/admin_init
	 */
	public function addPermalinkSettings() {
		foreach ( $this->permalinkTypes as $type => $label ) {
			$this->addPermalinkSetting( $type, $label );
		}
	}

	/**
	 * Add extra option to permalinks settings page.
	 *
	 * @param string $type
	 * @param string $label
	 */
	private function addPermalinkSetting( string $type, string $label ) {
		$settingName = $this->buildThemeSlug( [ $type, 'cpt_base' ] );

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
	 */
	public function checkRequirements( array $notices ): array {
		foreach ( $this->requirements as $key => $requirement ) {
			if ( version_compare( $requirement['required'], $requirement['current'], '>' ) ) {
				$notices[] = [
					'type'    => 'error',
					'message' => sprintf(
						__( '%1$s requires %2$s %3$s or greater. You have %4$s.', 'chipmunk' ),
						config()->getName(),
						$key,
						$requirement['required'],
						$requirement['current'],
					),
				];
			}
		}

		return $notices;
	}

	/**
	 * Checks if any theme update is available
	 *
	 * @param array $notices
	 */
	public function checkUpdate( array $notices ): array {
		// TODO: Find a way to pull this directly from the Updater class
		$apiResponse = $this->getTransient( 'update_response' );

		if ( $apiResponse === false ) {
			return $notices;
		}

		if ( version_compare( $this->getThemeVersion(), $apiResponse->new_version, '<' ) ) {
			if ( current_user_can( 'update_themes' ) ) {
				$notices[] = [
					'type'    => 'warning',
					'message' => sprintf(
						__( '<a href="%1$s" target="_blank">%2$s %3$s</a> is available! <a href="%4$s">Please update now</a>.', 'chipmunk' ),
						config()->getChangelogUrl(),
						$this->getThemeName(),
						$apiResponse->new_version,
						network_admin_url( 'update.php?action=upgrade-theme&amp;theme=' . urlencode( $this->getThemeSlug() ) )
					),
				];
			} else {
				$notices[] = [
					'type'    => 'warning',
					'message' => sprintf(
						__( '<a href="%1$s" target="_blank">%2$s %3$s</a> is available! Please notify the site administrator.', 'chipmunk' ),
						config()->getChangelogUrl(),
						$this->getThemeName(),
						$apiResponse->new_version
					),
				];
			}
		}

		return $notices;
	}

	/**
	 * Checks if there are any deprecated plugins activated
	 *
	 * @param array $notices
	 */
	public function checkDeprecatedPlugins( array $notices ): array {
		foreach ( $this->deprecatedPlugins as $key => $name ) {
			$slug = $this->buildThemeSlug( $key, '-' );

			if ( is_plugin_active( $this->getPath( $slug, "$slug.php" ) ) ) {
				$notices[] = [
					'type'    => 'warning',
					'message' => sprintf(
						__( '<strong>Addon No Longer Required</strong> - As of %1$s v1.17.0, %2$s addon is no longer needed and can be safely deleted.', 'chipmunk' ),
						config()->getName(),
						$name,
					),
				];
			}
		}

		return $notices;
	}
}
