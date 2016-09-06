<div class="section{{ (loop is empty) or (loop.index0 % 2 == 0) ? ' section_theme-white section_separated' : ' section_theme-gray' }}">
  <div class="container">
    <article class="resource row">
      <div class="resource__content column column_lg-6">
        <ul class="resource__stats stats">
          <li class="stats__item" title="<?php _e('Category', 'chipmunk'); ?>"><i class="icon icon_tag"></i> Marketing</li>
          <li class="stats__item" title="<?php _e('Published', 'chipmunk'); ?>"><i class="icon icon_clock"></i> {{ random(30) + 1 }}. August</li>
          <li class="stats__item" title="<?php _e('Views', 'chipmunk'); ?>"><i class="icon icon_view"></i> {{ random(2000) }}</li>
        </ul>

        <div class="resource__info">
          <h2 class="resource__title headline headline_xl">
            {% if not loop is empty %}
              <a href="#">
            {% endif %}

            Startup Stash

            {% if not loop is empty %}
              </a>
            {% endif %}
          </h2>
          <p class="resource__description">A curated directory of resources & tools to help you build your Startup</p>
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
        <a href="#" target="_blank"><img src="images/pic-resource-large-01.png" alt="" /></a>
      </aside>
    </article>
    <!-- /.resource -->
  </div>
</div>
<!-- /.section -->
