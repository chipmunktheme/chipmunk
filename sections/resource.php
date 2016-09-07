<div class="section<?php echo (!$wp_query->current_post or $wp_query->current_post % 2 == 0) ? ' section_theme-white section_separated' : ' section_theme-gray'; ?>">
  <div class="container">
    <article class="resource row">
      <div class="resource__content column column_lg-6">
        <ul class="resource__stats stats">
          <li class="stats__item" title="<?php _e('Collection', 'chipmunk'); ?>"><i class="icon icon_tag"></i> <?php the_terms(get_the_ID(), 'resource-collection'); ?></li>
          <li class="stats__item" title="<?php _e('Published', 'chipmunk'); ?>"><i class="icon icon_clock"></i> <?php the_time('j. F'); ?></li>

          <?php if (!Chipmunk::theme_option('disable_views')) : ?>
            <li class="stats__item" title="<?php _e('Views', 'chipmunk'); ?>"><i class="icon icon_view"></i> 0</li>
          <?php endif; ?>
        </ul>

        <div class="resource__info">
          <h2 class="resource__title headline headline_xl">
            <?php if (is_single()) : ?>
              <?php the_title(); ?>
            <?php else : ?>
              <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            <?php endif; ?>
          </h2>
          <p class="resource__description"><?php echo get_the_content(); ?></p>
        </div>

        <div class="resource__actions">
          <a href="#" class="button button_secondary" target="_blank"><?php _e('Visit website', 'chipmunk'); ?></a>

          <?php get_template_part('partials/share-box'); ?>
        </div>
      </div>

      <aside class="resource__image column column_lg-6">
        <a href="#" target="_blank">
          <?php the_post_thumbnail('lg'); ?>
        </a>
      </aside>
    </article>
    <!-- /.resource -->
  </div>
</div>
<!-- /.section -->
