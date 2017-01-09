<?php
/**
 * Chipmunk: Single Post
 *
 * @package WordPress
 * @subpackage Chipmunk
 */

chipmunk_set_views( get_the_ID() );
get_header(); ?>

	<div class="section section_theme-gray">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<div class="container">
				<?php get_template_part( 'sections/entry' ); ?>
			</div>
		<?php endwhile; endif; ?>

		<?php get_template_part( 'sections/promo' ); ?>
	</div>
	<!-- /.section -->

	<?php get_template_part( 'sections/toolbox' ); ?>

<?php get_footer(); ?>
