<a href="<?php echo esc_url( get_term_link( $collection ) ); ?>" class="tile column column--md-3 column--lg-4">
	<div class="tile__image">
		<?php if ( ! chipmunk_theme_option( 'disable_collection_thumbs' ) ) : ?>
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

			$resources->posts = array_reverse( $resources->posts );
			?>

			<?php if ( $resources->have_posts() ) : ?>
				<?php while ( $resources->have_posts() ) : $resources->the_post(); ?>

					<?php if ( has_post_thumbnail() ) : ?>
						<?php the_post_thumbnail( '600x420' ); ?>
					<?php endif; ?>

				<?php endwhile; wp_reset_postdata(); ?>
			<?php endif; ?>
		<?php endif; ?>
	</div>

	<div class="tile__content <?php echo ( chipmunk_theme_option( 'disable_collection_thumbs' ) ? 'tile__content_primary' : 'tile__content_dimmed' ); ?>">
		<div>
			<div class="tile__head">
				<?php echo chipmunk_conditional_markup( is_front_page(), 'h3', 'h2', 'tile__title', esc_html( chipmunk_truncate_string( $collection->name, 60 ) ) ); ?>
			</div>

			<p class="tile__copy"><?php esc_html_e( 'View this collection', 'chipmunk' ); ?><span>&nbsp;<?php chipmunk_get_template( 'partials/icon', array( 'icon' => 'arrow-right' ) ); ?></span></p>
		</div>

		<ul class="tile__stats stats">
			<?php if ( $term_children = get_term_children( $collection->term_id, 'resource-collection' ) ) : ?>
				<li class="stats__item" title="<?php esc_attr_e( 'Sub collections', 'chipmunk' ); ?>">
					<?php chipmunk_get_template( 'partials/icon', array( 'icon' => 'collections' ) ); ?>
					<?php echo count( $term_children ); ?>
				</li>
			<?php endif; ?>

			<li class="stats__item" title="<?php esc_attr_e( 'Resources', 'chipmunk' ); ?>">
				<?php chipmunk_get_template( 'partials/icon', array( 'icon' => 'link' ) ); ?>
				<?php echo $collection->count; ?>
			</li>
		</ul>
	</div>
</a>
