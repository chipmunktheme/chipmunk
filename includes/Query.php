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
			'post_status'       => 'publish',
			'posts_per_page'    => -1,
		);

		// Apply taxonomy params
		if ( isset( $tax ) ) {
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
		if ( isset( $date ) ) {
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
	public static function get_resources( $limit = -1, $paged = false, $term = null, $author = null ) {
		$args = array(
			'post_type'         => 'resource',
			'post_status'       => 'publish',
			'posts_per_page'    => $limit,
			'paged'             => $paged,
		);

		// Apply taxonomy options
		if ( is_author() && isset( $author ) ) {
			$args[] = array(
				'author_name'   => $author,
			);
		}

		$sort_args = \Chipmunk\Helpers::get_resources_sort_args();
		$tax_args = \Chipmunk\Helpers::get_resources_tax_args( $term );

		return new \WP_Query( array_merge( $args, $sort_args, $tax_args ) );
	}

	/**
	 * Get latest resources
	 */
	public static function get_latest_resources( $limit = -1, $paged = false ) {
		$args = array(
			'post_type'         => 'resource',
			'post_status'       => 'publish',
			'posts_per_page'    => $limit,
			'paged'             => $paged,
			'orderby'           => 'date',
			'order'             => 'DESC',
		);

		return new \WP_Query( $args );
	}

	/**
	 * Get featured resources
	 */
	public static function get_featured_resources( $limit = -1, $paged = false ) {
		$args = array(
			'post_type'         => 'resource',
			'post_status'       => 'publish',
			'posts_per_page'    => $limit,
			'paged'             => $paged,
			'meta_query'        => array(
				'featured'          => array(
					'key'               => '_' . THEME_SLUG . '_resource_is_featured',
					'value'             => array( '1', 'on' ),
					'compare'           => 'IN',
				),
				'views'             => array(
					'key'               => '_' . THEME_SLUG . '_post_view_count',
				),
			),
			'orderby'           => 'rand',
		);

		return new \WP_Query( $args );
	}

	/**
	 * Get popular resources
	 */
	public static function get_popular_resources( $limit = -1, $paged = false ) {
		$args = array(
			'post_type'         => 'resource',
			'post_status'       => 'publish',
			'posts_per_page'    => $limit,
			'paged'             => $paged,
			'meta_key'          => '_' . THEME_SLUG . '_post_view_count',
			'orderby'           => 'meta_value_num',
			'order'             => 'DESC',
		);

		return new \WP_Query( $args );
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
}
