<?php
/**
 * Chipmunk: Theme specific functionalities
 *
 * Author:       Made by Less
 * Author URI:   https://madebyless.com
 *
 * @package WordPress
 * @subpackage Chipmunk
 */

define( 'THEME_TITLE',          'Chipmunk' );
define( 'THEME_SLUG',           'chipmunk' );
define( 'THEME_VERSION',        '1.14.0' );
define( 'THEME_AUTHOR',         'Made by Less' );
define( 'THEME_TEMPLATE_URI',   get_template_directory_uri() );
define( 'THEME_TEMPLATE_DIR',   get_template_directory() );
define( 'THEME_DEMO_URL',       'https://demo.chipmunktheme.com' );
define( 'THEME_SHOP_URL',       'https://chipmunktheme.com' );
define( 'THEME_ITEM_ID',        '893' );
define( 'THEME_ITEM_SLUG',      'chipmunk-theme' );

/*
 * Require theme components
 */
require_once THEME_TEMPLATE_DIR . '/inc/customizer.php';
require_once THEME_TEMPLATE_DIR . '/inc/helpers.php';
require_once THEME_TEMPLATE_DIR . '/inc/config.php';
require_once THEME_TEMPLATE_DIR . '/inc/settings.php';
require_once THEME_TEMPLATE_DIR . '/inc/assets.php';
require_once THEME_TEMPLATE_DIR . '/inc/views.php';
require_once THEME_TEMPLATE_DIR . '/inc/shortcodes.php';
require_once THEME_TEMPLATE_DIR . '/inc/ajax.php';
require_once THEME_TEMPLATE_DIR . '/inc/submission.php';
require_once THEME_TEMPLATE_DIR . '/inc/upvotes.php';
require_once THEME_TEMPLATE_DIR . '/inc/bookmarks.php';
require_once THEME_TEMPLATE_DIR . '/inc/open-graph.php';

/*
 * Automatic update implementation
 * Using Easy Digital Downloads
 */
require_once THEME_TEMPLATE_DIR . '/inc/updater/theme-updater.php';

/*
 * Theme onboarding
 * Using Merlin WP
 */
require_once THEME_TEMPLATE_DIR . '/inc/merlin/vendor/autoload.php';
require_once THEME_TEMPLATE_DIR . '/inc/merlin/class-merlin.php';
require_once THEME_TEMPLATE_DIR . '/inc/merlin-config.php';

/*
 * Advanced Custom Fields PRO plugin
 */
define( 'CHIPMUNK_ACF_PATH', THEME_TEMPLATE_DIR . '/inc/acf/' );
define( 'CHIPMUNK_ACF_URL', THEME_TEMPLATE_URI . '/inc/acf/' );

require_once THEME_TEMPLATE_DIR . '/inc/acf/acf.php';
require_once THEME_TEMPLATE_DIR . '/inc/acf-config.php';


