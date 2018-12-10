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

        <?php get_template_part( 'templates/partials/promo' ); ?>

        <?php if ( ! is_front_page() || chipmunk_theme_option( 'disable_homepage_listings' ) ) : ?>
            <?php get_template_part( 'templates/partials/toolbox' ); ?>
        <?php endif; ?>

        <?php get_template_part( 'templates/partials/newsletter' ); ?>
        <?php get_template_part( 'templates/partials/page-bottom' ); ?>
        <?php get_template_part( 'templates/partials/page-foot' ); ?>
    </div>
    <!-- /.body-bag -->

    <?php if ( ! chipmunk_theme_option( 'disable_search' ) ) : ?>
        <?php get_template_part( 'templates/partials/search-bar' ); ?>
    <?php endif; ?>

    <?php if ( ! chipmunk_theme_option( 'disable_submissions' ) ) : ?>
        <?php get_template_part( 'templates/partials/popup' ); ?>
    <?php endif; ?>

    <?php wp_footer(); ?>

    <!-- Chipmunk Theme: Version <?php echo chipmunk_get_version(); ?> -->
</body>
</html>
