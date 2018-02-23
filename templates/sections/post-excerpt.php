<a href="<?php the_permalink(); ?>" class="entry column">
	<?php if ( has_post_thumbnail() ) : ?>
		<div class="entry__image" style="background-image: url(<?php the_post_thumbnail_url( 'xl' ); ?>)"></div>
	<?php endif; ?>

	<div class="entry__head">
		<ul class="entry__stats stats">
			<?php
				$collections_args = array(
					'display'  => true,
					'type'     => 'text',
					'quantity' => -1,
				);

				require locate_template( 'templates/partials/post-stats.php' );
			?>
		</ul>

		<h1 class="entry__title"><?php the_title(); ?></h1>

		<div class="entry__content content">
			<?php echo esc_html( chipmunk_truncate_string( get_the_excerpt(), 250 ) ); ?>
		</div>
		<!-- /.entry -->

		<span class="entry__button button button_secondary">
			<?php esc_html_e( 'Read more', 'chipmunk' ); ?>
		</span>
	</div>
	<!-- /.entry__head -->
</a>
