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
		add_filter( 'pre_get_posts', [ $this, 'updateResultsPerPage' ] );
		add_filter( 'pre_get_posts', [ $this, 'updateSearchParams' ] );
		add_filter( 'pre_get_posts', [ $this, 'excludeTaxChildren' ] );
	}

	/**
	 * Update results per page for different queries
	 *
	 * @return object
	 */
	public function updateResultsPerPage( $query ) {
		if ( is_admin() || is_front_page() || $query->get('related' ) ) {
			return $query;
		}

		// Posts
		if ( $query->get( 'post_type' ) == 'post' || $query->is_main_query() ) {
			$query->set( 'posts_per_page', Helpers::getOption( 'blog_posts_per_page' ) );
		}

		// Resources
		if ( $query->get( 'post_type' ) == 'resource' ) {
			$query->set( 'posts_per_page', Helpers::getOption( 'posts_per_page' ) );
		}

		// Search results
		if ( $query->is_search ) {
			$query->set( 'posts_per_page', Helpers::getOption( 'results_per_page' ) );
		}

		return $query;
	}

	/**
	 * Update search params to include resources
	 *
	 * @return object
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
	 * Exclude children from taxonomy listing
	 */
	public function excludeTaxChildren( $query ) {
		if ( is_admin() || empty( $query->query_vars['resource-collection'] ) ) {
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
}
