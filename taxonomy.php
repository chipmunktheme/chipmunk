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
	<?php $query = chipmunk_get_resources( chipmunk_theme_option( 'posts_per_page' ), $paged, $term ); ?>

	<div class="section">
		<div class="container">
			<?php $title = ucfirst( single_term_title( null, false ) ); ?>

			<?php if ( ! chipmunk_theme_option( 'disable_resource_sorting' ) and $query->have_posts() ) : ?>
				<div class="grid">
					<div class="grid__item grid__item--md-4 grid__item--lg-4">
						<h1 class="heading heading--h4"><?php echo esc_html( $title ); ?></h1>
					</div>

					<?php chipmunk_get_template_part( 'partials/filters' ); ?>

					<?php if ( ! empty( $term->description ) ) : ?>
						<div class="grid__item grid__item--md-4 grid__item--lg-8">
							<p class="text--content text--subtitle"><?php echo $term->description; ?></p>
						</div>
					<?php endif; ?>
				</div>
			<?php else : ?>
				<div class="grid">
					<div class="grid__item grid__item--md-4 grid__item--lg-8">
						<h3 class="heading heading--h4"><?php echo esc_html( $title ); ?></h3>

						<?php if ( ! empty( $term->description ) ) : ?>
							<p class="text--content text--subtitle"><?php echo $term->description; ?></p>
						<?php endif; ?>
					</div>
				</div>
			<?php endif; ?>

			<?php if ( ( $children_collections = get_terms( 'resource-collection', array( 'parent' => $term->term_id ) ) ) && $paged == 1 ) : ?>
				<div class="grid">
					<?php foreach ( $children_collections as $collection ) : ?>
						<?php chipmunk_get_template_part( 'sections/collection-tile', array( 'collection' => $collection ) ); ?>
					<?php endforeach; ?>
				</div>

				<?php if ( $query->have_posts() ) : ?>
					<div class="separator"></div>
				<?php endif; ?>
			<?php endif; ?>

			<?php if ( $query->have_posts() ) : ?>
				<div class="grid" data-action-element="load_posts">
					<?php while ( $query->have_posts() ) : $query->the_post(); ?>

						<?php chipmunk_get_template_part( 'sections/resource-tile' ); ?>

					<?php endwhile; wp_reset_postdata(); ?>
				</div>
			<?php elseif ( empty( $children_collections ) ) : ?>
				<p class="text--content text--separated">
					<?php if ( current_user_can( 'publish_posts' ) ) : ?>
						<?php esc_html_e( 'Ready to publish your first resource?', 'chipmunk' ); ?>

						<a href="<?php echo esc_url( admin_url( 'post-new.php?post_type=resource' ) ); ?>"><?php esc_html_e( 'Get started here', 'chipmunk' ); ?></a>.
					<?php else : ?>
						<?php esc_html_e( 'Sorry, there are no resources to display yet.', 'chipmunk' ); ?>
					<?php endif; ?>
				</p>

			<?php endif; ?>
		</div>

		<?php chipmunk_get_template_part( 'sections/pagination', array( 'query' => $query ) ); ?>
	</div>
	<!-- /.section -->

<?php get_footer(); ?>
