<a href="<?php the_permalink(); ?>" class="tile<?php echo (is_home() ? '' : ' column column_md-3 column_lg-4'); ?>">
  <div class="tile__image">
    <?php if (has_post_thumbnail()) : ?>
      <?php the_post_thumbnail('sm'); ?>
    <?php endif; ?>
  </div>

  <div class="tile__content">
    <div>
      <h3 class="tile__title"><?php the_title(); ?></h3>
      <p class="tile__copy"><?php echo get_the_content(); ?>&nbsp;<i class="icon icon_arrow"></i></p>
    </div>

    <ul class="stats">
      <li class="stats__item" title="<?php _e('Published', 'chipmunk'); ?>"><i class="icon icon_clock"></i> <?php the_time('j. F'); ?></li>

      <?php if (!Chipmunk::theme_option('disable_views')) : ?>
        <li class="stats__item" title="<?php _e('Views', 'chipmunk'); ?>"><i class="icon icon_view"></i> 0</li>
      <?php endif; ?>
    </ul>
  </div>
</a>
