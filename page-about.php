<?php /* Template Name: About */ ?>

<?php get_header(); ?>

  <div class="section section_theme-gray">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
      <div class="container">
        <h3 class="entry__title heading heading_md"><?php the_title(); ?></h3>
        <?php the_content(); ?>
      </div>
    <?php endwhile; endif; ?>

    <?php get_template_part('sections/promo'); ?>
  </div>
  <!-- /.section -->

  <?php get_template_part('sections/toolbox'); ?>

<?php get_footer(); ?>
