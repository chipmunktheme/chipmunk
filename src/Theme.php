<?php

namespace Chipmunk;

use Piotrkulpinski\Framework\Handler\ThemeHandler;
use Chipmunk\Options;
use Chipmunk\Templates;
use Chipmunk\Assets;
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
	 * Theme options
	 *
	 * @var Theme
	 */
	protected $options;

	/**
	 * Theme templates
	 *
	 * @var Theme
	 */
	protected $templates;

	/**
	 * Theme assets
	 *
	 * @var Theme
	 */
	protected $assets;

	/**
	 * Theme AJAX callbacks
	 *
	 * @var Theme
	 */
	protected $actions;

	/**
	 * Theme shortcodes
	 *
	 * @var Theme
	 */
	protected $shortcodes;

	/**
	 * Theme constructor.
	 */
	public function __construct() {
		$this->config     = new Config();
		$this->options    = new Options();
		$this->templates  = new Templates();
		$this->assets     = new Assets();
		$this->actions    = new Actions();
		$this->shortcodes = new Shortcodes();
	}

	/**
	 * initialize
	 *
	 * Hooks methods of this object into the WordPress ecosystem
	 *
	 * @return void
	 * @throws HandlerException
	 */
	public function initialize(): void {
		if ( ! $this->isInitialized() ) {
			$this->options->initialize();
			$this->templates->initialize();
			$this->assets->initialize();
			$this->actions->initialize();
			$this->shortcodes->initialize();
		}
	}
}
