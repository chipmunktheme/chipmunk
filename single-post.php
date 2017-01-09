<?php
/**
 * Chipmunk: Single Post
 *
 * @package WordPress
 * @subpackage Chipmunk
 */

chipmunk_set_views( get_the_ID() );
get_header(); ?>

	<?php while ( have_posts() ) : the_post(); ?>
		<?php get_template_part( 'sections/resource' ); ?>
	<?php endwhile; ?>

	<?php get_template_part( 'sections/resources' ); ?>
	<?php get_template_part( 'sections/toolbox' ); ?>

<?php get_footer(); ?>
