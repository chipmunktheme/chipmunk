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
		$section_color_rgb = chipmunk_hex_to_rgb( $section_color, true );

		$primary_font      = chipmunk_theme_option( 'primary_font' );
		$heading_font      = chipmunk_theme_option( 'heading_font' );
		$custom_css        = chipmunk_theme_option( 'custom_css' );

		$custom_style      = ! empty( $custom_css ) ? $custom_css : '';
		$primary_font      = $primary_font == 'System' ? '-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen, Ubuntu, Cantarell, "Open Sans", "Helvetica Neue", sans-serif' : '"' . str_replace( '+', ' ', $primary_font ) . '"';
		$heading_font      = $heading_font == 'System' ? '-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen, Ubuntu, Cantarell, "Open Sans", "Helvetica Neue", sans-serif' : '"' . str_replace( '+', ' ', $heading_font ) . '"';

		$disable_borders   = chipmunk_theme_option( 'disable_section_borders' );

		if ( ! empty( $primary_font ) ) {
			$custom_style .= "
				:root {
					--font-primary: $primary_font;
					--font-heading: $heading_font;

					--color-primary: $primary_color;
					--color-background: $background_color;
					--color-section: $section_color;
				}

				.tile--card:not(.tile--blank)[href]:hover {
					background-color: rgba($section_color_rgb, 0.5);
				}
			";
		}

		if ( ! empty( $disable_borders ) ) {
			$custom_style .= "
				.page-head,
				.search-bar,
				.section--theme-light {
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


if ( ! function_exists( 'chipmunk_deregister_block_styles' ) ) :
	/**
	 * Deregisters theme Gutenberg Block assets.
	 *
	 * @return void
	 */
	function chipmunk_deregister_block_styles() {
		wp_dequeue_style( 'wp-block-library' );
	}
endif;
add_action( 'wp_enqueue_scripts', 'chipmunk_deregister_block_styles' );


if ( ! function_exists( 'chipmunk_google_fonts' ) ) :
	/**
	 * Enqueue Google Fonts styles
	 */
	function chipmunk_google_fonts() {
		$fonts = array();

		$primary_font = chipmunk_theme_option( 'primary_font' );
		$heading_font = chipmunk_theme_option( 'heading_font' );

		if ( ! empty( $primary_font ) && $primary_font != 'System' ) {
			$fonts[] = $primary_font;
		}

		if ( ! empty( $heading_font ) && $heading_font != 'System' ) {
			$fonts[] = $heading_font;
		}

		if ( ! empty( $fonts ) ) {
			wp_enqueue_style( 'chipmunk-fonts', chipmunk_get_fonts_url( $fonts ) );
		}
	}
endif;
add_action( 'wp_enqueue_scripts', 'chipmunk_google_fonts' );


if ( ! function_exists( 'chipmunk_external_scripts' ) ) :
	/**
	 * Enqueue Google Fonts styles
	 */
	function chipmunk_external_scripts() {
		$enabled = chipmunk_theme_option( 'recaptcha_enabled' );
		$site_key = chipmunk_theme_option( 'recaptcha_site_key' );

		if ( $enabled and $site_key ) {
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
