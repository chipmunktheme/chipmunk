<?php

/**
 * Chipmunk: Search
 *
 * @package WordPress
 * @subpackage Chipmunk
 */

// If the search query is shorter than 3 letters redirect to homepage
if (strlen(get_search_query()) < 3 || Chipmunk\Helpers::get_theme_option('disable_search')) {
    wp_redirect(home_url('/', 'relative'));
    exit;
}

get_header(); ?>

<div class="l-section<?php echo (have_posts() ? ' l-section--compact-bottom' : ''); ?>">
    <div class="l-container">
        <div class="l-header">
            <h1 class="c-heading c-heading--h4">
                <small><?php esc_html_e('Search results for:', 'chipmunk'); ?></small>
                <?php echo get_search_query(); ?>
            </h1>

            <?php Chipmunk\Helpers::get_template_part('partials/search-form', ['narrow' => true]); ?>

            <?php if (!have_posts()) : ?>
                <p class="l-header__copy">
                    <?php esc_html_e('Sorry, your search did not match any resources.', 'chipmunk'); ?>
                </p>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php if (have_posts()) : ?>
    <div data-action-element="load_posts">
        <?php while (have_posts()) : the_post(); ?>

            <?php Chipmunk\Helpers::get_template_part(['sections/entry', 'resource']); ?>

        <?php endwhile; ?>
    </div>
<?php endif; ?>

<?php if ($wp_query->max_num_pages > 1) : ?>
    <div class="l-section">
        <div class="l-container">
            <?php Chipmunk\Helpers::get_template_part('sections/pagination'); ?>
        </div>
    </div>
<?php endif; ?>

<?php get_footer(); ?>
