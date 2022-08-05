<?php

namespace Chipmunk\Settings;

use Timber\Timber;
use MadeByLess\Lessi\Helper\HelperTrait;
use Chipmunk\Theme;
use Chipmunk\Core\Settings;

/**
 * A Addons settings class
 */
class Addons extends Theme {
	use HelperTrait;

	/**
	 * Setting class
	 *
	 * @var Settings
	 */
	protected Settings $settings;

	/**
	 * Setting name
	 *
	 * @var string
	 */
	private string $name = 'Addons';

	/**
	 * Setting slug
	 *
	 * @var string
	 */
	private string $slug;

	/**
	 * Option name
	 *
	 * @var string
	 */
	private string $option;

	/**
	 * A list of available addons
	 *
	 * @var array
	 */
	private array $addons;

	/**
	 * Class constructor.
	 *
	 * @param Settings $settings
	 */
	public function __construct( Settings $settings ) {
		$this->settings = $settings;
		$this->slug     = sanitize_title( $this->name );
		$this->option   = $this->buildThemeSlug( $this->slug );
		$this->addons   = $this->applyFilter( 'settings_addons', [] );
	}

	/**
	 * Hooks methods of this object into the WordPress ecosystem.
	 */
	public function initialize() {
		$this->addAction( 'admin_init', [ $this, 'registerOption' ] );

		// Output settings content
		$this->addFilter( $this->buildThemeSlug( 'settings_tabs' ), [ $this, 'addSettingsTab' ] );
	}

	/**
	 * Registers the option used to store the license key in the options table.
	 */
	public function registerOption() {
		register_setting( $this->option, $this->option );
	}

	/**
	 * Adds settings tab to the list
	 */
	public function addSettingsTab( $tabs ) {
		if ( ! empty( $this->addons ) ) {
			$tabs[] = [
				'name'    => $this->name,
				'slug'    => $this->slug,
				'content' => $this->getSettingsContent(),
			];
		}

		return $tabs;
	}

	/**
	 * Returns the settings markup for addons
	 *
	 * @return string
	 */
	private function getSettingsContent(): string {
		$options = get_option( $this->option );
		$args    = [
			'addons'           => $this->addons,
			'options'          => $options,
			'option'           => $this->option,
			'is_valid_license' => $this->settings->isValidLicense(),
		];

		return Timber::compile( 'admin/settings/addons.twig', array_merge( Timber::context(), $args ) );
	}

	/**
	 * Check if theme addon is enabled
	 *
	 * @param string $addon
	 *
	 * @return bool
	 */
	public function isAddonEnabled( string $addon ): bool {
		$option = get_option( $this->option );

		// Addon doesn't exists
		if ( empty( $this->addons[ $addon ] ) ) {
			return false;
		}

		// Addon is disabled
		if ( empty( $option[ $addon ] ) ) {
			return false;
		}

		// Addon is not allowed
		if ( $this->settings->getLicensePrice() < $this->addons[ $addon ] ) {
			return false;
		}

		return true;
	}
}
