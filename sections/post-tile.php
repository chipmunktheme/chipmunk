<a href="<?php the_permalink(); ?>" class="tile tile_card tile_blank column column_md-3 column_lg-4">
	<div class="tile__image">
		<?php if ( has_post_thumbnail() ) : ?>
			<?php the_post_thumbnail( 'chipmunk-sm' ); ?>
		<?php endif; ?>
	</div>

	<div class="tile__content">
		<div class="tile__info">
			<h2 class="tile__title"><?php the_title(); ?></h2>

			<?php $content = get_the_content(); ?>

			<?php if ( ! empty( $content ) ) : ?>
				<p class="tile__copy"><?php echo chipmunk_truncate_string( $content, 120 ); ?></p>
			<?php endif; ?>
		</div>

		<?php if ( ! ChipmunkCustomizer::theme_option( 'disable_resource_date' ) or ! ChipmunkCustomizer::theme_option( 'disable_views' ) or ! ChipmunkCustomizer::theme_option( 'disable_upvotes' ) ) : ?>
			<ul class="tile__stats stats">
				<?php
					$collections_args = array(
						'display'  => true,
						'type'     => 'text',
						'quantity' => 1,
					);

					include locate_template( 'partials/post-stats.php' );
				?>
			</ul>
		<?php endif; ?>

		<button type="button" class="tile__button button button_secondary visible-lg-block">
			<?php _e( 'Read more', 'chipmunk' ); ?>
		</button>
	</div>
</a>
