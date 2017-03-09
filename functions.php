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

define( 'CHIPMUNK_VERSION', '1.6' );
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


require_once CHIPMUNK_TEMPLATE_DIR . '/inc/helpers.php';
require_once CHIPMUNK_TEMPLATE_DIR . '/inc/config.php';
require_once CHIPMUNK_TEMPLATE_DIR . '/inc/assets.php';
require_once CHIPMUNK_TEMPLATE_DIR . '/inc/meta-boxes.php';
require_once CHIPMUNK_TEMPLATE_DIR . '/inc/customizer.php';
require_once CHIPMUNK_TEMPLATE_DIR . '/inc/views.php';
require_once CHIPMUNK_TEMPLATE_DIR . '/inc/upvotes.php';
require_once CHIPMUNK_TEMPLATE_DIR . '/inc/ajax.php';
