<?php

/**
 * Chipmunk: 404 page
 *
 * @package WordPress
 * @subpackage Chipmunk
 */

get_header(); ?>

<div class="l-section l-section--double">
    <div class="l-container">
        <div class="c-lead c-lead--center">
            <h1 class="c-lead__title c-heading c-heading--h1"><?php esc_html_e('Page not found!', 'chipmunk'); ?></h1>
            <p class="c-lead__content c-content c-content--type"><?php esc_html_e('Sorry, we couldn\'t find what you\'re looking for.', 'chipmunk'); ?></p>
            <a href="<?php echo esc_url(home_url('/', 'relative')); ?>" class="c-lead__cta c-button c-button--primary">
                <?php esc_html_e('Bring me to the frontpage', 'chipmunk'); ?>
            </a>
        </div>
    </div>
</div>

<?php Chipmunk\Helpers::get_template_part('sections/toolbox'); ?>

<?php get_footer(); ?>
