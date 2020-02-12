<?php
	$tile_classes = array(
		''           => 'tile tile--card',
		'tile'       => 'tile tile--tile',
		'card'       => 'tile tile--card',
		'card_blank' => 'tile tile--card tile--blank',
	);
?>

<a href="<?php echo esc_url( get_term_link( $collection->term_id ) ); ?>" class="<?php echo esc_attr( $tile_classes[ chipmunk_theme_option( 'display_collection_as' ) ] ); ?> column column--md-3 column--lg-4">
	<?php if ( ! chipmunk_theme_option( 'disable_collection_thumbs' ) || chipmunk_theme_option( 'display_collection_as' ) == 'tile' ) : ?>
		<div class="tile__image">
			<?php if ( ! chipmunk_theme_option( 'disable_collection_thumbs' ) ) : ?>
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

	<div class="tile__content<?php echo ( chipmunk_theme_option( 'display_collection_as' ) == 'tile' ? ( chipmunk_theme_option( 'disable_collection_thumbs' ) ? ' tile__content--primary' : ' tile__content--dimmed' ) : '' ); ?>">
		<div class="tile__info">
			<div class="tile__head">
				<?php echo chipmunk_conditional_markup( is_front_page(), 'h3', 'h2', 'tile__title', esc_html( chipmunk_truncate_string( $collection->name, 60 ) ) ); ?>
			</div>

			<?php if ( chipmunk_theme_option( 'display_collection_as' ) == 'tile' || ! empty( $collection->description ) ) : ?>
				<p class="tile__copy">
					<?php if ( chipmunk_theme_option( 'display_collection_as' ) == 'tile' ) : ?>
						<?php esc_html_e( 'View this collection', 'chipmunk' ); ?><span>&nbsp;<?php chipmunk_get_template( 'partials/icon', array( 'icon' => 'arrow-right' ) ); ?></span>
					<?php else : ?>
						<?php echo esc_html( chipmunk_truncate_string( $collection->description, apply_filters( 'chipmunk_collection_excerpt_length', ( chipmunk_theme_option( 'display_collection_as' ) == 'card_blank' ? 80 : 60 ) ) ) ); ?>
					<?php endif; ?>
				</p>
			<?php endif; ?>
		</div>

		<ul class="tile__stats stats">
			<?php if ( $term_children = wp_count_terms( 'resource-collection', array( 'parent' => $collection->term_id, 'hide_empty' => true ) ) ) : ?>
				<li class="stats__item" title="<?php esc_attr_e( 'Sub collections', 'chipmunk' ); ?>">
					<?php chipmunk_get_template( 'partials/icon', array( 'icon' => 'collections' ) ); ?>
					<?php echo $term_children; ?>
				</li>
			<?php endif; ?>

			<li class="stats__item" title="<?php esc_attr_e( 'Resources', 'chipmunk' ); ?>">
				<?php chipmunk_get_template( 'partials/icon', array( 'icon' => 'link' ) ); ?>
				<?php echo $collection->count; ?>
			</li>
		</ul>
	</div>
</a>
