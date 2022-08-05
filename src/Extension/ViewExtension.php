<?php

namespace Chipmunk\Extension;

use MadeByLess\Lessi\Factory\Singleton;
use MadeByLess\Lessi\Helper\HelperTrait;
use Chipmunk\Helper\OptionTrait;

/**
 * View extension class
 */
class ViewExtension extends Singleton {
    use HelperTrait;
    use OptionTrait;

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
