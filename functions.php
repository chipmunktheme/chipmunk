<?php

require __DIR__.'/includes/customizer.php';

class Chipmunk
{
  public function __construct()
  {
    new ChipmunkCustomizer();

    // Theme Support
    add_theme_support('menus');
    add_theme_support('post-thumbnails');

    // Image sizes
    // add_image_size('sm', 320, 240, true);

    // Init functions
    add_action('init', array($this, 'register_menus'));
    add_action('init', array($this, 'register_post_types'));
    add_action('admin_menu', array(&$this, 'remove_admin_pages'));
    add_action('wp_before_admin_bar_render', array(&$this, 'remove_admin_bar_pages'));
    add_filter('upload_mimes', array(&$this, 'cc_mime_types'));
  }

  /**
   * Register custom post types
   */
  public function register_post_types()
  {
    // CustomTypes::register_type_project();
  }

  /**
   * Register custom navigations
   */
  function register_menus()
  {
    register_nav_menus(array(
      'nav-primary'   => 'Header nav',
      'nav-secondary' => 'Footer nav'
    ));
  }

  /**
   * Allow SVG upload
   */
  public function cc_mime_types($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
  }

  /**
   * Remove unnecessary admin pages
   */
  public function remove_admin_pages()
  {
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

  /**
   * Get Chipmunk theme option
   */
  public static function theme_option($name, $default = false)
  {
  	$options = (get_option('chipmunk_settings')) ? get_option('chipmunk_settings') : null;

  	// return the option if it exists
  	if (isset($options[$name]) && ! empty($options[$name])) {
  		return apply_filters('chipmunk_settings_$name', $options[$name]);
  	}

  	// return default if nothing else
  	return apply_filters('chipmunk_settings_$name', $default);
  }
}

new Chipmunk();
