<?php
/**
 * Enqueue Chipmunk assets
 *
 * @package WordPress
 * @subpackage Chipmunk
 */

if ( ! function_exists( 'chipmunk_scripts' ) ) :
/**
 * Enqueue front end styles and scripts
 */
function chipmunk_scripts() {
	// Load Chipmunk main stylesheet
	wp_enqueue_style( 'chipmunk-styles', CHIPMUNK_TEMPLATE_URI . '/static/dist/styles/main.min.css', array(), CHIPMUNK_VERSION );

	// Load Chipmunk main script.
	wp_enqueue_script( 'chipmunk-scripts', CHIPMUNK_TEMPLATE_URI . '/static/dist/scripts/main.min.js', array(), CHIPMUNK_VERSION, true );
}
endif;
add_action( 'wp_enqueue_scripts', 'chipmunk_scripts' );


if ( ! function_exists( 'chipmunk_custom_style' ) ) :
/**
 * Enqueue custom CSS styles
 */
function chipmunk_custom_style() {
	$primary_color  = ChipmunkCustomizer::theme_option( 'primary_color' );
	$primary_font   = ChipmunkCustomizer::theme_option( 'primary_font' );
	$custom_css     = ChipmunkCustomizer::theme_option( 'custom_css' );

	$custom_style   = ! empty( $custom_css ) ? $custom_css : '';
	$primary_font   = $primary_font == 'System' ? '-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen, Ubuntu, Cantarell, "Open Sans", "Helvetica Neue", sans-serif' : '"' . str_replace( '+', ' ', $primary_font ) . '"';

	$custom_style .= "
		body {
			font-family: $primary_font;
		}
	";

	if ( $primary_color and $primary_color != '#F38181' ) {
		$custom_style .= "
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
			.resource__description a,
			.section_theme-primary .button_secondary:hover,
			.search-bar__icon:hover,
			.search-bar__close:hover {
				color: $primary_color;
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
				background-color: $primary_color;
			}
		";
	}

	wp_add_inline_style( 'chipmunk-styles', $custom_style );
}
endif;
add_action( 'wp_enqueue_scripts', 'chipmunk_custom_style' );


if ( ! function_exists( 'chipmunk_admin_scripts' ) ) :
/**
 * Enqueue admin end styles and scripts
 */
function chipmunk_admin_scripts() {
	// Load Chipmunk admin stylesheet
	wp_enqueue_style( 'chipmunk-admin-styles', CHIPMUNK_TEMPLATE_URI . '/admin.css', array(), CHIPMUNK_VERSION );
}
endif;
add_action( 'admin_enqueue_scripts', 'chipmunk_admin_scripts' );


if ( ! function_exists( 'chipmunk_google_fonts' ) ) :
/**
 * Enqueue Google Fonts styles
 */
function chipmunk_google_fonts() {
	$primary_font = ChipmunkCustomizer::theme_option( 'primary_font' );

	if ( $primary_font != 'System' ) {
		wp_enqueue_style( 'chipmunk-fonts', chipmunk_get_fonts_url( $primary_font ) );
	}
}
endif;
add_action( 'wp_enqueue_scripts', 'chipmunk_google_fonts' );


if ( ! function_exists( 'chipmunk_external_scripts' ) ) :
/**
 * Enqueue Google Fonts styles
 */
function chipmunk_external_scripts() {
	$recaptcha = ChipmunkCustomizer::theme_option( 'recaptcha_site_key' );

	if ( $recaptcha ) {
		wp_enqueue_script( 'chipmunk-external-recaptcha', '//google.com/recaptcha/api.js', array(), null, true );
	}
}
endif;
add_action( 'wp_enqueue_scripts', 'chipmunk_external_scripts' );
