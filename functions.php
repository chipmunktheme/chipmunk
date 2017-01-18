<?php
/**
 * Chipmunk: Theme specific functionalities
 *
 * Author: Piotr Kulpinski
 * URL: http://chipmunktheme.com
 *
 * @package WordPress
 * @subpackage Chipmunk
 */

define( 'CHIPMUNK_VERSION', '1.5.0' );
define( 'CHIPMUNK_TEMPLATE_URI', get_template_directory_uri() );
define( 'CHIPMUNK_TEMPLATE_DIR', get_template_directory() );
define( 'CHIPMUNK_THEME_TITLE', 'Chipmunk' );
define( 'CHIPMUNK_THEME_SLUG', 'chipmunk' );


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
	load_theme_textdomain( CHIPMUNK_THEME_SLUG, CHIPMUNK_TEMPLATE_DIR . '/languages' );

	// Theme Support
	add_theme_support( 'title-tag' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'comments' );
	add_theme_support( 'threaded-comments' );

	add_theme_support( 'custom-post', array(
		'resource' => array(
			'singular'              => __( 'Resource', 'chipmunk' ),
			'plural'                => __( 'Resources', 'chipmunk' ),
			'rewrite'               => array( 'slug' => __( 'resource', 'chipmunk' ), 'with_front' => false ),
			'supports'              => array( 'title', 'editor', 'author', 'thumbnail', 'comments', 'publicize' ),
			'menu_icon'             => 'dashicons-screenoptions',
			'show_in_rest'          => true,
			'rest_base'             => 'resources',
			'rest_controller_class' => 'WP_REST_Posts_Controller',
			'labels'                => array(
				'add_new_item'        => __( 'Add New Resource', 'chipmunk' ),
				'edit_item'           => __( 'Edit Resource', 'chipmunk' ),
				'new_item'            => __( 'New Resource', 'chipmunk' ),
				'view_item'           => __( 'View Resource', 'chipmunk' ),
				'all_items'           => __( 'All Resources', 'chipmunk' ),
				'search_items'        => __( 'Search Resources', 'chipmunk' ),
				'not_found'           => __( 'No Resources found.', 'chipmunk' ),
				'not_found_in_trash'  => __( 'No Resources found in trash.', 'chipmunk' ),
			),
		),
	) );

	add_theme_support( 'custom-taxonomy', array(
		'resource-collection' => array(
			'singular'              => __( 'Collection', 'chipmunk' ),
			'plural'                => __( 'Collections', 'chipmunk' ),
			'posts'                 => array( 'resource' ),
			'rewrite'               => array( 'slug' => __( 'collection', 'chipmunk' ), 'with_front' => false ),
			'rest_base'             => 'collections',
			'rest_controller_class' => 'WP_REST_Terms_Controller',
			'labels'                => array(
				'add_new_item'        => __( 'Add Collection', 'chipmunk' ),
				'new_item_name'       => __( 'New Collection Name', 'chipmunk' ),
				'edit_item'           => __( 'Edit Collection', 'chipmunk' ),
				'update_item'         => __( 'Update Collection', 'chipmunk' ),
				'parent_item'         => __( 'Parent Collection', 'chipmunk' ),
				'parent_item_colon'   => __( 'Parent Collection:', 'chipmunk' ),
				'all_items'           => __( 'All Collections', 'chipmunk' ),
				'search_items'        => __( 'Search Collections', 'chipmunk' ),
			),
		),

		'resource-tag' => array(
			'singular'              => __( 'Tag', 'chipmunk' ),
			'plural'                => __( 'Tags', 'chipmunk' ),
			'posts'                 => array( 'resource' ),
			'hierarchical'          => false,
			'show_in_menu'          => false,
			'labels'                => array(
				'add_new_item'        => __( 'Add Tag', 'chipmunk' ),
				'new_item_name'       => __( 'New Tag Name', 'chipmunk' ),
				'edit_item'           => __( 'Edit Tag', 'chipmunk' ),
				'update_item'         => __( 'Update Tag', 'chipmunk' ),
				'parent_item'         => __( 'Parent Tag', 'chipmunk' ),
				'parent_item_colon'   => __( 'Parent Tag:', 'chipmunk' ),
				'all_items'           => __( 'All Tags', 'chipmunk' ),
				'search_items'        => __( 'Search Tags', 'chipmunk' ),
			),
		),
	) );

	add_theme_support( 'menus', array(
		'nav-primary'   => 'Header nav',
		'nav-secondary' => 'Footer nav'
	) );

	add_theme_support( 'images', array(
		'chipmunk-xl' => array(
			'width'   => 1280,
			'height'  => 888,
			'crop'    => true
		),
		'chipmunk-lg' => array(
			'width'   => 640,
			'height'  => 444,
			'crop'    => true
		),
		'chipmunk-md' => array(
			'width'   => 460,
			'height'  => 320,
			'crop'    => true
		),
		'chipmunk-sm' => array(
			'width'   => 300,
			'height'  => 210,
			'crop'    => true
		),
	) );
}
endif;
add_action( 'after_setup_theme', 'chipmunk_setup' );


