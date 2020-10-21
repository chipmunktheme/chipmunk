<?php
/**
 * Chipmunk: Front page
 *
 * @package WordPress
 * @subpackage Chipmunk
 */

get_header(); ?>
	<?php chipmunk_get_template_part( 'sections/intro-text' ); ?>

	<?php if ( ! chipmunk_theme_option( 'disable_homepage_listings' ) ) : ?>
		<?php do_action( 'chipmunk_before_resources_tabs' ); ?>

		<?php chipmunk_get_template_part( 'sections/resources-tabs' ); ?>

		<?php do_action( 'chipmunk_after_resources_tabs' ); ?>

		<?php chipmunk_get_template_part( 'partials/toolbox' ); ?>
	<?php endif; ?>

	<?php if ( ! chipmunk_theme_option( 'disable_homepage_collections' ) ) : ?>
		<?php chipmunk_get_template_part( 'sections/collections' ); ?>
	<?php endif; ?>

	<?php if ( ! chipmunk_theme_option( 'disable_homepage_posts' ) ) : ?>
		<?php chipmunk_get_template_part( array( 'sections/loop', 'post' ) ); ?>
	<?php endif; ?>

<?php get_footer(); ?>
