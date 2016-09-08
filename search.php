<?php
// If the search query is shorter than 3 letters redirect to homepage
if (strlen(get_search_query()) < 3 or Chipmunk::theme_option('disable_search')) :
  wp_redirect(home_url()); exit;
endif;
?>

<?php get_header(); ?>

  <div class="section section_compact-bottom section_theme-gray">
    <div class="container">
      <h3 class="heading heading_md"><small><?php _e('Search results for:', 'chipmunk'); ?></small> <?php echo get_search_query(); ?></h3>
    </div>
  </div>
  <!-- /.section -->

	<?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>

      <?php get_template_part('sections/resource'); ?>

    <?php endwhile; ?>
  <?php endif; ?>

  <div class="section section_theme-gray">
  	<?php get_template_part('sections/promo'); ?>
  </div>
  <!-- /.section -->

	<?php get_template_part('sections/toolbox'); ?>

<?php get_footer(); ?>
