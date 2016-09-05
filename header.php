<!doctype html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <title><?php wp_title( '' ); ?><?php if ( wp_title( '', false ) ) {
      echo ' : ';
    } ?><?php bloginfo( 'name' ); ?></title>

  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
  <meta name="description" content="<?php bloginfo( 'description' ); ?>">

  <link rel="dns-prefetch" href="//www.google-analytics.com">
  <link rel="stylesheet" media="all" href="<?php echo get_template_directory_uri(); ?>/static/styles/main.min.css">
  <link rel="stylesheet" media="all" href="//fonts.googleapis.com/css?family=Poppins:400,700">
  <link rel="icon" href="<?php echo has_site_icon() ? get_site_icon_url() : '/static/images/chipmunk.png'; ?>">

  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
  <header class="page-head">
    <div class="container">
      <div class="page-head__inner">
        <h1 class="page-head__logo">
          <a href="<?php echo esc_url(site_url()); ?>" rel="index">
            <?php if ($logo = Chipmunk::theme_option('logo')) : ?>
              <img src="<?php echo $logo; ?>" alt="" />
            <?php else : ?>
              <?php bloginfo('name'); ?>
            <?php endif; ?>
          </a>
        </h1>

        <nav class="nav-primary">
          <div class="nav-primary__inner">
            <button type="button" class="nav-primary__close hidden-lg" data-nav-toggle>
              <i class="icon icon_close"></i>
              <span class="sr-only"><?php _e('Close', 'chipmunk'); ?></span>
            </button>

            <ul>
              <?php $menu_items = wp_get_nav_menu_items('Header nav'); ?>

              <?php foreach ($menu_items as $menu_item) : ?>
                <li class="nav-primary__item"><a href="<?php echo $menu_item->url; ?>"><?php echo $menu_item->title; ?></a></li>
            	<?php endforeach; ?>

              <li class="nav-primary__item hidden-lg">
                <button type="button" class="button button_secondary" data-popup-toggle>
                  <?php _e('Submit', 'chipmunk'); ?>
                </button>
              </li>
            </ul>
          </div>
          <!-- /.nav-primary__inner -->
        </nav>
        <!-- /.nav-primary -->

        <div class="page-head__cta">
          <button type="button" class="page-head__search" data-search-toggle>
            <i class="icon icon_search"></i>
            <span class="sr-only"><?php _e('Search', 'chipmunk'); ?></span>
          </button>

          <button type="button" class="button button_secondary visible-lg-block" data-popup-toggle>
            <?php _e('Submit', 'chipmunk'); ?>
          </button>

          <button type="button" class="page-head__trigger button button_secondary hidden-lg" data-nav-toggle>
            <?php _e('Menu', 'chipmunk'); ?>
          </button>
        </div>
        <!-- /.page-head__cta -->
      </div>
      <!-- /.page-head__inner -->
    </div>
    <!-- /.container -->
  </header>
  <!-- /.page-head -->
