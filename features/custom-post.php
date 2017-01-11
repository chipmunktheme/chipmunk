<?php
/**
 * Custom post
 *
 * @package WordPress
 * @subpackage Chipmunk
 */

if ( current_theme_supports( 'custom-post' ) ) {
	$posts = get_theme_support( 'custom-post' );

	// have we defined any posts?
	if ( is_array( $posts[0] ) ) {
		$posts = $posts[0];

		$defaults = array(
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
			'taxonomies'            => array(),
			'rewrite'               => array( 'slug' => '', 'with_front' => false ),
			'supports'              => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt' ),
		);

		// iterate through all of the post definitions and register the post types
		foreach ( $posts as $key => $post ) {
			$labels = array(
				'name'                => $post['plural'],
				'singular_name'       => $post['singular'],
				'menu_name'           => $post['plural'],
				'name_admin_bar'      => $post['singular'],
			);

			$args = wp_parse_args( $post, $defaults );
			$args['labels'] = wp_parse_args( $args['labels'], $labels );
			
			register_post_type( $key, $args );
		}
	}
}
