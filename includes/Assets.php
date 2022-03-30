<?php

namespace Chipmunk;

/**
 * Enqueue Chipmunk assets
 *
 * @package WordPress
 * @subpackage Chipmunk
 */
class Assets {

	/**
 	 * Stored manifest JSON file
	 *
	 * @var array
	 */
	public static $manifest = array();

	/**
 	 * Used to register custom hooks
	 *
	 * @return void
	 */
	function __construct() {
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_custom_assets' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_inline_styles' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_google_fonts' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_external_scripts' ) );
		// add_action( 'wp_enqueue_scripts', array( $this, 'deregister_block_styles' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_scripts' ) );
		add_filter( 'script_loader_tag', array( $this, 'add_async_attribute' ), 10, 3 );
	}

	/**
	 * Enqueue front end styles and scripts
	 *
	 * @return void
	 */
	public static function enqueue_custom_assets() {
		// Load Chipmunk main stylesheet
		if ( self::has_file( 'styles/theme.css' ) ) {
			wp_enqueue_style( 'chipmunk-styles', self::revisioned_path( 'styles/theme.css' ) );
		}

		// Load Chipmunk main script
		if ( self::has_file( 'scripts/theme.js' ) ) {
			wp_enqueue_script( 'chipmunk-scripts', self::revisioned_path( 'scripts/theme.js' ) );
		}
	}

	/**
	 * Enqueue custom CSS styles
	 *
	 * @return void
	 */
	public static function enqueue_inline_styles() {
		$primary_font      = Helpers::get_theme_option( 'primary_font' );
		$heading_font      = Helpers::get_theme_option( 'heading_font' );

		$primary_color     = Helpers::get_theme_option( 'primary_color' );
		$link_color        = Helpers::get_theme_option( 'link_color' );
		$background_color  = Helpers::get_theme_option( 'background_color' );
		$section_color     = Helpers::get_theme_option( 'section_color' );
		$content_size      = Helpers::get_theme_option( 'content_size' );
		$custom_css        = Helpers::get_theme_option( 'custom_css' );

		$logo_height       = Helpers::get_theme_option( 'logo_height' );

		$custom_style      = ! empty( $custom_css ) ? $custom_css : '';
		$primary_font      = ( ! empty( $primary_font ) && $primary_font != 'System' ) ? str_replace( '+', ' ', $primary_font ) : '';
		$heading_font      = ( ! empty( $heading_font ) && $heading_font != 'System' ) ? str_replace( '+', ' ', $heading_font ) : '';

		$disable_borders   = Helpers::get_theme_option( 'disable_section_borders' );

		if ( is_page() ) {
			switch ( get_page_template_slug() ) {
				case 'page-full-width.php':
					$content_width = 12;
					break;
				case 'page-wide-width.php':
					$content_width = 10;
					break;
				case 'page-normal-width.php':
					$content_width = 8;
					break;
				case 'page-narrow-width.php':
					$content_width = 6;
					break;
				default:
					$content_width = Helpers::get_theme_option( 'content_width' );
			}
		} else {
			$content_width = Helpers::get_theme_option( 'content_width' );
		}

		$custom_style .= "
			body {
				" . ( ! empty( $primary_font ) ? "--chipmunk--typography--font-family: '$primary_font';" : "" ) . "
				" . ( ! empty( $heading_font ) ? "--chipmunk--typography--heading-font-family: '$heading_font';" : "" ) . "
				--chipmunk--color--primary: $primary_color;
				--chipmunk--color--link: $link_color;
				--chipmunk--color--background: $background_color;
				--chipmunk--color--section: $section_color;
				--chipmunk--typography--content-size: $content_size;
				--chipmunk--layout--content-width: $content_width;
				--chipmunk--border-opacity: " . ( empty( $disable_borders ) ? "0.075" : "0" ) . ";
				--chipmunk--logo-height: " . $logo_height / 10 . "rem;
			}
		";

		wp_add_inline_style( 'chipmunk-styles', $custom_style );
	}

	/**
	 * Enqueue Google Fonts styles
	 *
	 * @return void
	 */
	public static function enqueue_google_fonts() {
		$fonts = array();

		$primary_font = Helpers::get_theme_option( 'primary_font' );
		$heading_font = Helpers::get_theme_option( 'heading_font' );

		if ( ! empty( $primary_font ) && $primary_font != 'System' ) {
			$fonts[] = $primary_font;
		}

		if ( ! empty( $heading_font ) && $heading_font != 'System' ) {
			$fonts[] = $heading_font;
		}

		if ( ! empty( $fonts ) ) {
			wp_enqueue_style( 'chipmunk-fonts', Helpers::get_google_fonts_url( $fonts ) );
		}
	}

	/**
	 * Enqueue external scripts
	 *
	 * @return void
	 */
	public static function enqueue_external_scripts() {
		$enabled = Helpers::get_theme_option( 'recaptcha_enabled' );
		$site_key = Helpers::get_theme_option( 'recaptcha_site_key' );

		if ( $enabled && $site_key ) {
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

	/**
	 * Deregisters theme Gutenberg Block assets.
	 *
	 * @return void
	 */
	public static function deregister_block_styles() {
		wp_dequeue_style( 'wp-block-library' );
	}

	/**
	 * Enqueue admin end styles and scripts
	 *
	 * @return void
	 */
	public static function enqueue_admin_scripts() {
		if ( self::has_file( 'styles/theme.css' ) ) {
			wp_enqueue_style( 'chipmunk-admin-styles', self::revisioned_path( 'styles/admin.css' ) );
		}
	}

	/**
	 * Add async attribute to WordPress scripts
	 *
	 * @return string
	 */
	public static function add_async_attribute( $tag, $handle, $src ) {
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

	/**
	 * Get parsed manifest file content
	 *
	 * @return array
	 */
	private static function get_manifest() {
		if ( empty( self::$manifest ) ) {
			self::init_manifest();
		}

		return self::$manifest;
	}

	/**
	 * Returns the real path of the revisioned file.
	 * based on the manifest file content.
	 *
	 * @param $asset
	 *
	 * @return string
	 */
	public static function revisioned_path( $asset ) {
		$manifest = self::get_manifest();

		if ( ! array_key_exists( $asset, $manifest ) ) {
			return 'FILE-NOT-REVISIONED';
		}

		return sprintf(
			'%s/%s%s',
			THEME_TEMPLATE_URI,
			THEME_DIST_PATH,
			$manifest[ $asset ]
		);
	}

	/**
	 * Returns the real path of the asset file.
	 *
	 * @param $asset
	 *
	 * @return string
	 */
	public static function asset_path( $asset ) {
		return self::revisioned_path( THEME_ASSETS_PATH . $asset );
	}

	/**
	 * Verifies existence of the given file in manifest
	 *
	 * @return bool
	 */
	public static function has_file( $asset ) {
		$manifest = self::get_manifest();

		return array_key_exists( $asset, $manifest );
	}

	/**
	 * Returns the real path of the dist directory.
	 *
	 * @return string
	 */
	public static function get_dist_path() {
		return sprintf( '%s/%s', THEME_TEMPLATE_URI, THEME_DIST_PATH );
	}

	/**
	 * Checks if request is in development environment
	 *
	 * @return boolean
	 */
	public static function is_dev() {
		return defined( 'THEME_DEV_ENV' );
	}

	/**
	 * Loads data from manifest file.
	 */
	private static function init_manifest() {
		$manifest_path = defined( 'THEME_DEV_ENV' )
			? THEME_MANIFEST_DEV_PATH
			: THEME_MANIFEST_PATH;

		if ( file_exists( THEME_TEMPLATE_DIR . "/{$manifest_path}" ) ) {
			self::$manifest = json_decode(
				file_get_contents( THEME_TEMPLATE_DIR . "/{$manifest_path}" ),
				true
			);
		}
	}
}
