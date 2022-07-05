<?php

namespace Chipmunk\Config;

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
		add_filter( 'pre_get_posts', [ $this, 'update_main_query' ] );
		add_filter( 'pre_get_posts', [ $this, 'update_search_query' ] );
		add_filter( 'pre_get_posts', [ $this, 'exclude_tax_children' ] );
	}

	/**
	 * Update main query
	 *
	 * @return object
	 */
	public static function update_main_query( $query ) {
		if ( ! is_admin() and ! is_front_page() and ! $query->get('related' ) ) {
			if ( $query->get( 'post_type' ) == 'post' ) {
				$query->set( 'posts_per_page', Helpers::getOption( 'blog_posts_per_page' ) );
			}

			if ( $query->get( 'post_type' ) == 'resource' ) {
				$query->set( 'posts_per_page', Helpers::getOption( 'posts_per_page' ) );
			}
		}

		return $query;
	}

	/**
	 * Update search query
	 *
	 * @return object
	 */
	public static function update_search_query( $query ) {
		if ( ! is_admin() && $query->is_search ) {
			// Use custom value for posts per page
			$query->set( 'posts_per_page', Helpers::getOption( 'results_per_page' ) );

			// Include resources
			$query->set( 'post_type', [ 'post', 'resource' ] );

			// Include only published posts
			$query->set( 'post_status', [ 'publish' ] );
		}

		return $query;
	}

	/**
	 * Exclude children from taxonomy listing
	 */
	public static function exclude_tax_children( $query ) {
		if ( ! is_admin() && isset( $query->query_vars['resource-collection'] ) ) {
			$query->set( 'tax_query', [ [
				'taxonomy'          => 'resource-collection',
				'field'             => 'slug',
				'terms'             => $query->query_vars['resource-collection'],
				'include_children'  => false,
			] ] );
		}
	}
}
