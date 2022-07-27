<?php

namespace Chipmunk\Core;

use Chipmunk\Theme;
use Chipmunk\Helper\AssetsTrait;
use Chipmunk\Helper\EnqueueTrait;
use Chipmunk\Helper\HelpersTrait;

/**
 * Theme assets
 */
class Assets extends Theme {

	use AssetsTrait;
	use EnqueueTrait;
	use HelpersTrait;

	/**
	 * Class constructor.
	 */
	public function __construct() {}

	/**
	 * Hooks methods of this object into the WordPress ecosystem
	 *
	 * @return void
	 */
	public function initialize(): void {
		$this->addAction( 'wp_enqueue_scripts', [ $this, 'enqueueCustomAssets' ] );
		// $this->addAction( 'wp_enqueue_scripts', [ $this, 'enqueueInlineStyles' ] );
		// $this->addAction( 'wp_enqueue_scripts', [ $this, 'enqueueGoogleFonts' ] );
		// $this->addAction( 'wp_enqueue_scripts', [ $this, 'enqueueExternalScripts' ] );
		$this->addAction( 'admin_enqueue_scripts', [ $this, 'enqueueAdminScripts' ] );
		$this->addFilter( 'script_loader_tag', [ $this, 'addAsyncAttribute' ], 10, 3 );
	}

	/**
	 * Enqueue front end styles and scripts
	 */
	public function enqueueCustomAssets() {
		$this->addStyle( 'chipmunk-styles', 'styles/theme.css' );
		$this->addScript( 'chipmunk-scripts', 'scripts/theme.js' );
	}

	/**
	 * Enqueue custom CSS styles
	 */
	public function enqueueInlineStyles() {
		global $post;

		$primaryFont     = Helpers::getOption( 'primary_font' );
		$headingFont     = Helpers::getOption( 'heading_font' );
		$primaryColor    = Helpers::getOption( 'primary_color' );
		$linkColor       = Helpers::getOption( 'link_color' );
		$backgroundColor = Helpers::getOption( 'background_color' );
		$sectionColor    = Helpers::getOption( 'section_color' );
		$contentSize     = Helpers::getOption( 'content_size' );
		$customCss       = Helpers::getOption( 'custom_css' );
		$logoHeight      = Helpers::getOption( 'logo_height' );
		$disableBorders  = Helpers::getOption( 'disable_section_borders' );
		$customStyle     = ( ! empty( $customCss ) ) ? $customCss : '';
		$primaryFont     = ( ! empty( $primaryFont ) && $primaryFont != 'System' ) ? str_replace( '+', ' ', $primaryFont ) : '';
		$headingFont     = ( ! empty( $headingFont ) && $headingFont != 'System' ) ? str_replace( '+', ' ', $headingFont ) : '';
		$contentWidth    = ( ! empty( $post ) ) ? get_field( $this->getThemeSlug( 'page_content_width' ), $post->ID ) : Helpers::getOption( 'content_width' );

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

		$this->addInlineStyle( 'chipmunk-styles', $customStyle );
	}

	/**
	 * Enqueue Google Fonts styles
	 */
	public function enqueueGoogleFonts() {
		$fonts = [];

		$primaryFont = Helpers::getOption( 'primary_font' );
		$headingFont = Helpers::getOption( 'heading_font' );

		if ( ! empty( $primaryFont ) && $primaryFont !== 'System' ) {
			$fonts[] = $primaryFont;
		}

		if ( ! empty( $headingFont ) && $headingFont !== 'System' ) {
			$fonts[] = $headingFont;
		}

		if ( ! empty( $fonts ) ) {
			$this->addStyle( 'chipmunk-fonts', Helpers::getGoogleFontsUrl( $fonts ) );
		}
	}

	/**
	 * Enqueue external scripts
	 */
	public function enqueueExternalScripts() {
		$enabled = Helpers::getOption( 'recaptcha_enabled' );
		$siteKey = Helpers::getOption( 'recaptcha_site_key' );

		if ( $enabled && $siteKey ) {
			$this->addScript( 'chipmunk-recaptcha', 'https://google.com/recaptcha/api.js?onload=CaptchaCallback&render=explicit', false, null, true );

			$this->addInlineScript(
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
	 * Enqueue admin end styles and scripts
	 */
	public function enqueueAdminScripts() {
		$this->addStyle( 'chipmunk-admin-styles', 'styles/admin.css' );
	}

	/**
	 * Add async attribute to WordPress scripts
	 *
	 * @param string $tag    The <script> tag for the enqueued script.
	 * @param string $handle The script's registered handle.
	 * @param string $src    The script's source URL.
	 *
	 * @return string
	 */
	public function addAsyncAttribute( string $tag, string $handle, string $src ): string {
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
