<?php

namespace Chipmunk\Helper;

use Timber\Theme;

/**
 * Provides methods for the getting config options
 */
trait ConfigTrait {

	/**
	 * Method that returns project name.
	 *
	 * Generally used for naming assets handlers, languages, etc.
	 */
	public static function getName(): string {
		return 'Chipmunk';
	}

	/**
	 * Method that returns project slug.
	 *
	 * Generally used for naming settings, customizer options etc.
	 */
	public static function getSlug(): string {
		return sanitize_title( static::getName() );
	}

	/**
	 * Method that returns project version.
	 *
	 * Generally used for versioning asset handlers while enqueueing them.
	 */
	public static function getVersion(): string {
		return ( new Theme() )->version;
	}

	/**
	 * Method that returns project author.
	 *
	 * Used for displaying author on theme settings.
	 */
	public static function getAuthor(): string {
		return 'Made by Less';
	}

	/**
	 * Method that returns dist path.
	 *
	 * Used for enqueueing static resources.
	 */
	public static function getDistPath(): string {
		return 'resources/output';
	}

	/**
	 * Method that returns assets path.
	 *
	 * Used for displaying static resources like images, fonts etc.
	 */
	public static function getAssetsPath(): string {
		return 'assets';
	}

	/**
	 * Method that returns templates path.
	 *
	 * Used for setting up template paths for Timber views.
	 */
	public static function getTemplatesPath(): string {
		return 'templates';
	}

	/**
	 * Method that returns manifest file path.
	 *
	 * Used for reading the production manifest file.
	 */
	public static function getManifestPath(): string {
		return 'manifest.json';
	}

	/**
	 * Method that returns manifest dev file path.
	 *
	 * Used for reading the development manifest file.
	 */
	public static function getManifestDevPath(): string {
		return 'manifest-dev.json';
	}

	/**
	 * Method that returns theme demo url.
	 *
	 * Used for Merlin Theme Wizarf onboarding.
	 */
	public static function getDemoUrl(): string {
		return 'https://demos.chipmunktheme.com';
	}

	/**
	 * Method that returns theme shop url.
	 *
	 * Used for linking to the theme shop in various places.
	 */
	public static function getShopUrl(): string {
		return 'https://chipmunktheme.com';
	}

	/**
	 * Method that returns theme shop item id.
	 *
	 * Used for checking license status and theme updates.
	 */
	public static function getShopItemId(): string {
		return '893';
	}

	/**
	 * Method that returns project author.
	 *
	 * Used for determining theme user access to certain parts of the theme.
	 */
	public static function getPlans(): array {
		return [
			'1' => 'Basic',
			'2' => 'Plus',
			'3' => 'Pro',
		];
	}
}
