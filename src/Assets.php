<?php

namespace Chipmunk;

use Piotrkulpinski\Framework\Handler\ThemeHandler;
use Chipmunk\Helper\AssetsTrait;

/**
 * Timber Templates settigs class
 *
 * Use this class to setup whole Timber related configuration
 *
 * @package Chipmunk
 */
class Assets extends ThemeHandler {

	use AssetsTrait;

	/**
	 * Tempalate class constructor.
	 */
	public function __construct() {
		parent::__construct();
	}

	/**
	 * initialize
	 *
	 * Hooks methods of this object into the WordPress ecosystem
	 *
	 * @return void
	 * @throws HandlerException
	 */
	public function initialize(): void {
		if ( ! $this->isInitialized() ) {
			$this->addAction( 'wp_enqueue_scripts', 'enqueueCustomAssets' );
			$this->addAction( 'wp_enqueue_scripts', 'enqueueInlineStyles' );
			$this->addAction( 'wp_enqueue_scripts', 'enqueueGoogleFonts' );
			$this->addAction( 'wp_enqueue_scripts', 'enqueueExternalScripts' );
			$this->addAction( 'admin_enqueue_scripts', 'enqueueAdminScripts' );
			$this->addFilter( 'script_loader_tag', 'addAsyncAttribute', 10, 3 );
		}
	}

	/**
	 * Enqueue front end styles and scripts
	 */
	protected function enqueueCustomAssets() {
		$this->enqueueStyle( 'chipmunk-styles', 'styles/theme.css' );
		$this->enqueueScript( 'chipmunk-scripts', 'scripts/theme.js' );
	}

	/**
	 * Enqueue custom CSS styles
	 */
	protected function enqueueInlineStyles() {
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
	protected function enqueueGoogleFonts() {
		$fonts = [];

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
	protected function enqueueExternalScripts() {
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
	protected function deregisterBlockStyles() {
		$this->dequeueStyle( 'wp-block-library' );
	}

	/**
	 * Enqueue admin end styles and scripts
	 */
	protected function enqueueAdminScripts() {
		$this->enqueueStyle( 'chipmunk-admin-styles', 'styles/admin.css' );
	}

	/**
	 * Add async attribute to WordPress scripts
	 *
	 * @return string
	 */
	protected function addAsyncAttribute( $tag, $handle, $src ) {
		// add script handles to the array below
		$scripts = [
			'defer' => [ 'chipmunk-scripts' ],
			'async' => [ 'chipmunk-recaptcha' ],
		];

		if ( in_array( $handle, $scripts['defer'], true ) ) {
			return str_replace( ' src=', ' defer src=', $tag );
		}

		if ( in_array( $handle, $scripts['async'], true ) ) {
			return str_replace( ' src=', ' async src=', $tag );
		}

		return $tag;
	}
}
