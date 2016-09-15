<?php

if (!class_exists('ChipmunkAjax'))
{
  class ChipmunkAjax
  {
    public function submit_resource()
    {
      // If the reCAPTCHA is configured prevent autosubmission
      if (ChipmunkHelpers::theme_option('recaptcha_site_key'))
      {
        if (empty($_REQUEST['g-recaptcha-response']))
        {
          // Failure due to incorrect captcha validation
          wp_send_json_error(__('Please verify that you are not a robot.', 'chipmunk'));
        }
      }

      if (!empty($_REQUEST['name']) and isset($_REQUEST['chipmunk_nonce']) and wp_verify_nonce($_REQUEST['chipmunk_nonce'], $_REQUEST['action']))
      {
        $meta_prefix = '_'.ChipmunkMetaBoxes::$field_name.'_resource';
        $tax_input = array();
        $meta_input = array();

        $tax_input['resource-collection'] = array(wp_filter_kses($_REQUEST['collection']));
        $meta_input[$meta_prefix.'_website'] = esc_url(wp_filter_nohtml_kses($_REQUEST['website']));

        if (!ChipmunkHelpers::theme_option('disable_submitter_info', true))
        {
          $meta_input[$meta_prefix.'_submitter_name'] = wp_filter_nohtml_kses($_REQUEST['submitter_name']);
          $meta_input[$meta_prefix.'_submitter_email'] = wp_filter_nohtml_kses($_REQUEST['submitter_email']);
        }

        $post_object = array(
          'post_type'     => 'resource',
          'post_title'    => wp_filter_nohtml_kses($_REQUEST['name']),
          'post_content'  => wp_filter_kses($_REQUEST['content']),
          'tax_input'     => $tax_input,
          'meta_input'    => $meta_input,
        );

        if ($post_id = wp_insert_post((object) $post_object))
        {
          if (ChipmunkHelpers::theme_option('inform_about_submissions'))
          {
            $this->inform_admin($post_id);
          }

          // Success
          wp_send_json_success(ChipmunkHelpers::theme_option('submission_thanks'));
        }
        // Failure during wp_insert_post
        else wp_send_json_error(ChipmunkHelpers::theme_option('submission_failure'));
      }
      // Failure due to incorrect nonce verification
      else wp_send_json_error(ChipmunkHelpers::theme_option('submission_failure'));

      die;
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

      mail($to, $subject, '<a href="'.admin_url('post.php?post='.$post_id.'&action=edit').'">'.__('Review submission', 'chipmunk').'</a>', implode("\n", $headers));
    }
  }
}
