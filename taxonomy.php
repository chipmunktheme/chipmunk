<?php
/**
 * Chipmunk: Taxonomy
 *
 * @package WordPress
 * @subpackage Chipmunk
 */

get_header(); ?>

	<?php $term = get_queried_object(); ?>
	<?php $paged = chipmunk_get_current_page(); ?>
	<?php $custom_query = chipmunk_get_resources( chipmunk_theme_option( 'posts_per_page' ), $paged, $term ); ?>

	<div class="section">
		<div class="container">
			<?php $title = sprintf( ( is_tax( 'resource-collection' ) ? esc_html__( '%s Collection', 'chipmunk' ) : esc_html__( '%s Tag', 'chipmunk' ) ), ucfirst( single_term_title( null, false ) ) ); ?>

			<?php if ( ! chipmunk_theme_option( 'disable_sorting' ) and $custom_query->have_posts() ) : ?>
				<div class="row row_center">
					<div class="column column_md-4 column_lg-8">
						<h3 class="heading heading_md"><?php echo esc_html( $title ); ?></h3>

						<?php if ( ! empty( $term->description ) ) : ?>
							<p class="text_content text_subtitle"><?php echo esc_html( $term->description ); ?></p>
						<?php endif; ?>
					</div>

					<?php get_template_part( 'partials/sort-resources' ); ?>
				</div>
			<?php else : ?>
				<h3 class="heading heading_md"><?php echo esc_html( $title ); ?></h3>

				<?php if ( ! empty( $term->description ) ) : ?>
					<p class="text_content text_subtitle"><?php echo esc_html( $term->description ); ?></p>
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
						<p class="text_content text_separated">
							<?php if ( current_user_can( 'publish_posts' ) ) : ?>
								<?php esc_html_e( 'Ready to publish your first resource?', 'chipmunk' ); ?>

								<a href="<?php echo esc_url( admin_url( 'post-new.php?post_type=resource' ) ); ?>"><?php esc_html_e( 'Get started here', 'chipmunk' ); ?></a>.
							<?php else : ?>
								<?php esc_html_e( 'Sorry, there are no resources to display yet.', 'chipmunk' ); ?>
							<?php endif; ?>
						</p>
					</div>

				<?php endif; ?>
			</div>
		</div>

		<?php include locate_template( 'sections/pagination.php' ); ?>
	</div>
	<!-- /.section -->

<?php get_footer(); ?>
