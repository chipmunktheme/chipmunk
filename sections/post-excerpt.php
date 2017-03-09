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

				include locate_template( 'partials/post-stats.php' );
			?>
		</ul>

		<h1 class="entry__title"><?php the_title(); ?></h1>

		<div class="entry__content">
			<?php echo chipmunk_truncate_string( get_the_excerpt(), 250 ); ?>
		</div>
		<!-- /.entry -->

		<span class="entry__button button button_secondary">
			<?php _e( 'Read more', 'chipmunk' ); ?>
		</span>
	</div>
	<!-- /.entry__head -->
</a>
