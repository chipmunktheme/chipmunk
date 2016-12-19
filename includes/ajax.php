<?php

if (!class_exists('ChipmunkAjax'))
{
  class ChipmunkAjax
  {
    public function submit_resource()
    {
      $this->verify_nonce();

      // If the reCAPTCHA is configured prevent autosubmission
      if (ChipmunkCustomizer::theme_option('recaptcha_site_key'))
      {
        if (isset($_REQUEST['g-recaptcha-response']) and empty($_REQUEST['g-recaptcha-response']))
        {
          // Failure due to incorrect captcha validation
          wp_send_json_error(__('Please verify that you are not a robot.', 'chipmunk'));
        }
      }

      if (!empty($_REQUEST['name']))
      {
        $meta_prefix = '_'.ChipmunkMetaBoxes::$field_name.'_resource';
        $meta_input = array();

        $meta_input[$meta_prefix.'_website'] = esc_url(wp_filter_nohtml_kses($_REQUEST['website']));
        $collection = intval(wp_filter_kses($_REQUEST['collection']));

        if (!ChipmunkCustomizer::theme_option('disable_submitter_info', true))
        {
          $meta_input[$meta_prefix.'_submitter_name'] = wp_filter_nohtml_kses($_REQUEST['submitter_name']);
          $meta_input[$meta_prefix.'_submitter_email'] = wp_filter_nohtml_kses($_REQUEST['submitter_email']);
        }

        $post_object = array(
          'post_type'     => 'resource',
          'post_title'    => wp_filter_nohtml_kses($_REQUEST['name']),
          'post_content'  => wp_filter_kses($_REQUEST['content']),
          'meta_input'    => $meta_input,
        );

        if ($post_id = wp_insert_post($post_object))
        {
          // Insert taxonomy information
          wp_set_object_terms($post_id, $collection, 'resource-collection');

          // Send email to website admin
          if (ChipmunkCustomizer::theme_option('inform_about_submissions'))
          {
            $this->inform_admin($post_id);
          }

          // Success
          wp_send_json_success(ChipmunkCustomizer::theme_option('submission_thanks'));
        }
        // Failure during wp_insert_post
        else wp_send_json_error(ChipmunkCustomizer::theme_option('submission_failure'));
      }
      // Failure due to incorrect nonce verification
      else wp_send_json_error(ChipmunkCustomizer::theme_option('submission_failure'));

      die;
    }

    public function process_upvote()
    {
      $this->verify_nonce();

      // Get post ID
      $post_id = (isset($_REQUEST['postId']) && is_numeric($_REQUEST['postId'])) ? $_REQUEST['postId'] : null;

      if ($post_id) {
        // Process the user upvote
        ChipmunkUpvotes::process_upvote($post_id);
      }
    }

    private function inform_admin($post_id)
    {
      $to       = get_bloginfo('admin_email');
      $from     = 'admin@'.$_SERVER['SERVER_NAME'];
      $name     = get_bloginfo('name');
      $subject  = get_bloginfo('name').': '.__('New user submission', 'chipmunk');

      $headers  = array(
        "Content-Type: text/html; charset=UTF-8;",
        "From: $name <$from>",
      );

      wp_mail($to, $subject, '<a href="'.admin_url('post.php?post='.$post_id.'&action=edit').'">'.__('Review submission', 'chipmunk').'</a>', implode("\n", $headers));
    }

    private function verify_nonce()
    {
      $nonce = isset($_REQUEST['nonce']) ? sanitize_text_field($_REQUEST['nonce']) : null;

      if (!$nonce || !wp_verify_nonce($nonce, $_REQUEST['action']))
      {
        wp_send_json_error(__('Not permitted.', 'chipmunk'));
        die;
      }
    }
  }
}
