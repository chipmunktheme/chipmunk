<div class="section section_theme-gray">
  <div class="container">
    <h3 class="headline headline_md"><?php _e('Collections', 'chipmunk'); ?></h3>

    <div class="row">
      <?php
        $collections = get_terms('resource-collection', array(
          'orderby'    => 'name',
          'hide_empty' => 0,
        ));
      ?>

      <?php if (!empty($collections)) : ?>
        <?php foreach ($collections as $collection) : ?>
          <a href="<?php echo esc_url(get_term_link($collection)); ?>" class="tile column column_md-3 column_lg-4">
            <div class="tile__image">
              <?php if (!Chipmunk::theme_option('disable_collection_thumbs')) : ?>
                <?php
                  $collection_resources = get_posts(array(
                    'numberposts'   => 3,
                    'post_type'     => 'resource',
                    'tax_query'     => array(
                      array(
                        'taxonomy'  => 'resource-collection',
                        'field'     => 'term_id',
                        'terms'     => $collection->term_id,
                      )
                    )
                  ));
                ?>

                <?php if (!empty($collection_resources)) : ?>
                  <?php foreach($collection_resources as $resource) : ?>
                    <?php if (has_post_thumbnail($resource)) : ?>
                      <?php echo get_the_post_thumbnail($resource, 'sm'); ?>
                    <?php endif; ?>
                  <?php endforeach; ?>
                <?php endif; ?>
              <?php endif; ?>
            </div>

            <div class="tile__content<?php echo !Chipmunk::theme_option('disable_collection_thumbs') ? ' tile__content_dimmed' : ''; ?>">
              <div>
                <h3 class="tile__title"><?php echo $collection->name; ?></h3>
                <p class="tile__copy"><?php _e('View this collection', 'chipmunk'); ?>&nbsp;<i class="icon icon_arrow" aria-hidden="true"></i></p>
              </div>

              <ul class="stats">
                <li class="stats__item" title="<?php _e('Resources', 'chipmunk'); ?>"><i class="icon icon_link" aria-hidden="true"></i> <?php echo $collection->count; ?></li>
              </ul>
            </div>
          </a>
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

  <?php if (is_home()) : ?>
    <?php get_template_part('sections/promo'); ?>
  <?php endif; ?>
</div>
<!-- /.section -->
