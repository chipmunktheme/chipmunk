<div class="tile tile--card tile--blank grid__item grid__item--md-3 grid__item--lg-4">
	<a href="<?php the_permalink(); ?>" class="tile__image">
		<?php if ( has_post_thumbnail() ) : ?>
			<?php the_post_thumbnail( '600x420' ); ?>
		<?php endif; ?>
	</a>

	<div class="tile__content">
		<div class="tile__info">
			<div class="tile__head">
				<h2 class="tile__title">
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</h2>
			</div>

			<?php $content = get_the_content(); ?>

			<?php if ( ! empty( $content ) ) : ?>
				<p class="tile__copy">
					<?php echo esc_html( chipmunk_truncate_string( $content, apply_filters( 'chipmunk_post_excerpt_length', 120 ) ) ); ?>
				</p>
			<?php endif; ?>
		</div>

		<?php if ( ! chipmunk_theme_option( 'disable_resource_date' ) or ! chipmunk_theme_option( 'disable_resource_views' ) or ! chipmunk_theme_option( 'disable_resource_upvotes' ) ) : ?>
			<ul class="tile__stats stats">
				<?php
					$collections_args = array(
						'display'  => true,
						'type'     => 'link',
						'quantity' => 1,
					);

					chipmunk_get_template_part( 'partials/post-stats', array( 'args' => $collections_args ) );
				?>
			</ul>
		<?php endif; ?>

		<a href="<?php the_permalink(); ?>" class="tile__button button button--primary-outline visible-lg-block">
			<?php esc_html_e( 'Read more', 'chipmunk' ); ?>
		</a>
	</div>
</div>
