<?php

namespace Chipmunk\Config;

use WP_Query;
use Chipmunk\Helpers;

/**
 * Query config hooks
 *
 * @package WordPress
 * @subpackage Chipmunk
 */
class Query {

	/**
 	 * Used to register custom hooks
	 */
	function __construct() {
		add_filter( 'pre_get_posts', [ $this, 'updatePerPageParams' ] );
		add_filter( 'pre_get_posts', [ $this, 'updateSearchParams' ] );
		add_filter( 'pre_get_posts', [ $this, 'updateAuthorParams' ] );
		add_filter( 'pre_get_posts', [ $this, 'updateRelatedParams' ] );
		add_filter( 'pre_get_posts', [ $this, 'updateOrderbyParams' ] );
		add_filter( 'pre_get_posts', [ $this, 'excludeTaxChildren' ] );
	}

	/**
	 * Update results per page for different queries
	 *
	 * @param WP_Query $query
	 *
	 * @return WP_Query
	 */
	public function updatePerPageParams( $query ) {
		// Don't change the value it has been already set
		if ( is_admin() || $query->get( 'posts_per_page' ) ) {
			return $query;
		}

		// Related
		if ( $query->get( 'related' ) ) {
			$query->set( 'posts_per_page', apply_filters( 'chipmunk_related_resources_count', 3 ) );

			return $query;
		}

		// Latest
		if ( $query->get( 'latest' ) ) {
			$query->set( 'posts_per_page', apply_filters( 'chipmunk_latest_posts_count', 3 ) );

			return $query;
		}

		// Search results
		if ( $query->is_search ) {
			$query->set( 'posts_per_page', Helpers::getOption( 'results_per_page' ) );

			return $query;
		}

		// Posts
		if ( $this->isQueryForPostType( $query, 'post' ) ) {
			$query->set( 'posts_per_page', Helpers::getOption( 'posts_per_page' ) );

			return $query;
		}

		// Resources
		if ( $this->isQueryForPostType( $query, 'resource' ) ) {
			$query->set( 'posts_per_page', Helpers::getOption( 'resources_per_page' ) );

			return $query;
		}

		return $query;
	}

	/**
	 * Update search params to include resources
	 *
	 * @param WP_Query $query
	 *
	 * @return WP_Query
	 */
	public function updateSearchParams( $query ) {
		if ( is_admin() || ! $query->is_search ) {
			return $query;
		}

		// Include resources
		$query->set( 'post_type', [ 'post', 'resource' ] );

		// Include only published posts
		$query->set( 'post_status', [ 'publish' ] );

		return $query;
	}

	/**
	 * Update author params to only include resources
	 *
	 * @param WP_Query $query
	 *
	 * @return WP_Query
	 */
	public function updateAuthorParams( $query ) {
		if ( is_admin() || ! $query->is_author ) {
			return $query;
		}

		$query->set( 'post_type', 'resource' );

		return $query;
	}

	/**
	 * Update orderby params
	 *
	 * @param WP_Query $query
	 *
	 * @return WP_Query
	 */
	public function updateRelatedParams( $query ) {
		global $post;

		if ( is_admin() || ! $query->get( 'related' ) or empty( $post ) ) {
			return $query;
		}

		$taxQuery = [];

		foreach ( get_object_taxonomies( get_post( $post->ID ), 'names' ) as $taxonomy ) {
			$terms = get_the_terms( $post->ID, $taxonomy );

			if ( ! empty( $terms ) ) {
				$taxQuery[] = [
					'taxonomy'    => $taxonomy,
					'field'       => 'term_id',
					'terms'       => array_column( $terms, 'term_id' ),
					'operator'    => 'IN',
				];
			};
		}

		if ( ! empty( $taxQuery ) && count( $taxQuery ) > 1 ) {
			$taxQuery['relation'] = 'OR';
		}

		$query->set( 'tax_query', $taxQuery );

		return $query;
	}

	/**
	 * Update orderby params for resources
	 *
	 * @param WP_Query $query
	 *
	 * @return WP_Query
	 */
	public function updateOrderbyParams( $query ) {
		if ( is_admin() || ! $this->isQueryForPostType( $query, 'resource' ) ) {
			return $query;
		}

		// TODO: Check if the custom ordering is working
		$customOrderby = [
			'views' 	=> '_' . THEME_SLUG . '_post_view_count',
			'upvotes' 	=> '_' . THEME_SLUG . '_upvote_count',
			'ratings' 	=> '_' . THEME_SLUG . '_rating_rank',
		];

		$orderby = $query->get( 'orderby' ) ?: Helpers::getOption( 'default_resource_orderby' );
		$order = $query->get( 'order' ) ?: Helpers::getOption( 'default_resource_order' );

		if ( array_key_exists( $orderby, $customOrderby ) ) {
			$query->set( 'meta_key', $customOrderby[ $orderby ] );
			$query->set( 'orderby', 'meta_value_num date' );
			$query->set( 'order', 'DESC' );
		} else {
			$query->set( 'orderby', $orderby );
			$query->set( 'order', $order );
		}

		return $query;
	}

	/**
	 * Exclude children from taxonomy listing for resources
	 *
	 * @param WP_Query $query
	 *
	 * @return WP_Query
	 */
	public function excludeTaxChildren( $query ) {
		if ( is_admin() || ! $this->isQueryForPostType( $query, 'resource' ) || empty( $query->query_vars['resource-collection'] ) ) {
			return $query;
		}

		$query->set( 'tax_query', [ [
			'taxonomy'          => 'resource-collection',
			'field'             => 'slug',
			'terms'             => $query->query_vars['resource-collection'],
			'include_children'  => false,
		] ] );

		return $query;
	}

	/**
	 * Checks if current query is quering given post type
	 *
	 * @param WP_Query $query
	 * @param string $postType
	 *
	 * @return bool
	 */
	private function isQueryForPostType( $query, $postType ) {
		if ( $postType == 'post' ) {
			if ( $query->is_posts_page || $query->is_date ) {
				return true;
			}

			if ( $query->get( 'category_name' ) ) {
				return true;
			}

			if ( $query->get( 'tag' ) ) {
				return true;
			}
		}

		if ( $postType == 'resource' ) {
			if ( $query->is_author ) {
				return true;
			}

			if ( $query->get( 'resource-collection' ) ) {
				return true;
			}

			if ( $query->get( 'resource-tag' ) ) {
				return true;
			}
		}

		return $query->get( 'post_type' ) == $postType;
	}
}
