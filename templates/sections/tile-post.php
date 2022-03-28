<?php
	$tile_class = Chipmunk\Helpers::class_name( 'c-tile', array( 'blank' ) );
?>

<div class="<?php echo esc_attr( $tile_class ); ?>">
	<div class="c-tile__inner">
		<?php $media_class = Chipmunk\Helpers::class_name( 'c-media', Chipmunk\Helpers::get_theme_option( 'post_image_aspect_ratio' ) ); ?>

		<a href="<?php the_permalink(); ?>" class="c-tile__image <?php echo esc_attr( $media_class ); ?>">
			<?php if ( has_post_thumbnail() ) : ?>
				<?php the_post_thumbnail( '640x480' ); ?>
			<?php endif; ?>
		</a>

		<div class="c-tile__content">
			<div class="c-tile__head">
				<h2 class="c-tile__title c-heading c-heading--h5">
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</h2>

				<p class="c-tile__copy"><?php echo esc_html( get_the_excerpt() ); ?></p>
			</div>

			<?php Chipmunk\Helpers::get_template_part( 'partials/stats', array(
				'class' => 'c-tile__stats',
				'stats' => array(
					'terms' => array(
						'term_args' => array(
							'quantity' => 1,
						),
					),
					'date' => array(),
					'views' => array(),
					'ratings' => array(),
				),
			) ); ?>

			<a href="<?php the_permalink(); ?>" class="c-tile__button c-button c-button--primary-outline u-visible-lg-block">
				<?php esc_html_e( 'Read more', 'chipmunk' ); ?>
			</a>
		</div>
	</div>
</div>
