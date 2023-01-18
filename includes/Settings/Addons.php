<?php

namespace Chipmunk\Settings;

use Chipmunk\Helpers;
use Chipmunk\Settings;

/**
 * A Addons settings class
 *
 * @package WordPress
 * @subpackage Chipmunk
 */
class Addons extends Settings
{
    /**
     * The Singleton's instance is stored in a static field.
     */
    private static $instances = [];

    /**
     * Option name
     *
     * @var string
     */
    private $option;

    /**
     * Setting name
     *
     * @var string
     */
    private $name = 'Addons';

    /**
     * Setting slug
     *
     * @var string
     */
    private $slug = 'addons';

    /**
     * The Addons's constructor should always be private to prevent direct
     * construction calls with the `new` operator.
     */
    protected function __construct()
    {
    }

    /**
     * Initialize the class
     */
    public function init()
    {
        $this->option = THEME_SLUG . '_' . $this->slug;

        // Setup hooks
        add_action('admin_init', [$this, 'register_option']);
        add_filter('chipmunk_settings_tabs', [$this, 'add_settings_tab']);
    }

    /**
     * Returns the option name
     */
    public function get_option_name()
    {
        return $this->option;
    }

    /**
     * Registers the option used to store the license key in the options table.
     */
    public function register_option()
    {
        register_setting(
            $this->option,
            $this->option
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
     * Returns the settings markup for upvote faker
     */
    private function get_settings_content()
    {
        $addons = apply_filters('chipmunk_settings_addons', []);
        $options = get_option($this->option);

        ob_start();
?>
        <form action="options.php" method="post">
            <?php settings_fields($this->option); ?>

            <div class="chipmunk__addons">
                <?php foreach ($addons as $addon) : ?>
                    <?php $setting_name = $this->option . "[{$addon['slug']}]"; ?>

                    <div class="chipmunk__addons-item chipmunk__box">
                        <h3 class="chipmunk__addons-title"><?php echo esc_html($addon['name']); ?></h3>

                        <p class="chipmunk__addons-excerpt">
                            <?php echo esc_html($addon['excerpt']); ?>
                            <a href="<?php echo esc_attr($addon['url']); ?>" target="_blank" class="link"><?php esc_html_e('Read more', 'chipmunk'); ?> &rarr;</a>
                        </p>

                        <div class="chipmunk__addons-cta">
                            <?php if (!Helpers::is_active_license()) : ?>
                                <p class="chipmunk__addons-error">
                                    <?php esc_html_e('Please use a valid license to enable.', 'chipmunk'); ?>
                                </p>
                            <?php elseif (!Helpers::is_addon_allowed($addon['slug'])) : ?>
                                <p class="chipmunk__addons-error">
                                    <a href="<?php echo esc_url(THEME_SHOP_URL); ?>/account/licenses" target="_blank" class="button-secondary"><?php esc_html_e('Upgrade now', 'chipmunk'); ?></a>
                                    <span><?php printf(esc_html__('Available in the %s plan.', 'chipmunk'), array_column(Helpers::get_allowed_variants($addon['slug']), 'name')[0]); ?></span>
                                </p>
                            <?php else : ?>
                                <label for="<?php echo esc_attr($addon['slug']); ?>">
                                    <input type="checkbox" name="<?php echo esc_attr($setting_name); ?>" id="<?php echo esc_attr($addon['slug']); ?>" value="1" <?php checked(1, $options[$addon['slug']] ?? '0'); ?> />
                                    <?php printf(esc_html__('Enable %s Addon', 'chipmunk'), $addon['name']); ?>
                                </label>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <?php if (Helpers::is_active_license()) : ?>
                <?php submit_button(); ?>
            <?php endif; ?>
        </form>

<?php
        return ob_get_clean();
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
    public static function get_instance(): Addons
    {
        $cls = static::class;

        if (!isset(self::$instances[$cls])) {
            self::$instances[$cls] = new static();
        }

        return self::$instances[$cls];
    }
}
