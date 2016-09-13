<?php

if (!class_exists('ChipmunkCustomPosts'))
{
  class ChipmunkCustomPosts
  {
    public function __construct()
    {
      $this->register_type_resource();
      $this->register_type_curator();
    }

    public static function register_type_resource()
    {
      register_post_type('resource', array(
        'labels'             => array(
          'name'               => _x('Resources', 'post type general name', 'chipmunk'),
          'singular_name'      => _x('Resource', 'post type singular name', 'chipmunk'),
          'menu_name'          => _x('Resources', 'admin menu', 'chipmunk'),
          'name_admin_bar'     => _x('Resource', 'add new on admin bar', 'chipmunk'),
          'add_new'            => __('Add New', 'chipmunk'),
          'add_new_item'       => __('Add New Resource', 'chipmunk'),
          'new_item'           => __('New Resource', 'chipmunk'),
          'edit_item'          => __('Edit Resource', 'chipmunk'),
          'view_item'          => __('View Resource', 'chipmunk'),
          'all_items'          => __('All Resources', 'chipmunk'),
          'search_items'       => __('Search Resources', 'chipmunk'),
          'parent_item_colon'  => __('Parent Resource:', 'chipmunk'),
          'not_found'          => __('No resources found.', 'chipmunk'),
          'not_found_in_trash' => __('No resources found in Trash.', 'chipmunk'),
        ),
        'show_ui'               => true,
        'rewrite'               => array('with_front' => false, 'slug' => __('resource', 'chipmunk')),
        'public'                => true,
        'menu_icon'             => 'dashicons-screenoptions',
        'show_in_rest'          => true,
    		'rest_controller_class' => 'WP_REST_Posts_Controller',
        'supports'              => array('title', 'editor', 'thumbnail'),
      ));

      register_taxonomy('resource-collection', 'resource', array(
        'labels'             => array(
          'name'              => _x('Collections', 'taxonomy general name', 'chipmunk'),
          'singular_name'     => _x('Collection', 'taxonomy singular name', 'chipmunk'),
          'search_items'      => __('Search Collections', 'chipmunk'),
          'all_items'         => __('All Collections', 'chipmunk'),
          'parent_item'       => __('Parent Collection', 'chipmunk'),
          'parent_item_colon' => __('Parent Collection:', 'chipmunk'),
          'edit_item'         => __('Edit Collection', 'chipmunk'),
          'update_item'       => __('Update Collection', 'chipmunk'),
          'add_new_item'      => __('Add New Collection', 'chipmunk'),
          'new_item_name'     => __('New Collection Name', 'chipmunk'),
          'menu_name'         => __('Collections', 'chipmunk'),
        ),
        'hierarchical'      => true,
        'rewrite'           => array('with_front' => false, 'slug' => __('collection', 'chipmunk')),
      ));

      register_taxonomy('resource-tag', 'resource', array(
        'labels'             => array(
          'name'              => _x('Tags', 'taxonomy general name', 'chipmunk'),
          'singular_name'     => _x('Tag', 'taxonomy singular name', 'chipmunk'),
          'search_items'      => __('Search Tags', 'chipmunk'),
          'all_items'         => __('All Tags', 'chipmunk'),
          'parent_item'       => __('Parent Tag', 'chipmunk'),
          'parent_item_colon' => __('Parent Tag:', 'chipmunk'),
          'edit_item'         => __('Edit Tag', 'chipmunk'),
          'update_item'       => __('Update Tag', 'chipmunk'),
          'add_new_item'      => __('Add New Tag', 'chipmunk'),
          'new_item_name'     => __('New Tag Name', 'chipmunk'),
          'menu_name'         => __('Tags', 'chipmunk'),
        ),
        'show_in_menu'      => false,
      ));
    }

    public static function register_type_curator()
    {
      register_post_type('curator', array(
        'labels'             => array(
          'name'               => _x('Curators', 'post type general name', 'chipmunk'),
          'singular_name'      => _x('Curator', 'post type singular name', 'chipmunk'),
          'menu_name'          => _x('Curators', 'admin menu', 'chipmunk'),
          'name_admin_bar'     => _x('Curator', 'add new on admin bar', 'chipmunk'),
          'add_new'            => __('Add New', 'chipmunk'),
          'add_new_item'       => __('Add New Curator', 'chipmunk'),
          'new_item'           => __('New Curator', 'chipmunk'),
          'edit_item'          => __('Edit Curator', 'chipmunk'),
          'view_item'          => __('View Curator', 'chipmunk'),
          'all_items'          => __('All Curators', 'chipmunk'),
          'search_items'       => __('Search Curators', 'chipmunk'),
          'parent_item_colon'  => __('Parent Curator:', 'chipmunk'),
          'not_found'          => __('No curators found.', 'chipmunk'),
          'not_found_in_trash' => __('No curators found in Trash.', 'chipmunk'),
        ),
        'show_ui'            => true,
        'public'             => false,
        'menu_icon'          => 'dashicons-businessman',
        'supports'           => array('title', 'thumbnail'),
      ));
    }
  }
}
