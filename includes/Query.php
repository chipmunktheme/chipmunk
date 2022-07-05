<?php

namespace Chipmunk;

use WP_Query;
use WP_User_Query;
use Timber\Timber;
use Timber\PostQuery;

/**
 * Theme helpers for retrieving data from DB.
 *
 * @package WordPress
 * @subpackage Chipmunk
 */
class Query {

	/**
	 * Get posts
	 */
	public static function getPosts( $args, $tax = null, $date = null ) {
		$defaults = [
			'post_type'         => 'post',
			'posts_per_page'    => -1,
		];

		// Apply taxonomy params
		if ( ! empty( $tax ) ) {
			$defaults['tax_query'] = [
				[
					'taxonomy'          => $tax->taxonomy,
					'field'             => 'id',
					'terms'             => $tax->term_id,
					'include_children'  => false,
				],
			];
		}

		// Apply date params
		if ( ! empty( $date ) ) {
			$defaults['date_query'] = [
				[
					'year'  => $date['year'],
					'month' => $date['month'],
				],
			];
		}

		return Timber::get_posts( wp_parse_args( $args, $defaults ) );
	}

	/**
	 * Get related resources
	 */
	public static function getRelated( $postId, $args = [] ) {
		$defaults = [
			'post_type'			=> get_post_type( $postId ),
			'post_status'		=> 'publish',
			'post__not_in'		=> [ $postId ],
			'posts_per_page'	=> apply_filters( 'chipmunk_related_resources_count', 3 ),
			'orderby'			=> 'rand',
			'related'			=> true,
		];

		foreach ( get_object_taxonomies( get_post( $postId ), 'names' ) as $taxonomy ) {
			$terms = get_the_terms( $postId, $taxonomy );

			if ( ! empty( $terms ) ) {
				$defaults['tax_query'][] = [
					'taxonomy'    => $taxonomy,
					'field'       => 'term_id',
					'terms'       => array_column( $terms, 'term_id' ),
					'operator'    => 'IN',
				];
			};
		}

		if ( ! empty( $defaults['tax_query'] ) && count( $defaults['tax_query'] ) > 1 ) {
			$defaults['tax_query']['relation'] = 'OR';
		}

		return Timber::get_posts( wp_parse_args( $args, $defaults ) );
	}

	/**
	 * Get resources
	 */
	public static function getResources( $args = [], $term = null ) {
		$defaults = [
			'post_type'         => 'resource',
			'post_status'       => 'publish',
			'posts_per_page'    => Helpers::getOption( 'posts_per_page' ),
			'paged'             => Helpers::getCurrentPage(),
		];

		// Add default ordering args
		if ( empty( $args['orderby'] ) ) {
			$defaults = array_merge( $defaults, self::getResourcesSortArgs() );
		}

		// Add default taxonomy args
		if ( ( is_tax() && ! empty( $term ) ) || ( ! empty( $_GET['tag'] ) && Helpers::isOptionEnabled( 'filters', 'resource', false ) ) ) {
			$defaults = array_merge( $defaults, self::getResourcesTaxArgs( $term ) );
		}

		return Timber::get_posts( wp_parse_args( $args, $defaults ) );
	}

	/**
	 * Get resources sort WP_Query arguments
	 */
	private static function getResourcesSortArgs() {
		$sortArgs = [];

		// Apply sorting options
		if ( ! empty( $_GET['sort'] ) && Helpers::isOptionEnabled( 'sorting', 'resource', false ) ) {
			$sortParams = explode( '-', $_GET['sort'] );
			$sortOrderby = $sortParams[0];
			$sortOrder = $sortParams[1];
		}
		else {
			$sortOrderby = Helpers::getOption( 'default_sort_by' );
			$sortOrder = Helpers::getOption( 'default_sort_order' );
		}

		switch ( $sortOrderby ) {
			case 'date':
				$sortArgs = [
					'orderby'   => 'date',
				];
				break;
			case 'name':
				$sortArgs = [
					'orderby'   => 'title',
				];
				break;
			case 'views':
				$sortArgs = [
					'orderby'   => 'meta_value_num date',
					'meta_key'  => '_' . THEME_SLUG . '_post_view_count',
				];
				break;
			case 'upvotes':
				$sortArgs = [
					'orderby'   => 'meta_value_num date',
					'meta_key'  => '_' . THEME_SLUG . '_upvote_count',
				];
				break;
			case 'ratings':
				$sortArgs = [
					'orderby'   => 'meta_value_num date',
					'meta_key'  => '_' . THEME_SLUG . '_rating_rank',
				];
				break;
		}

		$sortArgs['order'] = $sortOrder;

		return $sortArgs;
	}

	/**
	 * Get resources tax WP_Query arguments
	 */
	private static function getResourcesTaxArgs( $term = null ) {
		$taxQuery = [];

		// Apply taxonomy options
		if ( is_tax() && ! empty( $term ) ) {
			$taxQuery[] = [
				'taxonomy'          => $term->taxonomy,
				'field'             => 'slug',
				'terms'             => $term->slug,
			];
		}

		// Apply tag filters
		if ( ! empty( $_GET['tag'] ) && Helpers::isOptionEnabled( 'filters', 'resources', false ) ) {
			$taxQuery[] = [
				'taxonomy'          => 'resource-tag',
				'field'             => 'slug',
				'terms'             => $_GET['tag'],
			];
		}

		if ( count( $taxQuery ) > 1 ) {
			$taxQuery['relation'] = 'AND';
		}

		return [ 'tax_query' => $taxQuery ];
	}
}
