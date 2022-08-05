<?php

namespace Chipmunk\Core;

use Timber\Timber;
use MadeByLess\Lessi\Helper\AssetTrait;
use MadeByLess\Lessi\Helper\MediaTrait;
use MadeByLess\Lessi\Helper\HelperTrait;
use MadeByLess\Lessi\Helper\ThemeTrait;
use Chipmunk\Theme;
use Chipmunk\Errors;
use Chipmunk\Settings\Licenser;
use Chipmunk\Settings\Faker;
use Chipmunk\Settings\Addons;

/**
 * Custom settings pages for the theme
 */
class Settings extends Theme {
	use AssetTrait;
	use HelperTrait;
	use MediaTrait;
	use ThemeTrait;

	/**
	 * @var Settings The one true Settings
	 */
	private static $instance;

	/**
	 * Class constructor.
	 */
	public function __construct() {
		Licenser::getInstance()->initialize();
		Faker::getInstance()->initialize();
		Addons::getInstance()->initialize();
	}

	/**
	 * Insures that only one instance of Settings exists in memory at any one
	 * time. Also prevents needing to define globals all over the place.
	 *
	 * @return Settings
	 */
	public static function getInstance() {
		if ( ! isset( self::$instance ) && ! ( self::$instance instanceof Settings ) ) {
			self::$instance = new Settings();
		}

		return self::$instance;
	}

	/**
	 * Hooks methods of this object into the WordPress ecosystem.
	 */
	public function initialize() {
		$this->addAction( 'admin_menu', [ $this, 'addMenuPage' ], 1 );
		$this->addAction( 'admin_init', [ $this, 'displayErrors' ], 99 );
	}

	/**
	 * Register settings page to the admin_menu action hook
	 */
	public function addMenuPage() {
		add_menu_page(
			$this->getThemeProperty( 'name' ),
			$this->getThemeProperty( 'name' ),
			'edit_theme_options',
			$this->getThemeProperty( 'text-domain' ),
			[ $this, 'renderAdminSettings' ],
			$this->svgToBase64( $this->assetUrl( 'images/logo.svg' ) ),
		);
	}

	/**
	 * Renders the markup used on the theme settings page.
	 */
	public function renderAdminSettings() {
		$args = [
			'license'  => Licenser::getInstance()->getLicense(),
			'tabs' => $this->applyFilter( 'settings_tabs', [] ),
		];

		Timber::render( 'admin/settings.twig', array_merge( Timber::context(), $args ) );
	}

	/**
	 * Adds setting error using Settings API
	 *
	 * @param string $message Error message
	 * @param string $type Error type
	 */
	public function addMessage( $setting, $message, $type = 'error' ) {
		$setting = $this->buildThemeSlug( $setting );
		$errors  = get_settings_errors( $setting );

		if ( ! empty( $message ) && ! $this->findKeyValue( $errors, 'code', $setting ) ) {
			add_settings_error( $setting, $setting, $message, $type );
		}
	}

	/**
	 * Checks if a import action was submitted.
	 */
	public function displayErrors() {
		$errors = Errors::getInstance();

		foreach ( $errors->get_error_messages() as $error ) {
			$this->addMessage( '', $error );
		}
	}
}
