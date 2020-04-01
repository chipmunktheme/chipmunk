<?php
/**
 * Chipmunk: Front page
 *
 * @package WordPress
 * @subpackage Chipmunk
 */

get_header(); ?>
	<?php get_template_part( 'templates/sections/intro-text' ); ?>

	<?php if ( ! chipmunk_theme_option( 'disable_homepage_listings' ) ) : ?>
		<?php do_action( 'chipmunk_before_resources_tabs' ); ?>

		<?php get_template_part( 'templates/sections/resources-tabs' ); ?>

		<?php do_action( 'chipmunk_after_resources_tabs' ); ?>

		<?php get_template_part( 'templates/partials/toolbox' ); ?>
	<?php endif; ?>

	<?php if ( ! chipmunk_theme_option( 'disable_homepage_collections' ) ) : ?>
		<?php get_template_part( 'templates/sections/collections' ); ?>
	<?php endif; ?>

	<?php if ( ! chipmunk_theme_option( 'disable_homepage_posts' ) ) : ?>
		<?php get_template_part( 'templates/sections/posts' ); ?>
	<?php endif; ?>

<?php get_footer(); ?>
