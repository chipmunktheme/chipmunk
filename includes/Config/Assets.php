<?php

namespace Chipmunk\Config;

/**
 * Assets config hooks
 *
 * @package WordPress
 * @subpackage Chipmunk
 */
class Assets
{
    /**
     * Used to register custom hooks
     *
     * @return void
     */
    function __construct()
    {
        add_filter('script_loader_tag', array($this, 'remove_type_attr'), 10, 2);
        add_filter('style_loader_tag', array($this, 'remove_type_attr'), 10, 2);
        add_filter('upload_mimes',  array($this, 'custom_mime_types'), 99, 1);
    }

    /**
     * Remove type attribute for scripts and styles
     *
     * @return string
     */
    public static function remove_type_attr($tag, $handle)
    {
        return preg_replace("/type=['\"]text\/(javascript|css)['\"]/", '', $tag);
    }

    /**
     * Allow SVG Upload
     *
     * @param $mimes
     */
    public function custom_mime_types($mimes)
    {
        $mimes['svg'] = 'image/svg+xml';
        $mimes['svgz'] = 'image/svg+xml';
        return $mimes;
    }
}
