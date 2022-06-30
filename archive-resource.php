<?php
/**
 * Chipmunk: Archive
 *
 * @package WordPress
 * @subpackage Chipmunk
 */

get_header(); ?>

	<?php Chipmunk\Helpers::get_template_part( [ 'sections/loop', 'resource' ] ); ?>

<?php get_footer(); ?>
