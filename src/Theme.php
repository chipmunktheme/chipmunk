<?php

namespace Chipmunk;

use Piotrkulpinski\Framework\Handler\ThemeHandler;
use Piotrkulpinski\Framework\Helper\HookTrait;
use Piotrkulpinski\Framework\Helper\OptionTrait;
use Piotrkulpinski\Framework\Helper\ShortcodeTrait;
use Chipmunk\Config;
use Chipmunk\Core\Options;

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
	 * Theme config
	 *
	 * @var Config
	 */
	protected Config $config;

	/**
	 * Theme options
	 *
	 * @var Theme
	 */
	protected Theme $options;

	/**
	 * Theme setup
	 *
	 * @var Theme
	 */
	protected Theme $setup;

	/**
	 * Theme templates
	 *
	 * @var Theme
	 */
	protected Theme $templates;

	/**
	 * Theme assets
	 *
	 * @var Theme
	 */
	protected Theme $assets;

	/**
	 * Theme AJAX callbacks
	 *
	 * @var Theme
	 */
	protected Theme $actions;

	/**
	 * Theme shortcodes
	 *
	 * @var Theme
	 */
	protected Theme $shortcodes;

	/**
	 * Theme updater
	 *
	 * @var Theme
	 */
	protected Theme $updater;

	/**
	 * Theme constructor.
	 */
	public function __construct() {
		$this->config       = Config::instance();
		$this->options      = Options::instance();
		$this->setup        = new Core\Setup();
		$this->templates    = new Core\Templates();
		$this->assets       = new Core\Assets();
		$this->actions      = new Core\Actions();
		$this->shortcodes   = new Core\Shortcodes();
		$this->updater      = new Core\Updater();
		$this->vendorACF    = new Vendor\ACF();
		$this->vendorMerlin = new Vendor\Merlin();
		$this->configAdmin  = new Config\Admin();
		$this->configAssets = new Config\Assets();
		$this->configMisc   = new Config\Misc();
		$this->configQuery  = new Config\Query();
	}

	/**
	 * Hooks methods of this object into the WordPress ecosystem
	 */
	public function initialize() {
		if ( ! $this->isInitialized() ) {
			$this->options->initialize();
			$this->setup->initialize();
			$this->templates->initialize();
			$this->assets->initialize();
			$this->actions->initialize();
			$this->shortcodes->initialize();
			$this->updater->initialize();
			$this->vendorACF->initialize();
			$this->vendorMerlin->initialize();
			$this->configAdmin->initialize();
			$this->configAssets->initialize();
			$this->configMisc->initialize();
			$this->configQuery->initialize();
		}
	}
}