if ( ! function_exists( 'chipmunk_load_features' ) ) :
/**
 * Require custom features depending on theme support
 */
function chipmunk_load_features() {
	$features = scandir( dirname( __FILE__ ) . '/features/' );

	foreach ( $features as $feature ) {
		if ( current_theme_supports( str_replace( '.php', '', $feature ) ) ) {
			require_once dirname( __FILE__ ) . '/features/' . $feature;
		}
	}
}
endif;
add_action( 'init', 'chipmunk_load_features' );


if ( ! function_exists( 'chipmunk_scripts' ) ) :
/**
 * Enqueue front end styles and scripts
 */
function chipmunk_scripts() {
	// Load Chipmunk main stylesheet
	wp_enqueue_style( CHIPMUNK_THEME_SLUG . '-styles', CHIPMUNK_TEMPLATE_URI . '/static/dist/styles/main.min.css', array(), CHIPMUNK_VERSION );

	// Load Chipmunk main script.
	wp_enqueue_script( CHIPMUNK_THEME_SLUG . '-scripts', CHIPMUNK_TEMPLATE_URI . '/static/dist/scripts/main.min.js', array(), CHIPMUNK_VERSION, true );
}
endif;
add_action( 'wp_enqueue_scripts', 'chipmunk_scripts' );


if ( ! function_exists( 'chipmunk_admin_scripts' ) ) :
/**
 * Enqueue admin end styles and scripts
 */
function chipmunk_admin_scripts() {
	// Load Chipmunk admin stylesheet
	wp_enqueue_style( CHIPMUNK_THEME_SLUG . '-admin-styles', CHIPMUNK_TEMPLATE_URI . '/admin.css', array(), CHIPMUNK_VERSION );
}
endif;
add_action( 'admin_enqueue_scripts', 'chipmunk_admin_scripts' );


/**
 * Theme specific helpers.
 */
require_once CHIPMUNK_TEMPLATE_DIR . '/inc/helpers.php';

/**
 * Custom config actions
 */
require_once CHIPMUNK_TEMPLATE_DIR . '/inc/config.php';

/**
 * Clean up WordPress defaults
 */
require_once CHIPMUNK_TEMPLATE_DIR . '/inc/cleanup.php';

/**
 * Custom meta boxes.
 */
require_once CHIPMUNK_TEMPLATE_DIR . '/inc/meta-boxes.php';

/**
 * WP Customizer settings.
 */
require_once CHIPMUNK_TEMPLATE_DIR . '/inc/customizer.php';

/**
 * View count functionality
 */
require_once CHIPMUNK_TEMPLATE_DIR . '/inc/views.php';

/**
 * Upvotes functionality
 */
require_once CHIPMUNK_TEMPLATE_DIR . '/inc/upvotes.php';

/**
 * Custom AJAX callbacks.
 */
require_once CHIPMUNK_TEMPLATE_DIR . '/inc/ajax.php';
