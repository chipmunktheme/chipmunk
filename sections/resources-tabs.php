<?php
  $resources_count =  ChipmunkCustomizer::theme_option('resources_count', 9);
  $resources = array(
    'latest'    => ChipmunkHelpers::get_resources($resources_count),
    'featured'  => !ChipmunkCustomizer::theme_option('disable_featured') ? ChipmunkHelpers::get_featured_resources($resources_count) : new WP_Query,
    'popular'   => !ChipmunkCustomizer::theme_option('disable_views') ? ChipmunkHelpers::get_popular_resources($resources_count) : new WP_Query,
  );
?>

<?php if ($resources['latest']->have_posts()) : ?>
  <div class="section section_theme-gray">
    <div class="container" data-tabs role="tablist">
      <h3 class="heading heading_md">
        <?php if ($resources['featured']->have_posts()) : ?>
          <span class="heading__link active" data-tabs-toggle role="tab"><?php _e('Featured', 'chipmunk'); ?></span>
        <?php endif; ?>

        <?php if ($resources['latest']->have_posts()) : ?>
          <span class="heading__link<?php echo !$resources['featured']->have_posts() ? ' active' : ''; ?>" data-tabs-toggle role="tab"><?php _e('Latest', 'chipmunk'); ?></span>
        <?php endif; ?>

        <?php if ($resources['popular']->have_posts()) : ?>
          <span class="heading__link<?php echo !$resources['featured']->have_posts() ? '' : ' visible-sm-inline-block'; ?>" data-tabs-toggle role="tab"><?php _e('Popular', 'chipmunk'); ?></span>
        <?php endif; ?>
      </h3>


      <div class="tab-content">
        <?php if ($resources['featured']->have_posts()) : ?>
          <div class="tile__list tabs__item active" data-tabs-panel data-resource-slider role="tabpanel">
            <?php while ($resources['featured']->have_posts()) : $resources['featured']->the_post(); ?>

              <div class="tile__slider">
                <?php get_template_part('sections/resource-tile'); ?>
              </div>

            <?php endwhile; wp_reset_postdata(); ?>
          </div>
        <?php endif; ?>

        <?php if ($resources['latest']->have_posts()) : ?>
          <div class="tile__list tabs__item<?php echo !$resources['featured']->have_posts() ? ' active' : ''; ?>" data-tabs-panel data-resource-slider role="tabpanel">
            <?php while ($resources['latest']->have_posts()) : $resources['latest']->the_post(); ?>

              <div class="tile__slider">
                <?php get_template_part('sections/resource-tile'); ?>
              </div>

            <?php endwhile; wp_reset_postdata(); ?>
          </div>
        <?php endif; ?>

        <?php if ($resources['popular']->have_posts()) : ?>
          <div class="tile__list tabs__item" data-tabs-panel data-resource-slider role="tabpanel">
            <?php while ($resources['popular']->have_posts()) : $resources['popular']->the_post(); ?>

              <div class="tile__slider">
                <?php get_template_part('sections/resource-tile'); ?>
              </div>

            <?php endwhile; wp_reset_postdata(); ?>
          </div>
        <?php endif; ?>
      </div>
      <!-- /.tab-content -->
    </div>
  </div>
  <!-- /.section -->
<?php endif ; ?>
