<?php get_header(); ?>
<?php $term = get_queried_object(); ?>

  <div class="section section_theme-gray">
    <div class="container">
      <h3 class="heading heading_md">
        <?php single_term_title(); ?>

        <?php if (is_tax('resource-tag')) : ?>
          <?php _e('Tag', 'chipmunk'); ?>
        <?php endif; ?>

        <?php if (is_tax('resource-collection')) : ?>
          <?php _e('Collection', 'chipmunk'); ?>
        <?php endif; ?>
      </h3>

      <?php if (!empty($term->description)) : ?>
        <div class="row">
          <div class="column column_lg-8">
            <p class="text_content"><?php echo $term->description; ?></p>
          </div>
        </div>
      <?php endif; ?>

      <?php if ($children_collections = get_term_children($term->term_id, 'resource-collection')) : ?>
        <div class="row">
          <?php foreach ($children_collections as $collection) : ?>
            <?php $collection = get_term_by('id', $collection, 'resource-collection'); ?>
            <?php include locate_template('sections/collection-tile.php'); ?>
          <?php endforeach; ?>
        </div>

        <?php if (have_posts()) : ?>
          <div class="separator"></div>
        <?php endif; ?>
      <?php endif; ?>

      <div class="row">
        <?php if (have_posts()) : ?>
          <?php while (have_posts()) : the_post(); ?>

              <?php get_template_part('sections/resource-tile'); ?>

          <?php endwhile; wp_reset_postdata(); ?>
        <?php elseif (empty($children_collections)) : ?>

          <div class="column">
            <?php if (current_user_can('publish_posts')) : ?>
              <p class="text_content text_separated"><?php printf(__('Ready to publish your first resource? <a href="%1$s">Get started here</a>.', 'chipmunk'), esc_url(admin_url('post-new.php?post_type=resource'))); ?></p>
            <?php else : ?>
              <p class="text_content text_separated"><?php _e('Sorry, there are no resources to display yet.', 'chipmunk'); ?></p>
            <?php endif; ?>
          </div>

        <?php endif; ?>
      </div>
    </div>

    <?php if (!is_front_page()) : ?>
      <?php get_template_part('sections/pagination'); ?>
      <?php get_template_part('sections/promo'); ?>
    <?php endif; ?>
  </div>
  <!-- /.section -->

  <?php get_template_part('sections/toolbox'); ?>

<?php get_footer(); ?>
