<?php
$primary_color  = ChipmunkCustomizer::theme_option( 'primary_color' );
$primary_font   = ChipmunkCustomizer::theme_option( 'primary_font' );
$custom_css     = ChipmunkCustomizer::theme_option( 'custom_css' );
?>

<style type="text/css">
	body {
		<?php if ( $primary_font == 'System' ) : ?>
			font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen, Ubuntu, Cantarell, "Open Sans", "Helvetica Neue", sans-serif;
		<?php else : ?>
			font-family: "<?php echo str_replace( '+', ' ', $primary_font ); ?>", "Helvetica Neue", Helvetica, Arial, sans-serif;
		<?php endif; ?>
	}

	<?php if ( $primary_color and $primary_color != '#F38181' ) : ?>
		.button_primary:hover,
		.button_secondary,
		.entry__content a:hover,
		.nav-primary__close:hover,
		.nav-socials__item a:hover,
		.page-head__logo,
		.pagination__item a:hover,
		.popup__close:hover,
		.popup__close:hover,
		.popup__close:hover,
		.section_theme-primary .button_secondary:hover,
		.search-bar__icon:hover,
		.search-bar__close:hover {
			color: <?php echo $primary_color; ?>;
		}

		.select2-container .select2-results__option[aria-selected=true],
		.button_primary,
		.button_secondary:hover,
		.entry[href]:hover .entry__button,
		.section_theme-primary,
		.stats__button.is-active,
		.stats__button.is-loading.is-active::before,
		.tile__content_primary,
		.tile:hover .tile__button {
			background-color: <?php echo $primary_color; ?>;
		}
	<?php endif; ?>

	<?php if ( $custom_css ) : ?>
		<?php echo $custom_css; ?>
	<?php endif; ?>
</style>
