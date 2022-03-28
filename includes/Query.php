<?php

namespace Chipmunk;

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
	public static function get_posts( $args, $tax = null, $date = null ) {
		$defaults = array(
			'post_type'         => 'post',
			'posts_per_page'    => -1,
		);

		// Apply taxonomy params
		if ( ! empty( $tax ) ) {
			$defaults['tax_query'] = array(
				array(
					'taxonomy'          => $tax->taxonomy,
					'field'             => 'id',
					'terms'             => $tax->term_id,
					'include_children'  => false,
				),
			);
		}

		// Apply date params
		if ( ! empty( $date ) ) {
			$defaults['date_query'] = array(
				array(
					'year'  => $date['year'],
					'month' => $date['month'],
				),
			);
		}

		return new \WP_Query( wp_parse_args( $args, $defaults ) );
	}

	/**
	 * Get related resources
	 */
	public static function get_related( $post_id, $limit = 3 ) {
		$tax_query = array();

		$post = get_post( $post_id );
		$taxonomies = get_object_taxonomies( $post, 'names' );

		foreach ( $taxonomies as $taxonomy ) {
			$terms = get_the_terms( $post_id, $taxonomy );

			if ( ! empty( $terms ) ) {
				$tax_query[] = array(
					'taxonomy'    => $taxonomy,
					'field'       => 'term_id',
					'terms'       => array_column( $terms, 'term_id' ),
					'operator'    => 'IN',
				);
			};
		}

		if ( count( $tax_query ) > 1 ) {
			$tax_query['relation'] = 'OR';
		}

		$args = array(
			'post_type'         => get_post_type( $post_id ),
			'post_status'       => 'publish',
			'post__not_in'      => array( $post_id ),
			'posts_per_page'    => $limit,
			'tax_query'         => $tax_query,
			'orderby'           => 'rand',
		);

		return new \WP_Query( $args );
	}

	/**
	 * Get resources
	 */
	public static function get_resources( $args = array(), $term = null ) {
		$defaults = array(
			'post_type'         => 'resource',
			'posts_per_page'    => Helpers::get_theme_option( 'posts_per_page' ),
			'paged'             => Helpers::get_current_page(),
		);

		// Add default ordering args
		if ( empty( $args['orderby'] ) ) {
			$defaults = array_merge( $defaults, self::get_resources_sort_args() );
		}

		// Add default taxonomy args
		if ( ( is_tax() && ! empty( $term ) ) || ( ! empty( $_GET['tag'] ) && Helpers::is_feature_enabled( 'filters', 'resource', false ) ) ) {
			$defaults = array_merge( $defaults, self::get_resources_tax_args( $term ) );
		}

		return new \WP_Query( wp_parse_args( $args, $defaults ) );
	}

	/**
	 * Get users
	 */
	public static function get_users( $limit = -1 ) {
		$args = array(
			'role__in' => array( 'Administrator', 'Editor', 'Author' ),
			'number'   => $limit,
			'orderby'  => 'ID',
			'order'    => 'ASC',
		);

		return new \WP_User_Query( $args );
	}

	/**
	 * Get resources sort WP_Query arguments
	 */
	private static function get_resources_sort_args() {
		$sort_args = array();

		// Apply sorting options
		if ( ! empty( $_GET['sort'] ) && Helpers::is_feature_enabled( 'sorting', 'resource', false ) ) {
			$sort_params = explode( '-', $_GET['sort'] );
			$sort_orderby = $sort_params[0];
			$sort_order = $sort_params[1];
		}
		else {
			$sort_orderby = Helpers::get_theme_option( 'default_sort_by' );
			$sort_order = Helpers::get_theme_option( 'default_sort_order' );
		}

		switch ( $sort_orderby ) {
			case 'date':
				$sort_args = array(
					'orderby'   => 'date',
				);
				break;
			case 'name':
				$sort_args = array(
					'orderby'   => 'title',
				);
				break;
			case 'views':
				$sort_args = array(
					'orderby'   => 'meta_value_num date',
					'meta_key'  => '_' . THEME_SLUG . '_post_view_count',
				);
				break;
			case 'upvotes':
				$sort_args = array(
					'orderby'   => 'meta_value_num date',
					'meta_key'  => '_' . THEME_SLUG . '_upvote_count',
				);
				break;
			case 'ratings':
				$sort_args = array(
					'orderby'   => 'meta_value_num date',
					'meta_key'  => '_' . THEME_SLUG . '_rating_rank',
				);
				break;
		}

		$sort_args['order'] = $sort_order;

		return $sort_args;
	}

	/**
	 * Get resources tax WP_Query arguments
	 */
	private static function get_resources_tax_args( $term = null ) {
		$tax_query = array();

		// Apply taxonomy options
		if ( is_tax() && ! empty( $term ) ) {
			$tax_query[] = array(
				'taxonomy'          => $term->taxonomy,
				'field'             => 'slug',
				'terms'             => $term->slug,
			);
		}

		// Apply tag filters
		if ( ! empty( $_GET['tag'] ) && Helpers::is_feature_enabled( 'filters', 'resources', false ) ) {
			$tax_query[] = array(
				'taxonomy'          => 'resource-tag',
				'field'             => 'slug',
				'terms'             => $_GET['tag'],
			);
		}

		if ( count( $tax_query ) > 1 ) {
			$tax_query['relation'] = 'AND';
		}

		return array( 'tax_query' => $tax_query );
	}
}
