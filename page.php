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
				<?php chipmunk_get_template_part( array( 'sections/entry', 'page' ) ); ?>
			</div>
		<?php endwhile; endif; ?>
	</div>
	<!-- /.section -->

	<?php if ( comments_open() || get_comments_number() ) : ?>
		<div class="section section--theme-light">
			<div class="container">
				<?php comments_template(); ?>
			</div>
		</div>
		<!-- /.section -->
	<?php endif; ?>

<?php get_footer(); ?>
