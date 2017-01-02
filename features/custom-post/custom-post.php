<?php
/**
 * Custom post
 *
 * @package WordPress
 * @subpackage Chipmunk
 */

if (current_theme_supports('custom-post'))
{
  $posts = get_theme_support('custom-post');

  // have we defined any posts?
  if (is_array($posts[0]))
  {
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
      'rewrite'               => array('slug' => '', 'with_front' => false),
      'supports'              => array('title', 'editor', 'author', 'thumbnail', 'excerpt'),
    );

    // iterate through all of the post definitions and register the post types
    foreach ($posts as $key => $post)
    {
      $labels = array(
        'name'                => $post['plural'],
        'singular_name'       => $post['singular'],
        'menu_name'           => $post['plural'],
        'name_admin_bar'      => $post['singular'],
        'add_new'             => sprintf(__('Add %s', CHIPMUNK_THEME_SLUG), $post['singular']),
        'add_new_item'        => sprintf(__('Add %s', CHIPMUNK_THEME_SLUG), $post['singular']),
        'edit_item'           => sprintf(__('Edit %s', CHIPMUNK_THEME_SLUG), $post['singular']),
        'new_item'            => sprintf(__('New %s', CHIPMUNK_THEME_SLUG), $post['singular']),
        'view_item'           => sprintf(__('View %s', CHIPMUNK_THEME_SLUG), $post['singular']),
        'all_items'           => sprintf(__('All %s', CHIPMUNK_THEME_SLUG), $post['plural']),
        'search_items'        => sprintf(__('Search %s', CHIPMUNK_THEME_SLUG), $post['plural']),
        'not_found'           => sprintf(__('No %s found.', CHIPMUNK_THEME_SLUG), $post['plural']),
        'not_found_in_trash'  => sprintf(__('No %s found in trash.', CHIPMUNK_THEME_SLUG), $post['plural']),
      );

      $args = wp_parse_args($post, $defaults);
      $args['labels'] = $labels;
      register_post_type($key, $args);
    }
  }
}
