<?php
/**
 * Chipmunk: Theme specific functionalities
 *
 * Author: Piotr Kulpinski
 * URL: https://chipmunktheme.com
 *
 * @package WordPress
 * @subpackage Chipmunk
 */

define( 'THEME_VERSION', wp_get_theme()->get( 'Version' ) );
define( 'THEME_TEMPLATE_URI', get_template_directory_uri() );
define( 'THEME_TEMPLATE_DIR', get_template_directory() );
define( 'THEME_TITLE', 'Chipmunk' );
define( 'THEME_SLUG', 'chipmunk' );

require_once THEME_TEMPLATE_DIR . '/inc/customizer.php';
require_once THEME_TEMPLATE_DIR . '/inc/helpers.php';
require_once THEME_TEMPLATE_DIR . '/inc/config.php';
require_once THEME_TEMPLATE_DIR . '/inc/assets.php';
require_once THEME_TEMPLATE_DIR . '/inc/meta-boxes.php';
require_once THEME_TEMPLATE_DIR . '/inc/views.php';
require_once THEME_TEMPLATE_DIR . '/inc/shortcodes.php';
require_once THEME_TEMPLATE_DIR . '/inc/ajax.php';
require_once THEME_TEMPLATE_DIR . '/inc/submission.php';
require_once THEME_TEMPLATE_DIR . '/inc/upvotes.php';
require_once THEME_TEMPLATE_DIR . '/inc/bookmarks.php';


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
				'rewrite'               => array( 'slug' => ( ! empty( get_option( 'chipmunk_collection_cpt_base' ) ) ? get_option( 'chipmunk_collection_cpt_base' ) : lcfirst( esc_html__( 'Collection', 'chipmunk' ) ) ), 'with_front' => false, 'hierarchical' => true ),
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
				'rewrite'               => array( 'slug' => ( ! empty( get_option( 'chipmunk_tag_cpt_base' ) ) ? get_option( 'chipmunk_tag_cpt_base' ) : lcfirst( esc_html__( 'Tag', 'chipmunk' ) ) ), 'with_front' => false, 'hierarchical' => true ),
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

if ( isset( $_GET['refresh_upvotes'] ) ) {
	$db_key = '_' . THEME_SLUG . '_upvote';
	$db_key_count = '_' . THEME_SLUG . '_upvote_count';
	$db_old_key = '_' . THEME_SLUG . '_post_upvote_count';

	$resources = get_posts( array(
		'post_type'         => 'resource',
		'post_status'       => 'any',
		'posts_per_page'    => -1,
	) );

	foreach ( $resources as $resource ) {
		$old_count = (int) get_post_meta( $resource->ID, $db_old_key, true );
		$old_count = ( isset( $old_count ) && is_numeric( $old_count ) ) ? $old_count : 0;

		for ( $i = 0; $i < $old_count; $i++ ) {
			add_post_meta( $resource->ID, $db_key, '0.0.0.0' );
		}

		update_post_meta( $resource->ID, $db_key_count, count( get_post_meta( $resource->ID, $db_key ) ) );
		delete_post_meta( $resource->ID, $db_old_key );
	}
}
