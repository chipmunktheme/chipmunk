<a href="<?php the_permalink(); ?>" class="tile<?php echo (ChipmunkCustomizer::theme_option('display_resource_cards') ? ' tile_card' : ''); ?><?php echo ((is_front_page() and !ChipmunkCustomizer::theme_option('disable_homepage_listings_sliders')) ? '' : ' column column_md-3 column_lg-4'); ?>">
  <div class="tile__image">
    <?php if (has_post_thumbnail()) : ?>
      <?php the_post_thumbnail('sm'); ?>
    <?php endif; ?>
  </div>

  <div class="tile__content<?php echo (!ChipmunkCustomizer::theme_option('display_resource_cards') ? ' tile__content_dimmed' : ''); ?>">
    <div class="tile__info">
      <h3 class="tile__title"><?php the_title(); ?></h3>

      <?php $content = get_the_content(); ?>

      <?php if (!ChipmunkCustomizer::theme_option('disable_resource_desc') and !empty($content)) : ?>
        <p class="tile__copy"><?php echo ChipmunkHelpers::truncate_string($content, (ChipmunkCustomizer::theme_option('display_resource_cards') ? 80 : 60)); ?>&nbsp;<i class="icon icon_arrow"></i></p>
      <?php endif; ?>
    </div>

    <?php if (!ChipmunkCustomizer::theme_option('disable_resource_date') or !ChipmunkCustomizer::theme_option('disable_views')) : ?>
      <ul class="tile__stats stats">
        <?php if (!ChipmunkCustomizer::theme_option('disable_resource_date')) : ?>
          <li class="stats__item" title="<?php _e('Published', 'chipmunk'); ?>"><i class="icon icon_clock"></i> <?php echo get_post_time('j. F', true, get_the_ID(), true); ?></li>
        <?php endif; ?>

        <?php if (!ChipmunkCustomizer::theme_option('disable_views')) : ?>
          <li class="stats__item" title="<?php _e('Views', 'chipmunk'); ?>"><i class="icon icon_view"></i> <?php echo ChipmunkViewCounter::get_post_views(get_the_ID()); ?></li>
        <?php endif; ?>
      </ul>
    <?php endif; ?>
  </div>
</a>
