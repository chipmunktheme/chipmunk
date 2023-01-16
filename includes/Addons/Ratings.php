<?php

namespace Chipmunk\Addons;

use Chipmunk\Helpers;

/**
 * Adds a 5-star rating system to the theme
 *
 * @package WordPress
 * @subpackage Chipmunk
 */
class Ratings
{
    /**
     * Config object
     * @var object
     */
    private $config;

    /**
     * Transient name
     * @var string
     */
    private $transient;

    /**
     * Allowed post types supporting ChipmunkRatings
     *
     * @since 1.0
     * @var array
     */
    private $allowed_types = array('post', 'resource');

    /**
     * Initializes the addon.
     *
     * To keep the initialization fast, only add filter and action
     * hooks in the constructor.
     *
     * @return void
     */
    public function __construct($config = array())
    {
        // Set config defaults
        $this->config = wp_parse_args($config, array(
            'name'         => '',
            'slug'         => '',
            'excerpt'      => '',
            'url'          => '',
        ));

        $this->transient = THEME_SLUG . '_' . $this->config['slug'] . '_init';

        // Set hooks
        $this->hooks();
    }

    /**
     * Setup hooks
     *
     * @return  void
     */
    private function hooks()
    {
        add_action('init', array($this, 'setup_addon'));
        add_filter('chipmunk_settings_addons', array($this, 'add_settings_addon'));
    }

    /**
     * Page initialization
     *
     * Generates default post meta for all posts
     */
    private function register_post_meta()
    {
        $posts = get_posts(array(
            'posts_per_page' => -1,
            'post_type'      => $this->allowed_types,
        ));

        foreach ($posts as $post) {
            $this->add_default_meta($post->ID, $this->allowed_types);
        }
    }

    /**
     * Sets the default values for posts
     *
     * @param string $post_id Post ID
     *
     * @return array
     */
    private function add_default_meta($post_ID, $allowed_types)
    {
        $defaut_values = array(
            '_' . THEME_SLUG . '_rating_count'   => 0,
            '_' . THEME_SLUG . '_rating_average' => 0,
            '_' . THEME_SLUG . '_rating_rank'    => 0,
        );

        return \Chipmunk\Helpers::add_post_meta($post_ID, $defaut_values, $allowed_types);
    }

    /**
     * Setup main components and features of the addon
     *
     * @return void
     */
    public function setup_addon()
    {
        if (!Helpers::is_addon_enabled($this->config['slug'])) {
            return;
        }

        if (!get_transient($this->transient)) {
            // Register post meta
            $this->register_post_meta();

            // Set transient
            set_transient($this->transient, true);
        }

        new Ratings\Actions();
        new Ratings\Renderers();
    }

    /**
     * Add settings addon component
     *
     * @return array
     */
    public function add_settings_addon($addons)
    {
        $addons[] = $this->config;

        return $addons;
    }
}
