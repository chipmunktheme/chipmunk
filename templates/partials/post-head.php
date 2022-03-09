<?php if ( is_single() ) : ?>
	<h1 class="c-entry__title c-heading c-heading--h1" itemprop="headline">
		<?php the_title(); ?>
	</h1>
<?php else : ?>
	<h2 class="c-entry__title c-heading c-heading--h3">
		<a href="<?php the_permalink(); ?>" itemprop="headline"><?php the_title(); ?></a>
	</h2>
<?php endif; ?>

<div class="c-entry__meta">
	<?php if ( is_single() ) : ?>
		<div class="c-entry__author" itemprop="author">
			<?php echo get_avatar( get_the_author_meta( 'ID' ), 32 ); ?>
			<?php the_author(); ?>
		</div>
	<?php endif; ?>

	<ul class="c-entry__stats c-stats">
		<?php Chipmunk\Helpers::get_template_part( 'partials/post-stats', array( 'args' => $collections ) ); ?>
	</ul>
</div>
