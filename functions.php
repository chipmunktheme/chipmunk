<?php

require __DIR__.'/includes/customizer.php';
require __DIR__.'/includes/custom_posts.php';

class Chipmunk
{
  public function __construct()
  {
    new ChipmunkCustomizer();
    new ChipmunkCustomPosts();

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
    add_action('wp_enqueue_scripts', array(&$this, 'enqueue_assets'));
    add_action('wp_before_admin_bar_render', array(&$this, 'remove_admin_bar_pages'));
    add_filter('upload_mimes', array(&$this, 'cc_mime_types'));
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

  /**
   * Truncate long strings
   */
  public static function truncate_string($str, $chars, $to_space = true, $replacement = '...') {
    if ($chars > strlen($str)) return $str;

    $str = substr($str, 0, $chars);
    $space_pos = strrpos($str, ' ');

    if ($to_space && $space_pos >= 0)
    {
      $str = substr($str, 0, strrpos($str, ' '));
    }

    return($str . $replacement);
  }
}

new Chipmunk();
