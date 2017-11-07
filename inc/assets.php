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
	wp_enqueue_style( 'chipmunk-styles', THEME_TEMPLATE_URI . '/static/dist/styles/main-min.css', array(), THEME_VERSION );

	// Load Chipmunk main script.
	wp_enqueue_script( 'chipmunk-scripts', THEME_TEMPLATE_URI . '/static/dist/scripts/main-min.js', array(), THEME_VERSION, true );
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
		.content h1,
		.content h2,
		.content h3,
		.content h4,
		.content h5,
		.content h6 {
			font-family: $heading_font;
		}
	";

	if ( $primary_color and $primary_color != '#F38181' ) {
		$custom_style .= "
			.button_primary:hover,
			.button_secondary,
			.content a:hover,
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
			.filter__select ~ .select2-container .select2-dropdown {
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
	wp_enqueue_style( 'chipmunk-admin-styles', THEME_TEMPLATE_URI . '/admin.css', array(), THEME_VERSION );
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
	$site_key = chipmunk_theme_option( 'recaptcha_site_key' );

	if ( $site_key ) {
		wp_enqueue_script( 'chipmunk-recaptcha', '//google.com/recaptcha/api.js?onload=CaptchaCallback&render=explicit', false, null, true );

		wp_add_inline_script( 'chipmunk-recaptcha', "
			var CaptchaCallback = function() {
				if (document.getElementById('submit-recaptcha')) {
					grecaptcha.render('submit-recaptcha', {'sitekey' : '$site_key'});
				}

				if (document.getElementById('register-recaptcha')) {
					grecaptcha.render('register-recaptcha', {'sitekey' : '$site_key'});
				}
			};
		" );
	}
}
endif;
add_action( 'wp_enqueue_scripts', 'chipmunk_external_scripts' );


if ( ! function_exists( 'chipmunk_add_async_attribute' ) ) :
/**
 * Add async attribute to WordPress scripts
 */
function chipmunk_add_async_attribute( $tag, $handle, $src ) {
	// add script handles to the array below
	$scripts = array(
		'defer' => array( 'chipmunk-scripts' ),
		'async' => array( 'chipmunk-recaptcha' ),
	);

	if ( in_array( $handle, $scripts['defer'] ) ) {
		return str_replace( ' src=', ' defer src=', $tag );
	}

	if ( in_array( $handle, $scripts['async'] ) ) {
		return str_replace( ' src=', ' async src=', $tag );
	}

	return $tag;
}
endif;
add_filter( 'script_loader_tag', 'chipmunk_add_async_attribute', 10, 3 );
