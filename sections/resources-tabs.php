<div class="section section_theme-gray">
  <div class="container">
    <h3 class="headline headline_md">
      <ul class="headline__tabs" role="tablist">
        <a class="headline__link active" data-tab-toggle href="#featured" role="tab"><?php _e('Featured', 'chipmunk'); ?></a>
        <a class="headline__link" data-tab-toggle href="#latest" role="tab"><?php _e('Latest', 'chipmunk'); ?></a>
        <a class="headline__link visible-sm-block" data-tab-toggle href="#popular" role="tab"><?php _e('Popular', 'chipmunk'); ?></a>
      </ul>
    </h3>


    <div class="tab-content">
      <div class="tile__list tab-pane fade in active" id="featured" role="tabpanel" data-resource-slider>
        {% for i in 1..rows | default(1) %}
          {% set resources = ['Startup Stash', 'Color Hunt', 'Canopy'] %}

          {% for resource in resources %}
            <div class="tile__wrapper">
              {% include 'resource-item.twig' %}
            </div>
          {% endfor %}
        {% endfor %}
      </div>

      <div class="tile__list tab-pane fade in" id="latest" role="tabpanel" data-resource-slider>
        {% for i in 1..rows | default(1) %}
          {% set resources = ['Startup Stash', 'Color Hunt', 'Canopy'] %}

          {% for resource in resources %}
            <div class="tile__wrapper">
              {% include 'resource-item.twig' %}
            </div>
          {% endfor %}
        {% endfor %}
      </div>

      <div class="tile__list tab-pane fade in" id="popular" role="tabpanel" data-resource-slider>
        {% for i in 1..rows | default(1) %}
          {% set resources = ['Startup Stash', 'Color Hunt', 'Canopy'] %}

          {% for resource in resources %}
            <div class="tile__wrapper">
              {% include 'resource-item.twig' %}
            </div>
          {% endfor %}
        {% endfor %}
      </div>
    </div>
    <!-- /.tab-content -->
  </div>

  <?php if (!is_home()) : ?>
    <?php get_template_part('sections/promo'); ?>
  <?php endif; ?>
</div>
<!-- /.section -->
