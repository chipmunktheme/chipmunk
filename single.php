<?php
/**
 * Chipmunk: Single template
 *
 * @package WordPress
 * @subpackage Chipmunk
 */

Chipmunk\Extensions\Views::set_views( get_the_ID() );
get_header(); ?>

	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<?php Chipmunk\Helpers::get_template_part( [ 'sections/entry', get_post_type() ] ); ?>
	<?php endwhile; endif; ?>

	<?php if ( comments_open() || get_comments_number() ) : ?>
		<div class="l-section l-section--theme-light">
			<div class="l-container">
				<?php comments_template(); ?>
			</div>
		</div>
	<?php endif; ?>

	<?php Chipmunk\Helpers::get_template_part( [ 'sections/loop', get_post_type() ] ); ?>

<?php get_footer(); ?>
