<?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; ?>

<?php if (is_single()) : ?>
  <?php $custom_query = ChipmunkHelpers::get_related_resources(get_the_ID()); ?>
<?php else : ?>
  <?php $custom_query = ChipmunkHelpers::get_resources(ChipmunkCustomizer::theme_option('posts_per_page'), $paged); ?>
<?php endif; ?>

<div class="section section_theme-gray">
  <div class="container">
    <?php if (is_single()) : ?>
      <h3 class="section__title heading heading_md"><?php _e('Related', 'chipmunk'); ?></h3>
    <?php else : ?>
      <?php if (!ChipmunkCustomizer::theme_option('disable_sorting') and $custom_query->have_posts()) : ?>
        <div class="row row_center">
          <div class="column column_md-3 column_lg-6">
            <h3 class="section__title heading heading_md"><?php _e('Resources', 'chipmunk'); ?></h3>
          </div>

          <?php get_template_part('partials/sort-resources'); ?>
        </div>
      <?php else : ?>
        <h3 class="section__title heading heading_md"><?php _e('Resources', 'chipmunk'); ?></h3>
      <?php endif; ?>
    <?php endif; ?>

    <?php if ($custom_query->have_posts()) : ?>
      <div class="row">
        <?php while ($custom_query->have_posts()) : $custom_query->the_post(); ?>

          <?php get_template_part('sections/resource-tile'); ?>

        <?php endwhile; ?>
      </div>
    <?php else : ?>
      <?php if (current_user_can('publish_posts')) : ?>
        <p class="text_content text_separated"><?php printf(__('Ready to publish your first resource? <a href="%1$s">Get started here</a>.', 'chipmunk'), esc_url(admin_url('post-new.php?post_type=resource'))); ?></p>
      <?php else : ?>
        <p class="text_content text_separated"><?php _e('Sorry, there are no resources to display yet.', 'chipmunk'); ?></p>
      <?php endif; ?>
    <?php endif; ?>
  </div>

  <?php include locate_template('sections/pagination.php'); ?>

  <?php if (!is_front_page()) : ?>
    <?php get_template_part('sections/promo'); ?>
  <?php endif; ?>
</div>
<!-- /.section -->
