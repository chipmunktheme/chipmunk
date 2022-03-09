<?php
	$options = array(
		'display_as' => Chipmunk\Customizer::get_theme_option( 'display_collection_as' ),
	);

	$tile_classes = array(
		''           => array( 'card' ),
		'tile'       => array( 'tile' ),
		'card'       => array( 'card' ),
		'card_blank' => array( 'blank' ),
	);

	$tile_class = Chipmunk\Helpers::class_name( 'c-tile', $tile_classes[ $options['display_as'] ] );
?>

<a href="<?php echo esc_url( get_term_link( $collection->term_id ) ); ?>" class="<?php echo esc_attr( $tile_class ); ?>">
	<div class="c-tile__inner">
		<?php if ( ! Chipmunk\Customizer::get_theme_option( 'disable_collection_thumbs' ) || $options['display_as'] == 'tile' ) : ?>
			<div class="c-tile__image">
				<?php if ( ! Chipmunk\Customizer::get_theme_option( 'disable_collection_thumbs' ) ) : ?>
					<?php $collection_image = get_field( '_' . THEME_SLUG . '_collection_image', $collection ); ?>

					<?php if ( ! empty( $collection_image ) ) : ?>
						<?php echo wp_get_attachment_image( $collection_image, '600x420' ); ?>
					<?php else : ?>
						<?php
						$resources = new WP_Query( array(
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
						?>

						<?php if ( $resources->have_posts() ) : ?>
							<?php while ( $resources->have_posts() ) : $resources->the_post(); ?>

								<?php if ( has_post_thumbnail() ) : ?>
									<?php the_post_thumbnail( '600x420' ); ?>
								<?php endif; ?>

							<?php endwhile; wp_reset_postdata(); ?>
						<?php endif; ?>
					<?php endif; ?>
				<?php endif; ?>
			</div>
		<?php endif; ?>

		<div class="c-tile__content<?php echo ( $options['display_as'] == 'tile' ? ( Chipmunk\Customizer::get_theme_option( 'disable_collection_thumbs' ) ? ' c-tile__content--primary' : ' c-tile__content--dimmed' ) : '' ); ?>">
			<div class="c-tile__head">
				<<?php echo ( is_front_page() || is_single() ) ? 'h3' : 'h2'; ?> class="c-tile__title c-heading c-heading--h5">
					<?php echo $collection->name; ?>
				</<?php echo ( is_front_page() || is_single() ) ? 'h3' : 'h2'; ?>>

				<?php if ( $options['display_as'] == 'tile' ) : ?>
					<p class="c-tile__copy"><?php esc_html_e( 'View this collection', 'chipmunk' ); ?></p>
				<?php else : ?>
					<p class="c-tile__copy"><?php echo esc_html( $collection->description ); ?></p>
				<?php endif; ?>
			</div>

			<?php if ( ! Chipmunk\Customizer::get_theme_option( 'disable_collection_stats' ) ) : ?>
				<ul class="c-tile__stats c-stats">
					<?php if ( $term_children = wp_count_terms( 'resource-collection', array( 'parent' => $collection->term_id, 'hide_empty' => true ) ) ) : ?>
						<li class="c-stats__item" title="<?php esc_attr_e( 'Sub collections', 'chipmunk' ); ?>">
							<?php Chipmunk\Helpers::get_template_part( 'partials/icon', array( 'icon' => 'collection' ) ); ?>
							<?php echo $term_children; ?>
						</li>
					<?php endif; ?>

					<li class="c-stats__item" title="<?php esc_attr_e( 'Resources', 'chipmunk' ); ?>">
						<?php Chipmunk\Helpers::get_template_part( 'partials/icon', array( 'icon' => 'link' ) ); ?>
						<?php echo $collection->count; ?>
					</li>
				</ul>
			<?php endif; ?>
		</div>
	</div>
</a>
