<?php

namespace Chipmunk\Settings;

use \Chipmunk\Settings;

/**
 * A Faker settings class
 *
 * @package WordPress
 * @subpackage Chipmunk
 */
class Faker extends Settings
{
    /**
     * The Singleton's instance is stored in a static field.
     */
    private static $instances = [];

    /**
     * Setting name
     *
     * @var string
     */
    private $name = 'Faker';

    /**
     * Setting slug
     *
     * @var string
     */
    private $slug = 'faker';

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
        add_action('admin_init', [$this, 'action']);

        // Output settings content
        add_filter('chipmunk_settings_tabs', [$this, 'add_settings_tab']);
    }

    /**
     * Checks if a generator action was submitted.
     */
    public function action()
    {
        if (isset($_POST[THEME_SLUG . '_generator_upvote'])) {
            self::generate('upvote', (int) $_POST[THEME_SLUG . '_generator_upvote_start'], (int) $_POST[THEME_SLUG . '_generator_upvote_end'], ['resource']);
        }

        if (isset($_POST[THEME_SLUG . '_generator_view'])) {
            self::generate('post_view', (int) $_POST[THEME_SLUG . '_generator_view_start'], (int) $_POST[THEME_SLUG . '_generator_view_end'], ['post', 'resource']);
        }
    }

    /**
     * Generate fake values for upvote and view counters
     */
    private function generate($type, $start, $end, $post_types)
    {
        if (empty($start) && empty($end)) {
            $this->add_settings_error($this->slug, __('You need to provide both values for the range!', 'chipmunk'));
            return;
        }

        $db_key = '_' . THEME_SLUG . '_' . $type . '_count';

        $posts = get_posts([
            'post_type'         => $post_types,
            'post_status'       => 'any',
            'posts_per_page'    => -1,
        ]);

        foreach ($posts as $post) {
            $count = (int) get_post_meta($post->ID, $db_key, true);

            if (isset($count) && is_numeric($count)) {
                update_post_meta($post->ID, $db_key, $count + rand($start, ($start > $end ? $start : $end)));
            }
        }

        $this->add_settings_error($this->slug, __('Fake counters successfully generated!', 'chipmunk'), 'success');
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
        ob_start();
?>
        <h2><?php esc_html_e('Fake counter generators', 'chipmunk'); ?></h2>

        <p class="description">
            <?php esc_html_e('Adds fake values for your upvote or view counters.', 'chipmunk'); ?>
        </p>

        <table class="form-table">
            <tbody>
                <tr>
                    <th><?php esc_html_e('Upvotes', 'chipmunk'); ?></th>

                    <td>
                        <form method="post" action="">
                            <input type="number" class="small-text" name="<?php echo esc_attr(THEME_SLUG . '_generator_upvote_start'); ?>" value="" min="0" placeholder="<?php esc_attr_e('Start', 'chipmunk'); ?>" />
                            <input type="number" class="small-text" name="<?php echo esc_attr(THEME_SLUG . '_generator_upvote_end'); ?>" value="" min="0" placeholder="<?php esc_attr_e('End', 'chipmunk'); ?>" />
                            <button type="submit" class="button-primary" name="<?php echo esc_attr(THEME_SLUG . '_generator_upvote'); ?>"><?php esc_html_e('Generate', 'chipmunk'); ?></button>
                        </form>

                        <p class="description">
                            <?php printf(esc_html__('Pick a range to generate %1$s from.', 'chipmunk'), esc_html__('upvotes', 'chipmunk')); ?>
                        </p>
                    </td>
                </tr>

                <tr>
                    <th><?php esc_html_e('Views', 'chipmunk'); ?></th>

                    <td>
                        <form method="post" action="">
                            <input type="number" class="small-text" name="<?php echo esc_attr(THEME_SLUG . '_generator_view_start'); ?>" value="" min="0" placeholder="<?php esc_attr_e('Start', 'chipmunk'); ?>" />
                            <input type="number" class="small-text" name="<?php echo esc_attr(THEME_SLUG . '_generator_view_end'); ?>" value="" min="0" placeholder="<?php esc_attr_e('End', 'chipmunk'); ?>" />
                            <button type="submit" class="button-primary" name="<?php echo esc_attr(THEME_SLUG . '_generator_view'); ?>"><?php esc_html_e('Generate', 'chipmunk'); ?></button>
                        </form>

                        <p class="description">
                            <?php printf(esc_html__('Pick a range to generate %1$s from.', 'chipmunk'), esc_html__('views', 'chipmunk')); ?>
                        </p>
                    </td>
                </tr>
            </tbody>
        </table>

<?php
        return ob_get_clean();
    }

    /**
     * This is the static method that controls the access to the singleton
     * instance. On the first run, it creates a singleton object and places it
     * into the static field. On subsequent runs, it returns the client existing
     * object stored in the static field.
     *
     * This implementation lets you subclass the Singleton class while keeping
     * just one instance of each subclass around.
     */
    public static function get_instance(): Faker
    {
        $cls = static::class;

        if (!isset(self::$instances[$cls])) {
            self::$instances[$cls] = new static();
        }

        return self::$instances[$cls];
    }
}
