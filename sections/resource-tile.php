<a href="<?php the_permalink(); ?>" class="tile<?php echo (is_home() ? '' : ' column column_md-3 column_lg-4'); ?>">
  <div class="tile__image">
    <?php if (has_post_thumbnail()) : ?>
      <?php the_post_thumbnail('sm'); ?>
    <?php endif; ?>
  </div>

  <div class="tile__content tile__content_dimmed">
    <div>
      <h3 class="tile__title"><?php the_title(); ?></h3>

      <?php if (!ChipmunkCustomizer::theme_option('disable_resource_desc')) : ?>
        <p class="tile__copy"><?php echo ChipmunkHelpers::truncate_string(get_the_content(), 60); ?>&nbsp;<i class="icon icon_arrow"></i></p>
      <?php endif; ?>
    </div>

    <ul class="stats">
      <li class="stats__item" title="<?php _e('Published', 'chipmunk'); ?>"><i class="icon icon_clock"></i> <?php echo date_i18n('j. F'); ?></li>

      <?php if (!ChipmunkCustomizer::theme_option('disable_views')) : ?>
        <li class="stats__item" title="<?php _e('Views', 'chipmunk'); ?>"><i class="icon icon_view"></i> <?php echo ChipmunkViewCounter::get_post_views(get_the_ID()); ?></li>
      <?php endif; ?>
    </ul>
  </div>
</a>
