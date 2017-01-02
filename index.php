<?php
/**
 * Chipmunk: Index
 *
 * @package WordPress
 * @subpackage Chipmunk
 */

get_header(); ?>

  <?php if (!ChipmunkCustomizer::theme_option('disable_homepage_listings')) : ?>
    <?php get_template_part('sections/resources-tabs'); ?>
    <?php get_template_part('sections/toolbox'); ?>
  <?php endif; ?>

  <?php if (!ChipmunkCustomizer::theme_option('disable_homepage_collections')) : ?>
    <?php get_template_part('sections/collections'); ?>
  <?php endif; ?>

  <?php if (ChipmunkCustomizer::theme_option('disable_homepage_listings')) : ?>
    <?php get_template_part('sections/toolbox'); ?>
  <?php endif; ?>

<?php get_footer(); ?>
