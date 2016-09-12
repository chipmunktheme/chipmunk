<?php $resource_website = get_post_meta(get_the_ID(), '_'.ChipmunkMetaBoxes::$field_name.'_resource_website', true); ?>

<div class="section<?php echo (!$wp_query->current_post or $wp_query->current_post % 2 == 0) ? ' section_theme-white section_separated' : ' section_theme-gray'; ?>">
  <div class="container">
    <article class="resource row">
      <div class="resource__content column column_lg-6">
        <ul class="resource__stats stats">
          <li class="stats__item" title="<?php _e('Collection', 'chipmunk'); ?>"><i class="icon icon_tag"></i> <?php the_terms(get_the_ID(), 'resource-collection'); ?></li>
          <li class="stats__item" title="<?php _e('Published', 'chipmunk'); ?>"><i class="icon icon_clock"></i> <?php the_time('j. F'); ?></li>

          <?php if (!ChipmunkHelpers::theme_option('disable_views')) : ?>
            <li class="stats__item" title="<?php _e('Views', 'chipmunk'); ?>"><i class="icon icon_view"></i> <?php echo ChipmunkViewCounter::get_post_views(get_the_ID()); ?></li>
          <?php endif; ?>
        </ul>

        <div class="resource__info">
          <h2 class="resource__title heading heading_xl">
            <?php if (is_single()) : ?>
              <?php the_title(); ?>
            <?php else : ?>
              <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            <?php endif; ?>
          </h2>
          <p class="resource__description"><?php echo get_the_content(); ?></p>
        </div>

        <div class="resource__actions">
          <?php if (!empty($resource_website)) : ?>
            <a href="<?php echo $resource_website; ?>?ref=<?php echo sanitize_title(get_bloginfo('name')); ?>" class="button button_secondary" target="_blank"><?php _e('Visit website', 'chipmunk'); ?></a>
          <?php endif; ?>

          <?php get_template_part('partials/share-box'); ?>
        </div>
      </div>

      <aside class="resource__image column column_lg-6">
        <?php if (is_single()) : ?>
          <?php if (!empty($resource_website)) : ?>
            <a href="<?php echo $resource_website; ?>?ref=<?php echo sanitize_title(get_bloginfo('name')); ?>" target="_blank"><?php the_post_thumbnail('lg'); ?></a>
          <?php else : ?>
            <?php the_post_thumbnail('lg'); ?>
          <?php endif; ?>
        <?php else : ?>
          <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('lg'); ?></a>
        <?php endif; ?>
      </aside>
    </article>
    <!-- /.resource -->
  </div>
</div>
<!-- /.section -->
