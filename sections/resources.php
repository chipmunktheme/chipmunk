<div class="section section_theme-gray">
  <div class="container">
    <h3 class="heading heading_md">
      <?php if (is_single()) : ?>
        <?php _e('Related', 'chipmunk'); ?>
      <?php endif; ?>
    </h3>

    {% for i in 1..rows | default(1) %}
      <div class="row">
        {% set resources = ['Startup Stash', 'Color Hunt', 'Canopy'] %}

        {% for resource in resources %}
          {% include 'resource-item.twig' with { column: true } %}
        {% endfor %}
      </div>
    {% endfor %}
  </div>

  <?php if (!is_home()) : ?>
    <?php get_template_part('sections/promo'); ?>
  <?php endif; ?>
</div>
<!-- /.section -->
