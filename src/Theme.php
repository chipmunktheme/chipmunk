<?php

namespace Chipmunk;

use Exception;
use MadeByLess\Lessi\Handler\ThemeHandler;
use MadeByLess\Lessi\Helper\HookTrait;
use MadeByLess\Lessi\Helper\ShortcodeTrait;
use Chipmunk\Config;
use Chipmunk\Core\Options;
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
		$this->coreClasses = [
			// Core classes
			'Core\Setup',
			'Core\Templates',
			'Core\Assets',
			'Core\Actions',
			'Core\Shortcodes',
			'Core\Settings',
			'Core\Updater',

			// Config classes
			'Config\Admin',
			'Config\Assets',
			'Config\Query',
			'Config\Misc',

			// Vendor classes
			'Vendor\ACF',
			'Vendor\Merlin',
		];
	}

	/**
	 * Hooks methods of this object into the WordPress ecosystem
	 */
	public function initialize() {
		if ( ! $this->isInitialized() ) {
			Config::instance();
			( Options::instance() )->initialize();

			// Initialize theme classes
			foreach ( $this->coreClasses as $class ) {
				$className = "\Chipmunk\\${class}";
				$instance  = new $className();

				if ( ! $instance instanceof Theme ) {
					throw new Exception( __( 'Theme class has to implement Theme interface', 'chipmunk' ) );
				}

				$instance->initialize();
			}
		}
	}
}
