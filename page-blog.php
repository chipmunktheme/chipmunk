<?php

/**
 * Template Name: Listing - Blog
 * Chipmunk: Page Blog
 *
 * @package WordPress
 * @subpackage Chipmunk
 */

get_header(); ?>

	<?php Chipmunk\Helpers::get_template_part(['sections/loop', 'post']); ?>

<?php get_footer(); ?>
