<?php

namespace Chipmunk\Core;

use Timber\URLHelper;
use Chipmunk\Theme;
use Chipmunk\Helper\AssetsTrait;
use Chipmunk\Helper\FileTrait;
use Chipmunk\Helper\SelectorsTrait;

use function Chipmunk\config;

/**
 * Theme templates
 */
class Templates extends Theme {

	use AssetsTrait;
	use FileTrait;
	use SelectorsTrait;

	/**
	 * Class constructor.
	 */
	public function __construct() {}

	/**
	 * Hooks methods of this object into the WordPress ecosystem
	 *
	 * @return void
	 */
	public function initialize(): void {
		$this->addFilter( 'timber/locations', [ $this, 'setTimberLocation' ] );
		$this->addFilter( 'timber/context', [ $this, 'setTimberContext' ] );
		$this->addFilter( 'timber/twig/functions', [ $this, 'setTwigFunctions' ] );
		$this->addFilter( 'timber/twig/filters', [ $this, 'setTwigFilters' ] );
	}

	/**
	 * Sets custom locations for twig templates
	 *
	 * @param array $paths
	 *
	 * @return array
	 */
	public function setTimberLocation( array $paths ): array {
		$paths[] = [ $this->getTemplatePath( config()->getTemplatesPath() ) ];

		return $paths;
	}

	/**
	 * Adds custom global data to the twig context
	 *
	 * @param array $context
	 *
	 * @return array
	 */
	public function setTimberContext( array $context ): array {
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
		// $context['socials']      = Helpers::getSocials();
		// $context['menus']        = Helpers::getRegisteredMenus();

		return $context;
	}

	/**
	 * Adds custom functions to the twig templates
	 *
	 * @param array $functions
	 *
	 * @return array
	 */
	public function setTwigFunctions( array $functions ): array {
		$extend = [
			// WordPress Helpers
			'is_singular' => [ 'callable' => 'is_singular' ],
			'is_tax'      => [ 'callable' => 'is_tax' ],

			// Theme Helpers
			'asset'         => [ 'callable' => [ $this, 'assetPath' ] ],
			'class'                 => [ 'callable' => [ $this, 'className' ] ],
			// 'get_salt'           => [ 'callable' => [ Helpers::class, 'getSalt' ] ],
			// 'get_param'          => [ 'callable' => [ Helpers::class, 'getParam' ] ],
			// 'get_option'         => [ 'callable' => [ Helpers::class, 'getOption' ] ],
			// 'is_option_enabled'  => [ 'callable' => [ Helpers::class, 'isOptionEnabled' ] ],
			// 'is_addon_enabled'   => [ 'callable' => [ Helpers::class, 'isAddonEnabled' ] ],
			// 'get_external_link'  => [ 'callable' => [ Helpers::class, 'getExternalLink' ] ],
			// 'get_resource_links' => [ 'callable' => [ Helpers::class, 'getResourceLinks' ] ],
			// 'get_term_list'      => [ 'callable' => [ Helpers::class, 'getTermList' ] ],
			// 'get_term_options'   => [ 'callable' => [ Helpers::class, 'getTermOptions' ] ],
			// 'get_related_posts'  => [ 'callable' => [ Helpers::class, 'getRelatedPosts' ] ],
			// 'get_current_page'   => [ 'callable' => [ Helpers::class, 'getCurrentPage' ] ],
			// 'get_views'          => [ 'callable' => [ Views::class, 'getViews' ] ],

			// Addon Helpers
			// 'get_members_link'   => [ 'callable' => [ MembersHelpers::class, 'getPagePermalink' ] ],

			// Third-party Helpers
			'get_current_url'    => [ 'callable' => [ URLHelper::class, 'get_current_url' ] ],
			'is_external'        => [ 'callable' => [ URLHelper::class, 'is_external' ] ],
		];

		return array_replace( $functions, $extend );
	}

	/**
	 * Adds custom filters to the twig templates
	 *
	 * @param array $filters
	 *
	 * @return array
	 */
	public function setTwigFilters( array $filters ): array {
		$extend = [
			// PHP/WordPress built-in filters
			'esc_url'        => [ 'callable' => 'esc_url' ],
			'esc_attr'       => [ 'callable' => 'esc_attr' ],
			'esc_html'       => [ 'callable' => 'esc_html' ],
			'wp_kses_post'       => [ 'callable' => 'wp_kses_post' ],
			'lcfirst'        => [ 'callable' => 'lcfirst' ],
			'stripslashes'   => [ 'callable' => 'stripslashes' ],
			'sanitize_title' => [ 'callable' => 'sanitize_title' ],

			// Custom filters
			// 'format_number'  => [ 'callable' => [ Helpers::class, 'formatNumber' ] ],
			// 'svg_content'    => [ 'callable' => [ Helpers::class, 'getSvgContent' ] ],
			// 'external_url'   => [ 'callable' => [ Helpers::class, 'getExternalUrl' ] ],
		];

		return array_replace( $filters, $extend );
	}
}
