<div class="section<?php echo (!$wp_query->current_post or $wp_query->current_post % 2 == 0) ? ' section_theme-white section_separated' : ' section_theme-gray'; ?>">
  <div class="container">
    <article class="resource row">
      <div class="resource__content column column_lg-6">
        <ul class="resource__stats stats">
          <li class="stats__item" title="<?php _e('Collection', 'chipmunk'); ?>"><i class="icon icon_tag"></i> <?php the_terms(get_the_ID(), 'resource-collection'); ?></li>
          <li class="stats__item" title="<?php _e('Published', 'chipmunk'); ?>"><i class="icon icon_clock"></i> <?php the_time('j. F'); ?></li>
          <li class="stats__item" title="<?php _e('Views', 'chipmunk'); ?>"><i class="icon icon_view"></i> 0</li>
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

          <nav class="nav-socials">
            <h4 class="nav-socials__title"><?php _e('Share', 'chipmunk'); ?></h4>
            <ul>
              <li class="nav-socials__item"><a href="#" title="<?php _e('Twitter', 'chipmunk'); ?>"><i class="icon icon_twitter"></i><span class="sr-only"><?php _e('Twitter', 'chipmunk'); ?></span></a></li>
              <li class="nav-socials__item"><a href="#" title="<?php _e('Facebook', 'chipmunk'); ?>"><i class="icon icon_facebook"></i><span class="sr-only"><?php _e('Facebook', 'chipmunk'); ?></span></a></li>
            </ul>
          </nav>
          <!-- /.nav-socials -->
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
