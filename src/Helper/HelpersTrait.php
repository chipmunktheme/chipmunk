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
	 * @param string $slug      A slug to generate
	 * @param string $separator Separator used to generate the final slug
	 *
	 * @return string
	 */
	public function getThemeSlug( string $slug, string $separator = '_' ): string {
		return join( $separator, [ config()->getSlug(), $slug ] );
	}
}
