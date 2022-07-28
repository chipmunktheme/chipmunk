<?php

namespace Chipmunk\Helper;

use Piotrkulpinski\Framework\Helper\HelperTrait;

/**
 * Provides methods related to taxonomies
 */
trait TaxonomyTrait {

	use HelperTrait;

	/**
	 * Recursively get taxonomy and its children
	 *
	 * @param string $taxonomy Taxonomy name
	 * @param array  $args     A list of args used to query taxonomy
	 * @param int    $parent   ID of a taxonomy parent to query from
	 *
	 * @return ?array
	 */
	public function getTaxonomyHierarchy( string $taxonomy, array $args = [], int $parent = 0 ): ?array {
		$children = [];
		$taxonomy = is_array( $taxonomy ) ? array_shift( $taxonomy ) : $taxonomy;

		$terms = get_terms( $taxonomy, wp_parse_args( $args, [ 'parent' => $parent ] ) );

		if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
			foreach ( $terms as $term ) {
				$term->children = $this->getTaxonomyHierarchy( $taxonomy, $args, $term->term_id );

				$children[ $term->term_id ] = $term;
			}

			return $children;
		}

		return null;
	}

	/**
	 * Recursively returns taxonomy options
	 *
	 * @param string $taxonomy  Taxonomy name
	 * @param array  $terms  Term list
	 * @param int    $lever    Current level of the recursive call
	 *
	 * @return string
	 */
	public function getTermOptions( string $taxonomy, array $terms = [], int $level = 0 ): string {
		$output = '';

		if ( empty( $terms ) ) {
			$terms = $this->getTaxonomyHierarchy( $taxonomy );
		}

		foreach ( $terms as $term ) {
			$output .= '<option value="' . $term->name . '">' . str_repeat( '&horbar;', $level ) . ( $level ? '&nbsp;' : '' ) . $term->name . '</option>';

			if ( $term->children ) {
				$output .= $this->getTermOptions( $taxonomy, $term->children, $level + 1 );
			}
		}

		return $output;
	}

	/**
	 * Conditionally returns post terms
	 *
	 * @param array $terms  Terms list
	 * @param array $args   Argument list
	 *
	 * @return string
	 */
	public function getTermList( array $terms, array $args = [] ): string {
		$args = wp_parse_args(
			$args,
			[
				'type'     => 'link',
				'quantity' => -1,
			]
		);

		$output = '';

		// Max length of post term (set 0 to display full term)
		$termMaxLength = apply_filters( 'chipmunk_term_max_length', 25 );

		if ( $args['quantity'] > 0 && $args['quantity'] < count( $terms ) && apply_filters( 'chipmunk_shuffle_terms', false ) ) {
			shuffle( $terms );
		}

		foreach ( $terms as $key => $term ) {
			if ( $args['quantity'] < 0 || $args['quantity'] > $key ) {
				if ( $args['type'] == 'link' ) {
					$output .= '<a href="' . esc_url( get_term_link( $term->term_id ) ) . '">' . esc_html( $this->truncateString( $term->name, $termMaxLength ) ) . '</a>';
				}

				if ( $args['type'] == 'text' ) {
					$output .= '<span>' . esc_html( $this->truncateString( $term->name, $termMaxLength ) ) . '</span>';
				}
			}
		}

		return $output;
	}
}
