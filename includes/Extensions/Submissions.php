<?php

namespace Chipmunk\Extensions;

use Chipmunk\Helpers;
use Chipmunk\Customizer;
use Chipmunk\Vendors\OpenGraph;

/**
 * Submission form class
 *
 * @package WordPress
 * @subpackage Chipmunk
 */
class Submissions
{
    /**
     * Data object
     *
     * @var object
     */
    private $data;

    /**
     * Required fields from the form
     *
     * @var array
     */
    private $required = ['name', 'collection', 'website'];

    /**
     * Required fields to be left empty
     *
     * @var array
     */
    private $required_empty = ['filter'];

    /**
     * Meta prefix
     *
     * @var string
     */
    private $meta_prefix = '_' . THEME_SLUG . '_resource';

    /**
     * Create a new submission form object
     *
     * @param  object $data
     * @return void
     */
    function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Validate form fields and make sure spam filter is empty
     *
     * @return bool
     */
    private function validate()
    {
        if (isset($this->data['g-recaptcha-response']) && !Helpers::verify_recaptcha($this->data['g-recaptcha-response'])) {
            throw new \Exception(esc_html__('Please verify that you are not a robot.', 'chipmunk'));
            return false;
        }

        foreach (apply_filters('chipmunk_submission_required_fields', $this->required) as $field) {
            if (empty($this->data[$field])) {
                throw new \Exception(esc_html__('Please fill out required fields.', 'chipmunk'));
                return false;
            }
        }

        foreach ($this->required_empty as $field) {
            if (!empty($this->data[$field])) {
                throw new \Exception(esc_html__('Your request could not be processed.', 'chipmunk'));
                return false;
            }
        }

        return true;
    }

    /**
     * Get submitter user ID
     *
     * @param  string $email
     * @return integer
     */
    private function get_submitter_id($email)
    {
        if (is_user_logged_in()) {
            return get_current_user_id();
        }

        if (!empty($email) && $user = get_user_by('email', $email)) {
            return $user->ID;
        }

        return null;
    }

    /**
     * Attach post thumbnail
     *
     * @param  integer $post_id
     * @param  string $website
     */
    private function attach_post_thumbnail($post_id, $website)
    {
        try {
            if (!empty($website)) {
                $og_data = OpenGraph::fetch($website);

                if (!empty($og_data) && !empty($og_data->image)) {
                    if ($attachment_id = $this->upload_attachment($og_data->image)) {
                        set_post_thumbnail($post_id, $attachment_id);
                    }
                }
            }
        } catch (\Exception $e) {
            // Fail silently
        }
    }

    /**
     * Send email to website owner after resource is submitted
     */
    private function inform_admin($post_id)
    {
        $post       = get_post($post_id);
        $name       = get_bloginfo('name');
        $admin      = get_bloginfo('admin_email');
        $submitter  = get_field($this->meta_prefix . '_submitter', $post_id);
        $headers    = ['Content-Type: text/html; charset=UTF-8'];

        $subject    = sprintf(esc_html__('%s: New user submission', 'chipmunk'), $name);
        $template   = Helpers::get_template_part('emails/submission', ['subject' => $subject, 'post' => $post, 'submitter' => $submitter], false);

        wp_mail($admin, $subject, $template, $headers);
    }

    /**
     * Upload attachment image from URL
     */
    private function upload_attachment($url)
    {
        require_once ABSPATH . 'wp-admin/includes/image.php';

        if (!class_exists('\WP_Http')) {
            include_once(ABSPATH . WPINC . '/class-http.php');
        }

        $http = new \WP_Http();
        $response = $http->request($url);

        if (is_wp_error($response)) {
            $error_message = $response->get_error_message();
            error_log("Error: " . $error_message);
            return false;
        }

        $file_extension = Helpers::get_extension_by_mime($response['headers']['content-type']);

        $wp_upload_dir = wp_upload_dir();

        $upload = wp_upload_bits(basename($url) . $file_extension, null, $response['body']);

        if (!empty($upload['error'])) {
            return false;
        }

        $file_path = $upload['file'];
        $file_name = basename($file_path);
        $file_type = wp_check_filetype($file_name, null);
        $attachment_title = sanitize_file_name(pathinfo($file_name, PATHINFO_FILENAME));

        // Set up our images post data
        $attachment_info = [
            'guid'           => $wp_upload_dir['url'] . '/' . $file_name,
            'post_mime_type' => $file_type['type'],
            'post_title'     => $attachment_title,
            'post_content'   => '',
            'post_status'    => 'inherit',
        ];

        // Attach/upload image
        $attachment_id = wp_insert_attachment($attachment_info, $file_path);

        // Generate the necessary attachment data, filesize, height, width etc.
        $attachment_data = wp_generate_attachment_metadata($attachment_id, $file_path);

        // Add the above meta data data to our new image post
        wp_update_attachment_metadata($attachment_id,  $attachment_data);

        return $attachment_id;
    }

    /**
     * Submit an post into the database
     *
     * @return void
     */
    private function submit_post()
    {
        $name               = wp_filter_nohtml_kses(isset($this->data['name']) ? $this->data['name'] : '');
        $website            = wp_filter_nohtml_kses(isset($this->data['website']) ? $this->data['website'] : '');
        $collection         = wp_filter_kses(isset($this->data['collection']) ? $this->data['collection'] : '');
        $content            = wp_kses_post(wpautop(isset($this->data['content']) ? $this->data['content'] : ''));
        $submitter_email    = wp_filter_nohtml_kses(isset($this->data['submitter_email']) ? $this->data['submitter_email'] : '');
        $submitter_name     = wp_filter_nohtml_kses(isset($this->data['submitter_name']) ? $this->data['submitter_name'] : '');
        $author_id          = $this->get_submitter_id($submitter_email);

        $post_object = [
            'post_type'     => 'resource',
            'post_status'   => apply_filters('chipmunk_submission_post_status', 'pending'),
            'post_title'    => $name,
            'post_content'  => $content,
            'post_author'   => $author_id,
        ];

        if ($post_id = wp_insert_post($post_object)) {
            // Insert taxonomy information
            wp_set_object_terms($post_id, (int) $collection, 'resource-collection');

            // Update ACF Links
            update_field($this->meta_prefix . '_links', [
                [
                    'link' => [
                        'title'  => apply_filters('chipmunk_submission_link_title', __('Visit website', 'chipmunk')),
                        'url'    => esc_url($website),
                        'target' => '_blank',
                    ],
                ],
            ], $post_id);


            // Update ACF Submitter
            if (!empty($submitter_email) && !empty($submitter_name)) {
                update_field($this->meta_prefix . '_submitter', "{$submitter_name} <{$submitter_email}>", $post_id);
            }

            // Attach post thumbnail
            if (!Helpers::get_theme_option('disable_submission_image_fetch')) {
                $this->attach_post_thumbnail($post_id, $website);
            }

            // Send email to website admin
            if (Helpers::get_theme_option('inform_about_submissions')) {
                $this->inform_admin($post_id);
            }
        }

        // Failure during wp_insert_post
        else throw new \Exception(Helpers::get_theme_option('submission_failure'));
    }

    /**
     * Submit a post into the database and sends info messages
     *
     * @return void
     */
    public function process()
    {
        try {
            // Validate the form first
            $this->validate();

            // If validated, submit a post...
            $this->submit_post();

            // Return success message
            wp_send_json_success(Helpers::get_theme_option('submission_thanks'));
        } catch (\Exception $e) {

            // Return exception message
            wp_send_json_error($e->getMessage());
        }
    }
}
