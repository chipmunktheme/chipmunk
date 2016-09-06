<?php get_header(); ?>

  <div class="section section_compact-bottom section_theme-gray">
    <div class="container">
      <h3 class="headline headline_md"><small><?php _e('Search results for:', 'chipmunk'); ?></small> <?php echo get_search_query(); ?></h3>
    </div>
  </div>
  <!-- /.section -->

  <!-- {% for i in 1..3 %}
    {% include 'sections/resource.twig' %}
  {% endfor %} -->

  <div class="section section_theme-gray">
  	<?php get_template_part('sections/promo'); ?>
  </div>
  <!-- /.section -->

	<?php get_template_part('sections/toolbox'); ?>

<?php get_footer(); ?>
