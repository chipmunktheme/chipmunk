<?php

namespace Chipmunk;

use Chipmunk\Customizer;
use Chipmunk\Settings\Addons;

/**
 * Theme specific helpers.
 *
 * @package WordPress
 * @subpackage Chipmunk
 */
class Helpers
{
    /**
     * Get theme option alias
     *
     * @param string $name    Option name
     * @param mixed  $default Default value
     */
    public static function get_theme_option($name, $default = false)
    {
        return Customizer::get_theme_option($name, $default);
    }

    /**
     * Check if Chipmunk addon is enabled
     * (All addons are now freely available)
     *
     * @param string $addon   Addon slug
     *
     * @return bool
     */
    public static function is_addon_enabled($addon)
    {
        $option_name = Addons::get_instance()->get_option_name();
        $option = get_option($option_name);

        // All addons are now available, just check if enabled in settings
        return !empty($option[$addon]);
    }

    /**
     * Check if the API response is valid
     *
     * @param object $response Remote API response object
     *
     * @return boolean
     */
    public static function is_valid_response($response)
    {
        return
            !is_wp_error($response)
            && 200 == wp_remote_retrieve_response_code($response)
            && !empty(wp_remote_retrieve_body($response));
    }

    /**
     * Check if feature is enabled in customizer
     */
    public static function is_feature_enabled($feature, $post_type, $check_type = true)
    {
        return !self::get_theme_option("disable_{$post_type}_{$feature}") && ($check_type ? get_post_type() == $post_type : true);
    }

    /**
     * Renders the contents of the given template and return or outputs it
     *
     * @param string $template 	The name of the template to render (without .php)
     * @param array  $params    The PHP variables for the template
     * @param bool   $output    Whether the result should be returned or outputted
     *
     * @return string           The contents of the template.
     */
    public static function get_template_part($template, $params = [], $output = true)
    {
        if (!$output) {
            ob_start();
        }

        if (is_array($template)) {
            $template = implode('-', $template);
        }

        if (empty($params)) {
            get_template_part(THEME_TEMPLATES_PATH . $template);
        } elseif ($template_file = locate_template(THEME_TEMPLATES_PATH . "{$template}.php", false, false)) {
            extract($params, EXTR_SKIP);
            require($template_file);
        }

        if (!$output) {
            return ob_get_clean();
        }
    }

    /**
     * Checks if the technical requirements are met.
     */
    public static function check_requirements()
    {
        global $wp_version;

        $php_version = phpversion();
        $php_min_version = '7.4.0';
        $wp_min_version = '5.0';
        $notices = [];

        if (version_compare($php_min_version, $php_version, '>')) {
            $notices[] = [
                'type' => 'error',
                'message' => sprintf(
                    __('Chipmunk requires PHP %1$s or greater. You have %2$s.', 'chipmunk'),
                    $php_min_version,
                    $php_version
                ),
            ];
        }

        if (version_compare($wp_min_version, $wp_version, '>')) {
            $notices[] = [
                'type' => 'error',
                'message' => sprintf(
                    __('Chipmunk requires WordPress %1$s or greater. You have %2$s.', 'chipmunk'),
                    $wp_min_version,
                    $wp_version
                ),
            ];
        }

        return $notices;
    }

    /**
     * Builds class string based on name and modifiers
     *
     * @param  string $name 			Base class name
     * @param  string[] $modifiers,... 	Class name modifiers
     *
     * @return string
     */
    public static function class_name($name = '', $modifiers = null)
    {
        if (!is_string($name) || empty($name)) {
            return '';
        }

        $modifiers = array_slice(func_get_args(), 1);
        $classes   = [$name];

        foreach ($modifiers as $modifier) {
            if (!empty($modifier)) {
                if (is_array($modifier)) {
                    foreach ($modifier as $modifier) {
                        if (!empty($modifier)) {
                            $classes[] = $name . '--' . $modifier;
                        }
                    }
                } elseif (is_string($modifier)) {
                    $classes[] = $name . '--' . $modifier;
                }
            }
        }

        return implode(' ', $classes);
    }

