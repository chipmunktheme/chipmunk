<?php
// *DEBUG MODE*
// Add ?debug=true to your URL to enable
if (isset($_REQUEST['debug'])) {
  echo 'PHP Version: '.phpversion();

  ini_set('display_errors', 1);
  ini_set('error_reporting', E_ALL);
}

load_theme_textdomain('chipmunk', get_template_directory().'/languages');

include_once get_template_directory().'/includes/helpers.php';
include_once get_template_directory().'/includes/ajax.php';
include_once get_template_directory().'/includes/custom-posts.php';
include_once get_template_directory().'/includes/meta-boxes.php';
include_once get_template_directory().'/includes/view-counter.php';
include_once get_template_directory().'/includes/customizer/customizer.php';

class Chipmunk
{
  public function __construct()
  {
    new ChipmunkCustomizer();
    new ChipmunkCustomPosts();
    new ChipmunkMetaBoxes();
    new ChipmunkViewCounter();
    $ajax = new ChipmunkAjax();

    // Theme Support
    add_theme_support('menus');
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');

    // Image sizes
    add_image_size('xl', 1280, 888, true);
    add_image_size('lg', 640, 444, true);
    add_image_size('md', 460, 320, true);
    add_image_size('sm', 300, 210, true);

    // Init functions
    add_action('init', array($this, 'register_menus'));
    add_action('init', array($this, 'update_permalinks'));
    add_action('admin_menu', array($this, 'remove_admin_pages'));
    add_action('admin_head', array($this, 'enqueue_admin_assets'));
    add_action('wp_enqueue_scripts', array($this, 'enqueue_assets'));
    add_action('wp_before_admin_bar_render', array($this, 'remove_admin_bar_pages'));
    add_action('wp_head', array($this, 'add_fb_open_graph_tags'));
    add_filter('upload_mimes', array($this, 'cc_mime_types'));
    add_filter('pre_get_posts', array($this, 'update_search_query'));
    add_filter('pre_get_posts', array($this, 'update_main_query'));
    add_filter('pre_get_posts', array($this, 'exclude_tax_children'));

    add_action('wp_ajax_submit_resource', array($ajax, 'submit_resource'));
    add_action('wp_ajax_nopriv_submit_resource', array($ajax, 'submit_resource'));
  }

  /**
   * Enqueue scripts and styles.
   */
  public function enqueue_assets()
  {
    // Load our main stylesheet
    wp_enqueue_style('chipmunk-styles', get_template_directory_uri().'/static/dist/styles/main.min.css', array(), '1.3.1');

    // Load our main script.
    wp_enqueue_script('chipmunk-scripts', get_template_directory_uri().'/static/dist/scripts/main.min.js', array(), '1.3.1', true);
  }

  /**
   * Enqueue admin scripts and styles.
   */
  public function enqueue_admin_assets()
  {
    // Load our main stylesheet
    wp_enqueue_style('chipmunk-admin-styles', get_template_directory_uri().'/admin.css', array(), '1.3.1');
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
   * Force using postname in WP permalinks
   */
  public function update_permalinks()
  {
    global $wp_rewrite;

    $wp_rewrite->set_permalink_structure('/%postname%/');
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
      $query->set('posts_per_page', ChipmunkCustomizer::theme_option('results_per_page'));
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
      $query->set('posts_per_page', ChipmunkCustomizer::theme_option('posts_per_page'));
    }

    return $query;
  }

  /**
   * Exclude children from taxonomy listing
   */
  public function exclude_tax_children($query)
  {
    if (isset($query->query_vars['resource-collection']))
    {
      $query->set('tax_query', array(array(
        'taxonomy'          => 'resource-collection',
        'field'             => 'slug',
        'terms'             => $query->query_vars['resource-collection'],
        'include_children'  => false,
      )));
    }
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

  /**
   * Add facebook's Open Graph tags
   */
  public function add_fb_open_graph_tags()
  {
    $site_image = ($logo = ChipmunkCustomizer::theme_option('logo')) ? $logo : get_template_directory_uri().'/static/dist/images/chipmunk.png';

    if (is_single() or is_page())
    {
      global $post;

      if (get_the_post_thumbnail($post->ID, 'xl'))
      {
        $thumbnail_id     = get_post_thumbnail_id($post->ID);
        $thumbnail_object = wp_get_attachment_image_src($thumbnail_id, 'xl');
        $image            = $thumbnail_object[0];
      }

      $description = ChipmunkHelpers::custom_excerpt($post->post_content, $post->post_excerpt);
      $description = strip_tags($description);
      $description = str_replace('"', '\'', $description);
      ?>

      <!-- / FB Open Graph -->
      <meta property="og:type" content="article">
      <meta property="og:url" content="<?php the_permalink(); ?>">
      <meta property="og:title" content="<?php the_title(); ?> on <?php bloginfo('name'); ?>">
      <meta property="og:description" content="<?php echo $description ?>">
      <meta property="og:image" content="<?php echo isset($image) ? $image : $site_image; ?>">
      <meta property="og:site_name" content="<?php echo get_bloginfo('name'); ?>">

      <!-- / Twitter Cards -->
      <meta name="twitter:card" content="<?php echo isset($image) ? 'summary_large_image' : 'summary'; ?>">
      <meta name="twitter:title" content="<?php the_title(); ?> on <?php bloginfo('name'); ?>">
      <meta name="twitter:description" content="<?php echo $description ?>">
      <meta name="twitter:image" content="<?php echo isset($image) ? $image : $site_image; ?>">

      <?php
    }
    elseif (is_front_page())
    {
      ?>

      <!-- / FB Open Graph -->
      <meta property="og:type" content="website">
      <meta property="og:url" content="<?php echo get_bloginfo('url'); ?>">
      <meta property="og:title" content="<?php bloginfo('name'); ?>">
      <meta property="og:description" content="<?php bloginfo('description'); ?>">
      <meta property="og:image" content="<?php echo $site_image; ?>">

      <!-- / Twitter Cards -->
      <meta name="twitter:card" content="summary">
      <meta name="twitter:title" content="<?php bloginfo('name'); ?>">
      <meta name="twitter:description" content="<?php bloginfo('description'); ?>">
      <meta name="twitter:image" content="<?php echo $site_image; ?>">

      <?php
    }
  }
}

new Chipmunk();
