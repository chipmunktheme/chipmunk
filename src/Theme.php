<?php

namespace Chipmunk;

use MadeByLess\Lessi\Handler\ThemeHandler;
use MadeByLess\Lessi\Helper\{HookTrait, ShortcodeTrait};
use Chipmunk\Core\{Options, Settings};
use Chipmunk\Helper\OptionTrait;

/**
 * Main theme setup class
 *
 * @package Chipmunk
 */
class Theme extends ThemeHandler {
	use HookTrait;
	use OptionTrait;
	use ShortcodeTrait;

	/**
	 * A list of theme classes
	 *
	 * @var array
	 */
	private array $classes;

	/**
	 * Class constructor.
	 */
	public function __construct() {
		$this->classes = [
			// Core classes
			'Core\Setup',
			'Core\Templates',
			'Core\Assets',
			'Core\Actions',
			'Core\Shortcodes',
			'Core\Updater',

			// Config classes
			'Config\Admin',
			'Config\Assets',
			'Config\Query',
			'Config\Misc',

			// ThirdParty classes
			'ThirdParty\ACF',
			'ThirdParty\Merlin',
		];
	}

	/**
	 * Hooks methods of this object into the WordPress ecosystem
	 */
	public function initialize() {
		if ( ! $this->isInitialized() ) {
			// Initialize singleton object
			Options::getInstance()->initialize();
			Settings::getInstance()->initialize();

			// Initialize theme classes
			$this->initializeClasses( $this->classes );
		}
	}
}
