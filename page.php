<?php get_header(); ?>

  <div class="section section_theme-gray">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
      <div class="container">
        <div class="row">
          <div class="column column_lg-8 column_lg-offset-2">
            <h1 class="entry__title heading heading_md"><?php the_title(); ?></h1>

            <div class="entry">
              <?php the_content(); ?>
            </div>
            <!-- /.entry -->
          </div>
        </div>
      </div>
    <?php endwhile; endif; ?>

    <?php get_template_part('sections/promo'); ?>
  </div>
  <!-- /.section -->

  <?php get_template_part('sections/toolbox'); ?>

<?php get_footer(); ?>
