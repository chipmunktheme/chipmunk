<?php
load_theme_textdomain('chipmunk', get_template_directory().'/languages');

require __DIR__.'/includes/helpers.php';
require __DIR__.'/includes/ajax.php';
require __DIR__.'/includes/customizer.php';
require __DIR__.'/includes/custom-posts.php';
require __DIR__.'/includes/meta-boxes.php';
require __DIR__.'/includes/view-counter.php';

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
    add_action('init', array(&$this, 'register_menus'));
    add_action('init', array(&$this, 'update_permalinks'));
    add_action('admin_menu', array(&$this, 'remove_admin_pages'));
    add_action('admin_head', array(&$this, 'enqueue_admin_assets'));
    add_action('wp_enqueue_scripts', array(&$this, 'enqueue_assets'));
    add_action('wp_before_admin_bar_render', array(&$this, 'remove_admin_bar_pages'));
    add_action('wp_head', array(&$this, 'add_fb_open_graph_tags'));
    add_filter('wp_title', array(&$this, 'filter_wp_title'), 10, 2);
    add_filter('upload_mimes', array(&$this, 'cc_mime_types'));
    add_filter('pre_get_posts', array(&$this, 'update_search_query'));
    add_filter('pre_get_posts', array(&$this, 'update_main_query'));
    add_filter('pre_get_posts', array(&$this, 'exclude_tax_children'));

    add_action('wp_ajax_submit_resource', array(&$ajax, 'submit_resource'));
    add_action('wp_ajax_nopriv_submit_resource', array(&$ajax, 'submit_resource'));
  }

  /**
   * Enqueue scripts and styles.
   */
  public function enqueue_assets()
  {
    // Load our main stylesheet
    wp_enqueue_style('chipmunk-styles', get_template_directory_uri().'/static/dist/styles/main.min.css', array(), '1.2.0');

    // Load our main script.
    wp_enqueue_script('chipmunk-scripts', get_template_directory_uri().'/static/dist/scripts/main.min.js', array(), '1.2.0', true);
  }

  /**
   * Enqueue admin scripts and styles.
   */
  public function enqueue_admin_assets()
  {
    // Load our main stylesheet
    wp_enqueue_style('chipmunk-admin-styles', get_template_directory_uri().'/admin.css', array(), '1.2.0');
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
   * Filter wp title
   */
  public function filter_wp_title($title, $separator)
  {
    // Don't affect wp_title() calls in feeds.
    if (is_feed())
        return $title;

    // The $paged global variable contains the page number of a listing of posts.
    // The $page global variable contains the page number of a single post that is paged.
    // We'll display whichever one applies, if we're not looking at the first page.
    global $paged, $page;

    if (is_search())
    {
        // If we're a search, let's start over:
        $title = sprintf(__('Search results for %s', 'chipmunk'), '"' . get_search_query() . '"');
        // Add a page number if we're on page 2 or more:
        if ($paged >= 2)
            $title .= " $separator " . sprintf(__('Page %s', 'chipmunk'), $paged);
        // Add the site name to the end:
        $title .= " $separator " . get_bloginfo('name', 'display');
        // We're done. Let's send the new title back to wp_title():
        return $title;
    }

    // Otherwise, let's start by adding the site name to the end:
    $title .= get_bloginfo('name', 'display');
    // If we have a site description and we're on the home/front page, add the description:
    $site_description = get_bloginfo('description', 'display');

    if ($site_description && ( is_home() || is_front_page() ))
        $title .= " $separator " . $site_description;

    // Add a page number if necessary:
    if ($paged >= 2 || $page >= 2)
        $title .= " $separator " . sprintf(__('Page %s', 'chipmunk'), max($paged, $page));

    // Return the new title to wp_title():
    return $title;
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
