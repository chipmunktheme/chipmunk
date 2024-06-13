<?php

namespace Chipmunk\Addons\Ratings;

/**
 * Main ratings class
 *
 * @package WordPress
 * @subpackage Chipmunk
 */
class Ratings
{
    /**
     * Current post ID
     *
     * @var int
     */
    private $post_id;

    /**
     * Current user ID
     *
     * @var int
     */
    private $user_id;

    /**
     * Rating value
     *
     * @var int
     */
    private $rating;

    /**
     * Database meta key
     *
     * @var string
     */
    public static $db_key         = '_' . THEME_SLUG . '_rating';
    public static $db_key_count   = '_' . THEME_SLUG . '_rating_count';
    public static $db_key_average = '_' . THEME_SLUG . '_rating_average';
    public static $db_key_rank    = '_' . THEME_SLUG . '_rating_rank';

    /**
     * Maximun rating value
     *
     * @var int
     */
    public static $max_rating = 5;

    /**
     * Minimum ratings required to be listed
     *
     * @var string
     */
    private $min_ratings = 5;

    /**
     * Initializes the plugin config.
     *
     * To keep the initialization fast, only add filter and action
     * hooks in the constructor.
     *
     * @param  int $post_id
     * @param  int $rating
     *
     * @return void
     */
    public function __construct($post_id, $rating = null)
    {
        global $current_user;

        $this->post_id = intval(wp_filter_kses($post_id));
        $this->user_id = !empty($current_user->ID) ? $current_user->ID : \Chipmunk\Helpers::get_ip();

        if (!empty($rating)) {
            $this->rating = intval(wp_filter_kses($rating));
        }
    }

    /**
     * Submits the post rating
     *
     * @return object
     */
    private function submit_rating()
    {
        $ratings = $this->get_post_ratings();
        $old_rating = $this->get_user_rating($ratings);

        $new_rating = [
            'rating'    => $this->rating,
            'user_id'   => $this->user_id,
        ];

        if (!empty($old_rating)) {
            // Update user rating
            update_post_meta($this->post_id, self::$db_key, $new_rating, $old_rating);
        } else {
            // Add new user rating
            add_post_meta($this->post_id, self::$db_key, $new_rating);
        }

        // ------------------------------

        $ratings = $this->get_post_ratings();
        $average = $this->get_rating_average($ratings);
        $rank = $this->get_rating_rank($ratings, $average);

        // Update rating counter
        update_post_meta($this->post_id, self::$db_key_count, count($ratings));

        // Update rating average
        update_post_meta($this->post_id, self::$db_key_average, $average);

        // Update rating rank
        update_post_meta($this->post_id, self::$db_key_rank, $rank);

        // Return proper resounse params
        return [
            'post'      => $this->post_id,
            'content'   => $this->get_ratings_summary(),
        ];
    }

    /**
     * Retrieves the ratings of a post
     *
     * @return array
     */
    private function get_post_ratings()
    {
        return get_post_meta($this->post_id, self::$db_key);
    }

    /**
     * Gets the post rating from user
     *
     * @param  array $ratings
     *
     * @return boolean
     */
    private function get_user_rating($ratings)
    {
        return \Chipmunk\Helpers::find_key_value($ratings, 'user_id', $this->user_id);
    }

    /**
     * Utility calculates rating average for post,
     * returns appropriate number
     *
     * @param  array $ratings
     *
     * @return float
     */
    private function get_rating_average($ratings)
    {
        if (empty($ratings)) {
            return 0;
        }

        $ratings_sum = array_sum(array_column($ratings, 'rating'));
        $ratings_count = count($ratings);

        return (number_format($ratings_sum / $ratings_count, 1) * 100) / 100;
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
    private function get_rating_rank($ratings, $average)
    {
        if (empty($ratings)) {
            return 0;
        }

        $all_ratings = Helpers::get_meta_values(self::$db_key);
        $all_ratings_sum = array_sum(array_column($all_ratings, 'rating'));
        $all_ratings_average = ($all_ratings_sum / count($all_ratings));

        return ($average * count($ratings) + $all_ratings_average * $this->min_ratings) / (count($ratings) + $this->min_ratings);
    }

    /**
     * Get rating summary
     *
     * @return string
     */
    public function get_ratings_summary()
    {
        $ratings = $this->get_ratings();

        $summary = "<strong>" . $ratings['average'] . "</strong> " . __('out of', 'chipmunk') . " <span itemprop='bestRating'>" . self::$max_rating . "</span> " . __('stars', 'chipmunk')
            . "<small class='u-visible-md-inline'>(" . $ratings['count'] . " " . _n('rating', 'ratings', $ratings['count'], 'chipmunk') . ")</small>";

        return $ratings['count'] > 0 ? $summary : "";
    }

    /**
     * Retrieve info about current post ratings
     *
     * @return array
     */
    public function get_ratings()
    {
        $ratings = $this->get_post_ratings();
        $average = $this->get_rating_average($ratings);
        $rating = $this->get_user_rating($ratings);

        return [
            'rating'    => $rating,
            'average'   => $average,
            'count'     => count($ratings),
        ];
    }

    /**
     * Retrieve max rating setting
     *
     * @return int
     */
    public function get_max_rating()
    {
        return self::$max_rating;
    }

    /**
     * Processes the upvote request
     *
     * @return void
     */
    public function process()
    {
        // Check required attributes
        if (!$this->post_id || !$this->user_id || !$this->rating) {
            wp_send_json_error(__('Not permitted.', 'chipmunk'));
        }

        // Set proper Post meta values
        $params = $this->submit_rating();

        // Return success response
        wp_send_json_success($params);
    }
}
