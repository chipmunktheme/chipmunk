<a href="<?php echo esc_url( get_term_link( $collection ) ); ?>" class="tile column column_md-3 column_lg-4">
  <div class="tile__image">
    <?php if ( !ChipmunkCustomizer::theme_option( 'disable_collection_thumbs' ) ) : ?>
      <?php
        $query = new WP_Query( array(
          'posts_per_archive_page' => 3,
          'post_type'       => 'resource',
          'tax_query'       => array(
            array(
              'taxonomy'    => 'resource-collection',
              'field'       => 'term_id',
              'terms'       => $collection->term_id,
            ),
          ),
        ) );

        $query->posts = array_reverse( $query->posts );
      ?>

      <?php if ( $query->have_posts() ) : ?>
        <?php while ( $query->have_posts() ) : $query->the_post(); ?>

          <?php if ( has_post_thumbnail() ) : ?>
            <?php the_post_thumbnail( 'sm' ); ?>
          <?php endif; ?>

        <?php endwhile; wp_reset_postdata(); ?>
      <?php endif; ?>
    <?php endif; ?>
  </div>

  <div class="tile__content <?php echo ( ChipmunkCustomizer::theme_option( 'disable_collection_thumbs' ) ? 'tile__content_primary' : 'tile__content_dimmed' ); ?>">
    <div>
      <?php echo ChipmunkHelpers::conditional_markup( is_front_page(), 'h3', 'h2', 'tile__title', $collection->name ); ?>
      <p class="tile__copy"><?php _e( 'View this collection', CHIPMUNK_THEME_SLUG ); ?>&nbsp;<i class="icon icon_arrow" aria-hidden="true"></i></p>
    </div>

    <ul class="tile__stats stats">
      <?php if ( $term_children = get_term_children( $collection->term_id, 'resource-collection' ) ) : ?>
        <li class="stats__item" title="<?php _e( 'Sub collections', CHIPMUNK_THEME_SLUG ); ?>"><i class="icon icon_collection" aria-hidden="true"></i> <?php echo count( $term_children ); ?></li>
      <?php endif; ?>
			
      <li class="stats__item" title="<?php _e( 'Resources', CHIPMUNK_THEME_SLUG ); ?>"><i class="icon icon_link" aria-hidden="true"></i> <?php echo $collection->count; ?></li>
    </ul>
  </div>
</a>