    /**
     * Checks that the reCAPTCHA parameter sent with the registration
     * request is valid.
     *
     * @return bool True if the CAPTCHA is OK, otherwise false.
     */
    public static function verify_recaptcha($response)
    {
        $enabled    = self::get_theme_option('recaptcha_enabled');
        $site_key   = self::get_theme_option('recaptcha_site_key');
        $secret_key = self::get_theme_option('recaptcha_secret_key');

        // Verify if user is logged in
        if (is_user_logged_in()) {
            return true;
        }

        // Verify if recaptcha is disabled
        if (!$enabled or !$site_key) {
            return true;
        }

        if (!isset($response) or empty($response)) {
            return false;
        }

        if ($secret_key) {
            // Verify the captcha response from Google
            $remote_response = wp_remote_post(
                'https://www.google.com/recaptcha/api/siteverify',
                [
                    'body' => [
                        'secret' => $secret_key,
                        'response' => $response
                    ]
                ]
            );

            $success = false;

            if ($remote_response && is_array($remote_response)) {
                $decoded_response = json_decode($remote_response['body']);
                $success = $decoded_response->success;
            }

            return $success;
        }

        return true;
    }

    /**
     * Get socials
     */
    public static function get_socials()
    {
        $socials = [];

        foreach (Customizer::get_socials() as $social) {
            $value = self::get_theme_option(strtolower($social));

            if ($value) {
                $socials[$social] = $value;
            }
        }

        return $socials;
    }

    /**
     * Get post counter
     */
    public static function get_post_count($post_type, $post_status)
    {
        $counter = wp_count_posts($post_type);

        return $counter->$post_status;
    }

    /**
     * Create title for post and pages OG tags
     */
    public static function get_og_title()
    {
        if (!self::get_theme_option('disable_og_branding')) {
            $title = sprintf(esc_html__('%s on %s', 'chipmunk'), get_the_title(), get_bloginfo('name'));
        } else {
            $title = get_the_title();
        }

        return $title;
    }

    /**
     * Create meta description for post and pages
     */
    public static function get_meta_description()
    {
        global $post;

        if (is_front_page()) {
            $description = get_bloginfo('description');
        } elseif (is_single() || is_page()) {
            $description = self::get_custom_excerpt($post->post_content, $post->post_excerpt);
            $description = strip_tags($description);
            $description = str_replace('"', '\'', $description);
        }

        return isset($description) ? $description : '';
    }

    /**
     * Custom excerpt function
     */
    public static function get_custom_excerpt($text, $excerpt)
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

        if (count($words) > $excerpt_length) {
            array_pop($words);
            $text = implode(' ', $words);
            $text = $text . $excerpt_more;
        } else {
            $text = implode(' ', $words);
        }

        $text = str_replace('"', '\'', strip_tags($text));

