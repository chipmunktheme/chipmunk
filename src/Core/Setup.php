<?php

namespace Chipmunk\Core;

use MadeByLess\Lessi\Factory\PostType;
use MadeByLess\Lessi\Helper\EnqueueTrait;
use MadeByLess\Lessi\Helper\FileTrait;
use MadeByLess\Lessi\Helper\CoreTrait;
use MadeByLess\Lessi\Helper\ThemeTrait;
use Chipmunk\Theme;

/**
 * Theme setup.
 */
class Setup extends Theme {
	use CoreTrait;
	use EnqueueTrait;
	use FileTrait;
	use ThemeTrait;

	/**
	 * Class constructor.
	 */
	public function __construct() {}

	/**
	 * Hooks methods of this object into the WordPress ecosystem.
	 */
	public function initialize() {
		$this->addAction( 'after_setup_theme', [ $this, 'addSupports' ] );
		$this->addAction( 'after_setup_theme', [ $this, 'addImageSizes' ] );
		$this->addAction( 'after_setup_theme', [ $this, 'addNavMenus' ] );
		$this->addAction( 'after_setup_theme', [ $this, 'addTextDomains' ] );
		$this->addAction( 'after_setup_theme', [ $this, 'addPostTypes' ] );
		$this->addAction( 'after_setup_theme', [ $this, 'setupThreadedComments' ] );
	}

	/**
	 * Registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 *
	 * @see https://developer.wordpress.org/reference/hooks/after_setup_theme
	 */
	public function addSupports() {
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
	 * Registers custom image sizes.
	 *
	 * @see https://developer.wordpress.org/reference/hooks/after_setup_theme
	 */
	public function addImageSizes() {
		$this->addImageSize( '1920x1080', 1920, 1080 );
		$this->addImageSize( '1280x960', 1280, 960 );
		$this->addImageSize( '1280x720', 1280, 720 );
		$this->addImageSize( '640x480', 640, 480 );
	}

	/**
	 * Registers custom navigation menus.
	 *
	 * @see https://developer.wordpress.org/reference/hooks/after_setup_theme
	 */
	public function addNavMenus() {
		$this->addNavMenu( 'primary', __( 'Header menu', 'chipmunk' ) );
		$this->addNavMenu( 'secondary', __( 'Footer menu', 'chipmunk' ) );
	}

	/**
	 * Makes theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 *
	 * @see https://developer.wordpress.org/reference/hooks/after_setup_theme
	 */
	public function addTextDomains() {
		$this->addTextDomain( $this->getThemeProperty( 'text-domain' ), $this->getTemplatePath( 'languages' ) );
	}

	/**
	 * Register custom post types and their related taxonomies.
	 *
	 * @see https://developer.wordpress.org/reference/hooks/after_setup_theme
	 */
	public function addPostTypes() {
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

	/**
	 * Loads comment reply link in case of page and post pages
	 * if threaded comments are enabled.
	 *
	 * @see https://developer.wordpress.org/reference/hooks/after_setup_theme
	 */
	public function setupThreadedComments() {
		if ( ! is_admin() ) {
			if ( is_singular() && get_option( 'thread_comments' ) ) {
				$this->addScript( 'comment-reply' );
			}
		}
	}
}
