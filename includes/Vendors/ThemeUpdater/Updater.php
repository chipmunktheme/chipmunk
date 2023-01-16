<?php

namespace Chipmunk\Vendors\ThemeUpdater;

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
     * Strings array
     *
     * @var array
     */
    private $strings;

    /**
     * License key
     *
     * @var string
     */
    private $response_key;

    /**
     * License key
     *
     * @var string
     */
    private $item_slug;

    /**
     * Initiate the Theme updater
     *
     * @param array $config    Array of arguments from the theme requesting an update check
     * @param array $strings Strings for the update process
     */
    public function __construct($config = array(), $strings = array())
    {
        $this->config         = wp_parse_args($config, array());
        $this->item_slug      = sanitize_key($config['item_slug']);
        $this->response_key   = $this->config['item_slug'] . '-' . $this->config['beta'] . '-update-response';
        $this->strings        = $strings;

        // Theme Version Checker
        add_filter('pre_set_site_transient_update_themes', array($this, 'theme_update_transient'), 10, 2);
        add_filter('delete_site_transient_update_themes',  array($this, 'delete_theme_update_transient'));
        add_action('load-update-core.php',                 array($this, 'delete_theme_update_transient'));
        add_action('load-themes.php',                      array($this, 'delete_theme_update_transient'));
    }

    /**
     * Update the theme update transient with the response from the version check
     *
     * @param  object $value   The default update values.
     * @return array|boolean  If an update is available, returns the update parameters, if no update is needed returns false, if
     *                        the request fails returns false.
     */
    public function theme_update_transient($value)
    {
        if (isset($value->response) && empty($value->checked[$this->item_slug])) {
            return $value;
        }

        if ($data = $this->check_for_update()) {
            $value->response[$this->item_slug] = array(
                'theme'         => $this->item_slug,
                'new_version'   => $data['new_version'],
                'url'           => $data['url'],
                'package'       => $data['package'],
            );
        }

        return $value;
    }

    /**
     * Remove the update data for the theme
     *
     * @return void
     */
    public function delete_theme_update_transient()
    {
        delete_transient($this->response_key);
    }

    /**
     * Call the EDD SL API (using the URL in the construct) to get the latest version information
     *
     * @return array|boolean  If an update is available, returns the update parameters, if no update is needed returns false, if
     *                        the request fails returns false.
     */
    private function check_for_update()
    {
        $update_data = get_transient($this->response_key);

        if (false === $update_data) {
            $failed = false;

            $response = wp_remote_post($this->config['remote_api_url'], array(
                'timeout'   => 15,
                'body'      => array(
                    'edd_action' => 'get_version',
                    'license'    => $this->config['license'],
                    'name'       => $this->config['item_name'],
                    'slug'       => $this->item_slug,
                    'version'    => $this->config['version'],
                    'author'     => $this->config['author'],
                    'beta'       => $this->config['beta'],
                ),
            ));

            // Make sure the response was successful
            if (is_wp_error($response) || 200 != wp_remote_retrieve_response_code($response)) {
                $failed = true;
            }

            $update_data = json_decode(wp_remote_retrieve_body($response));

            if (!is_object($update_data)) {
                $failed = true;
            }

            // If the response failed, try again in 30 minutes
            if ($failed) {
                $data = new \stdClass;
                $data->new_version = $this->config['version'];
                set_transient($this->response_key, $data, strtotime('+30 minutes', time()));
                return false;
            } else {
                $update_data->sections = maybe_unserialize($update_data->sections);
                set_transient($this->response_key, $update_data, strtotime('+12 hours', time()));
            }
        }

        if (version_compare($this->config['version'], $update_data->new_version, '<')) {
            return (array) $update_data;
        }
    }
}
