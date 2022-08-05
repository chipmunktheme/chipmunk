<?php

namespace Chipmunk\Core;

use MadeByLess\Lessi\Helper\AssetTrait;
use MadeByLess\Lessi\Helper\EnqueueTrait;
use MadeByLess\Lessi\Helper\FontTrait;
use MadeByLess\Lessi\Helper\HelperTrait;
use Chipmunk\Theme;

/**
 * Theme assets.
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
	 * Hooks methods of this object into the WordPress ecosystem.
	 */
	public function initialize() {
		$this->addAction( 'wp_enqueue_scripts', [ $this, 'enqueueCustomAssets' ] );
		$this->addAction( 'wp_enqueue_scripts', [ $this, 'enqueueInlineStyles' ] );
		$this->addAction( 'wp_enqueue_scripts', [ $this, 'enqueueGoogleFonts' ] );
		$this->addAction( 'wp_enqueue_scripts', [ $this, 'enqueueExternalScripts' ] );
		$this->addAction( 'admin_enqueue_scripts', [ $this, 'enqueueAdminScripts' ] );
		$this->addFilter( 'script_loader_tag', [ $this, 'addAsyncAttribute' ], 10, 3 );
	}

	/**
	 * Enqueue front end styles and scripts.
	 *
	 * @see https://developer.wordpress.org/reference/hooks/wp_enqueue_scripts
	 */
	public function enqueueCustomAssets() {
		$this->addStyle( $this->buildThemeSlug( 'styles', '-' ), 'styles/theme.css' );
		$this->addScript( $this->buildThemeSlug( 'scripts', '-' ), 'scripts/theme.js', false, null, true );
	}

	/**
	 * Enqueue custom CSS styles.
	 *
	 * @see https://developer.wordpress.org/reference/hooks/wp_enqueue_scripts
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
		$contentWidth    = ( ! empty( $post ) ) ? get_field( $this->buildThemeSlug( 'page_content_width' ), $post->ID ) : $this->getOption( 'content_width' );

		$customStyle  = ( ! empty( $customCss ) ) ? $customCss : '';
		$customStyle .= ! empty( $primaryFont ) ? $this->buildPrefixedThemeSlug( 'typography--font-family', '--' ) . ": $primaryFont" : '';
		$customStyle .= ! empty( $headingFont ) ? $this->buildPrefixedThemeSlug( 'typography--heading-font-family', '--' ) . ": $headingFont" : '';
		$customStyle .= $this->buildPrefixedThemeSlug( 'color--primary', '--' ) . ": $primaryColor";
		$customStyle .= $this->buildPrefixedThemeSlug( 'color--link', '--' ) . ": $linkColor";
		$customStyle .= $this->buildPrefixedThemeSlug( 'color--background', '--' ) . ": $backgroundColor";
		$customStyle .= $this->buildPrefixedThemeSlug( 'color--section', '--' ) . ": $sectionColor";
		$customStyle .= $this->buildPrefixedThemeSlug( 'typography--content-size', '--' ) . ": $contentSize";
		$customStyle .= $this->buildPrefixedThemeSlug( 'layout--content-width', '--' ) . ": $contentWidth";
		$customStyle .= $this->buildPrefixedThemeSlug( 'border-opacity', '--' ) . ': ' . ( empty( $disableBorders ) ? '0.075' : '0' );
		$customStyle .= $this->buildPrefixedThemeSlug( 'logo-height', '--' ) . ': ' . $logoHeight / 10 . 'rem';

		$this->addInlineStyle( $this->buildThemeSlug( 'styles', '-' ), ":root {{$customStyle}}" );
	}

	/**
	 * Enqueue Google Fonts styles.
	 *
	 * @see https://developer.wordpress.org/reference/hooks/wp_enqueue_scripts
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
			$this->addStyle( $this->buildThemeSlug( 'fonts', '-' ), $this->getGoogleFontsUrl( $fonts ) );
		}
	}

	/**
	 * Enqueue external scripts.
	 *
	 * @see https://developer.wordpress.org/reference/hooks/wp_enqueue_scripts
	 */
	public function enqueueExternalScripts() {
		$enabled = $this->getOption( 'recaptcha_enabled' );
		$siteKey = $this->getOption( 'recaptcha_site_key' );

		if ( $enabled && $siteKey ) {
			$this->addScript( $this->buildThemeSlug( 'recaptcha', '-' ), 'https://google.com/recaptcha/api.js?onload=CaptchaCallback&render=explicit', false, null, true );

			$this->addInlineScript(
				$this->buildThemeSlug( 'recaptcha', '-' ),
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
	 * Enqueue admin end styles and scripts.
	 *
	 * @see https://developer.wordpress.org/reference/hooks/admin_enqueue_scripts
	 */
	public function enqueueAdminScripts() {
		$this->addStyle( $this->buildThemeSlug( 'admin-styles', '-' ), 'styles/admin.css' );
	}

	/**
	 * Add async attribute to WordPress scripts.
	 *
	 * @see https://developer.wordpress.org/reference/hooks/script_loader_tag
	 *
	 * @param string $tag    The <script> tag for the enqueued script.
	 * @param string $handle The script's registered handle.
	 * @param string $src    The script's source URL.
	 *
	 * @return string
	 */
	public function addAsyncAttribute( string $tag, string $handle, string $src ): string {
		$scripts = [
			'defer' => [ $this->buildThemeSlug( 'scripts', '-' ) ],
			'async' => [ $this->buildThemeSlug( 'recaptcha', '-' ) ],
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
