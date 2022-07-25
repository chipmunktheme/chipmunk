<?php

namespace Chipmunk;

use Chipmunk\Traits\ConfigTrait;
use Dashifen\WPHandler\Handlers\Themes\AbstractThemeHandler;

/**
 * Main theme setup class
 */
class Theme extends AbstractThemeHandler {

	use ConfigTrait;

	/**
	 * Theme version.
	 *
	 * @var string
	 */
	const VERSION = '1.17.0';

	/**
	 * Theme textdomain.
	 *
	 * @var string
	 */
	const TEXTDOMAIN = 'chipmunk';

	/**
	 * Main config object
	 *
	 * @var object
	 */
	private $config;

	/**
	 * Constructs a new Theme object
	 *
	 * @param object $config
	 */
	public function __construct( $config ) {
		$this->config = $config;
	}

	/**
	 * Gets the version number of the application.
	 *
	 * @return string
	 */
	public function getVersion() {
		return static::VERSION;
	}

	/**
	 * Hooks methods of this object into the WordPress ecosystem
	 *
	 * @return void
	 * @throws HandlerException
	 */
	public function initialize(): void {
		if ( ! $this->isInitialized() ) {
			$this->addAction( 'init', 'startSession' );
			$this->addFilter( 'timber/twig', 'addTwigFilters' );
			$this->addAction( 'wp_enqueue_scripts', 'addAssets' );
			$this->addAction( 'after_setup_theme', 'addThemeFeatures' );
			$this->addAction( 'template_redirect', 'forceAuthentication' );
		}
	}
}
