<?php

namespace Chipmunk\Settings;

use Chipmunk\Helpers;
use Chipmunk\Settings;

/**
 * A License settings class
 *
 * @package WordPress
 * @subpackage Chipmunk
 */
class Licenser extends Settings
{
    /**
     * The Singleton's instance is stored in a static field.
     */
    private static $instances = [];

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
    private $license_key;

    /**
     * License key option
     *
     * @var string
     */
    private $license_key_option;

    /**
     * License data option
     *
     * @var string
     */
    private $license_data_option;

    /**
     * Instance ID option
     *
     * @var string
     */
    private $instance_id_option;

    /**
     * Setting name
     *
     * @var string
     */
    private $name = 'License';

    /**
     * Setting slug
     *
     * @var string
     */
    private $slug = 'license';

    /**
     * The Licenser's constructor should always be private to prevent direct
     * construction calls with the `new` operator.
     */
    protected function __construct()
    {
    }

    /**
     * Initialize the class
     *
     * @param array $config Config array
     * @param array $strings Strings array
     */
    public function init($config = [], $strings = [])
    {
        // Set config defaults
        $this->config = wp_parse_args($config, [
            'remote_api_url'    => '',
            'item_name'         => '',
            'item_slug'         => '',
        ]);

        // Set default strings
        $this->strings = wp_parse_args($strings, [
            'enter-key'                 => __('To receive updates, please enter your valid license key.', 'chipmunk'),
            'license-key'               => __('License Key', 'chipmunk'),
            'license-action'            => __('License Action', 'chipmunk'),
            'deactivate-license'        => __('Deactivate License', 'chipmunk'),
            'activate-license'          => __('Activate License', 'chipmunk'),
            'renew'                     => __('Renew License', 'chipmunk'),
            'unlimited'                 => __('unlimited', 'chipmunk'),
            'expires%s'                 => __('Expires %s.', 'chipmunk'),
            '%1$s/%2$-sites'            => __('You have %1$s / %2$s sites activated.', 'chipmunk'),
            'license-is-active'         => __('License is active.', 'chipmunk'),
            'license-is-inactive'       => __('License is inactive.', 'chipmunk'),
            'license-is-disabled'       => __('License is disabled.', 'chipmunk'),
            'license-is-expired'        => __('License is expired.', 'chipmunk'),
            'license-is-unknown'        => __('License is unknown.', 'chipmunk'),
        ]);

        // Set license option names
        $this->license_key_option = "{$this->config['item_slug']}_license_key";
        $this->instance_id_option = "{$this->config['item_slug']}_instance_id";
        $this->license_data_option = "{$this->config['item_slug']}_license_data";

        // Set license options
        $this->license_key = get_option($this->license_key_option);

        // Set hooks
        add_action('admin_init', [$this, 'register_option']);
        add_action('admin_init', [$this, 'activate_license']);
        add_action('admin_init', [$this, 'deactivate_license']);
        add_action('admin_init', [$this, 'validate_license']);

        // Output settings content
        add_filter('chipmunk_settings_tabs', [$this, 'add_settings_tab']);
        add_filter('chipmunk_admin_notices', [$this, 'add_inactive_license_notice']);
    }

    /**
     * Activates the license key.
     *
     * @return void
     */
    public function activate_license()
    {
        if (!isset($_POST["{$this->config['item_slug']}_activate"])) {
            return;
        }

        $this->license_key = sanitize_text_field($_POST[$this->license_key_option]);

        if ($data = $this->get_api_response('activate')) {
            set_transient($this->instance_id_option, $data->instance->id);

            // Set fresh license data
            $this->set_license_data($data);
        }
    }

    /**
     * Deactivates the license key.
     *
     * @return void
     */
    public function deactivate_license()
    {
        if (!isset($_POST["{$this->config['item_slug']}_deactivate"])) {
            return;
        }

        if ($data = $this->get_api_response('deactivate')) {
            delete_transient($this->instance_id_option);

            // Set fresh license data
            $this->set_license_data($data);
        }
    }

    /**
     * Checks the license key and stores the license data in db.
     *
     * @return object
     */
    public function validate_license()
    {
        if (!$this->get_license_data() && $data = $this->get_api_response('validate')) {
            // Set fresh license data
            $this->set_license_data($data);
        }
    }

    /**
     * Sets the license data.
     *
     * @return void
     */
    public function set_license_data($license_data)
    {
        // Unset unneeded data
        unset($license_data->activated);
        unset($license_data->deactivated);
        unset($license_data->valid);
        unset($license_data->error);

        // Set license data
        set_transient($this->license_data_option, serialize($license_data), WEEK_IN_SECONDS);
    }

    /**
     * Returns the license data.
     *
     * @return object
     */
    public function get_license_data()
    {
        $license_data = get_transient($this->license_data_option);

        if (!empty($license_data)) {
            return maybe_unserialize($license_data);
        }
    }

    /**
     * Makes a call to the API and returns the response.
     *
     * @param string $action Name of the API action
     *
     * @return object|null JSON response.
     */
    private function get_api_response($action)
    {
        if (empty($this->license_key)) {
            return;
        }

        $license_param = ['license_key' => $this->license_key];
        $instance_id = get_transient($this->instance_id_option);
        $instance_param = !empty($instance_id)
            ? ['instance_id' => $instance_id]
            : ['instance_name' => get_bloginfo('name')];

        $response = wp_remote_post("{$this->config['remote_api_url']}/licenses/{$action}", [
            'timeout' => 15,
            'headers' => ['Accept' => 'application/json'],
            'body'    => array_merge($license_param, $instance_param),
        ]);

        $body = json_decode(wp_remote_retrieve_body($response));

        if (!Helpers::is_valid_response($response)) {
            $this->display_settings_error($response, $body->error);
            return;
        }

        return $body;
    }

