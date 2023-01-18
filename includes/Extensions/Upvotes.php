<?php

namespace Chipmunk\Extensions;

use Chipmunk\Helpers;
use Chipmunk\Customizer;

/**
 * Upvotes class
 *
 * @package WordPress
 * @subpackage Chipmunk
 */
class Upvotes
{
    /**
     * Current post ID
     *
     * @var int
     */
    private $post_id;

    /**
     * Current user ID
     *
     * @var int
     */
    private $user_id;

    /**
     * Database meta key
     *
     * @var string
     */
    public static $db_key = '_' . THEME_SLUG . '_upvote';
    public static $db_key_count = '_' . THEME_SLUG . '_upvote_count';
    public static $db_old_key = '_' . THEME_SLUG . '_post_upvote_count';

    /**
     * Create a new upvotes object
     *
     * @param  object $post_id
     *
     * @return void
     */
    function __construct($post_id)
    {
        global $current_user;

        $this->post_id = intval(wp_filter_kses($post_id));
        $this->user_id = !empty($current_user->ID) ? $current_user->ID : (Helpers::is_addon_enabled('members') && Helpers::get_theme_option('restrict_guest_upvotes') ? null : Helpers::get_ip());
    }

    /**
     * Output the upvote button
     *
     * @param  string $class
     *
     * @return string
     */
    public function get_button($action, $class = '')
    {
        $upvoted = $this->is_upvoted();
        $content = $this->get_content($upvoted);

        if ($upvoted) {
            $class = $class . ' is-active';
            $title = esc_html__('Remove upvote', 'chipmunk');
        } else {
            $title = esc_html__('Upvote', 'chipmunk');
        }

        $button = "<span class='$class' title='$title' data-action='$action' data-action-event='click' data-action-post-id='$this->post_id'>$content</span>";
        return $button;
    }

    /**
     * Retrieves proper content template
     *
     * @return string
     */
    public function get_content()
    {
        $icon = Helpers::get_template_part('partials/icon', ['icon' => 'thumbs-up'], false);

        $count = $this->get_upvote_count();
        $label = (is_numeric($count) && $count > 0) ? Helpers::format_number($count) : 0;

        return "<span>$icon$label</span";
    }

    /**
     * Toggles post upvote status
     *
     * @return object
     */
    private function toggle_upvote()
    {
        $upvoted = $this->is_upvoted();
        $current_counter = (int) get_post_meta($this->post_id, self::$db_key_count, true);

        // Remove upvote from the post
        if ($upvoted) {
            delete_post_meta($this->post_id, self::$db_key, $this->user_id);
            update_post_meta($this->post_id, self::$db_key_count, ($current_counter == 0 ? 0 : $current_counter - 1));

            $response['status'] = 'remove';
        }

        // Upvote the post
        else {
            add_post_meta($this->post_id, self::$db_key, $this->user_id);
            update_post_meta($this->post_id, self::$db_key_count, ($current_counter + 1));

            $response['status'] = 'add';
        }

        // Set proper resounse params
        $response['post'] = $this->post_id;
        $response['content'] = $this->get_content(!$upvoted);

        return $response;
    }

    /**
     * Tests if the post is already upvoted
     *
     * @return boolean
     */
    private function is_upvoted()
    {
        return in_array($this->user_id, get_post_meta($this->post_id, self::$db_key));
    }

    /**
     * Utility retrieves upvote count for post,
     * returns appropriate number
     *
     * @return integer
     */
    private function get_upvote_count()
    {
        $old_count = (int) get_post_meta($this->post_id, self::$db_old_key, true);
        $old_count = (isset($old_count) && is_numeric($old_count)) ? $old_count : 0;

        $count = (int) get_post_meta($this->post_id, self::$db_key_count, true);
        $count = (isset($count) && is_numeric($count)) ? $count : 0;

        return $count + $old_count;
    }

    /**
     * Processes the upvote request
     *
     * @return void
     */
    public function process()
    {
        // Check required attributes
        if (!$this->post_id || !$this->user_id) {
            wp_send_json_error(__('Not permitted.', 'chipmunk'));
        }

        // Set proper Post meta values
        $params = $this->toggle_upvote();

        // Return success response
        wp_send_json_success($params);
    }
}
