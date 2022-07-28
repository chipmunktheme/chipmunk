<?php

namespace Chipmunk\Core;

use Chipmunk\Theme;
use Chipmunk\Helper\FileTrait;
use Chipmunk\Factory\PostType;
use Chipmunk\Helper\CoreTrait;
use function Chipmunk\config;

/**
 * Theme setup
 */
class Setup extends Theme {

	use FileTrait;
	use CoreTrait;

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
		$this->addAction( 'after_setup_theme', [ $this, 'addSupports' ] );
		$this->addAction( 'after_setup_theme', [ $this, 'addImageSizes' ] );
		$this->addAction( 'after_setup_theme', [ $this, 'addNavMenus' ] );
		$this->addAction( 'after_setup_theme', [ $this, 'addTextDomains' ] );
		$this->addAction( 'after_setup_theme', [ $this, 'addPostTypes' ] );
	}

	/**
	 * Registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 *
	 * @return void
	 */
	public function addSupports(): void {
		// Theme Support
		$this->addSupport( 'title-tag' );
		$this->addSupport( 'automatic-feed-links' );
		$this->addSupport( 'post-thumbnails' );
		$this->addSupport( 'comments' );
		$this->addSupport( 'threaded-comments' );
		$this->addSupport(
			'html5',
			[
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			]
		);

		// Gutenberg
		$this->addSupport( 'align-wide' );
		$this->addSupport( 'responsive-embeds' );

		/**
		 * Adds support for editor color palette.
		 *
		 * @see https://developer.wordpress.org/reference/functions/add_theme_support/#editor-color-palette
		 */
		$this->addSupport(
			'editor-color-palette',
			[
				[
					'name'  => __( 'Black', 'chipmunk' ),
					'slug'  => 'black',
					'color' => '#000000',
				],
				[
					'name'  => __( 'Gray', 'chipmunk' ),
					'slug'  => 'gray',
					'color' => '#666',
				],
				[
					'name'  => __( 'White', 'chipmunk' ),
					'slug'  => 'white',
					'color' => '#FFF',
				],
			]
		);

		/**
		 * Adds support for editor font sizes.
		 *
		 * @see https://developer.wordpress.org/reference/functions/add_theme_support/#editor-color-palette
		 */
		$this->addSupport(
			'editor-font-sizes',
			[
				[
					'name' => __( 'Small', 'chipmunk' ),
					'size' => 16,
					'slug' => 'small',
				],
				[
					'name' => __( 'Normal', 'chipmunk' ),
					'size' => 21,
					'slug' => 'normal',
				],
				[
					'name' => __( 'Medium', 'chipmunk' ),
					'size' => 24,
					'slug' => 'medium',
				],
				[
					'name' => __( 'Large', 'chipmunk' ),
					'size' => 36,
					'slug' => 'large',
				],
				[
					'name' => __( 'Huge', 'chipmunk' ),
					'size' => 48,
					'slug' => 'huge',
				],
			]
		);
	}

	/**
	 * Registers custom image sizes
	 *
	 * @return void
	 */
	public function addImageSizes(): void {
		$this->addImageSize( '1920x1080', 1920, 1080 );
		$this->addImageSize( '1280x960', 1280, 960 );
		$this->addImageSize( '1280x720', 1280, 720 );
		$this->addImageSize( '640x480', 640, 480 );
	}

	/**
	 * Registers custom navigation menus
	 *
	 * @return void
	 */
	public function addNavMenus(): void {
		$this->addNavMenu( 'nav-primary', __( 'Header nav', 'chipmunk' ) );
		$this->addNavMenu( 'nav-secondary', __( 'Footer nav', 'chipmunk' ) );
	}

	/**
	 * Makes theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 *
	 * @return void
	 */
	public function addTextDomains(): void {
		$this->addTextDomain( config()->getSlug(), $this->getTemplatePath( 'languages' ) );
	}

	/**
	 * Register custom post types and their related taxonomies
	 *
	 * @return void
	 */
	public function addPostTypes(): void {
		$resource = new PostType(
			__( 'Resource', 'chipmunk' ),
			__( 'Resources', 'chipmunk' ),
			[
				'menu_icon'     => 'dashicons-screenoptions',
				'menu_position' => 20,
			],
		);

		$resource->register();
		$resource->addTaxonomy(
			__( 'Collection', 'chipmunk' ),
			__( 'Collections', 'chipmunk' ),
		);
		$resource->addTaxonomy(
			__( 'Tag', 'chipmunk' ),
			__( 'Tags', 'chipmunk' ),
			[
				'hierarchical' => false,
			],
		);
	}
}
