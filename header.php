<?php
/**
 * Chipmunk: Header
 *
 * Remember to always include the wp_head() call before the ending </head> tag
 *
 * Make sure that you include the <!DOCTYPE html> in the same line as ?> closing tag
 * otherwise ajax might not work properly
 *
 * @package WordPress
 * @subpackage Chipmunk
 */
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
  <meta name="robots" content="noodp">

  <?php if ( isset($post ) and is_singular( 'resource') ) : ?>
    <?php $description = ChipmunkHelpers::custom_excerpt( $post->post_content, $post->post_excerpt ); ?>
  <?php endif; ?>
  <meta name="description" content="<?php echo ( is_front_page() or !isset( $description ) ) ? get_bloginfo( 'description' ) : $description; ?>">

  <?php if ( ChipmunkCustomizer::theme_option( 'primary_font' ) != 'System' ) : ?>
    <link rel="stylesheet" media="all" href="//fonts.googleapis.com/css?family=<?php echo ChipmunkCustomizer::theme_option( 'primary_font' ); ?>:400,700">
  <?php endif; ?>
  <link rel="icon" href="<?php echo has_site_icon() ? get_site_icon_url() : get_template_directory_uri().'/static/dist/images/chipmunk.png'; ?>">

  <?php wp_head(); ?>

  <?php get_template_part( 'partials/custom-style' ); ?>
</head>

<body <?php body_class(); ?>
  data-assets-path="<?php echo get_template_directory_uri(); ?>/static"
  data-ajax-source="<?php echo site_url(); ?>/wp-admin/admin-ajax.php">

  <div class="body-bag">
    <?php get_template_part( 'partials/page-head' ); ?>
