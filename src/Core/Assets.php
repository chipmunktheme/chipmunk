<?php

namespace Chipmunk\Core;

use Piotrkulpinski\Framework\Helper\AssetTrait;
use Piotrkulpinski\Framework\Helper\EnqueueTrait;
use Piotrkulpinski\Framework\Helper\FontTrait;
use Piotrkulpinski\Framework\Helper\HelperTrait;
use Chipmunk\Theme;

/**
 * Theme assets
 */
class Assets extends Theme {

	use AssetTrait;
	use FontTrait;
	use EnqueueTrait;
	use HelperTrait;

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

		$primaryFont     = $this->getOption( 'primary_font' );
		$headingFont     = $this->getOption( 'heading_font' );
		$primaryColor    = $this->getOption( 'primary_color' );
		$linkColor       = $this->getOption( 'link_color' );
		$backgroundColor = $this->getOption( 'background_color' );
		$sectionColor    = $this->getOption( 'section_color' );
		$contentSize     = $this->getOption( 'content_size' );
		$customCss       = $this->getOption( 'custom_css' );
		$logoHeight      = $this->getOption( 'logo_height' );
		$disableBorders  = $this->getOption( 'disable_section_borders' );
		$primaryFont     = ( ! empty( $primaryFont ) && $primaryFont !== 'System' ) ? str_replace( '+', ' ', $primaryFont ) : '';
		$headingFont     = ( ! empty( $headingFont ) && $headingFont !== 'System' ) ? str_replace( '+', ' ', $headingFont ) : '';
		$contentWidth    = ( ! empty( $post ) ) ? get_field( $this->getThemeSlug( 'page_content_width' ), $post->ID ) : $this->getOption( 'content_width' );

		$customStyle  = ( ! empty( $customCss ) ) ? $customCss : '';
		$customStyle .= ! empty( $primaryFont ) ? $this->getThemeSlug( [ '', 'typography--font-family' ], '--', 1 ) . ": $primaryFont" : '';
		$customStyle .= ! empty( $headingFont ) ? $this->getThemeSlug( [ '', 'typography--heading-font-family' ], '--', 1 ) . ": $headingFont" : '';
		$customStyle .= $this->getThemeSlug( [ '', 'color--primary' ], '--', 1 ) . ": $primaryColor";
		$customStyle .= $this->getThemeSlug( [ '', 'color--link' ], '--', 1 ) . ": $linkColor";
		$customStyle .= $this->getThemeSlug( [ '', 'color--background' ], '--', 1 ) . ": $backgroundColor";
		$customStyle .= $this->getThemeSlug( [ '', 'color--section' ], '--', 1 ) . ": $sectionColor";
		$customStyle .= $this->getThemeSlug( [ '', 'typography--content-size' ], '--', 1 ) . ": $contentSize";
		$customStyle .= $this->getThemeSlug( [ '', 'layout--content-width' ], '--', 1 ) . ": $contentWidth";
		$customStyle .= $this->getThemeSlug( [ '', 'border-opacity' ], '--', 1 ) . ': ' . ( empty( $disableBorders ) ? '0.075' : '0' );
		$customStyle .= $this->getThemeSlug( [ '', 'logo-height' ], '--', 1 ) . ': ' . $logoHeight / 10 . 'rem';

		$this->addInlineStyle( 'chipmunk-styles', ":root {{$customStyle}}" );
	}

	/**
	 * Enqueue Google Fonts styles
	 */
	public function enqueueGoogleFonts() {
		$fonts = [];

		$primaryFont = $this->getOption( 'primary_font' );
		$headingFont = $this->getOption( 'heading_font' );

		if ( ! empty( $primaryFont ) && $primaryFont !== 'System' ) {
			$fonts[] = $primaryFont;
		}

		if ( ! empty( $headingFont ) && $headingFont !== 'System' ) {
			$fonts[] = $headingFont;
		}

		if ( ! empty( $fonts ) ) {
			$this->addStyle( 'chipmunk-fonts', $this->getGoogleFontsUrl( $fonts ) );
		}
	}

	/**
	 * Enqueue external scripts
	 */
	public function enqueueExternalScripts() {
		$enabled = $this->getOption( 'recaptcha_enabled' );
		$siteKey = $this->getOption( 'recaptcha_site_key' );

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
