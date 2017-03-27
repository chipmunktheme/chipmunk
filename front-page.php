<?php
/**
 * Chipmunk: Front page
 *
 * @package WordPress
 * @subpackage Chipmunk
 */

get_header(); ?>

	<?php if ( ! chipmunk_theme_option( 'disable_homepage_listings' ) ) : ?>
		<?php get_template_part( 'sections/resources-tabs' ); ?>
		<?php get_template_part( 'partials/toolbox' ); ?>
	<?php endif; ?>

	<?php if ( ! chipmunk_theme_option( 'disable_homepage_collections' ) ) : ?>
		<?php get_template_part( 'sections/collections' ); ?>
	<?php endif; ?>

	<?php if ( ! chipmunk_theme_option( 'disable_homepage_posts' ) ) : ?>
		<?php get_template_part( 'sections/posts' ); ?>
	<?php endif; ?>

<?php get_footer(); ?>
