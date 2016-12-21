<?php $resource_website = get_post_meta(get_the_ID(), '_'.ChipmunkMetaBoxes::$field_name.'_resource_website', true); ?>

<div class="section<?php echo (!$wp_query->current_post or $wp_query->current_post % 2 == 0) ? ' section_theme-white section_separated' : ' section_theme-gray'; ?>">
  <div class="container">
    <article class="resource row">
      <div class="resource__content column column_lg-6">
        <ul class="resource__stats stats">
          <?php get_template_part('partials/resource-stats'); ?>
        </ul>

        <div class="resource__info">
          <?php echo ChipmunkHelpers::conditional_markup(is_single(), 'h1', 'h2', 'resource__title heading heading_lg', is_single() ? get_the_title() : '<a href="'.get_the_permalink().'">'.get_the_title().'</a>'); ?>

          <?php $content = get_the_content(); ?>

          <?php if (!empty($content)) : ?>
            <p class="resource__description"><?php echo do_shortcode($content); ?></p>
          <?php endif; ?>
        </div>

        <div class="resource__actions">
          <?php if (!empty($resource_website)) : ?>
            <a href="<?php echo ChipmunkHelpers::external_link($resource_website); ?>" class="button button_secondary" target="_blank"><?php _e('Visit website', 'chipmunk'); ?></a>
          <?php endif; ?>

          <?php get_template_part('partials/share-box'); ?>
        </div>
      </div>

      <aside class="resource__image column column_lg-6">
        <?php if (is_single()) : ?>
          <?php if (!empty($resource_website)) : ?>
            <a href="<?php echo ChipmunkHelpers::external_link($resource_website); ?>" target="_blank"><?php the_post_thumbnail('lg'); ?></a>
          <?php else : ?>
            <?php the_post_thumbnail('xl'); ?>
          <?php endif; ?>
        <?php else : ?>
          <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('xl'); ?></a>
        <?php endif; ?>
      </aside>
    </article>
    <!-- /.resource -->
  </div>
</div>
<!-- /.section -->