    /**
     * Displays the error on the page
     *
     * @param object $response Remote API response object
     * @param string $error Fallback error message
     */
    private function display_settings_error($response, $error = '')
    {
        $message = is_wp_error($response) ? $response->get_error_message() : $error;

        // Add proper error message
        $this->add_settings_error($this->slug, $message);
    }

    /**
     * Returns a license status
     *
     * @param object $data License data object
     *
     * @return string/object License status.
     */
    public function get_license_status($data)
    {
        $messages = [];

        // If response doesn't include license data, return
        if (empty($data->license_key)) {
            return $this->strings['license-is-unknown'];
        }

        if ($data->license_key->expires_at) {
            $expires_at = date_i18n('F j, Y', strtotime($data->license_key->expires_at, current_time('timestamp')));
            $renew_link = '<a href="' . esc_url(THEME_SHOP_URL) . '" target="_blank">' . $this->strings['renew'] . '</a>';
        }

        switch ($data->license_key->status) {
            case 'active':
                $messages[] = $this->strings['license-is-active'];

                if (!empty($expires_at)) {
                    $messages[] = sprintf($this->strings['expires%s'], $expires_at);
                }

                if ($data->license_key->activation_usage) {
                    $messages[] = sprintf($this->strings['%1$s/%2$-sites'], $data->license_key->activation_usage, $data->license_key->activation_limit ?? $this->strings['unlimited']);
                }

                break;

            case 'expired':
                $messages[] = $this->strings['license-is-expired'];

                if (!empty($renew_link)) {
                    $messages[] = $renew_link;
                }

                break;

            case 'inactive':
                $messages[] = $this->strings['license-is-inactive'];
                break;

            case 'disabled':
                $messages[] = $this->strings['license-is-disabled'];
                break;

            default:
                $messages[] = $this->strings['license-is-unknown'];
                break;
        }

        return implode(' ', $messages);
    }

    /**
     * Registers the option used to store the license key in the options table.
     */
    public function register_option()
    {
        register_setting(
            $this->license_key_option,
            $this->license_key_option
        );
    }

    /**
     * Adds settings tab to the list
     */
    public function add_settings_tab($tabs)
    {
        $tabs[] = [
            'name'      => $this->name,
            'slug'      => $this->slug,
            'content'   => $this->get_settings_content(),
        ];

        return $tabs;
    }

    /**
     * Returns the markup used on the theme license page.
     */
    private function get_settings_content()
    {
        ob_start();

        $data   = $this->get_license_data();
        $status = $this->get_license_status($data);
?>

        <form action="options.php" method="post">
            <div class="chipmunk__license chipmunk__box">
                <h3 class="chipmunk__license-head">
                    <?php echo $this->config['item_name']; ?>
                </h3>

                <div class="chipmunk__license-body">
                    <?php settings_fields($this->license_key_option); ?>

                    <input id="<?php echo $this->license_key_option; ?>" name="<?php echo $this->license_key_option; ?>" type="text" class="regular-text" value="<?php echo esc_attr($this->license_key); ?>" placeholder="<?php echo esc_attr($this->strings['license-key']); ?>" />

                    <?php if (!empty($data->license_key) && 'active' === $data->license_key->status) : ?>
                        <button type="submit" class="button-secondary" name="<?php echo $this->config['item_slug']; ?>_deactivate"><?php echo esc_attr($this->strings['deactivate-license']); ?></button>
                    <?php else : ?>
                        <button type="submit" class="button-primary" name="<?php echo $this->config['item_slug']; ?>_activate"><?php echo esc_attr($this->strings['activate-license']); ?></button>
                    <?php endif; ?>
                </div>

                <?php if (empty($data->license_key)) : ?>
                    <div class="chipmunk__license-data is-inactive">
                        <p class="description"><?php echo __('Please activate your license to unlock all functionalities.', 'chipmunk'); ?></p>
                    </div>
                <?php else : ?>
                    <div class="chipmunk__license-data is-<?php echo $data->license_key->status; ?>">
                        <p class="description"><?php echo $status; ?></p>
                    </div>
                <?php endif; ?>

                <?php do_action('chipmunk_license_content'); ?>
            </div>
        </form>

<?php
        return ob_get_clean();
    }

    /**
     * Adds a notice to the admin dashboard if the license is inactive.
     *
     * @param array $notices Array of notices.
     *
     * @return array Array of notices.
     */
    public function add_inactive_license_notice($notices)
    {
        if ('toplevel_page_chipmunk' === get_current_screen()->id) {
            return $notices;
        }

        $data = $this->get_license_data();

        if (empty($data->license_key) || 'active' !== $data->license_key->status) {
            $notices[] = [
                'type' => 'warning',
                'message' => sprintf(
                    __('Please <a href="%1$s">activate</a> your %2$s license to <strong>unlock all functionalities</strong>.', 'chipmunk'),
                    get_admin_url(null, 'admin.php?page=chipmunk'),
                    $this->config['item_name']
                ),
            ];
        }

        return $notices;
    }

    /**
     * This is the static method that controls the access to the Licenser
     * instance. On the first run, it creates a singleton object and places it
     * into the static field. On subsequent runs, it returns the client existing
     * object stored in the static field.
     *
     * This implementation lets you subclass the Singleton class while keeping
     * just one instance of each subclass around.
     */
    public static function get_instance(): Licenser
    {
        $cls = static::class;

        if (!isset(self::$instances[$cls])) {
            self::$instances[$cls] = new static();
        }

        return self::$instances[$cls];
    }
}
