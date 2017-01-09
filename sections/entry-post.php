<div class="row">
	<?php if ( has_post_thumbnail() ) : ?>
		<div class="column">
			<div class="entry__image" style="background-image: url(<?php the_post_thumbnail_url( 'xl' ); ?>)"></div>
		</div>
	<?php endif; ?>

	<div class="column column_lg-8 column_lg-offset-2">
		<div class="entry__head">
			<ul class="entry__stats stats">
				<?php get_template_part( 'partials/post-stats' ); ?>
			</ul>

			<h1 class="entry__title"><?php the_title(); ?></h1>

			<div class="entry__author">
				<?php echo get_avatar( get_the_author_meta( 'ID' ), 50 ); ?>
				<?php _e( 'Posted by', 'chipmunk') ?> <strong><?php the_author(); ?></strong>
			</div>
		</div>
		<!-- /.entry__head -->

		<div class="entry">
			<?php the_content(); ?>
		</div>
		<!-- /.entry -->
	</div>
</div>
