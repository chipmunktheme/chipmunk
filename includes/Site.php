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
		add_filter( 'timber/locations', [ $this, 'setTemplatesDirectory' ] );
		add_filter( 'timber/context', [ $this, 'extendContext' ] );

		parent::__construct();
	}

	/**
	 * You can add custom global data to twig context
	 *
	 * @param array $context
	 *
	 * @return array
	 */
	public function extendContext( $context ) {
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
	public function setTemplatesDirectory( $paths ) {
		$paths[] = [ THEME_TEMPLATE_DIR . '/views' ];

		return $paths;
	}
}
