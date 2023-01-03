<?php

namespace Chipmunk\Extensions;

use Chipmunk\Helpers;

/**
 * Bookmarks class
 *
 * @package WordPress
 * @subpackage Chipmunk
 */
class Bookmarks
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
    public static $db_key = '_chipmunk_bookmark';

    /**
     * Create a new bookmarks object
     *
     * @param  object $post_id
     *
     * @return void
     */
    function __construct($post_id)
    {
        global $current_user;

        $this->post_id = intval(wp_filter_kses($post_id));
        $this->user_id = $current_user->ID;
    }

    /**
     * Output the bookmark button
     *
     * @param  string $class
     *
     * @return string
     */
    public function get_button($action, $class = '')
    {
        $bookmarked  = $this->is_bookmarked();
        $content     = $this->get_content($bookmarked);

        if ($bookmarked) {
            $class = $class . ' is-active';
            $title = esc_html__('Remove bookmark', 'chipmunk');
        } else {
            $title = esc_html__('Bookmark', 'chipmunk');
        }

        $button = "<span class='$class' title='$title' data-action='$action' data-action-event='click' data-action-post-id='$this->post_id'>$content</span>";
        return $button;
    }

    /**
     * Toggles post bookmark status
     *
     * @return object
     */
    private function toggle_bookmark()
    {
        $bookmarked = $this->is_bookmarked();

        // Remove bookmark from the post
        if ($bookmarked) {
            delete_post_meta($this->post_id, self::$db_key, $this->user_id);
            $response['status'] = 'remove';
        }

        // Bookmark the post
        else {
            add_post_meta($this->post_id, self::$db_key, $this->user_id);
            $response['status'] = 'add';
        }

        $response['post'] = $this->post_id;
        $response['content'] = $this->get_content(!$bookmarked);

        return $response;
    }

    /**
     * Tests if the post is already bookmarked
     *
     * @return boolean
     */
    private function is_bookmarked()
    {
        return in_array($this->user_id, get_post_meta($this->post_id, self::$db_key));
    }

    /**
     * Retrieves proper content template
     *
     * @param  boolean  $active
     *
     * @return string
     */
    private function get_content($active)
    {
        $icon = Helpers::get_template_part('partials/icon', array('icon' => 'bookmark'), false);
        $label = $active ? __('Bookmarked', 'chipmunk') : __('Bookmark', 'chipmunk');

        return '<span>' . $icon . $label . '</span>';
    }

    /**
     * Processes the bookmark request
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
        $params = $this->toggle_bookmark();

        // Return success response
        wp_send_json_success($params);
    }
}
