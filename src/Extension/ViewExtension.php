<?php

namespace Chipmunk\Extension;

use MadeByLess\Lessi\Helper\HelperTrait;
use Chipmunk\Helper\OptionTrait;

/**
 * View extension class
 */
class ViewExtension {
    use HelperTrait;
    use OptionTrait;

	/**
	 * @var ViewExtension The one true ViewExtension
	 */
	private static $instance;

	/**
	 * Database key name
	 *
	 * @var string
	 */
	private string $dbKey;

	/**
	 * Class constructor.
	 */
	public function __construct() {
		$this->dbKey = $this->buildPrefixedThemeSlug( 'post_view_count' );
	}

	/**
	 * Insures that only one instance of ViewExtension exists in memory at any one
	 * time. Also prevents needing to define globals all over the place.
	 *
	 * @return ViewExtension
	 */
	public static function getInstance() {
		if ( ! isset( self::$instance ) && ! ( self::$instance instanceof ViewExtension ) ) {
			self::$instance = new ViewExtension();
		}

		return self::$instance;
	}

	/**
	 * Retrieve current view counter
	 *
	 * @param int $postId Post ID number
	 *
	 * @return int
	 */
	public function getViews( $postId ): int {
		$count = get_post_meta( $postId, $this->dbKey, true ) ?: 0;

		return (int) $count;
	}

	/**
	 * Increase the view counter
	 *
	 * @param int $postId Post ID number
	 */
	public function setViews( int $postId ) {

        // Don't set anything if cookie is present
        if ( isset( $_COOKIE[ $this->dbKey . '_' . $postId ] ) ) {
            return;
        }

		$count = get_post_meta( $postId, $this->dbKey, true ) ?: 0;
        update_post_meta( $postId, $this->dbKey, ++$count );

        if ( ! $this->getOption( 'disable_cookies' ) ) {
            setcookie( $this->dbKey . '_' . $postId, true );
        }
	}
}
