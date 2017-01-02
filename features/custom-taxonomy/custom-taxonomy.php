<?php
/**
 * Custom taxonomy
 *
 * @package WordPress
 * @subpackage Chipmunk
 */

if (current_theme_supports('custom-taxonomy'))
{
  $taxonomies = get_theme_support('custom-taxonomy');

  // have we defined any posts?
  if (is_array($taxonomies[0]))
  {
    $taxonomies = $taxonomies[0];

    $defaults = array(
      'public'                => true,
      'hierarchical'          => true,
      'query_var'             => true,
      'show_in_menu'          => true,
      'show_admin_column'     => true,
      'rewrite'               => array('slug' => '', 'with_front' => false),
    );

    // iterate through all of the post definitions and register the post types
    foreach ($taxonomies as $key => $taxonomy)
    {
      $labels = array(
        'name'                => $taxonomy['plural'],
        'singular_name'       => $taxonomy['singular'],
        'menu_name'           => $taxonomy['plural'],
        'add_new_item'        => sprintf(__('Add %s', CHIPMUNK_THEME_SLUG), $taxonomy['singular']),
        'new_item_name'       => sprintf(__('New %s Name', CHIPMUNK_THEME_SLUG), $taxonomy['singular']),
        'edit_item'           => sprintf(__('Edit %s', CHIPMUNK_THEME_SLUG), $taxonomy['singular']),
        'update_item'         => sprintf(__('Update %s', CHIPMUNK_THEME_SLUG), $taxonomy['singular']),
        'parent_item'         => sprintf(__('Parent %s', CHIPMUNK_THEME_SLUG), $taxonomy['singular']),
        'parent_item_colon'   => sprintf(__('Parent %s:', CHIPMUNK_THEME_SLUG), $taxonomy['singular']),
        'all_items'           => sprintf(__('All %s', CHIPMUNK_THEME_SLUG), $taxonomy['plural']),
        'search_items'        => sprintf(__('Search %s', CHIPMUNK_THEME_SLUG), $taxonomy['plural']),
      );

      $args = wp_parse_args($taxonomy, $defaults);
      $args['labels'] = $labels;
      register_taxonomy($key, $taxonomy['posts'], $args);
    }
  }
}
