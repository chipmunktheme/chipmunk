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
	 * Class constructor.
	 *
	 * @param Settings $settings
	 */
	public function __construct( Settings $settings ) {
		$this->settings = $settings;
		$this->slug     = sanitize_title( $this->name );
		$this->option   = $this->buildThemeSlug( $this->slug );
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
		$tabs[] = [
			'name'    => $this->name,
			'slug'    => $this->slug,
			'content' => $this->getSettingsContent(),
		];

		return $tabs;
	}

	/**
	 * Returns the settings markup for upvote faker
	 */
	private function getSettingsContent(): string {
		if ( empty( $addons = $this->applyFilter( 'settings_addons', [] ) ) ) {
			return '';
		}

		$options = get_option( $this->option );
		$args    = [
			'addons'           => $addons,
			'options'          => $options,
			'option'           => $this->option,
			'is_valid_license' => $this->settings->isValidLicense(),
		];

		return Timber::compile( 'admin/settings/addons.twig', array_merge( Timber::context(), $args ) );
	}

	/**
	 * Check if Chipmunk plugin is allowed
	 *
	 * @param string $addon
	 *
	 * @return bool
	 */
	public function isAddonAllowed( string $addon ): bool {
		return $this->settings->getLicensePrice() >= config()->getAddons()[ $addon ];
	}

	/**
	 * Check if Chipmunk plugin is enabled
	 *
	 * @param string $addon
	 *
	 * @return bool
	 */
	public function isAddonEnabled( string $addon ): bool {
		$option = get_option( $this->option );

		return $this->isAddonAllowed( $addon ) && ! empty( $option[ $addon ] );
	}
}
