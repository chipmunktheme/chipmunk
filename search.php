<?php
/**
 * Chipmunk: Search
 *
 * @package WordPress
 * @subpackage Chipmunk
 */

// If the search query is shorter than 3 letters redirect to homepage
if ( strlen( get_search_query() ) < 3 or ChipmunkCustomizer::theme_option( 'disable_search' ) ) {
	wp_redirect( home_url( '/' ) ); exit;
}

get_header(); ?>

	<div class="section section_theme-gray<?php echo ( have_posts() ? ' section_compact-bottom' : '' ); ?>">
		<div class="container">
			<h1 class="heading heading_md">
				<small><?php esc_html_e( 'Search results for:', 'chipmunk' ); ?></small>
				<?php echo get_search_query(); ?>
			</h1>

			<?php if ( ! have_posts() ) : ?>
				<p class="text_content text_separated"><?php esc_html_e( 'Sorry, your search did not match any resources.', 'chipmunk' ); ?></p>
			<?php endif; ?>
		</div>
	</div>
	<!-- /.section -->

	<?php if ( have_posts() ) : ?>
		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'sections/resource' ); ?>

		<?php endwhile; ?>
	<?php endif; ?>

	<?php if ( $wp_query->max_num_pages > 1 ) : ?>
		<div class="section section_theme-gray">
			<?php get_template_part( 'sections/pagination' ); ?>
		</div>
		<!-- /.section -->
	<?php endif; ?>

<?php get_footer(); ?>
