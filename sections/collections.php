<div class="section section_theme-gray">
  <div class="container">
    <h3 class="headline headline_md"><?php _e('Collections', 'chipmunk'); ?></h3>

    <div class="row">
      {% set collections = ['Design', 'Development', 'Technology', 'Products', 'Apps', 'Podcasts', 'Startups', 'Business', 'Marketing', 'Writings', 'Newsletters', 'Typography', 'Bots', 'Themes', 'Photography'] %}

      {% for collection in collections %}
        <a href="#" class="tile column column_md-3 column_lg-4">
          <div class="tile__image">
            <img src="images/pic-resource-0{{ random(2) + 1 }}.png" alt="" />
            <img src="images/pic-resource-0{{ random(2) + 1 }}.png" alt="" />
            <img src="images/pic-resource-0{{ random(2) + 1 }}.png" alt="" />
          </div>

          <div class="tile__content">
            <div>
              <h3 class="tile__title">{{ collection }}</h3>
              <p class="tile__copy">View this collection&nbsp;<i class="icon icon_arrow"></i></p>
            </div>

            <ul class="stats">
              <li class="stats__item" title="Resources"><i class="icon icon_link"></i> {{ random(200) }}</li>
            </ul>
          </div>
        </a>
      {% endfor %}
    </div>
  </div>

  <?php if (is_home()) : ?>
    <?php get_template_part('sections/promo'); ?>
  <?php endif; ?>
</div>
<!-- /.section -->
