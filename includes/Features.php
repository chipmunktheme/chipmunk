<?php

namespace Chipmunk;

/**
 * Registers custom theme support features
 *
 * @package WordPress
 * @subpackage Chipmunk
 */
class Features {

	/**
	 * A list of defined custom features
	 *
	 * @var array
	 */
	private $features = [
		'posts' 		=> 'addPostsSupport',
		'taxonomies' 	=> 'addTaxonomiesSupport',
		'images' 		=> 'addImagesSupport',
		'menus' 		=> 'addMenusSupport',
	];

	/**
 	 * Used to register custom hooks
	 */
	function __construct() {
		foreach( $this->features as $name => $callback ) {
			if ( current_theme_supports( $name ) ) {
				$this->{$callback}( $name );
			}
		}
	}

	/*
	 * Custom posts support
	 */
	public function addPostsSupport( $name ) {
		$posts = get_theme_support( $name );

		// have we defined any posts?
		if ( is_array( $posts[0] ) ) {
			$posts = $posts[0];

			$defaults = [
				'public'                => true,
				'publicly_queryable'    => true,
				'show_ui'               => true,
				'show_in_menu'          => true,
				'show_in_rest'          => true,
				'show_in_nav_menus'     => true,
				'query_var'             => true,
				'capability_type'       => 'post',
				'has_archive'           => true,
				'hierarchical'          => false,
				'can_export'            => true,
				'taxonomies'            => [],
				'rewrite'               => [ 'slug' => '', 'with_front' => false ],
				'supports'              => [ 'title', 'editor', 'author', 'thumbnail', 'excerpt' ],
			];

			// iterate through all of the post definitions and register the post types
			foreach ( $posts as $key => $post ) {
				$labels = [
					'name'                => $post['plural'],
					'singular_name'       => $post['singular'],
					'menu_name'           => $post['plural'],
					'name_admin_bar'      => $post['singular'],
				];

				$args = wp_parse_args( $post, $defaults );
				$args['labels'] = wp_parse_args( $args['labels'], $labels );

				register_post_type( $key, $args );
			}
		}
	}

	/*
	 * Custom taxonomies support
	 */
	public function addTaxonomiesSupport( $name ) {
		$taxonomies = get_theme_support( $name );

		// have we defined any posts?
		if ( is_array( $taxonomies[0] ) ) {
			$taxonomies = $taxonomies[0];

			$defaults = [
				'public'                => true,
				'hierarchical'          => true,
				'query_var'             => true,
				'show_in_menu'          => true,
				'show_in_rest'          => true,
				'show_admin_column'     => true,
				'rewrite'               => [ 'slug' => '', 'with_front' => false ],
			];

			// iterate through all of the post definitions and register the post types
			foreach ( $taxonomies as $key => $taxonomy ) {
				$labels = [
					'name'                => $taxonomy['plural'],
					'singular_name'       => $taxonomy['singular'],
					'menu_name'           => $taxonomy['plural'],
				];

				$args = wp_parse_args( $taxonomy, $defaults );
				$args['labels'] = wp_parse_args( $args['labels'], $labels );

				register_taxonomy( $key, $taxonomy['posts'], $args );
			}
		}
	}

	/*
	 * Custom images support
	 */
	public function addImagesSupport( $name ) {
		$images = get_theme_support( $name );

		// if some parameters have been added to the images
		if ( is_array( $images[0] ) ) {
			$images = $images[0];

			// iterate through the images array and enable specific image sizes
			foreach ( $images as $key => $image ) {
				add_image_size( $key, $image['width'], $image['height'], $image['crop'] );
			}
		}

		// add post-thumbnails support
		add_theme_support( 'post-thumbnails' );
	}

	/*
	 * Custom menus support
	 */
	public function addMenusSupport( $name ) {
		$menus = get_theme_support( $name );

		// if some parameters have been added to the menus
		if ( is_array( $menus[0] ) ) {
			$menus = $menus[0];
		}

		register_nav_menus( $menus );
	}
}
