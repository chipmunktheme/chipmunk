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
	 */
	function __construct() {
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueueCustomAssets' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueueInlineStyles' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueueGoogleFonts' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueueExternalScripts' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueueAdminScripts' ) );
		add_filter( 'script_loader_tag', array( $this, 'addAsyncAttribute' ), 10, 3 );
	}

	/**
	 * Enqueue front end styles and scripts
	 */
	public static function enqueueCustomAssets() {
		// Load Chipmunk main stylesheet
		if ( self::hasFile( 'styles/theme.css' ) ) {
			wp_enqueue_style( 'chipmunk-styles', self::revisionedPath( 'styles/theme.css' ) );
		}

		// Load Chipmunk main script
		if ( self::hasFile( 'scripts/theme.js' ) ) {
			wp_enqueue_script( 'chipmunk-scripts', self::revisionedPath( 'scripts/theme.js' ) );
		}
	}

	/**
	 * Enqueue custom CSS styles
	 */
	public static function enqueueInlineStyles() {
		global $post;

		$primaryFont = Helpers::getOption( 'primary_font' );
		$headingFont = Helpers::getOption( 'heading_font' );

		$primaryColor    = Helpers::getOption( 'primary_color' );
		$linkColor       = Helpers::getOption( 'link_color' );
		$backgroundColor = Helpers::getOption( 'background_color' );
		$sectionColor    = Helpers::getOption( 'section_color' );
		$contentSize     = Helpers::getOption( 'content_size' );
		$customCss       = Helpers::getOption( 'custom_css' );

		$logoHeight = Helpers::getOption( 'logo_height' );

		$customStyle = ! empty( $customCss ) ? $customCss : '';
		$primaryFont = ( ! empty( $primaryFont ) && $primaryFont != 'System' ) ? str_replace( '+', ' ', $primaryFont ) : '';
		$headingFont = ( ! empty( $headingFont ) && $headingFont != 'System' ) ? str_replace( '+', ' ', $headingFont ) : '';

		$disableBorders = Helpers::getOption( 'disable_section_borders' );
		$contentWidth   = isset( $post ) ? get_field( '_' . THEME_SLUG . '_page_content_width', $post->ID ) : Helpers::getOption( 'content_width' );

		$customStyle .= '
			body {
				' . ( ! empty( $primaryFont ) ? "--chipmunk--typography--font-family: '$primaryFont';" : '' ) . '
				' . ( ! empty( $headingFont ) ? "--chipmunk--typography--heading-font-family: '$headingFont';" : '' ) . "
				--chipmunk--color--primary: $primaryColor;
				--chipmunk--color--link: $linkColor;
				--chipmunk--color--background: $backgroundColor;
				--chipmunk--color--section: $sectionColor;
				--chipmunk--typography--content-size: $contentSize;
				--chipmunk--layout--content-width: $contentWidth;
				--chipmunk--border-opacity: " . ( empty( $disableBorders ) ? '0.075' : '0' ) . ';
				--chipmunk--logo-height: ' . $logoHeight / 10 . 'rem;
			}
		';

		wp_add_inline_style( 'chipmunk-styles', $customStyle );
	}

	/**
	 * Enqueue Google Fonts styles
	 */
	public static function enqueueGoogleFonts() {
		$fonts = array();

		$primaryFont = Helpers::getOption( 'primary_font' );
		$headingFont = Helpers::getOption( 'heading_font' );

		if ( ! empty( $primaryFont ) && $primaryFont != 'System' ) {
			$fonts[] = $primaryFont;
		}

		if ( ! empty( $headingFont ) && $headingFont != 'System' ) {
			$fonts[] = $headingFont;
		}

		if ( ! empty( $fonts ) ) {
			wp_enqueue_style( 'chipmunk-fonts', Helpers::getGoogleFontsUrl( $fonts ) );
		}
	}

	/**
	 * Enqueue external scripts
	 */
	public static function enqueueExternalScripts() {
		$enabled = Helpers::getOption( 'recaptcha_enabled' );
		$siteKey = Helpers::getOption( 'recaptcha_site_key' );

		if ( $enabled && $siteKey ) {
			wp_enqueue_script( 'chipmunk-recaptcha', '//google.com/recaptcha/api.js?onload=CaptchaCallback&render=explicit', false, null, true );

			wp_add_inline_script(
				'chipmunk-recaptcha',
				"
				var CaptchaCallback = function() {
					if (document.getElementById('submit-recaptcha')) {
						grecaptcha.render('submit-recaptcha', {'sitekey' : '$siteKey'});
					}

					if (document.getElementById('register-recaptcha')) {
						grecaptcha.render('register-recaptcha', {'sitekey' : '$siteKey'});
					}
				};
			"
			);
		}
	}

	/**
	 * Deregisters theme Gutenberg Block assets.
	 */
	public static function deregisterBlockStyles() {
		wp_dequeue_style( 'wp-block-library' );
	}

	/**
	 * Enqueue admin end styles and scripts
	 */
	public static function enqueueAdminScripts() {
		if ( self::hasFile( 'styles/theme.css' ) ) {
			wp_enqueue_style( 'chipmunk-admin-styles', self::revisionedPath( 'styles/admin.css' ) );
		}
	}

	/**
	 * Add async attribute to WordPress scripts
	 *
	 * @return string
	 */
	public static function addAsyncAttribute( $tag, $handle, $src ) {
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
	private static function getManifest() {
		if ( empty( self::$manifest ) ) {
			self::initManifest();
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
	public static function revisionedPath( $asset ) {
		$manifest = self::getManifest();

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
	public static function assetPath( $asset ) {
		return self::revisionedPath( THEME_ASSETS_PATH . $asset );
	}

	/**
	 * Verifies existence of the given file in manifest
	 *
	 * @return bool
	 */
	public static function hasFile( $asset ) {
		$manifest = self::getManifest();

		return array_key_exists( $asset, $manifest );
	}

	/**
	 * Returns the real path of the dist directory.
	 *
	 * @return string
	 */
	public static function getDistPath() {
		return sprintf( '%s/%s', THEME_TEMPLATE_URI, THEME_DIST_PATH );
	}

	/**
	 * Checks if request is in development environment
	 *
	 * @return boolean
	 */
	public static function isDev() {
		return defined( 'THEME_DEV_ENV' );
	}

	/**
	 * Loads data from manifest file.
	 */
	private static function initManifest() {
		$manifestPath = defined( 'THEME_DEV_ENV' )
			? THEME_MANIFEST_DEV_PATH
			: THEME_MANIFEST_PATH;

		if ( file_exists( THEME_TEMPLATE_DIR . "/{$manifestPath}" ) ) {
			self::$manifest = json_decode(
				file_get_contents( THEME_TEMPLATE_DIR . "/{$manifestPath}" ),
				true
			);
		}
	}
}
