<?php
/**
 * Chipmunk: Search
 *
 * @package WordPress
 * @subpackage Chipmunk
 */

// If the search query is shorter than 3 letters redirect to homepage
if (strlen(get_search_query()) < 3 or ChipmunkCustomizer::theme_option('disable_search'))
{
  wp_redirect(home_url()); exit;
}

get_header(); ?>

  <div class="section section_compact-bottom section_theme-gray">
    <div class="container">
      <h1 class="section__title heading heading_md"><small><?php _e('Search results for:', CHIPMUNK_THEME_SLUG); ?></small> <?php echo get_search_query(); ?></h1>

    	<?php if (!have_posts()) : ?>
        <p class="text_content text_separated"><?php _e('Sorry, your search did not match any resources.', CHIPMUNK_THEME_SLUG); ?></p>
      <?php endif; ?>
    </div>
  </div>
  <!-- /.section -->

	<?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>

      <?php get_template_part('sections/resource'); ?>

    <?php endwhile; ?>
  <?php endif; ?>

  <div class="section section_theme-gray">
    <?php get_template_part('sections/pagination'); ?>
  	<?php get_template_part('sections/promo'); ?>
  </div>
  <!-- /.section -->

	<?php get_template_part('sections/toolbox'); ?>

<?php get_footer(); ?>
