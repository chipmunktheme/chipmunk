<div class="section section_theme-gray">
  <div class="container" data-tabs role="tablist">
    <h3 class="headline headline_md">
      <?php if (!Chipmunk::theme_option('disable_featured')) : ?>
        <span class="headline__link active" data-tabs-toggle href="#featured" role="tab"><?php _e('Featured', 'chipmunk'); ?></span>
      <?php endif; ?>

      <span class="headline__link<?php echo Chipmunk::theme_option('disable_featured') ? ' active' : ''; ?>" data-tabs-toggle href="#latest" role="tab"><?php _e('Latest', 'chipmunk'); ?></span>

      <?php if (!Chipmunk::theme_option('disable_views')) : ?>
        <span class="headline__link<?php echo Chipmunk::theme_option('disable_featured') ? '' : ' visible-sm-inline-block'; ?>" data-tabs-toggle href="#popular" role="tab"><?php _e('Popular', 'chipmunk'); ?></span>
      <?php endif; ?>
    </h3>


    <div class="tab-content">
      <?php if (!Chipmunk::theme_option('disable_featured')) : ?>
        <div class="tile__list tabs__item active" id="featured" data-tabs-panel data-resource-slider role="tabpanel">
          <?php $latest_query = new WP_Query(array(
            'numberposts'   => 9,
            'post_type'     => 'resource',
          )); ?>

          <?php if ($latest_query->have_posts()) : ?>
            <?php while ($latest_query->have_posts()) : $latest_query->the_post(); ?>

              <div class="tile__wrapper">
                <?php get_template_part('sections/resource-tile'); ?>
              </div>

            <?php endwhile; wp_reset_postdata(); ?>
          <?php else : ?>

            <?php if (current_user_can('publish_posts')) : ?>
              <p class="text-empty"><?php printf(__('Ready to publish your first resource? <a href="%1$s">Get started here</a>.', 'chipmunk'), esc_url(admin_url('post-new.php?post_type=resource'))); ?></p>
            <?php else : ?>
              <p class="text-empty"><?php _e('Sorry, there are no resources to display yet.', 'chipmunk'); ?></p>
            <?php endif; ?>

          <?php endif; ?>
        </div>
      <?php endif; ?>

      <div class="tile__list tabs__item" id="latest" data-tabs-panel data-resource-slider role="tabpanel">
        <div class="tile__wrapper">
          Latest
        </div>
      </div>

      <?php if (!Chipmunk::theme_option('disable_views')) : ?>
        <div class="tile__list tabs__item" id="popular" data-tabs-panel data-resource-slider role="tabpanel">
          <div class="tile__wrapper">
            Popular
          </div>
        </div>
      <?php endif; ?>
    </div>
    <!-- /.tab-content -->
  </div>

  <?php if (!is_home()) : ?>
    <?php get_template_part('sections/promo'); ?>
  <?php endif; ?>
</div>
<!-- /.section -->
