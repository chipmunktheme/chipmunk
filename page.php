<?php
/**
 * Chipmunk: Page
 *
 * @package WordPress
 * @subpackage Chipmunk
 */

get_header(); ?>

	<div class="l-section">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<div class="l-container">
				<?php Chipmunk\Helpers::get_template_part( [ 'sections/entry', 'page' ] ); ?>
			</div>
		<?php endwhile; endif; ?>
	</div>

	<?php if ( comments_open() || get_comments_number() ) : ?>
		<div class="l-section l-section--theme-light">
			<div class="l-container">
				<?php comments_template(); ?>
			</div>
		</div>
	<?php endif; ?>

<?php get_footer(); ?>
