<?php
/**
 * Chipmunk: Front page
 *
 * @package WordPress
 * @subpackage Chipmunk
 */

get_header(); ?>

	<?php if ( ! chipmunk_theme_option( 'disable_homepage_listings' ) ) : ?>
		<?php get_template_part( 'templates/sections/resources-tabs' ); ?>
		<?php get_template_part( 'templates/partials/toolbox' ); ?>
	<?php endif; ?>

	<?php if ( ! chipmunk_theme_option( 'disable_homepage_collections' ) ) : ?>
		<?php get_template_part( 'templates/sections/collections' ); ?>
	<?php endif; ?>

	<?php if ( ! chipmunk_theme_option( 'disable_homepage_posts' ) ) : ?>
		<?php get_template_part( 'templates/sections/posts' ); ?>
	<?php endif; ?>

<?php get_footer(); ?>
