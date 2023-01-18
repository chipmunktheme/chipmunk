<?php

namespace Chipmunk;

use Chipmunk\Settings\Licenser;
use Chipmunk\Settings\Faker;
use Chipmunk\Settings\Addons;

/**
 * Custom settings pages for the theme
 *
 * @package WordPress
 * @subpackage Chipmunk
 */
class Settings
{
    /**
     * License data object
     *
     * @var object
     */
    private static $license;

    /**
     * Used to register custom hooks
     *
     * @return void
     */
    function __construct()
    {
        add_action('admin_menu', [$this, 'add_menu_page'], 1);
        add_action('chipmunk_settings_nav', [$this, 'add_menu_page'], 1);

        // Initialize theme licenser
        Licenser::get_instance()->init([
            'remote_api_url' => THEME_API_URL,
            'item_name'      => THEME_TITLE,
            'item_slug'      => THEME_SLUG,
        ]);

        // Initialize other settings
        Faker::get_instance()->init();
        Addons::get_instance()->init();
    }

    /**
     * Register settings page to the admin_menu action hook
     */
    public function add_menu_page()
    {
        add_menu_page(
            THEME_TITLE,
            THEME_TITLE,
            'edit_theme_options',
            THEME_SLUG,
            [$this, 'admin_settings'],
            Helpers::svg_to_base64(Assets::asset_path('images/logo.svg')),
        );
    }

    /**
     * Outputs the markup used on the theme settings page.
     */
    public function admin_settings()
    {
        $tabs = apply_filters('chipmunk_settings_tabs', []);
?>

        <div class="chipmunk">
            <div class="chipmunk__head chipmunk__wrap">
                <h1 class="chipmunk__title">
                    <?php echo Helpers::get_svg_content(Assets::asset_path('images/logo.svg')); ?>
                    <?php echo THEME_TITLE; ?>
                </h1>

                <?php if (Helpers::is_active_license(self::$license)) : ?>
                    <div class="chipmunk__status">
                        <div class="chipmunk__status-icon">
                            ✓
                        </div>

                        <?php if ($variant = Helpers::get_license_variant(self::$license)) : ?>
                            <div class="chipmunk__status-content">
                                <strong><?php printf(esc_html__('%s License', 'chipmunk'), $variant['name']); ?></strong><br>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <div class="wrap">
                    <h2></h2>
                </div>
            </div>

            <div class="chipmunk__nav chipmunk__wrap">
                <ul>
                    <?php foreach ($tabs as $tab) : ?>
                        <li><a href="?page=chipmunk&tab=<?php echo esc_attr($tab['slug']); ?>" <?php echo $this->is_active_tab($tabs, $tab) ? 'class="active"' : ''; ?>><?php echo esc_html($tab['name']); ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <div class="chipmunk__main chipmunk__wrap">
                <?php settings_errors(); ?>

                <?php foreach ($tabs as $index => $tab) : ?>
                    <?php if ($this->is_active_tab($tabs, $tab) && !empty($tab['content'])) : ?>
                        <?php echo $tab['content']; ?>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>

            <script>
                var HW_config = {
                    selector: ".chipmunk__head h1",
                    account: "yZMVmJ"
                }
            </script>
            <script async src="https://cdn.headwayapp.co/widget.js"></script>
        </div>

<?php
    }

    /**
     * Checks if the tab is active
     *
     * @param array $tabs Tabs array list
     * @param array $tab Single tab instance
     */
    private function is_active_tab($tabs, $tab)
    {
        return (!empty($_GET['tab']) && $_GET['tab'] == $tab['slug']) || (empty($_GET['tab']) && $tabs[0] == $tab);
    }

    /**
     * Adds setting error using Settings API
     *
     * @param string $message Error message
     * @param string $type Error type
     */
    protected function add_settings_error($setting, $message, $type = 'error')
    {
        $setting = THEME_SLUG . '_' . $setting;
        $errors = get_settings_errors($setting);

        if (!empty($message) && !Helpers::find_key_value($errors, 'code', $setting)) {
            add_settings_error($setting, $setting, $message, $type);
        }
    }

    /**
     * Returns the license data
     *
     * @return object
     */
    public static function get_license()
    {
        return self::$license;
    }
}
