<?php

namespace Chipmunk\Vendors;

use Chipmunk\Helpers;
use Chipmunk\Settings\Licenser;

/**
 * Theme updater class.
 *
 * @package WordPress
 * @subpackage Chipmunk
 */
class Updater
{
    /**
     * Config object
     * @var object
     */
    private $config;

    /**
     * Transient key
     *
     * @var string
     */
    public $transient_key;

    /**
     * Transient allowed
     *
     * @var boolean
     */
    public $transient_allowed;

    /**
     * Initiate the Theme updater
     *
     * @param array $config    Array of arguments from the theme requesting an update check
     */
    public function __construct($config = [])
    {
        // Set config defaults
        $this->config = wp_parse_args($config, [
            'remote_api_url' => THEME_SHOP_URL . '/wp-json/lsq/v1/update',
            'theme_slug'     => THEME_ITEM_SLUG,
            'version'        => wp_get_theme()->get('Version'),
        ]);

        // Transient options
        $this->transient_key     = THEME_SLUG . '_updater';
        $this->transient_allowed = false; // Only disable this for debugging

        // Set hooks
        add_filter('pre_set_site_transient_update_themes', [$this, 'theme_update_transient'], 10, 2);
        add_filter('delete_site_transient_update_themes',  [$this, 'delete_theme_update_transient']);
        add_action('load-update-core.php',                 [$this, 'delete_theme_update_transient']);
        add_action('load-themes.php',                      [$this, 'delete_theme_update_transient']);
        add_filter('http_request_args',                    [$this, 'disable_wporg_request'], 5, 2);
    }

    /**
     * Update the theme update transient with the response from the version check
     *
     * @param  object $transient   The default update transient.
     * @return array|boolean  If an update is available, returns the update parameters, if no update is needed returns false, if
     *                        the request fails returns false.
     */
    public function theme_update_transient($transient)
    {
        if (empty($transient->checked[$this->config['theme_slug']])) {
            return $transient;
        }

        if ($data = $this->check_for_update()) {
            if (version_compare($this->config['version'], $data->update->version, '<')) {
                $transient->response[$this->config['theme_slug']] = [
                    'theme'        => $this->config['theme_slug'],
                    'new_version'  => $data->update->version,
                    'url'          => THEME_SHOP_URL,
                    'package'      => $data->update->download_link,
                    'requires'     => $data->update->requires,
                    'requires_php' => $data->update->requires_php,
                    'sections'     => (array) $data->update->sections,
                ];
            }
        }

        if (empty($transient->response[$this->config['theme_slug']])) {
            // Adding the "mock" item to the `no_update` property is required
            // for the enable/disable auto-updates links to correctly appear in UI.
            $transient->no_update[$this->config['theme_slug']] = [
                'theme'        => $this->config['theme_slug'],
                'new_version'  => $this->config['version'],
                'url'          => '',
                'package'      => '',
                'requires'     => '',
                'requires_php' => '',
            ];
        }

        return $transient;
    }

    /**
     * Remove the update data for the theme
     *
     * @return void
     */
    public function delete_theme_update_transient()
    {
        delete_transient($this->transient_key);
    }

    /**
     * Call the EDD SL API (using the URL in the construct) to get the latest version information
     *
     * @return object|boolean  If an update is available, returns the update parameters, if no update is needed returns false, if
     *                        the request fails returns false.
     */
    private function check_for_update()
    {
        // Check permissions
        if (!current_user_can('manage_options')) {
            return false;
        }

        // Check theme license
        if (!Helpers::is_active_license() || empty($license = Licenser::get_instance()->get_license_data())) {
            return false;
        }

        $update_data = get_transient($this->transient_key);

        if (false !== $update_data && $this->transient_allowed) {
            if ('error' === $update_data) {
                return false;
            }

            return $update_data;
        }

        $response = wp_remote_get("{$this->config['remote_api_url']}?license_key={$license->license_key->key}", [
            'timeout'   => 15,
        ]);

        if (!Helpers::is_valid_response($response)) {
            // If the response failed, try again in 15 minutes
            set_transient($this->transient_key, 'error', 15 * MINUTE_IN_SECONDS);

            return false;
        }

        $update_data = json_decode(wp_remote_retrieve_body($response));

        // Set the transient for a day
        set_transient($this->transient_key, $update_data, DAY_IN_SECONDS);

        // Check the version
        if (version_compare($this->config['version'], $update_data->update->version, '<')) {
            return $update_data;
        }
    }

    /**
     * Disable requests to wp.org repository for this theme.
     */
    public function disable_wporg_request($r, $url)
    {
        // If it's not a theme update request, bail.
        if (0 !== strpos($url, 'https://api.wordpress.org/themes/update-check/1.1/')) {
            return $r;
        }

        // Decode the JSON response
        $themes = json_decode($r['body']['themes']);

        // Remove the active parent and child themes from the check
        $parent = get_option('template');
        $child = get_option('stylesheet');
        unset($themes->themes->$parent);
        unset($themes->themes->$child);

        // Encode the updated JSON response
        $r['body']['themes'] = json_encode($themes);

        return $r;
    }
}
