<?php

if (!class_exists('ChipmunkHelpers'))
{
  class ChipmunkHelpers
  {
    private function map_terms($term)
    {
      return $term->term_id;
    }

    /**
     * Truncate long strings
     */
    public static function truncate_string($str, $chars, $to_space = true, $replacement = '...')
    {
      $str = strip_tags($str);

      if ($chars > strlen($str)) return $str;

      $str = substr($str, 0, $chars);
      $space_pos = strrpos($str, ' ');

      if ($to_space && $space_pos >= 0)
      {
        $str = substr($str, 0, strrpos($str, ' '));
      }

      return($str . $replacement);
    }

    /**
     * Truncate long strings
     */
    public static function external_link($url)
    {
      if (!ChipmunkCustomizer::theme_option('disable_ref')) {
        $title = str_replace('-', '', sanitize_title(get_bloginfo('name')));
        $prefix = (preg_match('(\&|\?)', $url) === 1) ? '&ref=' : '?ref=';

        return $url . $prefix . $title;
      }

      return $url;
    }

    /**
     * Get menu items
     */
    public static function get_menu_items($location)
    {
      if (($locations = get_nav_menu_locations()) && isset($locations[$location]))
      {
        $menu = wp_get_nav_menu_object($locations[$location]);

        if ($menu)
        {
          return wp_get_nav_menu_items($menu->term_id);
        }
      }

      return false;
    }

    /**
     * Custom excerpt function
     */
    public static function custom_excerpt($text, $excerpt)
    {
      if ($excerpt) return $excerpt;

      $text = strip_shortcodes($text);
      $text = apply_filters('the_content', $text);
      $text = str_replace(']]>', ']]&gt;', $text);
      $text = strip_tags($text);
      $excerpt_length = apply_filters('excerpt_length', 55);
      $excerpt_more = apply_filters('excerpt_more', ' ' . '[...]');
      $words = preg_split("/[\n
         ]+/", $text, $excerpt_length + 1, PREG_SPLIT_NO_EMPTY);

      if (count($words) > $excerpt_length)
      {
        array_pop($words);
        $text = implode(' ', $words);
        $text = $text . $excerpt_more;
      }
      else
      {
        $text = implode(' ', $words);
      }

      $text = str_replace('"', '\'', strip_tags($text));

      return apply_filters('wp_trim_excerpt', $text);
    }

    /**
     * Get resources
     */
    public static function get_resources($limit = -1, $paged = false, $term = null)
    {
      $args = array(
        'post_type'       => 'resource',
        'posts_per_page'  => $limit,
        'paged'           => $paged,
      );

      $sort_args = array();
      $tax_args = array();

      // Apply sorting options
      if (isset($_GET['sort']) and !ChipmunkCustomizer::theme_option('disable_sorting'))
      {
        $sort_params = explode('-', $_GET['sort']);
        $sort_orderby = $sort_params[0];
        $sort_order = $sort_params[1];
      }
      else
      {
        $sort_orderby = ChipmunkCustomizer::theme_option('default_sort_by');
        $sort_order = ChipmunkCustomizer::theme_option('default_sort_order');
      }

      switch ($sort_orderby)
      {
        case 'date':
          $sort_args = array(
            'orderby'   => 'date',
          );
          break;
        case 'name':
          $sort_args = array(
            'orderby'   => 'title',
          );
          break;
        case 'popularity':
          $sort_args = array(
            'orderby'   => 'meta_value_num',
            'meta_key'  => ChipmunkViewCounter::$db_key,
          );
          break;
      }

      $sort_args['order'] = $sort_order;

      // Apply taxonomy options
      if (is_tax() and isset($term))
      {
        $tax_args['tax_query'] = array(
          array(
            'taxonomy'          => $term->taxonomy,
            'field'             => 'id',
            'terms'             => $term->term_id,
            'include_children'  => false
          ),
        );
      }

      $query = new WP_Query(array_merge($args, $sort_args, $tax_args));
      return $query;
    }

    /**
     * Get latest resources
     */
    public static function get_latest_resources($limit = -1, $paged = false)
    {
      $args = array(
        'post_type'       => 'resource',
        'posts_per_page'  => $limit,
        'paged'           => $paged,
        'orderby'         => 'date',
        'order'           => 'DESC',
      );

      $query = new WP_Query($args);
      return $query;
    }

    /**
     * Get featured resources
     */
    public static function get_featured_resources($limit = -1, $paged = false)
    {
      $args = array(
        'post_type'       => 'resource',
        'posts_per_page'  => $limit,
        'paged'           => $paged,
        'meta_query'      => array(
          'featured'        => array(
            'key'             => '_'.ChipmunkMetaBoxes::$field_name.'_resource_is_featured',
            'value'           => 'on',
          ),
          'views'           => array(
            'key'             => ChipmunkViewCounter::$db_key,
          )
        ),
        'orderby'         => 'rand',
      );

      $query = new WP_Query($args);
      return $query;
    }

    /**
     * Get popular resources
     */
    public static function get_popular_resources($limit = -1, $paged = false)
    {
      $args = array(
        'post_type'       => 'resource',
        'posts_per_page'  => $limit,
        'paged'           => $paged,
        'meta_key'        => ChipmunkViewCounter::$db_key,
        'orderby'         => 'meta_value_num',
        'order'           => 'DESC',
      );

      $query = new WP_Query($args);
      return $query;
    }

    /**
     * Get related resources
     */
    public static function get_related_resources($post_id)
    {
      $args = array(
        'posts_per_page'  => 3,
        'post_type'       => 'resource',
        'post__not_in'    => array($post_id),
        'orderby'         => 'rand',
      );

      $tags = get_the_terms($post_id, 'resource-tag');
      $collections = get_the_terms($post_id, 'resource-collection');

      if (!empty($tags))
      {
        $args['tax_query'] = array(
          array(
            'taxonomy'    => 'resource-tag',
            'field'       => 'term_id',
            'terms'       => array_map(array($this, 'map_terms'), $tags),
            'operator'    => 'IN',
          ),
        );
      }
      else
      {
        if (!empty($collections))
        {
          $args['tax_query'] = array(
            array(
              'taxonomy'    => 'resource-collection',
              'field'       => 'term_id',
              'terms'       => array_map(array($this, 'map_terms'), $collections),
              'operator'    => 'IN',
            ),
          );
        }
      }

      $query = new WP_Query($args);
      return $query;
    }

    /**
     * Get curators
     */
    public static function get_curators($limit = -1)
    {
      $args = array(
        'post_type'       => 'curator',
        'posts_per_page'  => $limit,
        'order'           => 'ASC',
      );

      $query = new WP_Query($args);
      return $query;
    }
  }
}
