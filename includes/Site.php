<?php

namespace Chipmunk;

use Timber\Theme;
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
	public function __construct() {
		// Timber config
		add_filter( 'timber/locations', [ $this, 'setTimberLocation' ] );
		add_filter( 'timber/context', [ $this, 'setTimberContext' ] );
		add_filter( 'timber/twig/functions', [ $this, 'setTwigFunctions' ] );
		add_filter( 'timber/twig/filters', [ $this, 'setTwigFilters' ] );
	}

	/**
	 * Sets custom locations for twig files
	 *
	 * @param array $paths
	 *
	 * @return array
	 */
	public function setTimberLocation( $paths ) {
		$paths[] = [ THEME_TEMPLATE_DIR . '/views' ];

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
		$conditionals = [
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
		];

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
		$extend = [
			// WordPress Helpers
			'is_singular'        => [ 'callable' => 'is_singular' ],
			'is_tax'             => [ 'callable' => 'is_tax' ],

			// Generic Helpers
			'revisioned_path'    => [ 'callable' => [ Assets::class, 'revisionedPath' ] ],
			'asset_path'         => [ 'callable' => [ Assets::class, 'assetPath' ] ],
			'has_file'           => [ 'callable' => [ Assets::class, 'hasFile' ] ],
			'get_dist_path'      => [ 'callable' => [ Assets::class, 'getDistPath' ] ],
			'is_dev'             => [ 'callable' => [ Assets::class, 'isDev' ] ],

			// Theme Helpers
			'cn'                 => [ 'callable' => [ Helpers::class, 'className' ] ],
			'get_salt'           => [ 'callable' => [ Helpers::class, 'getSalt' ] ],
			'get_param'          => [ 'callable' => [ Helpers::class, 'getParam' ] ],
			'get_option'         => [ 'callable' => [ Helpers::class, 'getOption' ] ],
			'is_option_enabled'  => [ 'callable' => [ Helpers::class, 'isOptionEnabled' ] ],
			'is_addon_enabled'   => [ 'callable' => [ Helpers::class, 'isAddonEnabled' ] ],
			'get_external_link'  => [ 'callable' => [ Helpers::class, 'getExternalLink' ] ],
			'get_resource_links' => [ 'callable' => [ Helpers::class, 'getResourceLinks' ] ],
			'get_term_list'      => [ 'callable' => [ Helpers::class, 'getTermList' ] ],
			'get_term_options'   => [ 'callable' => [ Helpers::class, 'getTermOptions' ] ],
			'get_related_posts'  => [ 'callable' => [ Helpers::class, 'getRelatedPosts' ] ],
			'get_current_page'   => [ 'callable' => [ Helpers::class, 'getCurrentPage' ] ],
			'get_views'          => [ 'callable' => [ Views::class, 'getViews' ] ],

			// Addon Helpers
			'get_members_link'   => [ 'callable' => [ MembersHelpers::class, 'getPagePermalink' ] ],

			// Third-party Helpers
			'get_current_url'    => [ 'callable' => [ URLHelper::class, 'get_current_url' ] ],
			'is_external'        => [ 'callable' => [ URLHelper::class, 'is_external' ] ],
		];

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
		$extend = [
			// PHP/WordPress built-in filters
			'esc_url'        => [ 'callable' => 'esc_url' ],
			'esc_attr'       => [ 'callable' => 'esc_attr' ],
			'esc_html'       => [ 'callable' => 'esc_html' ],
			'lcfirst'        => [ 'callable' => 'lcfirst' ],
			'stripslashes'   => [ 'callable' => 'stripslashes' ],
			'sanitize_title' => [ 'callable' => 'sanitize_title' ],

			// Custom filters
			'format_number'  => [ 'callable' => [ Helpers::class, 'formatNumber' ] ],
			'svg_content'    => [ 'callable' => [ Helpers::class, 'getSvgContent' ] ],
			'external_url'   => [ 'callable' => [ Helpers::class, 'getExternalUrl' ] ],
		];

		return array_merge( $filters, $extend );
	}
}
