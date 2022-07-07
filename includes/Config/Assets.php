<?php

namespace Chipmunk\Config;

/**
 * Assets config hooks
 *
 * @package WordPress
 * @subpackage Chipmunk
 */
class Assets {

	/**
 	 * Used to register custom hooks
	 */
	function construct() {
		add_filter( 'script_loader_tag', [ $this, 'removeTypeAttr' ], 10, 2 );
		add_filter( 'style_loader_tag', [ $this, 'removeTypeAttr' ], 10, 2 );
		add_filter( 'upload_mimes',  [ $this, 'customMimeTypes' ], 99, 1 );
	}

	/**
	 * Remove type attribute for scripts and styles
	 *
	 * @return string
	 */
	public function removeTypeAttr( $tag ) {
		return preg_replace( "/type=['\"]text\/(javascript|css)['\"]/", '', $tag );
	}

	/**
	* Allow SVG Upload
	*
	* @param $mimes
	*/
	public function customMimeTypes( $mimes ) {
        $mimes['svg'] = 'image/svg+xml';
		$mimes['svgz'] = 'image/svg+xml';
		return $mimes;
	}
}
