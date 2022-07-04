<?php

namespace Chipmunk;

use Twig\TwigFunction;
use Twig\TwigFilter;
use Twig\Environment;
use Chipmunk\Helpers;
use Chipmunk\Extensions\Upvotes;
use Chipmunk\Extensions\Views;

/**
 * Use this class to extend twig functionality
 *
 * @package WordPress
 * @subpackage Chipmunk
 */
class Twig {

	/**
 	 * Class constructor
	 */
	function __construct() {
		add_filter( 'timber/loader/twig', [ $this, 'extendTwig' ] );
	}

	/**
	 * Extends Twig, registers filters and functions.
	 *
	 * @param Environment $twig
	 *
	 * @return Environment $twig
	 */
	public function extendTwig( $twig ) {
		$twig = $this->registerTwigFilters( $twig );
		$twig = $this->registerTwigFunctions( $twig );

		return $twig;
	}

	/**
	 * You can add you own functions to twig here
	 *
	 * @param Environment $twig
	 *
	 * @return Environment $twig
	 */
	protected function registerTwigFunctions( $twig ) {
		// Generic Helpers
		$this->registerFunction( $twig, 'revisioned_path', 		[ Assets::class, 'revisionedPath' ] );
		$this->registerFunction( $twig, 'asset_path', 			[ Assets::class, 'assetPath' ] );
		$this->registerFunction( $twig, 'has_file', 			[ Assets::class, 'hasFile' ] );
		$this->registerFunction( $twig, 'get_dist_path', 		[ Assets::class, 'getDistPath' ] );
		$this->registerFunction( $twig, 'is_dev', 				[ Assets::class, 'isDev' ] );

		$this->registerFunction( $twig, 'cn', 					[ Helpers::class, 'className' ] );
		$this->registerFunction( $twig, 'class_name', 			[ Helpers::class, 'className' ] );
		$this->registerFunction( $twig, 'get_option', 			[ Helpers::class, 'getOption' ] );
		$this->registerFunction( $twig, 'is_option_enabled',	[ Helpers::class, 'isOptionEnabled' ] );
		$this->registerFunction( $twig, 'is_addon_enabled',		[ Helpers::class, 'isAddonEnabled' ] );
		$this->registerFunction( $twig, 'get_resource_links',	[ Helpers::class, 'getResourceLinks' ] );
		$this->registerFunction( $twig, 'get_term_list',		[ Helpers::class, 'getTermList' ] );
		$this->registerFunction( $twig, 'get_views',			[ Views::class, 'getViews' ] );

		$this->registerFunction( $twig, 'get_current_url', 		[ URLHelper::class, 'get_current_url' ] );
		$this->registerFunction( $twig, 'is_external', 			[ URLHelper::class, 'is_external' ] );

		return $twig;
	}

	/**
	 * You can add your own filters to Twig here
	 *
	 * @param Environment $twig
	 *
	 * @return Environment $twig
	 */
	protected function registerTwigFilters( $twig ) {
		$this->registerFilter( $twig, 'lcfirst', 				'lcfirst' );
		$this->registerFilter( $twig, 'stripslashes', 			'stripslashes' );
		$this->registerFilter( $twig, 'highlight', 				[ Helpers::class, 'highlight' ] );
		$this->registerFilter( $twig, 'has_any', 				[ Helpers::class, 'hasAny' ] );
		$this->registerFilter( $twig, 'inject', 				[ Helpers::class, 'inject' ] );
		$this->registerFilter( $twig, 'encode', 				[ Helpers::class, 'encode' ] );
		$this->registerFilter( $twig, 'decode', 				[ Helpers::class, 'decode' ] );
		$this->registerFilter( $twig, 'format_number', 			[ Helpers::class, 'formatNumber' ] );
		$this->registerFilter( $twig, 'find_by_property', 		[ Helpers::class, 'findByProperty' ] );
		$this->registerFilter( $twig, 'svg_content',			[ Helpers::class, 'getSvgContent' ] );
		$this->registerFilter( $twig, 'external_url',			[ Helpers::class, 'getExternalUrl' ] );

		return $twig;
	}

	/**
	 * Use this method to register new Twig function.
	 * This method must not be changed.
	 *
	 * @param Environment $twig
	 * @param $name
	 * @param $callback
	 */
	protected function registerFunction( $twig, $name, $callback = null ) {
		if ( ! $callback ) {
			$callback = [ $this, $name ];
		}

		$twig->addFunction( new TwigFunction( $name, $callback ) );
	}

	/**
	 * Use this method to register new Twig filter.
	 * This method must not be changed.
	 *
	 * @param Environment $twig
	 * @param $name
	 * @param $callback
	 */
	protected function registerFilter( $twig, $name, $callback = null ) {
		if ( ! $callback ) {
			$callback = [ $this, $name ];
		}

		$twig->addFilter( new TwigFilter( $name, $callback ) );
	}
}
