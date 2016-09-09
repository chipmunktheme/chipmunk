<div class="section section_theme-gray">
  <div class="container">
    <h3 class="heading heading_md">
      <?php if (is_single()) : ?>
        <?php _e('Related', 'chipmunk'); ?>
      <?php else : ?>
        <?php _e('Resources', 'chipmunk'); ?>
      <?php endif; ?>
    </h3>

    <?php $resources = ChipmunkHelpers::get_latest_resources(ChipmunkHelpers::theme_option('posts_per_page')); ?>

    <?php if ($resources->have_posts()) : ?>
      <div class="row">
        <?php while ($resources->have_posts()) : $resources->the_post(); ?>

          <?php get_template_part('sections/resource-tile'); ?>

        <?php endwhile; ?>
      </div>
    <?php else : ?>
      <?php if (current_user_can('publish_posts')) : ?>
        <p class="text-empty"><?php printf(__('Ready to publish your first resource? <a href="%1$s">Get started here</a>.', 'chipmunk'), esc_url(admin_url('post-new.php?post_type=resource'))); ?></p>
      <?php else : ?>
        <p class="text-empty"><?php _e('Sorry, there are no resources to display yet.', 'chipmunk'); ?></p>
      <?php endif; ?>
    <?php endif; ?>
  </div>

  <?php get_template_part('sections/pagination'); ?>

  <?php if (!is_home()) : ?>
    <?php get_template_part('sections/promo'); ?>
  <?php endif; ?>
</div>
<!-- /.section -->
