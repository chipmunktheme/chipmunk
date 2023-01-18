<?php

/**
 * Chipmunk: Footer
 *
 * Remember to always include the wp_footer() call before the </body> tag
 *
 * @package WordPress
 * @subpackage Chipmunk
 */
?>

<?php Chipmunk\Helpers::get_template_part('partials/promo'); ?>

<?php if (!is_front_page() || Chipmunk\Helpers::get_theme_option('disable_homepage_listings')) : ?>
    <?php Chipmunk\Helpers::get_template_part('partials/toolbox'); ?>
<?php endif; ?>

<?php Chipmunk\Helpers::get_template_part('partials/newsletter'); ?>
<?php Chipmunk\Helpers::get_template_part('partials/page-bottom'); ?>
<?php Chipmunk\Helpers::get_template_part('partials/page-foot'); ?>

<?php if (!Chipmunk\Helpers::get_theme_option('disable_submissions') && empty(Chipmunk\Helpers::get_theme_option('submit_page'))) : ?>
    <?php Chipmunk\Helpers::get_template_part('partials/popup'); ?>
<?php endif; ?>

<?php wp_footer(); ?>

<!-- Chipmunk Theme: Version <?php echo wp_get_theme()->get('Version'); ?> -->
</body>

</html>
