<?php

namespace Chipmunk;

use Timber\Site as TimberSite;
use Chipmunk\Helpers;

/**
 * Class Site
 * @package ChipmunkTheme
 *
 * Use this class to setup whole site related configuration
 */
class Site extends TimberSite {
	/**
	 * Site constructor.
	 */
	function __construct() {
		// Timber config
		add_filter( 'timber/locations', [ $this, 'set_templates_directory' ] );
		add_filter( 'timber/context', [ $this, 'extend_context' ] );

		parent::__construct();
	}

	/**
	 * You can add custom global data to twig context
	 *
	 * @param array $context
	 *
	 * @return array
	 */
	public static function extend_context( $context ) {
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

		$context['search_query']		= get_search_query();
		$context['socials']				= Helpers::getSocials();
		$context['menus']               = Helpers::getRegisteredMenus();

		return $context;
	}

	/**
	 * Sets custom locations for twig files
	 *
	 * @param array $paths
	 *
	 * @return array
	 */
	public static function set_templates_directory( $paths ) {
		$paths[] = [ THEME_TEMPLATE_DIR . '/views' ];

		return $paths;
	}
}
