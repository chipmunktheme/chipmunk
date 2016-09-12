<?php

if (!class_exists('ChipmunkHelpers'))
{
  class ChipmunkHelpers
  {
    /**
     * Get Chipmunk theme option
     */
    public static function theme_option($name, $default = false)
    {
    	$options = (get_option('chipmunk_settings')) ? get_option('chipmunk_settings') : null;

    	// return the option if it exists
    	if (isset($options[$name]) && ! empty($options[$name])) {
    		return apply_filters('chipmunk_settings_$name', $options[$name]);
    	}

    	// return default if nothing else
    	return apply_filters('chipmunk_settings_$name', $default);
    }

    /**
     * Truncate long strings
     */
    public static function truncate_string($str, $chars, $to_space = true, $replacement = '...')
    {
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
     * Get latest resources
     */
    public static function get_latest_resources($limit = -1, $paged = false)
    {
      $query = new WP_Query(array(
        'post_type'       => 'resource',
        'posts_per_page'  => $limit,
        'paged'           => $paged,
      ));

      return $query->have_posts() ? $query : false;
    }

    /**
     * Get featured resources
     */
    public static function get_featured_resources($limit = -1, $paged = false)
    {
      $query = new WP_Query(array(
        'post_type'       => 'resource',
        'posts_per_page'  => $limit,
        'paged'           => $paged,
        'meta_query'      => array(
          'featured'        => array(
            'key'             => '_'.ChipmunkMetaBoxes::$field_name.'_is_featured',
            'value'           => 'on',
          ),
          'views'           => array(
            'key'             => ChipmunkViewCounter::$db_key,
          )
        ),
        'orderby'         => array(
          'views'           => 'DESC',
          'date'            => 'DESC',
        ),
      ));

      return $query->have_posts() ? $query : false;
    }

    /**
     * Get popular resources
     */
    public static function get_popular_resources($limit = -1, $paged = false)
    {
      $query = new WP_Query(array(
        'post_type'       => 'resource',
        'posts_per_page'  => $limit,
        'paged'           => $paged,
        'meta_key'        => ChipmunkViewCounter::$db_key,
        'orderby'         => 'meta_value_num',
        'order'           => 'DESC',
      ));

      return $query->have_posts() ? $query : false;
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
            'terms'       => array_map(function ($result) { return $result->term_id; }, $tags),
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
              'terms'       => array_map(function ($result) { return $result->term_id; }, $collections),
              'operator'    => 'IN',
            ),
          );
        }
      }

      $query = new WP_Query($args);

      return $query->have_posts() ? $query : false;
    }
  }
}
