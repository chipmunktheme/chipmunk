<?php
/**
 * Chipmunk: Footer
 *
 * Remember to always include the wp_footer() call before the </body> tag
 *
 * @package WordPress
 * @subpackage Chipmunk
 */
?>

		<?php chipmunk_get_template_part( 'partials/promo' ); ?>

		<?php if ( ! is_front_page() || chipmunk_theme_option( 'disable_homepage_listings' ) ) : ?>
			<?php chipmunk_get_template_part( 'partials/toolbox' ); ?>
		<?php endif; ?>

		<?php chipmunk_get_template_part( 'partials/newsletter' ); ?>
		<?php chipmunk_get_template_part( 'partials/page-bottom' ); ?>
		<?php chipmunk_get_template_part( 'partials/page-foot' ); ?>
	</div>
	<!-- /.body-bag -->

	<?php if ( ! chipmunk_theme_option( 'disable_search' ) ) : ?>
		<?php chipmunk_get_template_part( 'partials/search-bar' ); ?>
	<?php endif; ?>

	<?php if ( ! chipmunk_theme_option( 'disable_submissions' ) && empty( chipmunk_theme_option( 'submit_page' ) ) ) : ?>
		<?php chipmunk_get_template_part( 'partials/popup' ); ?>
	<?php endif; ?>

	<?php wp_footer(); ?>

	<!-- Chipmunk Theme: Version <?php echo chipmunk_get_version(); ?> -->
</body>
</html>
