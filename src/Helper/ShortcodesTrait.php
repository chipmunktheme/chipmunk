<?php

namespace Chipmunk\Helper;

use Timber\Timber;

/**
 * Provides methods to register new shortcodes in the theme
 */
trait ShortcodesTrait {

	/**
	 * Passes its arguments to add_shortcode().
	 *
	 * @param string   $tag
	 * @param callable $callback
	 */
	public function addShortcode( string $tag, callable $callback ) {
		return is_string( $callback )
			? add_shortcode( $tag, [ $this, $callback ] )
			: add_shortcode( $tag, $callback );
	}

	/**
	 * Retrieves shortcode template and passes attributes to it.
	 *
	 * @param string $template
	 * @param array  $atts
	 *
	 * @return string
	 */
	public function getShortcodeTemplate( string $template, array $atts = [] ): string {
		return Timber::compile( $template, array_merge( Timber::context(), $atts ) );
	}
}
