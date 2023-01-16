<?php

namespace Chipmunk\Settings;

use \Chipmunk\Settings;

/**
 * A Addons settings class
 *
 * @package WordPress
 * @subpackage Chipmunk
 */
class Addons extends Settings
{
    /**
     * Option name
     *
     * @var string
     */
    private static $option;

    /**
     * Setting name
     *
     * @var string
     */
    private static $name = 'Addons';

    /**
     * Setting slug
     *
     * @var string
     */
    private static $slug = 'addons';

    /**
     * Initialize the class
     */
    function __construct()
    {
        self::$option = THEME_SLUG . '_' . self::$slug;

        add_action('admin_init', array($this, 'register_option'));

        // Output settings content
        add_filter('chipmunk_settings_tabs', array($this, 'add_settings_tab'));
    }

    /**
     * Registers the option used to store the license key in the options table.
     */
    public function register_option()
    {
        register_setting(
            self::$option,
            self::$option
        );
    }

    /**
     * Adds settings tab to the list
     */
    public function add_settings_tab($tabs)
    {
        $tabs[] = array(
            'name'      => self::$name,
            'slug'      => self::$slug,
            'content'   => $this->get_settings_content(),
        );

        return $tabs;
    }

    /**
     * Returns the settings markup for upvote faker
     */
    private function get_settings_content()
    {
        $addons = apply_filters('chipmunk_settings_addons', array());
        $options = get_option(self::$option);

        ob_start();

?>

        <form action="options.php" method="post">
            <?php settings_fields(self::$option); ?>

            <div class="chipmunk__addons">
                <?php foreach ($addons as $addon) : ?>
                    <?php $setting_name = self::$option . "[{$addon['slug']}]"; ?>

                    <div class="chipmunk__addons-item chipmunk__box">
                        <h3 class="chipmunk__addons-title"><?php echo esc_html($addon['name']); ?></h3>

                        <p class="chipmunk__addons-excerpt">
                            <?php echo esc_html($addon['excerpt']); ?>
                            <a href="<?php echo esc_attr($addon['url']); ?>" target="_blank" class="link"><?php esc_html_e('Read more', 'chipmunk'); ?> &rarr;</a>
                        </p>

                        <div class="chipmunk__addons-cta">
                            <?php if (!self::is_active_license()) : ?>
                                <p class="chipmunk__addons-error">
                                    <?php esc_html_e('Please use a valid license to enable.', 'chipmunk'); ?>
                                </p>
                            <?php elseif (!self::is_addon_allowed($addon['slug'])) : ?>
                                <p class="chipmunk__addons-error">
                                    <a href="<?php echo esc_url(THEME_SHOP_URL); ?>/account/licenses" target="_blank" class="button-secondary"><?php esc_html_e('Upgrade now', 'chipmunk'); ?></a>
                                    <span><?php printf(esc_html__('Available in the %s plan.', 'chipmunk'), array_column(self::get_allowed_variants($addon['slug']), 'name')[0]); ?></span>
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

            <?php submit_button(); ?>
        </form>

<?php
        return ob_get_clean();
    }

    /**
     * Get the allowed variants for given addon
     */
    public static function get_allowed_variants($addon)
    {
        return array_filter(THEME_VARIANTS, function ($variant) use ($addon) {
            return in_array($addon, $variant['addons']);
        });
    }

    /**
     * Check if Chipmunk plugin is allowed
     */
    public static function is_addon_allowed($addon)
    {
        if (!self::is_active_license() || !self::get_license_variant()) {
            return false;
        }

        return in_array($addon, self::get_license_variant()['addons']);
    }

    /**
     * Check if Chipmunk plugin is enabled
     */
    public static function is_addon_enabled($addon)
    {
        $option = get_option(self::$option);

        return self::is_addon_allowed($addon) && !empty($option[$addon]);
    }
}
