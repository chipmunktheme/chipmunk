<div class="section section_theme-gray">
  <div class="container">
    <h3 class="heading heading_md"><?php _e('Collections', 'chipmunk'); ?></h3>

    <div class="row">
      <?php
        $collections = get_terms('resource-collection', array(
          'orderby'     => 'name',
          'hide_empty'  => 0,
          'parent'      => 0,
        ));
      ?>

      <?php if (!empty($collections)) : ?>
        <?php foreach ($collections as $collection) : ?>

          <?php include locate_template('sections/collection-tile.php'); ?>
          
        <?php endforeach; ?>
      <?php else : ?>
        <div class="column">
          <?php if (current_user_can('publish_posts')) : ?>
            <p class="text-empty"><?php printf(__('Ready to publish your first collection? <a href="%1$s">Get started here</a>.', 'chipmunk'), esc_url(admin_url('edit-tags.php?taxonomy=resource-collection&post_type=resource'))); ?></p>
          <?php else : ?>
            <p class="text-empty"><?php _e('Sorry, there are no collections to display yet.', 'chipmunk'); ?></p>
          <?php endif; ?>
        </div>
      <?php endif; ?>
    </div>
  </div>

  <?php get_template_part('sections/promo'); ?>
</div>
<!-- /.section -->