if ( ! function_exists( 'chipmunk_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function chipmunk_setup() {
		/*
		 * Makes theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 */
		load_theme_textdomain( THEME_SLUG, THEME_TEMPLATE_DIR . '/languages' );

		// Add-Ons
		add_theme_support( 'chipmunk-members' );
		add_theme_support( 'chipmunk-ratings' );

		// Theme Support
		add_theme_support( 'title-tag' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );
		add_theme_support( 'comments' );
		add_theme_support( 'threaded-comments' );

		// Gutenberg
		add_theme_support( 'align-wide' );
		add_theme_support( 'responsive-embeds' );

		add_theme_support( 'sidebars', array(
			'blog-sidebar'  => array(
				'name' => __( 'Blog sidebar', 'chipmunk' ),
			),
		) );

		/**
		 * Adds support for editor color palette.
		 *
		 * @see https://developer.wordpress.org/reference/functions/add_theme_support/#editor-color-palette
		 */
		add_theme_support( 'editor-color-palette', array(
			array(
				'name'  => __( 'Black', 'chipmunk' ),
				'slug'  => 'black',
				'color'	=> '#000000',
			),
			array(
				'name'  => __( 'Gray', 'chipmunk' ),
				'slug'  => 'gray',
				'color' => '#666',
			),
			array(
				'name'  => __( 'White', 'chipmunk' ),
				'slug'  => 'white',
				'color' => '#FFF',
			),
		) );

		/**
		 * Adds support for editor font sizes.
		 *
		 * @see https://developer.wordpress.org/reference/functions/add_theme_support/#editor-color-palette
		 */
		add_theme_support( 'editor-font-sizes', array(
			array(
				'name'      => __( 'Small', 'chipmunk' ),
				'size'      => 16,
				'slug'      => 'small'
			),
			array(
				'name'      => __( 'Normal', 'chipmunk' ),
				'size'      => 21,
				'slug'      => 'normal'
			),
			array(
				'name'      => __( 'Medium', 'chipmunk' ),
				'size'      => 24,
				'slug'      => 'medium'
			),
			array(
				'name'      => __( 'Large', 'chipmunk' ),
				'size'      => 36,
				'slug'      => 'large'
			),
			array(
				'name'      => __( 'Huge', 'chipmunk' ),
				'size'      => 48,
				'slug'      => 'huge'
			)
		) );

		add_theme_support( 'custom-post', array(
			'resource' => array(
				'singular'              => esc_html__( 'Resource', 'chipmunk' ),
				'plural'                => esc_html__( 'Resources', 'chipmunk' ),
				'rewrite'               => array( 'slug' => ( ! empty( get_option( 'chipmunk_resource_cpt_base' ) ) ? get_option( 'chipmunk_resource_cpt_base' ) : lcfirst( esc_html__( 'Resource', 'chipmunk' ) ) ) ),
				'supports'              => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'publicize' ),
				'menu_icon'             => 'dashicons-screenoptions',
				'menu_position'         => 20,
				'show_in_rest'          => true,
				'rest_base'             => 'resources',
				'rest_controller_class' => 'WP_REST_Posts_Controller',
				'labels'                => array(
					'add_new_item'        => esc_html__( 'Add New Resource', 'chipmunk' ),
					'edit_item'           => esc_html__( 'Edit Resource', 'chipmunk' ),
					'new_item'            => esc_html__( 'New Resource', 'chipmunk' ),
					'view_item'           => esc_html__( 'View Resource', 'chipmunk' ),
					'all_items'           => esc_html__( 'All Resources', 'chipmunk' ),
					'search_items'        => esc_html__( 'Search Resources', 'chipmunk' ),
					'not_found'           => esc_html__( 'No Resources found.', 'chipmunk' ),
					'not_found_in_trash'  => esc_html__( 'No Resources found in trash.', 'chipmunk' ),
				),
			),
		) );

		add_theme_support( 'custom-taxonomy', array(
			'resource-collection' => array(
				'singular'              => esc_html__( 'Collection', 'chipmunk' ),
				'plural'                => esc_html__( 'Collections', 'chipmunk' ),
				'posts'                 => array( 'resource' ),
				'rewrite'               => array( 'slug' => ( ! empty( get_option( 'chipmunk_collection_cpt_base' ) ) ? get_option( 'chipmunk_collection_cpt_base' ) : sanitize_title( esc_html__( 'Collection', 'chipmunk' ) ) ), 'with_front' => false, 'hierarchical' => true ),
				'rest_base'             => 'collections',
				'rest_controller_class' => 'WP_REST_Terms_Controller',
				'labels'                => array(
					'add_new_item'        => esc_html__( 'Add Collection', 'chipmunk' ),
					'new_item_name'       => esc_html__( 'New Collection Name', 'chipmunk' ),
					'edit_item'           => esc_html__( 'Edit Collection', 'chipmunk' ),
					'update_item'         => esc_html__( 'Update Collection', 'chipmunk' ),
					'parent_item'         => esc_html__( 'Parent Collection', 'chipmunk' ),
					'parent_item_colon'   => esc_html__( 'Parent Collection:', 'chipmunk' ),
					'all_items'           => esc_html__( 'All Collections', 'chipmunk' ),
					'search_items'        => esc_html__( 'Search Collections', 'chipmunk' ),
				),
			),

			'resource-tag' => array(
				'singular'              => esc_html__( 'Tag', 'chipmunk' ),
				'plural'                => esc_html__( 'Tags', 'chipmunk' ),
				'posts'                 => array( 'resource' ),
				'rewrite'               => array( 'slug' => ( ! empty( get_option( 'chipmunk_tag_cpt_base' ) ) ? get_option( 'chipmunk_tag_cpt_base' ) : sanitize_title( esc_html__( 'Resource Tag', 'chipmunk' ) ) ), 'with_front' => false, 'hierarchical' => true ),
				'hierarchical'          => false,
				'labels'                => array(
					'add_new_item'        => esc_html__( 'Add Tag', 'chipmunk' ),
					'new_item_name'       => esc_html__( 'New Tag Name', 'chipmunk' ),
					'edit_item'           => esc_html__( 'Edit Tag', 'chipmunk' ),
					'update_item'         => esc_html__( 'Update Tag', 'chipmunk' ),
					'parent_item'         => esc_html__( 'Parent Tag', 'chipmunk' ),
					'parent_item_colon'   => esc_html__( 'Parent Tag:', 'chipmunk' ),
					'all_items'           => esc_html__( 'All Tags', 'chipmunk' ),
					'search_items'        => esc_html__( 'Search Tags', 'chipmunk' ),
				),
			),
		) );

		add_theme_support( 'menus', array(
			'nav-primary'   => 'Header nav',
			'nav-secondary' => 'Footer nav'
		) );

		add_theme_support( 'images', array(
			'1920x1080' => array(
				'width'   => 1920,
				'height'  => 1080,
				'crop'    => true,
			),
			'1280x960' => array(
				'width'   => 1280,
				'height'  => 960,
				'crop'    => true,
			),
			'1280x720' => array(
				'width'   => 1280,
				'height'  => 720,
				'crop'    => true,
			),
			'600x420' => array(
				'width'   => 600,
				'height'  => 420,
				'crop'    => true,
			),
			'300x210' => array(
				'width'   => 300,
				'height'  => 210,
				'crop'    => true,
			),
		) );

		global $customizer;
		$customizer = new ChipmunkCustomizer();
	}
endif;
add_action( 'after_setup_theme', 'chipmunk_setup' );


if ( ! function_exists( 'chipmunk_load_features' ) ) :
	/**
	 * Require custom features depending on theme support
	 */
	function chipmunk_load_features() {
		$features = scandir( THEME_TEMPLATE_DIR . '/features/' );

		foreach ( $features as $feature ) {
			if ( current_theme_supports( str_replace( '.php', '', $feature ) ) ) {
				require_once THEME_TEMPLATE_DIR . '/features/' . $feature;
			}
		}
	}
	endif;
add_action( 'init', 'chipmunk_load_features' );
