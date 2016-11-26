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

    public function register_type_resource()
    {
      register_post_type('resource', array(
        'labels'             => array(
          'name'               => __('Resources', 'chipmunk'),
          'singular_name'      => __('Resource', 'chipmunk'),
          'menu_name'          => __('Resources', 'chipmunk'),
          'name_admin_bar'     => __('Resource', 'chipmunk'),
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
        'rewrite'               => array('with_front' => false, 'slug' => 'resource'),
        'public'                => true,
        'menu_icon'             => 'dashicons-screenoptions',
        'supports'              => array('title', 'editor', 'author', 'thumbnail'),
      ));

      register_taxonomy('resource-collection', 'resource', array(
        'labels'             => array(
          'name'              => __('Collections', 'chipmunk'),
          'singular_name'     => __('Collection', 'chipmunk'),
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
        'rewrite'           => array('with_front' => false, 'slug' => 'collection'),
        'show_admin_column' => true,
      ));

      register_taxonomy('resource-tag', 'resource', array(
        'show_in_menu'      => false,
        'show_admin_column' => true,
      ));
    }

    public function register_type_curator()
    {
      register_post_type('curator', array(
        'labels'             => array(
          'name'               => __('Curators', 'chipmunk'),
          'singular_name'      => __('Curator', 'chipmunk'),
          'menu_name'          => __('Curators', 'chipmunk'),
          'name_admin_bar'     => __('Curator', 'chipmunk'),
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
