<?php if ( is_single() ) : ?>
	<h1 class="c-entry__title c-heading c-heading--h1" itemprop="headline">
		<?php the_title(); ?>
	</h1>
<?php else : ?>
	<h2 class="c-entry__title c-heading c-heading--h2">
		<a href="<?php the_permalink(); ?>" itemprop="headline"><?php the_title(); ?></a>
	</h2>
<?php endif; ?>

<?php Chipmunk\Helpers::get_template_part( 'partials/stats', array(
	'class' => 'c-entry__stats',
	'stats' => array(
		'author' => array(
			'show_avatar' => true,
		),
		'terms' => array(
			'term_args' => $term_args ?? array(),
		),
		'date' => array(),
		'views' => array(),
		'ratings' => ! is_single() ? array() : null,
	),
) ); ?>
