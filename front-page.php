<?php

/**
 * Chipmunk: Front page
 *
 * @package WordPress
 * @subpackage Chipmunk
 */

get_header(); ?>
    <?php Chipmunk\Helpers::get_template_part('partials/intro-text'); ?>

    <?php if (!Chipmunk\Helpers::get_theme_option('disable_homepage_listings')) : ?>
       	<?php do_action('chipmunk_before_resources_tabs'); ?>

       	<?php Chipmunk\Helpers::get_template_part('sections/tabs'); ?>

       	<?php do_action('chipmunk_after_resources_tabs'); ?>

       	<?php Chipmunk\Helpers::get_template_part('partials/toolbox'); ?>
    <?php endif; ?>

    <?php if (!Chipmunk\Helpers::get_theme_option('disable_homepage_collections')) : ?>
       	<?php Chipmunk\Helpers::get_template_part('sections/collections'); ?>
    <?php endif; ?>

    <?php if (!Chipmunk\Helpers::get_theme_option('disable_homepage_posts')) : ?>
       	<?php Chipmunk\Helpers::get_template_part(['sections/loop', 'post']); ?>
    <?php endif; ?>

<?php get_footer(); ?>
