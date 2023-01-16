<?php

namespace Chipmunk\Addons;

use Chipmunk\Helpers;

/**
 * Allows users to sign-up and improve the experience of the theme
 *
 * @package WordPress
 * @subpackage Chipmunk
 */
class Members
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
     * Creates all WordPress pages needed by the addon.
     */
    private function register_pages()
    {
        $options = Members\Helpers::get_options('pages');

        // Information needed for creating the addon's pages
        $page_definitions = array(
            'login' => array(
                'title' => __('Login', 'chipmunk'),
                'content' => '[chipmunk-login-form]',
                'template' => 'page-narrow-width.php',
            ),

            'register' => array(
                'title' => __('Register', 'chipmunk'),
                'content' => '[chipmunk-register-form]',
                'template' => 'page-narrow-width.php',
            ),

            'lost-password' => array(
                'title' => __('Forgot Your Password?', 'chipmunk'),
                'content' => '[chipmunk-lost-password-form]',
                'template' => 'page-narrow-width.php',
            ),

            'reset-password' => array(
                'title' => __('Reset Password', 'chipmunk'),
                'content' => '[chipmunk-reset-password-form]',
                'template' => 'page-narrow-width.php',
            ),

            'profile' => array(
                'title' => __('Edit Profile', 'chipmunk'),
                'content' => '[chipmunk-profile-form]',
                'template' => 'page-narrow-width.php',
            ),

            'dashboard' => array(
                'title' => __('Dashboard', 'chipmunk'),
                'content' => '[chipmunk-dashboard]',
                'template' => 'page-full-width.php',
            ),
        );

        foreach ($page_definitions as $slug => $page) {
            $normalized_slug = str_replace('-', '_', $slug);
            $option_slug = "chipmunk_{$normalized_slug}_page_id";
            $current_page = $options[$option_slug];

            if (empty($current_page) || !get_post($current_page) || get_post_status($current_page) != 'publish') {
                // Add the page using the data from the array above
                $post_id = wp_insert_post(
                    array(
                        'post_content'   => "<!-- wp:shortcode -->{$page['content']}<!-- /wp:shortcode -->",
                        'post_name'      => $slug,
                        'post_title'     => $page['title'],
                        'post_status'    => 'publish',
                        'post_type'      => 'page',
                        'ping_status'    => 'closed',
                        'comment_status' => 'closed',
                        'page_template'  => $page['template'],
                    )
                );

                $options[$option_slug] = $post_id;
            } elseif (get_post($current_page) && get_post_status($current_page) != 'publish') {
                wp_update_post(
                    array(
                        'ID'             => $current_page,
                        'post_status'    => 'publish',
                    ),
                );
            }
        }

        // Remove and recreate rewrite rules
        flush_rewrite_rules();

        // Update page options
        Members\Helpers::set_options('pages', $options);
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
            $this->register_pages();

            // Set transient
            set_transient($this->transient, true);
        }

        new Members\Actions();
        new Members\Config();
        new Members\Redirects();
        new Members\Renderers();
        new Members\Settings($this->config);
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
