<?php
	$options = [
		'display_as' => Chipmunk\Helpers::get_theme_option( 'display_collection_as' ),
	];

	$tile_classes = [
		''           => [ 'card' ],
		'tile'       => [ 'tile' ],
		'card'       => [ 'card' ],
		'card_blank' => [ 'blank' ],
	];

	$tile_class = Chipmunk\Helpers::class_name( 'c-tile', $tile_classes[ $options['display_as'] ] );
?>

<div class="<?php echo esc_attr( $tile_class ); ?>">
	<a href="<?php echo esc_url( get_term_link( $collection->term_id ) ); ?>" class="c-tile__inner">
		<?php if ( ! Chipmunk\Helpers::get_theme_option( 'disable_collection_thumbs' ) || $options['display_as'] == 'tile' ) : ?>
			<?php $media_class = Chipmunk\Helpers::class_name( 'c-media', Chipmunk\Helpers::get_theme_option( 'resource_image_aspect_ratio' ) ); ?>

			<div class="c-tile__image <?php echo esc_attr( $media_class ); ?>">
				<?php if ( ! Chipmunk\Helpers::get_theme_option( 'disable_collection_thumbs' ) ) : ?>
					<?php $collection_image = get_field( '_' . THEME_SLUG . '_collection_image', $collection ); ?>

					<?php if ( ! empty( $collection_image ) ) : ?>
						<?php echo wp_get_attachment_image( $collection_image, '640x480' ); ?>
					<?php else : ?>
						<?php
						$resources = new WP_Query( [
							'posts_per_archive_page' => 3,
							'post_type'       => 'resource',
							'tax_query'       => [
								[
									'taxonomy'    => 'resource-collection',
									'field'       => 'term_id',
									'terms'       => $collection->term_id,
								],
							],
						] );
						?>

						<?php if ( $resources->have_posts() ) : ?>
							<?php while ( $resources->have_posts() ) : $resources->the_post(); ?>

								<?php if ( has_post_thumbnail() ) : ?>
									<?php the_post_thumbnail( '640x480' ); ?>
								<?php endif; ?>

							<?php endwhile; wp_reset_postdata(); ?>
						<?php endif; ?>
					<?php endif; ?>
				<?php endif; ?>
			</div>
		<?php endif; ?>

		<div class="c-tile__content<?php echo ( $options['display_as'] == 'tile' ? ( Chipmunk\Helpers::get_theme_option( 'disable_collection_thumbs' ) ? ' c-tile__content--primary' : ' c-tile__content--dimmed' ) : '' ); ?>">
			<div class="c-tile__head">
				<<?php echo ( is_front_page() || is_single() ) ? 'h3' : 'h2'; ?> class="c-tile__title c-heading c-heading--h5">
					<?php echo $collection->name; ?>
				</<?php echo ( is_front_page() || is_single() ) ? 'h3' : 'h2'; ?>>

				<?php if ( $options['display_as'] == 'tile' ) : ?>
					<p class="c-tile__copy"><?php esc_html_e( 'View this collection', 'chipmunk' ); ?></p>
				<?php elseif ( ! empty( $collection->description ) ) : ?>
					<p class="c-tile__copy"><?php echo esc_html( $collection->description ); ?></p>
				<?php endif; ?>
			</div>

			<?php if ( ! Chipmunk\Helpers::get_theme_option( 'disable_collection_stats' ) ) : ?>
				<?php Chipmunk\Helpers::get_template_part( 'partials/stats', [
					'class' => 'c-tile__stats',
					'stats' => [
						'count-collections' => [
							'term_id' => $collection->term_id,
						],
						'count-resources' => [
							'count' => $collection->count,
						],
					],
				] ); ?>
			<?php endif; ?>
		</div>
	</a>
</div>
