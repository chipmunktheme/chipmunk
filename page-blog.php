<?php
/**
 * Template Name: Blog
 * Chipmunk: Page Blog
 *
 * @package WordPress
 * @subpackage Chipmunk
 */

get_header(); ?>

	<?php get_template_part( 'sections/posts' ); ?>
	<?php get_template_part( 'sections/toolbox' ); ?>

<?php get_footer(); ?>
