<?php

namespace Chipmunk\Core;

use Chipmunk\Theme;
use Chipmunk\Helper\FileTrait;
use Chipmunk\Factory\PostType;
use function Chipmunk\config;

/**
 * Theme setup
 */
class Setup extends Theme {

	use FileTrait;

	/**
	 * Class constructor
	 */
	public function __construct() {}

	/**
	 * Hooks methods of this object into the WordPress ecosystem
	 *
	 * @return void
	 */
	public function initialize(): void {
		// $this->addAction( 'after_setup_theme', [ $this, 'addSuport' ] );
		$this->addAction( 'after_setup_theme', [ $this, 'registerPostTypes' ] );
		$this->addAction( 'after_setup_theme', [ $this, 'addTextDomain' ] );
	}

	/**
	 * Register custom post types and their related taxonomies
	 *
	 * @return void
	 */
	public function registerPostTypes(): void {
		$resource = new PostType(
			__( 'Resource', 'chipmunk' ),
			__( 'Resources', 'chipmunk' ),
			[
				'menu_icon'     => 'dashicons-screenoptions',
				'menu_position' => 20,
			],
		);

		$resource->register();
	}

	/**
	 * Makes theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 *
	 * @return void
	 */
	public function addTextDomain(): void {
		load_theme_textdomain( config()->getSlug(), $this->getTemplatePath( 'languages' ) );
	}
}
