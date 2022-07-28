<?php

namespace Chipmunk\Config;

use Chipmunk\Theme;

/**
 * Assets config hooks.
 */
class Assets extends Theme {

	/**
	 * Class constructor.
	 */
	public function __construct() {}

	/**
	 * Hooks methods of this object into the WordPress ecosystem.
	 */
	public function initialize() {
		$this->addFilter( 'script_loader_tag', [ $this, 'removeTypeAttr' ], 10, 2 );
		$this->addFilter( 'style_loader_tag', [ $this, 'removeTypeAttr' ], 10, 2 );
		$this->addFilter( 'upload_mimes', [ $this, 'customMimeTypes' ], 99, 1 );
	}

	/**
	 * Removes type attribute for scripts and styles.
	 *
	 * @see https://developer.wordpress.org/reference/hooks/script_loader_tag
	 * @see https://developer.wordpress.org/reference/hooks/style_loader_tag
	 *
	 * @param string $tag
	 */
	public function removeTypeAttr( string $tag ): string {
		return preg_replace( "/type=['\"]text\/(javascript|css)['\"]/", '', $tag );
	}

	/**
	 * Allows SVG Upload.
	 *
	 * @see https://developer.wordpress.org/reference/hooks/upload_mimes
	 *
	 * @param array $mimes
	 */
	public function customMimeTypes( array $mimes ): array {
		$mimes['svg']  = 'image/svg+xml';
		$mimes['svgz'] = 'image/svg+xml';
		return $mimes;
	}
}
