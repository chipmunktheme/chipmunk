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
  <link rel="stylesheet" media="all" href="//fonts.googleapis.com/css?family=Poppins:400,700">
  <link rel="icon" href="<?php echo has_site_icon() ? get_site_icon_url() : get_template_directory_uri().'/static/images/chipmunk.png'; ?>">

  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
  <div class="body-bag">
    <?php get_template_part('partials/page-head'); ?>
