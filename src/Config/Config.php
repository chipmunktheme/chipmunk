<?php

namespace Chipmunk\Config;

use Timber\Theme;

/**
 * The theme config class.
 */
class Config {

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
		return (new Theme())->version;
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
