<?php

namespace Chipmunk;

use Chipmunk\Helpers;
use Chipmunk\Extensions\Views;
use Chipmunk\Addons\Members\Helpers as MembersHelpers;

/**
 * Class Timber
 *
 * @package ChipmunkTheme
 *
 * Use this class to setup whole site related configuration
 */
class Site {
	/**
	 * Site constructor.
	 */
	function __construct() {
		// Timber config
		add_filter( 'timber/locations', array( $this, 'setTimberLocation' ) );
		add_filter( 'timber/context', array( $this, 'setTimberContext' ) );
		add_filter( 'timber/twig/functions', array( $this, 'setTwigFunctions' ) );
		add_filter( 'timber/twig/filters', array( $this, 'setTwigFilters' ) );
	}

	/**
	 * Sets custom locations for twig files
	 *
	 * @param array $paths
	 *
	 * @return array
	 */
	public function setTimberLocation( $paths ) {
		$paths[] = array( THEME_TEMPLATE_DIR . '/views' );

		return $paths;
	}

	/**
	 * You can add custom global data to twig context
	 *
	 * @param array $context
	 *
	 * @return array
	 */
	public function setTimberContext( $context ) {
		$conditionals = array(
			'is_home',
			'is_front_page',
			'is_single',
			'is_attachment',
			'is_page',
			'is_category',
			'is_search',
			'is_tag',
			'is_tax',
			'is_author',
			'is_archive',
		);

		foreach ( $conditionals as $conditional ) {
			$context[ $conditional ] = $conditional();
		}

		$context['search_query'] = get_search_query();
		$context['socials']      = Helpers::getSocials();
		$context['menus']        = Helpers::getRegisteredMenus();

		return $context;
	}

	/**
	 * You can add custom global data to twig context
	 *
	 * @param array $functions
	 *
	 * @return array
	 */
	public function setTwigFunctions( $functions ) {
		$extend = array(
			// WordPress Helpers
			'is_singular'        => array( 'callable' => 'is_singular' ),
			'is_tax'             => array( 'callable' => 'is_tax' ),

			// Generic Helpers
			'revisioned_path'    => array( 'callable' => array( Assets::class, 'revisionedPath' ) ),
			'asset_path'         => array( 'callable' => array( Assets::class, 'assetPath' ) ),
			'has_file'           => array( 'callable' => array( Assets::class, 'hasFile' ) ),
			'get_dist_path'      => array( 'callable' => array( Assets::class, 'getDistPath' ) ),
			'is_dev'             => array( 'callable' => array( Assets::class, 'isDev' ) ),

			// Theme Helpers
			'cn'                 => array( 'callable' => array( Helpers::class, 'className' ) ),
			'get_salt'           => array( 'callable' => array( Helpers::class, 'getSalt' ) ),
			'get_param'          => array( 'callable' => array( Helpers::class, 'getParam' ) ),
			'get_option'         => array( 'callable' => array( Helpers::class, 'getOption' ) ),
			'is_option_enabled'  => array( 'callable' => array( Helpers::class, 'isOptionEnabled' ) ),
			'is_addon_enabled'   => array( 'callable' => array( Helpers::class, 'isAddonEnabled' ) ),
			'get_external_link'  => array( 'callable' => array( Helpers::class, 'getExternalLink' ) ),
			'get_resource_links' => array( 'callable' => array( Helpers::class, 'getResourceLinks' ) ),
			'get_term_list'      => array( 'callable' => array( Helpers::class, 'getTermList' ) ),
			'get_term_options'   => array( 'callable' => array( Helpers::class, 'getTermOptions' ) ),
			'get_related_posts'  => array( 'callable' => array( Helpers::class, 'getRelatedPosts' ) ),
			'get_current_page'   => array( 'callable' => array( Helpers::class, 'getCurrentPage' ) ),
			'get_views'          => array( 'callable' => array( Views::class, 'getViews' ) ),

			// Addon Helpers
			'get_members_link'   => array( 'callable' => array( MembersHelpers::class, 'getPagePermalink' ) ),

			// Third-party Helpers
			'get_current_url'    => array( 'callable' => array( URLHelper::class, 'get_current_url' ) ),
			'is_external'        => array( 'callable' => array( URLHelper::class, 'is_external' ) ),
		);

		return array_merge( $functions, $extend );
	}

	/**
	 * You can add custom global data to twig context
	 *
	 * @param array $filters
	 *
	 * @return array
	 */
	public function setTwigFilters( $filters ) {
		$extend = array(
			// PHP/WordPress built-in filters
			'esc_url'        => array( 'callable' => 'esc_url' ),
			'esc_attr'       => array( 'callable' => 'esc_attr' ),
			'esc_html'       => array( 'callable' => 'esc_html' ),
			'lcfirst'        => array( 'callable' => 'lcfirst' ),
			'stripslashes'   => array( 'callable' => 'stripslashes' ),
			'sanitize_title' => array( 'callable' => 'sanitize_title' ),

			// Custom filters
			'format_number'  => array( 'callable' => array( Helpers::class, 'formatNumber' ) ),
			'svg_content'    => array( 'callable' => array( Helpers::class, 'getSvgContent' ) ),
			'external_url'   => array( 'callable' => array( Helpers::class, 'getExternalUrl' ) ),
		);

		return array_merge( $filters, $extend );
	}
}
