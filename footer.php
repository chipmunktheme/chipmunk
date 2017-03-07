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

		<?php get_template_part( 'partials/promo' ); ?>

		<?php if ( ! is_front_page() || ChipmunkCustomizer::theme_option( 'disable_homepage_listings' ) ) : ?>
			<?php get_template_part( 'partials/toolbox' ); ?>
		<?php endif; ?>

		<?php get_template_part( 'partials/newsletter' ); ?>
		<?php get_template_part( 'partials/page-bottom' ); ?>
		<?php get_template_part( 'partials/page-foot' ); ?>

		<?php if ( !ChipmunkCustomizer::theme_option( 'disable_search' ) ) : ?>
			<?php get_template_part( 'partials/search-bar' ); ?>
		<?php endif; ?>
	</div>
	<!-- /.body-bag -->

	<?php if ( !ChipmunkCustomizer::theme_option( 'disable_submissions' ) ) : ?>
		<?php get_template_part( 'partials/popup' ); ?>
	<?php endif; ?>

	<?php if ($tracking_code = ChipmunkCustomizer::theme_option( 'tracking_code') ) : ?>
		<?php echo $tracking_code; ?>
	<?php endif ?>

	<?php if ( ChipmunkCustomizer::theme_option( 'recaptcha_site_key' ) ) : ?>
		<script src='https://www.google.com/recaptcha/api.js'></script>
	<?php endif ?>

	<?php wp_footer(); ?>
</body>
</html>
