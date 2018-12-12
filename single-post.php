<?php
/**
 * Chipmunk: Single Post
 *
 * @package WordPress
 * @subpackage Chipmunk
 */

chipmunk_set_views( get_the_ID() );
get_header(); ?>

	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<?php get_template_part( 'templates/sections/entry', 'post' ); ?>
	<?php endwhile; endif; ?>

	<?php if ( comments_open() || get_comments_number() ) : ?>
		<div class="section section--theme-light">
			<div class="container">
				<?php comments_template(); ?>
			</div>
		</div>
		<!-- /.section -->
	<?php endif; ?>

	<?php get_template_part( 'templates/sections/posts' ); ?>

<?php get_footer(); ?>
