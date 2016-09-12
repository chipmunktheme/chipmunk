<?php

if (!class_exists('ChipmunkShortcodes'))
{
  class ChipmunkShortcodes
  {
    public function __construct()
    {
      add_shortcode('curators', array(&$this, 'add_shortcode_curators'));
    }

    public static function add_shortcode_curators($atts, $content = null)
    {
      $attributes = shortcode_atts(array(
        'limit' => -1,
      ), $atts);

      $query = new WP_Query(array(
        'posts_per_page'  => $attributes['limit'],
        'post_type'       => 'curator',
        'order'           => 'ASC',
      ));

      if ($query->have_posts())
      {
        ob_start();
        include locate_template('sections/curators.php');
        return ob_get_clean();
      }

      return false;
    }
  }
}
