<?php
/**
 * Template Name: Listing - Resources
 * Chipmunk: Page Resources
 *
 * @package WordPress
 * @subpackage Chipmunk
 */

get_header(); ?>

	<?php chipmunk_get_template_part( array( 'sections/loop', 'resource' ) ); ?>

<?php get_footer(); ?>
