<?php

namespace Chipmunk;

use Piotrkulpinski\Framework\Handler\ThemeHandler;
use Chipmunk\Helper\FileTrait;
use Chipmunk\Helper\ConfigTrait;

/**
 * Timber Templates settigs class
 *
 * Use this class to setup whole Timber related configuration
 *
 * @package Chipmunk
 */
class Templates extends ThemeHandler {

	use FileTrait;

	use ConfigTrait;

	/**
	 * Tempalate class constructor.
	 */
	public function __construct() {
		parent::__construct();
	}

	/**
	 * initialize
	 *
	 * Hooks methods of this object into the WordPress ecosystem
	 *
	 * @return void
	 * @throws HandlerException
	 */
	public function initialize(): void {
		if ( ! $this->isInitialized() ) {
			$this->addFilter( 'timber/locations', 'setTimberLocation' );
			$this->addFilter( 'timber/context', 'setTimberContext' );
			$this->addFilter( 'timber/twig/functions', 'setTwigFunctions' );
			$this->addFilter( 'timber/twig/filters', 'setTwigFilters' );
		}
	}

	/**
	 * Sets custom locations for twig files
	 *
	 * @param array $paths
	 *
	 * @return array
	 */
	protected function setTimberLocation( array $paths ): array {
		$paths[] = [ $this->buildPath( get_template_directory(), $this->getTemplatesPath() ) ];

		return $paths;
	}

	/**
	 * You can add custom global data to twig context
	 *
	 * @param array $context
	 *
	 * @return array
	 */
	protected function setTimberContext( array $context ): array {
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
	 * You can add custom global data to twig context
	 *
	 * @param array $functions
	 *
	 * @return array
	 */
	protected function setTwigFunctions( array $functions ): array {
		$extend = [
			// WordPress Helpers
			'is_singular' => [ 'callable' => 'is_singular' ],
			'is_tax'      => [ 'callable' => 'is_tax' ],

			// Generic Helpers
			// 'revisioned_path'    => [ 'callable' => [ Assets::class, 'revisionedPath' ] ],
			// 'asset_path'         => [ 'callable' => [ Assets::class, 'assetPath' ] ],
			// 'has_file'           => [ 'callable' => [ Assets::class, 'hasFile' ] ],
			// 'get_dist_path'      => [ 'callable' => [ Assets::class, 'getDistPath' ] ],
			// 'is_dev'             => [ 'callable' => [ Assets::class, 'isDev' ] ],

			// Theme Helpers
			// 'cn'                 => [ 'callable' => [ Helpers::class, 'className' ] ],
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
			// 'get_current_url'    => [ 'callable' => [ URLHelper::class, 'get_current_url' ] ],
			// 'is_external'        => [ 'callable' => [ URLHelper::class, 'is_external' ] ],
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
	protected function setTwigFilters( array $filters ): array {
		$extend = [
			// PHP/WordPress built-in filters
			'esc_url'        => [ 'callable' => 'esc_url' ],
			'esc_attr'       => [ 'callable' => 'esc_attr' ],
			'esc_html'       => [ 'callable' => 'esc_html' ],
			'lcfirst'        => [ 'callable' => 'lcfirst' ],
			'stripslashes'   => [ 'callable' => 'stripslashes' ],
			'sanitize_title' => [ 'callable' => 'sanitize_title' ],

			// Custom filters
			// 'format_number'  => [ 'callable' => [ Helpers::class, 'formatNumber' ] ],
			// 'svg_content'    => [ 'callable' => [ Helpers::class, 'getSvgContent' ] ],
			// 'external_url'   => [ 'callable' => [ Helpers::class, 'getExternalUrl' ] ],
		];

		return array_merge( $filters, $extend );
	}
}
