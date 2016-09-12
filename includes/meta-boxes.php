<?php

if (!class_exists('ChipmunkMetaBoxes'))
{
  class ChipmunkMetaBoxes
  {
    public static $field_name = 'chipmunk';

    public function __construct()
    {
      // Fire meta box setup function on the post editor screen.
      add_action('load-post.php', array(&$this, 'post_meta_boxes_setup'));
      add_action('load-post-new.php', array(&$this, 'post_meta_boxes_setup'));
    }

    public function post_meta_boxes_setup()
    {
      add_action('add_meta_boxes', array(&$this, 'add_post_meta_boxes'));
      add_action('save_post_resource', array(&$this, 'resource_save_meta_boxes_data'));
      add_action('save_post_curator', array(&$this, 'curator_save_meta_boxes_data'));
      add_action('save_post_page', array(&$this, 'about_save_meta_boxes_data'));
    }

    public function add_post_meta_boxes()
    {
      global $post;

      add_meta_box(
        self::$field_name.'_resource',
        __('Custom fields', 'chipmunk'),
        array(&$this, 'resource_build_meta_boxes'),
        'resource',
        'normal',
        'high'
      );

      add_meta_box(
        self::$field_name.'_curator',
        __('Custom fields', 'chipmunk'),
        array(&$this, 'curator_build_meta_boxes'),
        'curator',
        'normal',
        'high'
      );

      if (!empty($post))
      {
        $template = get_post_meta($post->ID, '_wp_page_template', true);

        if (!$template or in_array($template, array('default')))
        {
          add_meta_box(
            self::$field_name.'_about',
            __('Custom fields', 'chipmunk'),
            array(&$this, 'about_build_meta_boxes'),
            'page',
            'normal',
            'high'
          );
        }
        else
        {
          remove_post_type_support('page', 'editor');
        }
      }
    }

    /**
     * Build custom field meta box
     *
     * @param post $post The post object
     */
    public function resource_build_meta_boxes($post)
    {
      wp_nonce_field(basename(__FILE__), self::$field_name.'_resource_nonce');
      $website = get_post_meta($post->ID, '_'.self::$field_name.'_resource_website', true);
      $is_featured = get_post_meta($post->ID, '_'.self::$field_name.'_resource_is_featured', true);

      ?>
      <div class="chipmunk-fields">
        <div class="chipmunk-field">
          <label class="chipmunk-label" for="website"><?php _e('Website URL', 'chipmunk'); ?></label>
          <input type="url" name="website" id="website" value="<?php echo $website; ?>" class="widefat" />
        </div>

        <div class="chipmunk-field">
          <p class="chipmunk-label"><?php _e('Featured?', 'chipmunk'); ?></p>

          <label for="is_featured">
            <input type="checkbox" name="is_featured" id="is_featured" <?php echo $is_featured ? ' checked' : ''; ?> />
            <?php _e('Featured on homepage', 'chipmunk'); ?>
          </label>
        </div>
      </div>
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
      if (!isset($_POST[self::$field_name.'_resource_nonce']) || !wp_verify_nonce($_POST[self::$field_name.'_resource_nonce'], basename(__FILE__)))
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
        update_post_meta($post_id, '_'.self::$field_name.'_resource_website', sanitize_text_field($_POST['website']));
      }

      if (isset($_REQUEST['is_featured']))
      {
        update_post_meta($post_id, '_'.self::$field_name.'_resource_is_featured', sanitize_text_field($_POST['is_featured']));
      }
      else
      {
        delete_post_meta($post_id, '_'.self::$field_name.'_resource_is_featured');
      }
    }

    /**
     * Build custom field meta box
     *
     * @param post $post The post object
     */
    public function curator_build_meta_boxes($post)
    {
      wp_nonce_field(basename(__FILE__), self::$field_name.'_curator_nonce');
      $twitter = get_post_meta($post->ID, '_'.self::$field_name.'_curator_twitter', true);

      ?>
      <div class="chipmunk-fields">
        <div class="chipmunk-field">
          <label class="chipmunk-label" for="twitter"><?php _e('Twitter Handle', 'chipmunk'); ?></label>
          <p>Add twitter username here (in the @username format).</p>
          <input type="text" name="twitter" id="twitter" value="<?php echo $twitter; ?>" class="widefat" />
        </div>
      </div>
      <?php
    }

    /**
     * Store custom field meta box data
     *
     * @param int $post_id The post ID.
     */
    public function curator_save_meta_boxes_data($post_id)
    {
      // verify taxonomies meta box nonce
      if (!isset($_POST[self::$field_name.'_curator_nonce']) || !wp_verify_nonce($_POST[self::$field_name.'_curator_nonce'], basename(__FILE__)))
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
      if (isset($_REQUEST['twitter']))
      {
        update_post_meta($post_id, '_'.self::$field_name.'_curator_twitter', sanitize_text_field($_POST['twitter']));
      }
    }

    /**
     * Build custom field meta box
     *
     * @param post $post The post object
     */
    public function about_build_meta_boxes($post)
    {
      wp_nonce_field(basename(__FILE__), self::$field_name.'_about_nonce');
      $wide_content = get_post_meta($post->ID, '_'.self::$field_name.'_about_wide_content', true);
      $curators_enabled = get_post_meta($post->ID, '_'.self::$field_name.'_about_curators_enabled', true);

      ?>
      <div class="chipmunk-fields">
        <div class="chipmunk-field">
          <p class="chipmunk-label"><?php _e('Wide content', 'chipmunk'); ?></p>

          <label for="wide_content">
            <input type="checkbox" name="wide_content" id="wide_content" <?php echo $wide_content ? ' checked' : ''; ?> />
            <?php _e('Enable wide content for this page (it will make first heading of this page a left-floated title)', 'chipmunk'); ?>
          </label>
        </div>

        <div class="chipmunk-field">
          <p class="chipmunk-label"><?php _e('Enable curators', 'chipmunk'); ?></p>

          <label for="curators_enabled">
            <input type="checkbox" name="curators_enabled" id="curators_enabled" <?php echo $curators_enabled ? ' checked' : ''; ?> />
            <?php _e('Enable curators listing on this page', 'chipmunk'); ?>
          </label>
        </div>
      </div>
      <?php
    }

    /**
     * Store custom field meta box data
     *
     * @param int $post_id The post ID.
     */
    public function about_save_meta_boxes_data($post_id)
    {
      // verify taxonomies meta box nonce
      if (!isset($_POST[self::$field_name.'_about_nonce']) || !wp_verify_nonce($_POST[self::$field_name.'_about_nonce'], basename(__FILE__)))
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
      if (isset($_REQUEST['wide_content']))
      {
        update_post_meta($post_id, '_'.self::$field_name.'_about_wide_content', sanitize_text_field($_POST['wide_content']));
      }
      else
      {
        delete_post_meta($post_id, '_'.self::$field_name.'_about_wide_content');
      }

      if (isset($_REQUEST['curators_enabled']))
      {
        update_post_meta($post_id, '_'.self::$field_name.'_about_curators_enabled', sanitize_text_field($_POST['curators_enabled']));
      }
      else
      {
        delete_post_meta($post_id, '_'.self::$field_name.'_about_curators_enabled');
      }
    }
  }
}
