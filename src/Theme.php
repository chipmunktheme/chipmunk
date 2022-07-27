<?php

namespace Chipmunk;

use Piotrkulpinski\Framework\Handler\ThemeHandler;
use Chipmunk\Config;
use Chipmunk\Core\Setup;
use Chipmunk\Core\Options;
use Chipmunk\Core\Templates;
use Chipmunk\Core\Assets;
use Chipmunk\Core\Actions;
use Chipmunk\Core\Shortcodes;
use Chipmunk\Helper\HooksTrait;
use Chipmunk\Helper\ShortcodesTrait;

/**
 * Main theme setup class
 *
 * @package Chipmunk
 */
class Theme extends ThemeHandler {
	use HooksTrait;
	use ShortcodesTrait;

	/**
	 * Theme setup
	 *
	 * @var Setup
	 */
	protected $setup;

	/**
	 * Theme options
	 *
	 * @var Options
	 */
	protected $options;

	/**
	 * Theme templates
	 *
	 * @var Templates
	 */
	protected $templates;

	/**
	 * Theme assets
	 *
	 * @var Assets
	 */
	protected $assets;

	/**
	 * Theme AJAX callbacks
	 *
	 * @var Actions
	 */
	protected $actions;

	/**
	 * Theme shortcodes
	 *
	 * @var Shortcodes
	 */
	protected $shortcodes;

	/**
	 * Theme constructor.
	 */
	public function __construct() {
		new Config();

		$this->setup      = new Setup();
		$this->options    = new Options();
		$this->templates  = new Templates();
		$this->assets     = new Assets();
		$this->actions    = new Actions();
		$this->shortcodes = new Shortcodes();
	}

	/**
	 * Hooks methods of this object into the WordPress ecosystem
	 *
	 * @return void
	 */
	public function initialize(): void {
		if ( ! $this->isInitialized() ) {
			$this->setup->initialize();
			$this->options->initialize();
			$this->templates->initialize();
			$this->assets->initialize();
			$this->actions->initialize();
			$this->shortcodes->initialize();
		}
	}
}
