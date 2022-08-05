<?php

namespace Chipmunk\Settings;

use Timber\Timber;
use MadeByLess\Lessi\Helper\HelperTrait;
use Chipmunk\Theme;
use Chipmunk\Settings\Licenser;

/**
 * A Addons settings class
 */
class Addons extends Theme {
	use HelperTrait;

	/**
	 * @var Addons The one true Addons
	 */
	private static $instance;

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
	 */
	public function __construct() {
		$this->slug     = sanitize_title( $this->name );
		$this->option   = $this->buildThemeSlug( $this->slug );
		$this->addons   = $this->applyFilter( 'settings_addons', [] );
	}

	/**
	 * Insures that only one instance of Addons exists in memory at any one
	 * time. Also prevents needing to define globals all over the place.
	 *
	 * @return Addons
	 */
	public static function getInstance() {
		if ( ! isset( self::$instance ) && ! ( self::$instance instanceof Addons ) ) {
			self::$instance = new Addons();
		}

		return self::$instance;
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
     * Returns the list of available addons
     *
     * @return array
     */
    public function getAddons(): array {
        return $this->addons;
    }

    /**
     * Returns the option containing addon options
     */
    public function getAddonsOptions() {
        return get_option( $this->option );
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
			'is_valid_license' => Licenser::getInstance()->isValidLicense(),
		];

		return Timber::compile( 'admin/settings/addons.twig', array_merge( Timber::context(), $args ) );
	}
}
