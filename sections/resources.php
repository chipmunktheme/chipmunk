<div class="section section_theme-gray">
  <div class="container">
    <h3 class="headline headline_md">{{ title }}</h3>

    {% for i in 1..rows | default(1) %}
      <div class="row">
        {% set resources = ['Startup Stash', 'Color Hunt', 'Canopy'] %}

        {% for resource in resources %}
          {% include 'resource-item.twig' with { column: true } %}
        {% endfor %}
      </div>
    {% endfor %}
  </div>

  <?php get_template_part('sections/promo'); ?>
</div>
<!-- /.section -->
