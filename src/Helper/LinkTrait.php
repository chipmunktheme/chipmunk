<?php

namespace Chipmunk\Helper;

use MadeByLess\Lessi\Helper\HelperTrait;
use MadeByLess\Lessi\Helper\SelectorTrait;
use Chipmunk\Helper\OptionTrait;

/**
 * Provides methods related to links
 */
trait LinkTrait {
	use HelperTrait;
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

	/**
	 * Get resource links
	 *
	 * @param int $postId ID of the resource
	 *
	 * @return array
	 */
	public function getResourceLinks( int $postId ): array {
		$links = [];

		$metaWebsite = get_post_meta( $postId, $this->buildPrefixedThemeSlug( [ 'resource', 'website' ] ), true );
		$metaLinks   = get_field( $this->buildPrefixedThemeSlug( [ 'resource', 'links' ] ), $postId );

		if ( ! empty( $metaWebsite ) ) {
			$links[] = [
				'title'  => $this->applyFilter( 'submission_website_label', __( 'Visit website', 'chipmunk' ) ),
				'url'    => $metaWebsite,
				'target' => '_blank',
			];
		}

		if ( ! empty( $metaLinks ) ) {
			$links = array_merge( $links, array_column( $metaLinks, 'link' ) );
		}

		return $links;
	}
}