        return apply_filters('wp_trim_excerpt', $text);
    }

    /**
     * Get menu items
     */
    public static function get_menu_items($location)
    {
        if (($locations = get_nav_menu_locations()) && isset($locations[$location])) {
            $menu = wp_get_nav_menu_object($locations[$location]);

            if ($menu) {
                return wp_get_nav_menu_items($menu->term_id);
            }
        }

        return false;
    }

    /**
     * Recursively get taxonomy and its children
     */
    public static function get_taxonomy_hierarchy($taxonomy, $args = [], $parent = 0)
    {
        $children = [];
        $taxonomy = is_array($taxonomy) ? array_shift($taxonomy) : $taxonomy;

        $terms = get_terms($taxonomy, wp_parse_args($args, ['parent' => $parent]));

        if (!empty($terms) && !is_wp_error($terms)) {
            foreach ($terms as $term) {
                $term->children = self::get_taxonomy_hierarchy($taxonomy, $args, $term->term_id);

                $children[$term->term_id] = $term;
            }

            return $children;
        }

        return null;
    }

    /**
     * Recursively display taxonomy and its children
     */
    public static function display_terms($terms, $level = 0)
    {
        foreach ($terms as $term) {
            echo '<option value="' . $term->term_id . '">' . str_repeat('&horbar;', $level) . ($level ? '&nbsp;' : '') . $term->name . '</option>';

            if ($term->children) {
                self::display_terms($term->children, $level + 1);
            }
        }
    }

    /**
     * Conditionally display post terms
     */
    public static function display_term_list($terms, $args = [])
    {
        $args = array_merge([
            'type'     => 'link',
            'quantity' => -1,
        ], $args);

        $output = '';
        $count = count($terms);

        // Max length of post term (set 0 to display full term)
        $term_max_length = apply_filters('chipmunk_term_max_length', 25);

        if ($args['quantity'] > 0 && $args['quantity'] < $count && apply_filters('chipmunk_shuffle_terms', false)) {
            shuffle($terms);
        }

        foreach ($terms as $key => $term) {
            if ($args['quantity'] < 0 || $args['quantity'] > $key) {
                if ($args['type'] == 'link') {
                    $output .= '<a href="' . esc_url(get_term_link($term->term_id)) . '">' . esc_html(self::truncate_string($term->name, $term_max_length)) . '</a>';
                }

                if ($args['type'] == 'text') {
                    $output .= '<span>' . esc_html(self::truncate_string($term->name, $term_max_length)) . '</span>';
                }
            }
        }

        return $output;
    }

    /**
     * Get primary resource website link
     */
    public static function get_resource_website($resource_id)
    {
        $key_prefix = '_' . THEME_SLUG . '_resource_';

        $website = get_post_meta($resource_id, $key_prefix . 'website', true);
        $links = \get_field($key_prefix . 'links', $resource_id);

        if (!empty($website)) {
            return esc_url($website);
        }

        if (!empty($links)) {
            return esc_url($links[0]['link']['url']);
        }

        return false;
    }

    /**
     * Create external links
     */
    public static function render_external_link($url, $affiliated = false)
    {
        // If affiliate ID is set
        if ($affiliated && !empty(self::get_theme_option('affiliate_id'))) {
            return self::get_external_link($url, [
                'aff' => self::get_theme_option('affiliate_id')
            ]);
        }

        // If referral is not disabled
        if (!self::get_theme_option('disable_ref')) {
            return self::get_external_link($url, [
                'ref' => str_replace('-', '', sanitize_title(get_bloginfo('name')))
            ]);
        }

        // Return original URL
        return self::get_external_link($url);
    }

    /**
     * Get external links
     */
    public static function get_external_link($url, $data = [])
    {
        // Check if URL contains any query parameters
        $prefix = preg_match('(\&|\?)', $url) === 1 ? '&' : '?';

        // Build query string
        $query = http_build_query($data);

        // Return original URL
        return esc_url($url . (!empty($query) ? $prefix . $query : ''));
    }

    /**
     * Template for comments, without pingbacks or trackbacks
     */
    public static function comment_template($comment, $args, $depth)
    {
        if ($comment->comment_type == 'pingback' || $comment->comment_type == 'trackback') {
            return;
        }

        $tag = ('div' === $args['style']) ? 'div' : 'li';
?>
        <<?php echo $tag; ?> <?php comment_class('c-comment'); ?> id="comment-<?php comment_ID(); ?>">
            <article class="c-comment__body">
                <?php if ($args['avatar_size'] != 0) : ?>
                    <figure class="c-comment__image">
                        <?php echo get_avatar($comment, $args['avatar_size']); ?>
                    </figure>
                <?php endif; ?>

                <div class="c-comment__info">
                    <h4 class="c-comment__title c-heading c-heading--h5"><?php echo get_comment_author_link(); ?></h4>
                    <a href="<?php echo get_comment_link(); ?>">
                        <time class="c-comment__date" datetime="<?php comment_time('c'); ?>" title="<?php comment_time('Y-m-d H:i'); ?>">
                            <?php echo get_comment_time(get_option('date_format'), false, true); ?>
                        </time>
                    </a>

                    <div class="c-comment__content c-content c-content--type">
                        <?php comment_text(); ?>
                    </div>

                    <div class="c-comment__reply">
                        <?php comment_reply_link(array_merge($args, ['reply_text' => self::get_template_part('partials/icon', ['icon' => 'reply'], false) . esc_html__('Reply', 'chipmunk'), 'depth' => $depth, 'max_depth' => $args['max_depth']])); ?>
                    </div>

                    <?php if (!$comment->comment_approved) : ?>
                        <p class="c-comment__note"><?php esc_html_e('Your comment is awaiting moderation.', 'chipmunk'); ?></p>
                    <?php endif; ?>
                </div>
            </article>
    <?php
    }

    /**
     * Add post meta from the array
     */
    public static function add_post_meta($post_ID, $meta_values, $allowed_types, $unique = true)
    {
        if (!in_array(get_post_type($post_ID), $allowed_types)) {
            return $post_ID;
        }

        foreach ($meta_values as $meta => $value) {
            add_post_meta($post_ID, $meta, $value, $unique);
        }

        return $post_ID;
    }

    /**
     * Get current page attribute
     */
    public static function get_current_page()
    {
        if (get_query_var('paged')) {
            return get_query_var('paged');
        } elseif (get_query_var('page')) {
            return get_query_var('page');
        } else {
            return 1;
        }
    }

    /**
     * Truncate long strings
     */
    public static function truncate_string($str, $chars, $to_space = true, $replacement = '&hellip;')
    {
        $str = strip_tags($str);

        if ($chars == 0 || $chars > strlen($str)) {
            return $str;
        }

        $str = substr($str, 0, $chars);
        $space_pos = strrpos($str, ' ');

        if ($to_space && $space_pos >= 0) {
            $str = substr($str, 0, strrpos($str, ' '));
        }

        return ($str . $replacement);
    }

    /**
     * Get popular fonts from Google Fonts API
     */
    public static function get_google_fonts($api_key, $sort = 'popularity')
    {
        $ch = curl_init("https://www.googleapis.com/webfonts/v1/webfonts?key=$api_key&sort=$sort");
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        $fonts = json_decode($response, true);

        if ($http_code == 200 && !empty($fonts)) {
            return $fonts['items'];
        }

        return null;
    }

    /**
     * Parse Google Fonts url
     */
    public static function get_google_fonts_url($fonts = [])
    {
        $font_families = [];

        foreach ($fonts as $font) {
            if (!array_key_exists($font, $font_families)) {
                $font_families[$font] = "{$font}:400,700";
            }
        }

        $query_args = [
            'family' => urlencode(implode('|', array_values($font_families))),
            'subset' => urlencode('latin,latin-ext'),
        ];

        return esc_url(add_query_arg($query_args, '//fonts.googleapis.com/css'));
    }

    /**
     * Get file extension by content mime type
     */
    public static function get_extension_by_mime($mime)
    {
        $extensions = [
            'image/jpeg'     => '.jpeg',
            'image/jpg'     => '.jpg',
            'image/png'     => '.png',
            'image/gif'     => '.gif',
            'image/bmp'     => '.bmp',
            'image/webp'     => '.webp',
            'image/svg+xml' => '.svg',
        ];

        return $extensions[$mime];
    }

    /**
     * Pulls the image content into the svg markup
     */
    public static function get_svg_content($path)
    {
        if (!empty($path) && $svg_file = @file_get_contents($path)) {
            $position = strpos($svg_file, '<svg');
            return substr($svg_file, $position);
        }

        return "<img src='$path' alt='' />";
    }

    /**
     * Converts svg content to base64 encoded
     */
    public static function svg_to_base64($path)
    {
        if (!empty($path) && $svg_file = @file_get_contents($path)) {
            return 'data:image/svg+xml;base64,' . base64_encode($svg_file);
        }
    }

    /**
     * Geneterates random string
     */
    public static function get_salt($length = 5)
    {
        return substr(md5(rand()), 0, $length);
    }

    /**
     * Utility to find if key/value pair exists in array
     */
    public static function find_key_value($array, $key, $val)
    {
        foreach ($array as $item) {
            if (is_array($item) && self::find_key_value($item, $key, $val)) {
                return $item;
            }

            if (isset($item[$key]) && $item[$key] == $val) {
                return $item;
            }
        }

        return false;
    }

    /**
     * Utility to retrieve IP address
     */
    public static function get_ip()
    {
        if (isset($_SERVER['HTTP_CLIENT_IP']) && !empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && !empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = (isset($_SERVER['REMOTE_ADDR'])) ? $_SERVER['REMOTE_ADDR'] : '0.0.0.0';
        }

        $ip = filter_var($ip, FILTER_VALIDATE_IP);
        $ip = ($ip === false) ? '0.0.0.0' : $ip;
        return $ip;
    }

    /**
     * Utility function to format the numbers,
     * appending "K" if one thousand or greater,
     * "M" if one million or greater,
     * and "B" if one billion or greater (unlikely).
     *
     * @param Number $precision - how many decimal points to display (1.25K)
     */
    public static function format_number($number, $precision = 1)
    {
        if ($number >= 1000 && $number < 1000000) {
            $formatted = number_format($number / 1000, (float) $precision) . 'K';
        } elseif ($number >= 1000000 && $number < 1000000000) {
            $formatted = number_format($number / 1000000, (float) $precision) . 'M';
        } elseif ($number >= 1000000000) {
            $formatted = number_format($number / 1000000000, (float) $precision) . 'B';
        } else {
            $formatted = $number; // Number is less than 1000
        }

        $formatted = preg_replace('/\.[0]+([KMB]?)$/i', '$1', $formatted);
        return $formatted;
    }

    /**
     * Utility function to convert hex colors to RGB arrays
     *
     * @param String $color - Hex color value
     * @param Boolean $implode - Return color as a string
     */
    public static function hex_to_rgb($color, $implode = false)
    {
        $color = str_replace('#', '', $color);

        if (strlen($color) == 6) {
            list($r, $g, $b) = array_map('hexdec', str_split($color, 2));

            return $implode ? implode(', ', [$r, $g, $b]) : [$r, $g, $b];
        }

        return false;
    }
}
