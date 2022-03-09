<?php
	$tile_class = Chipmunk\Helpers::class_name( 'c-tile', array( 'blank' ) );
?>

<div class="<?php echo esc_attr( $tile_class ); ?>">
	<div class="c-tile__inner">
		<a href="<?php the_permalink(); ?>" class="c-tile__image">
			<?php if ( has_post_thumbnail() ) : ?>
				<?php the_post_thumbnail( '600x420' ); ?>
			<?php endif; ?>
		</a>

		<div class="c-tile__content">
			<div class="c-tile__head">
				<h2 class="c-tile__title c-heading c-heading--h5">
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</h2>

				<p class="c-tile__copy"><?php echo esc_html( get_the_excerpt() ); ?></p>
			</div>

			<?php if ( ! Chipmunk\Customizer::get_theme_option( 'disable_resource_date' ) || ! Chipmunk\Customizer::get_theme_option( 'disable_resource_views' ) || ! Chipmunk\Customizer::get_theme_option( 'disable_resource_upvotes' ) ) : ?>
				<ul class="c-tile__stats c-stats">
					<?php
						$collections_args = array(
							'display'  => true,
							'type'     => 'link',
							'quantity' => 1,
						);

						Chipmunk\Helpers::get_template_part( 'partials/post-stats', array( 'args' => $collections_args ) );
					?>
				</ul>
			<?php endif; ?>

			<a href="<?php the_permalink(); ?>" class="c-tile__button c-button c-button--primary-outline u-visible-lg-block">
				<?php esc_html_e( 'Read more', 'chipmunk' ); ?>
			</a>
		</div>
	</div>
</div>
