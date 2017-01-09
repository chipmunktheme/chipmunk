<?php if ( has_post_thumbnail() ) : ?>
	<div class="column">
		<a href="<?php the_permalink(); ?>" class="entry__image" style="background-image: url(<?php the_post_thumbnail_url( 'xl' ); ?>)"></a>
	</div>
<?php endif; ?>

<div class="column column_lg-8 column_lg-offset-2">
	<div class="entry__head">
		<ul class="entry__stats stats">
			<?php get_template_part( 'partials/post-stats' ); ?>
		</ul>

		<h1 class="entry__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>

		<div class="entry__content">
			<?php echo chipmunk_truncate_string( get_the_excerpt(), 250 ); ?>
		</div>
		<!-- /.entry -->

		<a href="<?php the_permalink(); ?>" class="entry__button button button_secondary">
			<?php _e( 'Read more', 'chipmunk' ); ?>
		</a>
	</div>
	<!-- /.entry__head -->
</div>
