<?php
/**
 * Custom taxonomy
 *
 * @package WordPress
 * @subpackage Chipmunk
 */

if ( current_theme_supports( 'custom-taxonomy' ) ) {
    $taxonomies = get_theme_support( 'custom-taxonomy' );

    // have we defined any posts?
    if ( is_array( $taxonomies[0] ) ) {
        $taxonomies = $taxonomies[0];

        $defaults = array(
            'public'                => true,
            'hierarchical'          => true,
            'query_var'             => true,
            'show_in_menu'          => true,
            'show_in_rest'          => true,
            'show_admin_column'     => true,
            'rewrite'               => array( 'slug' => '', 'with_front' => false ),
        );

        // iterate through all of the post definitions and register the post types
        foreach ( $taxonomies as $key => $taxonomy ) {
            $labels = array(
                'name'                => $taxonomy['plural'],
                'singular_name'       => $taxonomy['singular'],
                'menu_name'           => $taxonomy['plural'],
            );

            $args = wp_parse_args( $taxonomy, $defaults );
            $args['labels'] = wp_parse_args( $args['labels'], $labels );

            register_taxonomy( $key, $taxonomy['posts'], $args );
        }
    }
}
