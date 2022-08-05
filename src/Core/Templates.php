<?php

namespace Chipmunk\Core;

use Timber\Timber;
use Timber\URLHelper;
use MadeByLess\Lessi\Helper\{
    AssetTrait,
    FileTrait,
    HelperTrait,
    MediaTrait,
    SelectorTrait,
    ThemeTrait,
};
use Chipmunk\Theme;
use Chipmunk\Helper\{
    AddonTrait,
    LinkTrait,
    TaxonomyTrait,
};

/**
 * Theme templates
 */
class Templates extends Theme {
	use AddonTrait;
	use AssetTrait;
	use FileTrait;
	use HelperTrait;
	use MediaTrait;
	use SelectorTrait;
	use ThemeTrait;

	use LinkTrait;
	use TaxonomyTrait;

	/**
	 * Class constructor.
	 */
	public function __construct() {}

	/**
	 * Hooks methods of this object into the WordPress ecosystem
	 */
	public function initialize() {
		$this->addFilter( 'timber/locations', [ $this, 'setTimberLocation' ] );
		$this->addFilter( 'timber/context', [ $this, 'setTimberContext' ] );
		$this->addFilter( 'timber/twig/functions', [ $this, 'setTwigFunctions' ] );
		$this->addFilter( 'timber/twig/filters', [ $this, 'setTwigFilters' ] );
	}

	/**
	 * Sets custom locations for twig templates
	 *
	 * @see https://developer.wordpress.org/reference/hooks/timber/locations
	 *
	 * @param array $paths
	 */
	public function setTimberLocation( array $paths ): array {
		$paths[] = [ $this->getTemplatePath( config()->getTemplatesPath() ) ];

		return $paths;
	}

	/**
	 * Adds custom global data to the twig context
	 *
	 * @see https://developer.wordpress.org/reference/hooks/timber/context
	 *
	 * @param array $context
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

		// Config
		$context['config'] = [
			'demo_url'      => config()->getDemoUrl(),
			'changelog_url' => config()->getChangelogUrl(),
			'shop_url'      => config()->getShopUrl(),
			'shop_item_id'  => config()->getShopItemId(),
			'plans'         => config()->getPlans(),
			'addons'        => config()->getAddons(),
			'socials'       => config()->getSocials(),
		];

		return $context;
	}

	/**
	 * Adds custom functions to the twig templates
	 *
	 * @see https://developer.wordpress.org/reference/hooks/timber/twig/functions
	 *
	 * @param array $functions
	 */
	public function setTwigFunctions( array $functions ): array {
		$extend = [
			// WordPress Helpers
			'is_singular'        => [ 'callable' => 'is_singular' ],
			'is_tax'             => [ 'callable' => 'is_tax' ],

			// Theme Helpers
			'asset'              => [ 'callable' => [ $this, 'assetUrl' ] ],
			'class'              => [ 'callable' => [ $this, 'className' ] ],
			'get_theme_slug'     => [ 'callable' => [ $this, 'buildThemeSlug' ] ],
			'get_theme_property' => [ 'callable' => [ $this, 'getThemeProperty' ] ],
			'get_param'          => [ 'callable' => [ $this, 'getParam' ] ],
			'get_option'         => [ 'callable' => [ $this, 'getOption' ] ],
			'is_option_enabled'  => [ 'callable' => [ $this, 'isOptionEnabled' ] ],
			'is_addon_enabled'   => [ 'callable' => [ $this, 'isAddonEnabled' ] ],
			'get_svg_content'    => [ 'callable' => [ $this, 'getSvgContent' ] ],
			'get_external_link'  => [ 'callable' => [ $this, 'getExternalLink' ] ],
			// 'get_resource_links'  => [ 'callable' => [ $this, 'getResourceLinks' ] ],
			'get_term_list'      => [ 'callable' => [ $this, 'getTermList' ] ],
			'get_term_options'   => [ 'callable' => [ $this, 'getTermOptions' ] ],
			// 'get_related_posts'   => [ 'callable' => [ $this, 'getRelatedPosts' ] ],
			// 'get_current_page'    => [ 'callable' => [ $this, 'getCurrentPage' ] ],
			// 'get_views'           => [ 'callable' => [ Views::class, 'getViews' ] ],

			// Addon Helpers
			'get_members_link'    => [ 'callable' => [ $this, 'getParam' ] ],

			// Third-party Helpers
			'get_menu'           => [ 'callable' => [ Timber::class, 'get_menu' ] ],
			'get_current_url'    => [ 'callable' => [ URLHelper::class, 'get_current_url' ] ],
			'is_external'        => [ 'callable' => [ URLHelper::class, 'is_external' ] ],
		];

		return array_replace( $functions, $extend );
	}

	/**
	 * Adds custom filters to the twig templates
	 *
	 * @see https://developer.wordpress.org/reference/hooks/timber/twig/filters
	 *
	 * @param array $filters
	 */
	public function setTwigFilters( array $filters ): array {
		$extend = [
			// PHP/WordPress built-in filters
			'esc_url'        => [ 'callable' => 'esc_url' ],
			'esc_attr'       => [ 'callable' => 'esc_attr' ],
			'esc_html'       => [ 'callable' => 'esc_html' ],
			'wp_kses_post'   => [ 'callable' => 'wp_kses_post' ],
			'lcfirst'        => [ 'callable' => 'lcfirst' ],
			'stripslashes'   => [ 'callable' => 'stripslashes' ],
			'sanitize_title' => [ 'callable' => 'sanitize_title' ],

			// Custom filters
			// 'format_number'  => [ 'callable' => [ Helpers::class, 'formatNumber' ] ],
			// 'external_url'   => [ 'callable' => [ Helpers::class, 'getExternalUrl' ] ],
		];

		return array_replace( $filters, $extend );
	}
}
