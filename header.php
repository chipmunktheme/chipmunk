<!doctype html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <title>
    <?php if (wp_title('', false)) : ?>
      <?php wp_title(' - ', true, 'right'); ?>
    <?php endif; ?>

    <?php bloginfo('name'); ?><?php if (is_home() and get_bloginfo('description')) : ?>: <?php bloginfo('description'); ?><?php endif; ?>
  </title>

  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
  <meta name="description" content="<?php bloginfo('description'); ?>">

  <?php if (ChipmunkCustomizer::theme_option('primary_font')) : ?>
    <link rel="stylesheet" media="all" href="//fonts.googleapis.com/css?family=<?php echo ChipmunkCustomizer::theme_option('primary_font'); ?>:400,700">
  <?php endif; ?>
  <link rel="icon" href="<?php echo has_site_icon() ? get_site_icon_url() : get_template_directory_uri().'/static/dist/images/chipmunk.png'; ?>">

  <?php wp_head(); ?>

  <?php get_template_part('partials/custom-style'); ?>
</head>

<body <?php body_class(); ?>
  data-assets-path="<?php echo get_template_directory_uri(); ?>/static"
  data-ajax-source="<?php echo site_url(); ?>/wp-admin/admin-ajax.php">

  <div class="body-bag">
    <?php get_template_part('partials/page-head'); ?>
