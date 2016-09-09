<?php

if (!class_exists('ChipmunkMetaBoxes'))
{
  class ChipmunkMetaBoxes
  {
    public function __construct()
    {
      $this->field_name = 'chipmunk_resource';

      // Fire meta box setup function on the post editor screen.
      add_action('load-post.php', array(&$this, 'post_meta_boxes_setup'));
      add_action('load-post-new.php', array(&$this, 'post_meta_boxes_setup'));
    }

    public function post_meta_boxes_setup()
    {
      add_action('add_meta_boxes', array(&$this, 'add_post_meta_boxes'));
      add_action('save_post_resource', array(&$this, 'resource_save_meta_boxes_data'));
    }

    public function add_post_meta_boxes()
    {
      add_meta_box(
        $this->field_name,
        __('Custom fields', 'chipmunk'),
        array(&$this, 'resource_build_meta_boxes'),
        'resource',
        'normal',
        'high'
      );
    }

    /**
     * Build custom field meta box
     *
     * @param post $post The post object
     */
    public function resource_build_meta_boxes($post)
    {
      wp_nonce_field(basename(__FILE__), $this->field_name.'_nonce');
      $current_website = get_post_meta($post->ID, '_'.$this->field_name.'_website', true);

      ?>
      <p>
        <label for="website"><?php _e('Website URL', 'chipmunk'); ?></label><br>
        <input type="url" name="website" value="<?php echo $current_website; ?>" class="widefat" />
      </p>
      <?php
    }

    /**
     * Store custom field meta box data
     *
     * @param int $post_id The post ID.
     */
    public function resource_save_meta_boxes_data($post_id)
    {
      // verify taxonomies meta box nonce
      if (!isset($_POST[$this->field_name.'_nonce']) || !wp_verify_nonce($_POST[$this->field_name.'_nonce'], basename(__FILE__)))
      {
        return;
      }

      // return if autosave
      if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
      {
        return;
      }

      // Check the user's permissions.
      if (!current_user_can('edit_post', $post_id))
      {
        return;
      }

      // store custom fields values
      if (isset($_REQUEST['website']))
      {
        update_post_meta($post_id, '_'.$this->field_name.'_website', sanitize_text_field($_POST['website']));
      }
    }
  }
}
