<?php

namespace Chipmunk;

use Piotrkulpinski\Framework\Handler\ThemeHandler;
use Chipmunk\Options;
use Chipmunk\Templates;
use Chipmunk\Assets;
use Chipmunk\Helper\HooksTrait;

/**
 * Main theme setup class
 *
 * @package Chipmunk
 */
class Theme extends ThemeHandler {
	use HooksTrait;

	/**
	 * Theme options
	 *
	 * @var object
	 */
	protected $options;

	/**
	 * Theme templates
	 *
	 * @var object
	 */
	protected $templates;

	/**
	 * Theme assets
	 *
	 * @var object
	 */
	protected $assets;

	/**
	 * Theme constructor.
	 */
	public function __construct() {
		$this->config    = new Config();
		$this->options   = new Options();
		$this->templates = new Templates();
		$this->assets    = new Assets();
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
		}
	}
}
