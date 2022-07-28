<?php

namespace Chipmunk\Helper;

use Piotrkulpinski\Framework\Helper\OptionTrait;
use Piotrkulpinski\Framework\Helper\SelectorTrait;

/**
 * Provides methods related to links
 */
trait LinkTrait {

	use OptionTrait;
	use SelectorTrait;

	/**
	 * Creates an external URL
	 *
	 * @param string $url URL to convert to an external one
	 *
	 * @return string
	 */
	public function getExternalUrl( string $url ): string {
		if ( ! $this->getOption( 'disable_ref' ) ) {
			$title = str_replace( '-', '', sanitize_title( get_bloginfo( 'name' ) ) );

			return add_query_arg( 'ref', $title, $url );
		}

		return $url;
	}

	/**
	 * Creates an external links
	 *
	 * @param string $url   URL to convert to an external one
	 * @param string $title Link content
	 * @param array $atts   A list of HTML attributes to apply
	 *
	 * @return string
	 */
	public function getExternalLink( string $url, string $title, array $atts = [] ): string {
		$atts = wp_parse_args(
			$atts,
			[
				'target' => '_blank',
				'rel'    => $this->getOption( 'disable_nofollow' ) ? null : 'nofollow',
			]
		);

		return '<a href="' . esc_url( $this->getExternalUrl( $url ) ) . '"' . $this->ensureString( $atts ) . '>' . $title . '</a>';
	}
}
