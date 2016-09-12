<?php

require __DIR__.'/includes/helpers.php';
require __DIR__.'/includes/customizer.php';
require __DIR__.'/includes/custom-posts.php';
require __DIR__.'/includes/meta-boxes.php';
require __DIR__.'/includes/shortcodes.php';
require __DIR__.'/includes/view-counter.php';

class Chipmunk
{
  public function __construct()
  {
    new ChipmunkCustomizer();
    new ChipmunkCustomPosts();
    new ChipmunkMetaBoxes();
    new ChipmunkShortcodes();
    new ChipmunkViewCounter();

    // Theme Support
    add_theme_support('menus');
    add_theme_support('post-thumbnails');

    // Image sizes
    add_image_size('lg', 640, 444, true);
    add_image_size('md', 460, 320, true);
    add_image_size('sm', 300, 210, true);

    // Init functions
    add_action('init', array($this, 'register_menus'));
    add_action('admin_menu', array(&$this, 'remove_admin_pages'));
    add_action('admin_head', array(&$this, 'enqueue_admin_assets'));
    add_action('wp_enqueue_scripts', array(&$this, 'enqueue_assets'));
    add_action('wp_before_admin_bar_render', array(&$this, 'remove_admin_bar_pages'));
    add_filter('upload_mimes', array(&$this, 'cc_mime_types'));
    add_filter('pre_get_posts', array(&$this, 'update_search_query'));
    add_filter('pre_get_posts', array(&$this, 'update_main_query'));
  }

  /**
   * Enqueue scripts and styles.
   */
  public function enqueue_assets()
  {
  	// Load our main stylesheet
  	wp_enqueue_style('chipmunk-styles', get_template_directory_uri().'/static/dist/styles/main.min.css', array(), '1.0.0');

  	// Load our main script.
  	wp_enqueue_script('chipmunk-scripts', get_template_directory_uri().'/static/dist/scripts/main.min.js', array(), '1.0.0', true);
  }

  /**
   * Enqueue admin scripts and styles.
   */
  public function enqueue_admin_assets()
  {
  	// Load our main stylesheet
  	wp_enqueue_style('chipmunk-admin-styles', get_template_directory_uri().'/admin.css', array(), '1.0.0');
  }

  /**
   * Register custom navigations
   */
  public function register_menus()
  {
    register_nav_menus(array(
      'nav-primary'   => 'Header nav',
      'nav-secondary' => 'Footer nav'
    ));
  }

  /**
   * Allow SVG upload
   */
  public function cc_mime_types($mimes)
  {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
  }

  /**
   * Update search query
   */
  public function update_search_query($query)
  {
    if ($query->is_search)
    {
      $query->set('post_type', 'resource');
      $query->set('posts_per_page', ChipmunkHelpers::theme_option('results_per_page'));
    }

    return $query;
  }

  /**
   * Update main query
   */
  public function update_main_query($query)
  {
    if ($query->is_tax and is_tax())
    {
      $query->set('posts_per_page', ChipmunkHelpers::theme_option('posts_per_page'));
    }

    return $query;
  }

  /**
   * Remove unnecessary admin pages
   */
  public function remove_admin_pages()
  {
    remove_menu_page('edit.php');
    remove_menu_page('edit-comments.php');
  }

  /**
   * Remove unnecessary admin pages
   */
  public function remove_admin_bar_pages()
  {
    global $wp_admin_bar;

    $wp_admin_bar->remove_menu('comments');
    $wp_admin_bar->remove_menu('new-content');
  }
}

new Chipmunk();
