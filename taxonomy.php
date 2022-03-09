<?php
/**
 * Chipmunk: Taxonomy
 *
 * @package WordPress
 * @subpackage Chipmunk
 */

get_header(); ?>

	<?php $term = get_queried_object(); ?>
	<?php $paged = Chipmunk\Helpers::get_current_page(); ?>
	<?php $query = Chipmunk\Query::get_resources( Chipmunk\Customizer::get_theme_option( 'posts_per_page' ), $paged, $term ); ?>
	<?php $children_collections = get_terms( 'resource-collection', array( 'parent' => $term->term_id ) ); ?>

	<div class="l-section">
		<div class="l-container">
			<?php $title = ucfirst( single_term_title( null, false ) ); ?>

			<div class="l-component l-header">
				<?php if ( ! Chipmunk\Customizer::get_theme_option( 'disable_resource_sorting' ) && $query->have_posts() ) : ?>
					<h1 class="c-heading c-heading--h4"><?php echo esc_html( $title ); ?></h1>

					<?php Chipmunk\Helpers::get_template_part( 'partials/filters' ); ?>

					<?php if ( ! empty( $term->description ) ) : ?>
						<p class="l-header__copy"><?php echo $term->description; ?></p>
					<?php endif; ?>
				<?php else : ?>
					<h3 class="c-heading c-heading--h4"><?php echo esc_html( $title ); ?></h3>

					<?php if ( ! empty( $term->description ) ) : ?>
						<p class="l-header__copy"><?php echo $term->description; ?></p>
					<?php endif; ?>
				<?php endif; ?>

				<?php if ( ! $query->have_posts() && empty( $children_collections ) ) : ?>
					<p class="l-header__copy">
						<?php esc_html_e( 'Sorry, there are no resources to display yet.', 'chipmunk' ); ?>
					</p>
				<?php endif; ?>
			</div>

			<?php if ( ! empty( $children_collections ) && $paged == 1 ) : ?>
				<div class="l-component">
					<div class="c-tile__list">
						<?php foreach ( $children_collections as $collection ) : ?>
							<?php Chipmunk\Helpers::get_template_part( 'sections/collection-tile', array( 'collection' => $collection ) ); ?>
						<?php endforeach; ?>
					</div>
				</div>
			<?php endif; ?>

			<div class="l-component<?php echo ( ! empty( $children_collections ) ? ' l-component--lg' : '' ); ?>">
				<?php if ( $query->have_posts() ) : ?>
					<div class="c-tile__list" data-action-element="load_posts">
						<?php while ( $query->have_posts() ) : $query->the_post(); ?>

							<?php Chipmunk\Helpers::get_template_part( 'sections/resource-tile' ); ?>

						<?php endwhile; wp_reset_postdata(); ?>
					</div>
				<?php endif; ?>
			</div>

			<div class="l-component l-component--md">
				<?php Chipmunk\Helpers::get_template_part( 'sections/pagination', array( 'query' => $query ) ); ?>
			</div>
		</div>
	</div>

<?php get_footer(); ?>
