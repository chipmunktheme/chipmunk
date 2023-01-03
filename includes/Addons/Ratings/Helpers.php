<?php

namespace Chipmunk\Addons\Ratings;

/**
 * Plugin specific helpers.
 *
 * @package WordPress
 * @subpackage Chipmunk
 */
class Helpers
{
    /**
     * Gets an array of all meta values by the key
     *
     * @param string $key Meta key to search for
     *
     * @return array
     */
    public static function get_meta_values($key)
    {
        global $wpdb;

        return $wpdb->get_col("SELECT meta_value FROM $wpdb->postmeta WHERE meta_key = '{$key}'");
    }

    /**
     * Gets the average rating of a post
     *
     * @param string $post_id Post ID
     *
     * @return array
     */
    public static function get_post_rating($post_id)
    {
        return get_post_meta($post_id, Ratings::$db_key_average, true);
    }
}
