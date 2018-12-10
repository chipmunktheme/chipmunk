<?php
/**
 * Chipmunk: Search
 *
 * @package WordPress
 * @subpackage Chipmunk
 */

// If the search query is shorter than 3 letters redirect to homepage
if ( strlen( get_search_query() ) < 3 or chipmunk_theme_option( 'disable_search' ) ) {
    wp_redirect( home_url( '/', 'relative' ) ); exit;
}

get_header(); ?>

    <div class="section<?php echo ( have_posts() ? ' section_compact-bottom' : '' ); ?>">
        <div class="container">
            <div class="row">
                <div class="column column--md-3 column--lg-8">
                    <h1 class="heading heading_md">
                        <small><?php esc_html_e( 'Search results for:', 'chipmunk' ); ?></small>
                        <?php echo get_search_query(); ?>
                    </h1>
                </div>

                <div class="column column--md-3 column--lg-4">
                    <div class="search-bar__inner">
                        <form action="<?php echo esc_url( home_url( '/', 'relative' ) ); ?>" method="get" class="search-bar__form" role="search" novalidate autocomplete="off">
                            <input type="search" name="s" placeholder="<?php esc_attr_e( 'Search query...', 'chipmunk' ); ?>" value="<?php echo get_search_query(); ?>" required minlength="3">
                            <button type="submit" class="search-bar__icon">
                                <?php chipmunk_get_template( 'partials/icon', array( 'icon' => 'search' ) ); ?>
                            </button>
                        </form>
                    </div>
                    <!-- /.search-bar__inner -->
                </div>
            </div>

            <?php if ( ! have_posts() ) : ?>
                <p class="text_content text_separated">
                    <?php esc_html_e( 'Sorry, your search did not match any resources.', 'chipmunk' ); ?>
                </p>
            <?php endif; ?>
        </div>
    </div>
    <!-- /.section -->

    <?php if ( have_posts() ) : ?>
        <div data-action-element="load_posts">
            <?php while ( have_posts() ) : the_post(); ?>

                <?php get_template_part( 'templates/sections/resource' ); ?>

            <?php endwhile; ?>
        </div>
    <?php endif; ?>

    <?php if ( $wp_query->max_num_pages > 1 ) : ?>
        <div class="section">
            <?php get_template_part( 'templates/sections/pagination' ); ?>
        </div>
        <!-- /.section -->
    <?php endif; ?>

<?php get_footer(); ?>
