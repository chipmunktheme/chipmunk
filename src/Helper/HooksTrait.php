<?php

namespace Chipmunk\Helper;

use Chipmunk\Helper\HelpersTrait;
use function Chipmunk\config;

/**
 * Provides methods to register new hooks in the theme
 */
trait HooksTrait {

	use HelpersTrait;

	/**
	 * Passes its arguments to add_action().
	 *
	 * @param string   $hook
	 * @param callable $callback
	 * @param int      $priority
	 * @param int      $args
	 *
	 * @return bool
	 */
	public function addAction( string $hook, callable $callback, int $priority = 10, int $args = 1 ): bool {
		return is_string( $callback )
			? add_action( $hook, [ $this, $callback ], $priority, $args )
			: add_action( $hook, $callback, $priority, $args );
	}

	/**
	 * Passes its arguments to add_filter.
	 *
	 * @param string   $hook
	 * @param callable $callback
	 * @param int      $priority
	 * @param int      $args
	 *
	 * @return bool
	 */
	public function addFilter( string $hook, callable $callback, int $priority = 10, int $args = 1 ): bool {
		return is_string( $callback )
			? add_filter( $hook, [ $this, $callback ], $priority, $args )
			: add_filter( $hook, $callback, $priority, $args );
	}

	/**
	 * Generate proper AJAX hook names and asses its arguments to add_action().
	 *
	 * @param string   $hook
	 * @param callable $callback
	 * @param int      $priority
	 * @param int      $args
	 *
	 * @return bool
	 */
	public function addAjaxAction( string $hook, callable $callback, int $priority = 10, int $args = 1 ): bool {
		$this->addAction( 'wp_ajax_' . $this->getThemeSlug( $hook ), $callback, $priority, $args );
		$this->addAction( 'wp_ajax_nopriv_' . $this->getThemeSlug( $hook ), $callback, $priority, $args );

		return true;
	}

	/**
	 * Passes its arguments to add_filter and adds a Hook to our collection.
	 *
	 * @param string $hook
	 * @param mixed  $value
	 * @param mixed  $args
	 *
	 * @return mixed
	 */
	public function applyFilter( string $hook, $value, ...$args ) {
		return apply_filters( join( '_', [ config()->getSlug(), $hook ] ), $value, ...$args );
	}
}
