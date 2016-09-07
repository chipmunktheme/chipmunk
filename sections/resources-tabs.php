<div class="section section_theme-gray">
  <div class="container">
    <h3 class="headline headline_md">
      <ul class="headline__tabs" role="tablist">
        <?php if (!Chipmunk::theme_option('disable_featured')) : ?>
          <a class="headline__link active" data-tab-toggle href="#featured" role="tab"><?php _e('Featured', 'chipmunk'); ?></a>
        <?php endif; ?>

        <a class="headline__link<?php echo Chipmunk::theme_option('disable_featured') ? ' active' : ''; ?>" data-tab-toggle href="#latest" role="tab"><?php _e('Latest', 'chipmunk'); ?></a>

        <?php if (!Chipmunk::theme_option('disable_views')) : ?>
          <a class="headline__link<?php echo Chipmunk::theme_option('disable_featured') ? '' : ' visible-sm-block'; ?>" data-tab-toggle href="#popular" role="tab"><?php _e('Popular', 'chipmunk'); ?></a>
        <?php endif; ?>
      </ul>
    </h3>


    <div class="tab-content">
      <div class="tile__list tab-pane fade in active" id="featured" role="tabpanel" data-resource-slider>
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

      <div class="tile__list tab-pane fade in" id="latest" role="tabpanel" data-resource-slider>
      </div>

      <?php if (!Chipmunk::theme_option('disable_views')) : ?>
        <div class="tile__list tab-pane fade in" id="popular" role="tabpanel" data-resource-slider>
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
