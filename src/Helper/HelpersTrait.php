<?php

namespace Chipmunk\Helper;

use function Chipmunk\config;

/**
 * Provides helper methods
 */
trait HelpersTrait {

	/**
	 * Builds a slug based on the theme slug config
	 *
	 * @param string $slug      A slug to generate.
	 * @param string $separator Separator used to generate the final slug.
	 * @param ?string $prefix   String to add to the beginning of slug.
	 * @param ?string $suffix   String to add to the end of slug.
	 *
	 * @return string
	 */
	public function getThemeSlug( string $slug, string $separator = '_', ?string $prefix = null, ?string $suffix = null ): string {
		$segments = [ $prefix, config()->getSlug(), $slug, $suffix ];
		$segments = array_filter( $segments, fn( $value ) => ! is_null( $value ) );

		return join( $separator, $segments );
	}
}
