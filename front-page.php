<?php get_header(); ?>

  <?php if (!ChipmunkCustomizer::theme_option('disable_resource_sliders')) : ?>
    <?php get_template_part('sections/resources-tabs'); ?>
    <?php get_template_part('sections/toolbox'); ?>
  <?php endif; ?>

  <?php get_template_part('sections/collections'); ?>

  <?php if (ChipmunkCustomizer::theme_option('disable_resource_sliders')) : ?>
    <?php get_template_part('sections/toolbox'); ?>
  <?php endif; ?>

<?php get_footer(); ?>
