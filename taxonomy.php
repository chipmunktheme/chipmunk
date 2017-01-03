<?php
/**
 * Chipmunk: Taxonomy
 *
 * @package WordPress
 * @subpackage Chipmunk
 */

get_header(); ?>

  <?php $term = get_queried_object(); ?>
  <?php $paged = ChipmunkHelpers::get_current_page(); ?>
  <?php $custom_query = ChipmunkHelpers::get_resources( ChipmunkCustomizer::theme_option( 'posts_per_page' ), $paged, $term ); ?>

  <div class="section section_theme-gray">
    <div class="container">
      <?php $title = sprintf( ( is_tax( 'resource-collection' ) ? __( '%s Collection', 'chipmunk' ) : __( '%s Tag', 'chipmunk' ) ), single_term_title( null, false ) ); ?>

      <?php if ( !ChipmunkCustomizer::theme_option( 'disable_sorting' ) and $custom_query->have_posts() ) : ?>
        <div class="row row_center">
          <div class="column column_md-4 column_lg-8">
            <h3 class="section__title heading heading_md"><?php echo $title; ?></h3>

            <?php if ( !empty( $term->description ) ) : ?>
              <p class="text_content text_subtitle"><?php echo $term->description; ?></p>
            <?php endif; ?>
          </div>

          <?php get_template_part( 'partials/sort-resources' ); ?>
        </div>
      <?php else : ?>
        <h3 class="section__title heading heading_md"><?php echo $title; ?></h3>

        <?php if ( !empty( $term->description ) ) : ?>
          <p class="text_content text_subtitle"><?php echo $term->description; ?></p>
        <?php endif; ?>
      <?php endif; ?>

      <?php if ( ( $children_collections = get_term_children( $term->term_id, 'resource-collection' ) ) && $paged == 1 ) : ?>
        <div class="row">
          <?php foreach ( $children_collections as $collection ) : ?>
            <?php $collection = get_term_by( 'id', $collection, 'resource-collection' ); ?>
            <?php include locate_template( 'sections/collection-tile.php' ); ?>
          <?php endforeach; ?>
        </div>

        <?php if ( $custom_query->have_posts() ) : ?>
          <div class="separator"></div>
        <?php endif; ?>
      <?php endif; ?>

      <div class="row">
        <?php if ( $custom_query->have_posts() ) : ?>
          <?php while ( $custom_query->have_posts() ) : $custom_query->the_post(); ?>

              <?php get_template_part( 'sections/resource-tile' ); ?>

          <?php endwhile; wp_reset_postdata(); ?>
        <?php elseif ( empty( $children_collections ) ) : ?>

          <div class="column">
            <?php if ( current_user_can( 'publish_posts' ) ) : ?>
              <p class="text_content text_separated"><?php printf( __( 'Ready to publish your first resource? <a href="%1$s">Get started here</a>.', 'chipmunk' ), esc_url( admin_url( 'post-new.php?post_type=resource' ) ) ); ?></p>
            <?php else : ?>
              <p class="text_content text_separated"><?php _e( 'Sorry, there are no resources to display yet.', 'chipmunk' ); ?></p>
            <?php endif; ?>
          </div>

        <?php endif; ?>
      </div>
    </div>

    <?php include locate_template( 'sections/pagination.php' ); ?>
    <?php get_template_part( 'sections/promo' ); ?>
  </div>
  <!-- /.section -->

  <?php get_template_part( 'sections/toolbox' ); ?>

<?php get_footer(); ?>
