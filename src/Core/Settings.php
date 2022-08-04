<?php

namespace Chipmunk\Core;

use Timber\Timber;
use MadeByLess\Lessi\Helper\AssetTrait;
use MadeByLess\Lessi\Helper\MediaTrait;
use MadeByLess\Lessi\Helper\HelperTrait;
use MadeByLess\Lessi\Helper\ThemeTrait;
use Chipmunk\Theme;
use Chipmunk\Errors;
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
	 * License data object
	 *
	 * @var object
	 */
	private object $license;

	/**
	 * Class constructor.
	 */
	public function __construct() {
		// $licenser = new Settings\Licenser(
		// 	[
		// 		'remoteApiUrl' => config()->getShopUrl(),
		// 		'itemId'       => config()->getShopItemId(),
		// 		'itemName'     => $this->getThemeName(),
		// 		'itemSlug'     => $this->getThemeSlug(),
		// 	]
		// );

		// // Store license data
		// $this->license = $licenser->getLicenseData();

		// Initialize other settings
		( new Faker( $this ) )->initialize();
		( new Addons( $this ) )->initialize();
		// new Settings\Addons();
	}

	/**
	 * Hooks methods of this object into the WordPress ecosystem.
	 */
	public function initialize() {
		$this->addAction( 'admin_menu', [ $this, 'addMenuPage' ], 1 );
		$this->addAction( 'chipmunk_settings_nav', [ $this, 'addMenuPage' ], 1 );
		$this->addAction( 'admin_init', [ $this, 'displayErrors' ], 99 );
	}

	/**
	 * Register settings page to the admin_menu action hook
	 */
	public function addMenuPage() {
		add_menu_page(
			$this->getThemeName(),
			$this->getThemeName(),
			'edit_theme_options',
			$this->getThemeSlug(),
			[ $this, 'renderAdminSettings' ],
			$this->svgToBase64( $this->assetUrl( 'images/logo.svg' ) ),
		);
	}

	/**
	 * Renders the markup used on the theme settings page.
	 */
	public function renderAdminSettings() {
		$args = [
			// 'license'  => $this->license,
			'tabs' => $this->applyFilter( 'settings_tabs', [] ),
		];

		Timber::render( 'admin/settings.twig', array_merge( Timber::context(), $args ) );
	}

	/**
	 * Is valid license activated
	 *
	 * @return bool
	 */
	public function isValidLicense() {
		return ! empty( $this->license ) && 'valid' === $this->license->license;
	}

	/**
	 * Get the price ID if the license is valid and activated
	 *
	 * @return int
	 */
	public function getLicensePrice() {
		return $this->isValidLicense() ? (int) $this->license->price_id : 0;
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
