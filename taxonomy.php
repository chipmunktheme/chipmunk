<?php get_header(); ?>

  <div class="section section_theme-gray">
    <div class="container">
      <h3 class="heading heading_md"><?php single_term_title(); ?> <?php _e('Collection', 'chipmunk'); ?></h3>

      <div class="row">
        <?php if (have_posts()) : ?>
          <?php while (have_posts()) : the_post(); ?>

              <?php get_template_part('sections/resource-tile'); ?>

          <?php endwhile; wp_reset_postdata(); ?>
        <?php else : ?>

          <div class="column">
            <?php if (current_user_can('publish_posts')) : ?>
              <p class="text-empty"><?php printf(__('Ready to publish your first resource? <a href="%1$s">Get started here</a>.', 'chipmunk'), esc_url(admin_url('post-new.php?post_type=resource'))); ?></p>
            <?php else : ?>
              <p class="text-empty"><?php _e('Sorry, there are no resources to display yet.', 'chipmunk'); ?></p>
            <?php endif; ?>
          </div>

        <?php endif; ?>
      </div>
    </div>

    <?php if (!is_home()) : ?>
      <?php get_template_part('sections/pagination'); ?>
      <?php get_template_part('sections/promo'); ?>
    <?php endif; ?>
  </div>
  <!-- /.section -->

  <?php get_template_part('sections/toolbox'); ?>

<?php get_footer(); ?>
