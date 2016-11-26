<?php

if (!class_exists('ChipmunkViewCounter'))
{
  class ChipmunkViewCounter
  {
    public static $db_key = '_chipmunk_post_view_count';

    public function __construct()
    {
      // Remove issues with prefetching adding extra views
      remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
    }

    /**
     * Retrieve current view counter
     */
    public static function get_post_views($id)
    {
      $count = get_post_meta($id, self::$db_key, true);

      if ($count == '')
      {
        delete_post_meta($id, self::$db_key);
        add_post_meta($id, self::$db_key, '0');
        return 0;
      }

      return $count;
    }

    /**
     * Set new view counter
     */
    public static function set_post_views($id)
    {
      $count = get_post_meta($id, self::$db_key, true);

      if ($count == '')
      {
        $count = 0;
        delete_post_meta($id, self::$db_key);
        add_post_meta($id, self::$db_key, 0);
      }
      else
      {
        if (!isset($_COOKIE[self::$db_key.'-'.$id]))
        {
          $count++;
          update_post_meta($id, self::$db_key, $count);
          setcookie(self::$db_key.'-'.$id, true);
        }
      }
    }
  }
}
