<?php

namespace Chipmunk\Config;

use Chipmunk\Helpers;

/**
 * Query config hooks
 *
 * @package WordPress
 * @subpackage Chipmunk
 */
class Query
{
    /**
     * Used to register custom hooks
     *
     * @return void
     */
    function __construct()
    {
        add_filter('pre_get_posts', array($this, 'update_main_query'));
        add_filter('pre_get_posts', array($this, 'update_search_query'));
        add_filter('pre_get_posts', array($this, 'exclude_tax_children'));
    }

    /**
     * Update main query
     *
     * @return object
     */
    public static function update_main_query($query)
    {
        if (!is_admin() && $query->is_tax && is_tax()) {
            $query->set('posts_per_page', Helpers::get_theme_option('posts_per_page'));
        }

        return $query;
    }

    /**
     * Update search query
     *
     * @return object
     */
    public static function update_search_query($query)
    {
        if (!is_admin() && $query->is_search) {
            // Use custom value for posts per page
            $query->set('posts_per_page', Helpers::get_theme_option('results_per_page'));

            // Include resources
            $query->set('post_type', array('post', 'resource'));

            // Include only published posts
            $query->set('post_status', array('publish'));
        }

        return $query;
    }

    /**
     * Exclude children from taxonomy listing
     *
     * @return void
     */
    public static function exclude_tax_children($query)
    {
        if (!is_admin() && isset($query->query_vars['resource-collection'])) {
            $query->set('tax_query', array(array(
                'taxonomy'          => 'resource-collection',
                'field'             => 'slug',
                'terms'             => $query->query_vars['resource-collection'],
                'include_children'  => false,
            )));
        }
    }
}
