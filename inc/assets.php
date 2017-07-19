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
	$primary_color     = chipmunk_theme_option( 'primary_color' );
	$background_color  = chipmunk_theme_option( 'background_color' );
	$section_color     = chipmunk_theme_option( 'section_color' );
	$section_color_rgb = implode( ', ', chipmunk_hex_to_rgb( $section_color ) );
	
	$primary_font      = chipmunk_theme_option( 'primary_font' );
	$heading_font      = chipmunk_theme_option( 'heading_font' );
	$custom_css        = chipmunk_theme_option( 'custom_css' );

	$custom_style      = ! empty( $custom_css ) ? $custom_css : '';
	$primary_font      = $primary_font == 'System' ? '-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen, Ubuntu, Cantarell, "Open Sans", "Helvetica Neue", sans-serif' : '"' . str_replace( '+', ' ', $primary_font ) . '"';
	$heading_font      = $heading_font == 'System' ? '-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen, Ubuntu, Cantarell, "Open Sans", "Helvetica Neue", sans-serif' : '"' . str_replace( '+', ' ', $heading_font ) . '"';
	
	$disable_borders   = chipmunk_theme_option( 'disable_section_borders' );

	$custom_style .= "
		body {
			font-family: $primary_font;
		}
		
		.heading:not(.heading_thin),
		.card__title,
		.tile__title,
		.section__title,
		.entry__content h1,
		.entry__content h2,
		.entry__content h3,
		.entry__content h4,
		.entry__content h5,
		.entry__content h6 {
			font-family: $heading_font;
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
			.tile__content_primary,
			.tile:hover .tile__button {
				background-color: $primary_color;
			}
			
			body,
			.sort__select ~ .select2-container .select2-dropdown {
				background-color: $background_color;
			}
			
			.page-head,
			.search-bar,
			.section_theme-light,
			.popup__content,
			.tile_card:not(.tile_blank),
			.select2-container .select2-dropdown {
				background-color: $section_color;
			}
			
			.tile_card:not(.tile_blank):hover {
				background-color: rgba($section_color_rgb, 0.5);
			}
		";
	}

	if ( $disable_borders ) {
		$custom_style .= "
			.page-head,
			.search-bar,
			.section_theme-light {
				box-shadow: none;
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
	$font_names = array();
	$primary_font = chipmunk_theme_option( 'primary_font' );
	$heading_font = chipmunk_theme_option( 'heading_font' );

	if ( ! empty( $primary_font ) && $primary_font != 'System' ) {
		$font_names[] = $primary_font;
	}

	if ( ! empty( $heading_font ) && $heading_font != 'System' ) {
		$font_names[] = $heading_font;
	}
	
	if ( ! empty( $font_names ) ) {
		wp_enqueue_style( 'chipmunk-fonts', chipmunk_get_fonts_url( $font_names ) );
	}
}
endif;
add_action( 'wp_enqueue_scripts', 'chipmunk_google_fonts' );


if ( ! function_exists( 'chipmunk_external_scripts' ) ) :
/**
 * Enqueue Google Fonts styles
 */
function chipmunk_external_scripts() {
	$recaptcha = chipmunk_theme_option( 'recaptcha_site_key' );

	if ( $recaptcha ) {
		wp_enqueue_script( 'chipmunk-external-recaptcha', '//google.com/recaptcha/api.js' );
	}
}
endif;
add_action( 'wp_enqueue_scripts', 'chipmunk_external_scripts' );
