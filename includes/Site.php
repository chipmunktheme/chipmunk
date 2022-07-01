<?php

namespace Chipmunk;

use Timber\Timber;
use Timber\User;
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
	public function __construct() {
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
		$context['is_front_page']		= is_front_page();
		$context['is_home']				= is_home();
		$context['search_query']		= get_search_query();

		$context['socials']				= Helpers::getSocials();
		$context['menus']               = self::getRegisteredMenus();

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

	private static function getRegisteredMenus() {
		$menus = [];

		// Set all nav menus in context.
		foreach ( array_keys( get_registered_nav_menus() ) as $location ) {
			// Bail out if menu has no location.
			if ( $menu = Timber::get_menu( $location ) ) {
				$menus[ str_replace( 'nav-', '', $location ) ] = $menu;
			}
		}

		return $menus;
	}
}
