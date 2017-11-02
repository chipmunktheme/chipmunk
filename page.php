<?php
/**
 * Chipmunk: Page
 *
 * @package WordPress
 * @subpackage Chipmunk
 */

get_header(); ?>

	<div class="section">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<div class="container">
				<?php get_template_part( 'templates/sections/entry', 'page' ); ?>
			</div>
		<?php endwhile; endif; ?>
	</div>
	<!-- /.section -->

<?php get_footer(); ?>
