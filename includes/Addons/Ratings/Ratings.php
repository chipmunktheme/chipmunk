<?php

namespace Chipmunk\Addons\Ratings;

use Chipmunk\Helpers;
use Chipmunk\Addons\Ratings\Helpers as RatingsHelpers;

/**
 * Main ratings class
 *
 * @package WordPress
 * @subpackage Chipmunk
 */
class Ratings {

	/**
	 * Database meta key
	 *
	 * @var string
	 */
	public static $dbKey        = '_' . THEME_SLUG . '_rating';
	public static $dbKeyCount   = '_' . THEME_SLUG . '_rating_count';
	public static $dbKeyAverage = '_' . THEME_SLUG . '_rating_average';
	public static $dbKeyRank    = '_' . THEME_SLUG . '_rating_rank';

	/**
	 * Maximun rating value
	 *
	 * @var int
	 */
	protected $maxRating = 5;

	/**
	 * Minimum ratings required to be listed
	 *
	 * @var string
	 */
	private $minRatings = 5;

	/**
	 * Initializes the plugin config.
	 *
	 * To keep the initialization fast, only add filter and action
	 * hooks in the constructor.
	 *
	 * @param  int $postId
	 * @param  int $rating
	 *
	 * @return void
	 */
	function __construct( $postId, $rating = null ) {
		global $current_user;

		$this->postId = intval( wp_filter_kses( $postId ) );
		$this->userId = ! empty( $current_user->ID ) ? $current_user->ID : Helpers::getIp();

		if ( ! empty( $rating ) ) {
			$this->rating = intval( wp_filter_kses( $rating ) );
		}
	}

	/**
	 * Submits the post rating
	 *
	 * @return object
	 */
	private function submitRating() {
		$ratings = $this->getPostRatings();
		$oldRating = $this->getUserRating( $ratings );

		$newRating = [
			'rating'    => $this->rating,
			'user_id'   => $this->userId,
		];

		if ( ! empty( $oldRating ) ) {
			// Update user rating
			update_post_meta( $this->postId, self::$dbKey, $newRating, $oldRating );
		}

		else {
			// Add new user rating
			add_post_meta( $this->postId, self::$dbKey, $newRating );
		}

		// ------------------------------

		$ratings = $this->getPostRatings();
		$average = $this->getRatingAverage( $ratings );
		$rank = $this->getRatingRank( $ratings, $average );

		// Update rating counter
		update_post_meta( $this->postId, self::$dbKeyCount, count( $ratings ) );

		// Update rating average
		update_post_meta( $this->postId, self::$dbKeyAverage, $average );

		// Update rating rank
		update_post_meta( $this->postId, self::$dbKeyRank, $rank );

		// Return proper resounse params
		return [
			'post'      => $this->postId,
			'content'   => $this->getRatingsSummary(),
		];
	}

	/**
	 * Retrieves the ratings of a post
	 *
	 * @return array
	 */
	private function getPostRatings() {
		return get_post_meta( $this->postId, self::$dbKey );
	}

	/**
	 * Gets the post rating from user
	 *
	 * @param  array $ratings
	 *
	 * @return boolean
	 */
	private function getUserRating( $ratings ) {
		return Helpers::findKeyValue( $ratings, 'user_id', $this->userId );
	}

	/**
	 * Utility calculates rating average for post,
	 * returns appropriate number
	 *
	 * @param  array $ratings
	 *
	 * @return float
	 */
	private function getRatingAverage( $ratings ) {
		if ( empty( $ratings ) ) {
			return 0;
		}

		$ratingsSum = array_sum( array_column( $ratings, 'rating' ) );
		$ratingsCount = count( $ratings );

		return ( number_format( $ratingsSum / $ratingsCount, 1 ) * 100 ) / 100;
	}

	/**
	 * Utility calculates rating rank based on true Bayesian estimate,
	 * returns appropriate number
	 *
	 * @param  array $ratings
	 * @param  float $average
	 *
	 * @return float
	 */
	private function getRatingRank( $ratings, $average ) {
		if ( empty( $ratings ) ) {
			return 0;
		}

		$allRatings = RatingsHelpers::getMetaValues( self::$dbKey );
		$allRatingsSum = array_sum( array_column( $allRatings, 'rating' ) );
		$allRatingsAverage = ( $allRatingsSum / count( $allRatings ) );

		return ( $average * count( $ratings ) + $allRatingsAverage * $this->minRatings ) / ( count( $ratings ) + $this->minRatings );
	}

	/**
	 * Get rating summary
	 *
	 * @return string
	 */
	public function getRatingsSummary() {
		$ratings = $this->getRatings();

		$summary = "<div itemprop='aggregateRating' itemscope itemtype='http://schema.org/AggregateRating' " . ( $ratings['count'] == 0 ? "style='display: none'" : "" ) . ">"
				. "<strong itemprop='ratingValue'>{$ratings['average']}</strong> " . __( 'out of', 'chipmunk' ) . " <span itemprop='bestRating'>" . $this->maxRating . "</span> " . __( 'stars', 'chipmunk' )
				. "<small class='u-visible-md-inline'>(<span itemprop='ratingCount'>" . $ratings['count'] . "</span> " . _n( 'rating', 'ratings', $ratings['count'], 'chipmunk' ) . ")</small>"
			. "</div>";

		return $summary;
	}

	/**
	 * Retrieve info about current post ratings
	 *
	 * @return array
	 */
	public function getRatings() {
		$ratings = $this->getPostRatings();
		$average = $this->getRatingAverage( $ratings );
		$rating = $this->getUserRating( $ratings );

		return [
			'rating'    => $rating,
			'average'   => $average,
			'count'     => count( $ratings ),
		];
	}

	/**
	 * Retrieve max rating setting
	 *
	 * @return int
	 */
	public function getMaxRating() {
		return $this->maxRating;
	}

	/**
	 * Processes the upvote request
	 *
	 * @return void
	 */
	public function process() {
		// Check required attributes
		if ( ! $this->postId || ! $this->userId || ! $this->rating ) {
			wp_send_json_error( __( 'Not permitted.', 'chipmunk' ) );
		}

		// Set proper Post meta values
		$params = $this->submitRating();

		// Return success response
		wp_send_json_success( $params );
	}
}
