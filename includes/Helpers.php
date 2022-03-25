<?php

namespace Chipmunk;

/**
 * Theme specific helpers.
 *
 * @package WordPress
 * @subpackage Chipmunk
 */
class Helpers {

	/**
	 * Get current theme version
	 */
	public static function get_version() {
		return wp_get_theme()->get( 'Version' );
	}

	/**
	 * Set theme env based on the proxy value
	 */
	public static function set_theme_env() {
		if ( isset( $_SERVER['HTTP_X_CHISEL_PROXY'] ) ) {
			define( 'THEME_DEV_ENV', true );
		}
	}

	/**
	 * Check if Chipmunk plugin is enabled
	 */
	public static function has_addon( $plugin ) {
		$class = '\Chipmunk' . ucwords( $plugin );

		// return class_exists( $class ) && property_exists( $class, 'is_enabled' ) && $class::$is_enabled;
		return true;
	}

	/**
	 * Check if feature is enabled in customizer
	 */
	public static function is_feature_enabled( $feature, $post_type ) {
		return ! Customizer::get_theme_option( "disable_{$post_type}_{$feature}" ) && get_post_type() == $post_type;
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
	public static function get_template_part( $template, $params = array(), $output = true ) {
		if ( ! $output ) {
			ob_start();
		}

		if ( is_array( $template ) ) {
			$template = implode( '-', $template );
		}

		if ( empty( $params ) ) {
			get_template_part( THEME_TEMPLATES_PATH . $template );
		}

		elseif ( $template_file = locate_template( THEME_TEMPLATES_PATH . "{$template}.php", false, false ) ) {
			extract( $params, EXTR_SKIP );
			require( $template_file );
		}

		if ( ! $output ) {
			return ob_get_clean();
		}
	}

	/**
	 * Checks if the technical requirements are met.
	 */
	public static function check_requirements() {
		global $wp_version;

		$php_min_version = '7.4.0';
		$wp_min_version = '5.0';
		$php_current_version = phpversion();
		$errors = array();

		if ( version_compare( $php_min_version, $php_current_version, '>' ) ) {
			$errors[] = sprintf(
				__( 'Chipmunk requires PHP %1$s or greater. You have %2$s.', 'chipmunk' ),
				$php_min_version,
				$php_current_version
			);
		}

		if ( version_compare( $wp_min_version, $wp_version, '>' ) ) {
			$errors[] = sprintf(
				__( 'Chipmunk requires WordPress %1$s or greater. You have %2$s.', 'chipmunk' ),
				$wp_min_version,
				$wp_version
			);
		}

		return $errors;
	}

	/**
	 * Builds class string based on name and modifiers
	 *
	 * @param  string $name 			Base class name
	 * @param  string[] $modifiers,... 	Class name modifiers
	 *
	 * @return string
	 */
	public static function class_name( $name = '', $modifiers = null ) {
		if ( ! is_string( $name ) || empty( $name ) ) {
			return '';
		}

		$modifiers = array_slice( func_get_args(), 1 );
		$classes   = array( $name );

		foreach ( $modifiers as $modifier ) {
			if ( ! empty( $modifier ) ) {
				if ( is_array( $modifier ) ) {
					foreach ( $modifier as $modifier ) {
						if ( ! empty( $modifier ) ) {
							$classes[] = $name . '--' . $modifier;
						}
					}
				} elseif ( is_string( $modifier ) ) {
					$classes[] = $name . '--' . $modifier;
				}
			}
		}

		return implode( ' ', $classes );
	}/**
	 * Checks that the reCAPTCHA parameter sent with the registration
	 * request is valid.
	 *
	 * @return bool True if the CAPTCHA is OK, otherwise false.
	 */
	public static function verify_recaptcha( $response ) {
		$enabled    = Customizer::get_theme_option( 'recaptcha_enabled' );
		$site_key   = Customizer::get_theme_option( 'recaptcha_site_key' );
		$secret_key = Customizer::get_theme_option( 'recaptcha_secret_key' );

		// Verify if user is logged in
		if ( is_user_logged_in() ) {
			return true;
		}

		// Verify if recaptcha is disabled
		if ( ! $enabled or ! $site_key ) {
			return true;
		}

		if ( ! isset( $response ) or empty( $response ) ) {
			return false;
		}

		if ( $secret_key ) {
			// Verify the captcha response from Google
			$remote_response = wp_remote_post(
				'https://www.google.com/recaptcha/api/siteverify',
				array(
					'body' => array(
						'secret' => $secret_key,
						'response' => $response
					)
				)
			);

			$success = false;

			if ( $remote_response && is_array( $remote_response ) ) {
				$decoded_response = json_decode( $remote_response['body'] );
				$success = $decoded_response->success;
			}

			return $success;
		}

		return true;
	}

	/**
	 * Get socials
	 */
	public static function get_socials() {
		$socials = array();

		foreach ( Customizer::get_socials() as $social ) {
			$value = Customizer::get_theme_option( strtolower( $social ) );

			if ( $value ) {
				$socials[$social] = $value;
			}
		}

		return $socials;
	}

	/**
	 * Get post counter
	 */
	public static function get_post_count( $post_type, $post_status ) {
		$counter = wp_count_posts( $post_type );

		return $counter->$post_status;
	}

	/**
	 * Create title for post and pages OG tags
	 */
	public static function get_og_title() {
		if ( ! Customizer::get_theme_option( 'disable_og_branding' ) ) {
			$title = sprintf( esc_html__( '%s on %s', 'chipmunk' ), get_the_title(), get_bloginfo( 'name' ) );
		}
		else {
			$title = get_the_title();
		}

		return $title;
	}

	/**
	 * Create meta description for post and pages
	 */
	public static function get_meta_description() {
		global $post;

		if ( is_front_page() ) {
			$description = get_bloginfo( 'description' );
		}

		elseif ( is_single() || is_page() ) {
			$description = self::get_custom_excerpt( $post->post_content, $post->post_excerpt );
			$description = strip_tags( $description );
			$description = str_replace( '"', '\'', $description );
		}

		return isset( $description ) ? $description : '';
	}

	/**
	 * Custom excerpt function
	 */
	public static function get_custom_excerpt( $text, $excerpt ) {
		if ( $excerpt ) return $excerpt;

		$text = strip_shortcodes( $text );
		$text = apply_filters( 'the_content', $text );
		$text = str_replace( ']]>', ']]&gt;', $text );
		$text = strip_tags( $text );

		$excerpt_length = apply_filters( 'excerpt_length', 55 );
		$excerpt_more = apply_filters( 'excerpt_more', ' ' . '[...]' );
		$words = preg_split( "/[\n
			]+/", $text, $excerpt_length + 1, PREG_SPLIT_NO_EMPTY );

		if ( count( $words ) > $excerpt_length ) {
			array_pop( $words );
			$text = implode( ' ', $words );
			$text = $text . $excerpt_more;
		}
		else {
			$text = implode( ' ', $words );
		}

		$text = str_replace( '"', '\'', strip_tags( $text ) );

		return apply_filters( 'wp_trim_excerpt', $text );
	}

	/**
	 * Get menu items
	 */
	public static function get_menu_items( $location ) {
		if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[$location] ) ) {
			$menu = wp_get_nav_menu_object( $locations[$location] );

			if ( $menu ) {
				return wp_get_nav_menu_items( $menu->term_id );
			}
		}

		return false;
	}

	/**
	 * Recursively get taxonomy and its children
	 */
	public static function get_taxonomy_hierarchy( $taxonomy, $args = array(), $parent = 0 ) {
		$children = array();
		$taxonomy = is_array( $taxonomy ) ? array_shift( $taxonomy ) : $taxonomy;

		$terms = get_terms( $taxonomy, wp_parse_args( $args, array( 'parent' => $parent ) ) );

		if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
			foreach ( $terms as $term ) {
				$term->children = self::get_taxonomy_hierarchy( $taxonomy, $args, $term->term_id );

				$children[$term->term_id] = $term;
			}

			return $children;
		}

		return null;
	}

	/**
	 * Recursively display taxonomy and its children
	 */
	public static function display_terms( $terms, $level = 0 ) {
		foreach ( $terms as $term ) {
			echo '<option value="'. $term->term_id . '">' . str_repeat( '&horbar;', $level ) . ( $level ? '&nbsp;' : '' ) . $term->name . '</option>';

			if ( $term->children ) {
				self::display_terms( $term->children, $level + 1 );
			}
		}
	}

	/**
	 * Conditionally display post terms
	 */
	public static function display_term_list( $terms, $args = array() ) {
		$args = array_merge( array(
			'type'     => 'link',
			'quantity' => -1,
		), $args );

		$output = '';
		$count = count( $terms );

		// Max length of post term (set 0 to display full term)
		$term_max_length = apply_filters( 'chipmunk_term_max_length', 25 );

		if ( $args['quantity'] > 0 && $args['quantity'] < $count && apply_filters( 'chipmunk_shuffle_terms', false ) ) {
			shuffle( $terms );
		}

		foreach ( $terms as $key => $term ) {
			if ( $args['quantity'] < 0 || $args['quantity'] > $key ) {
				if ( $args['type'] == 'link' ) {
					$output .= '<a href="' . esc_url( get_term_link( $term->term_id ) ) . '">' . esc_html( self::truncate_string( $term->name, $term_max_length ) ) . '</a>';
				}

				if ( $args['type'] == 'text' ) {
					$output .= '<span>' . esc_html( self::truncate_string( $term->name, $term_max_length ) ) . '</span>';
				}
			}
		}

		return $output;
	}

	/**
	 * Get primary resource website link
	 */
	public static function get_resource_website( $resource_id ) {
		$key_prefix = '_' . THEME_SLUG . '_resource_';

		$website = get_post_meta( $resource_id, $key_prefix . 'website', true );
		$links = get_field( $key_prefix . 'links', $resource_id );

		if ( ! empty( $website ) ) {
			return esc_url( $website );
		}

		if ( ! empty( $links ) ) {
			return esc_url( $links[0]['link']['url'] );
		}

		return false;
	}

	/**
	 * Create external links
	 */
	public static function render_external_link( $url ) {
		if ( ! Customizer::get_theme_option( 'disable_ref' ) ) {
			$title = str_replace( '-', '', sanitize_title( get_bloginfo( 'name' ) ) );
			$prefix = ( preg_match( '(\&|\?)', $url ) === 1 ) ? '&ref=' : '?ref=';

			return $url . $prefix . $title;
		}

		return esc_url( $url );
	}

	/**
	 * Get resources sort WP_Query arguments
	 */
	public static function get_resources_sort_args() {
		$sort_args = array();

		// Apply sorting options
		if ( isset( $_GET['sort'] ) && ! empty( $_GET['sort'] ) && ! Customizer::get_theme_option( 'disable_resource_sorting' ) ) {
			$sort_params = explode( '-', $_GET['sort'] );
			$sort_orderby = $sort_params[0];
			$sort_order = $sort_params[1];
		}
		else {
			$sort_orderby = Customizer::get_theme_option( 'default_sort_by' );
			$sort_order = Customizer::get_theme_option( 'default_sort_order' );
		}

		switch ( $sort_orderby ) {
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
			case 'views':
				$sort_args = array(
					'orderby'   => 'meta_value_num date',
					'meta_key'  => '_' . THEME_SLUG . '_post_view_count',
				);
				break;
			case 'upvotes':
				$sort_args = array(
					'orderby'   => 'meta_value_num date',
					'meta_key'  => '_' . THEME_SLUG . '_upvote_count',
				);
				break;
			case 'ratings':
				$sort_args = array(
					'orderby'   => 'meta_value_num date',
					'meta_key'  => '_' . THEME_SLUG . '_rating_rank',
				);
				break;
		}

		$sort_args['order'] = $sort_order;

		return $sort_args;
	}

	/**
	 * Get resources tax WP_Query arguments
	 */
	public static function get_resources_tax_args( $term = null ) {
		$tax_args = array(
			'tax_query' => array(),
		);

		// Apply taxonomy options
		if ( is_tax() && isset( $term ) ) {
			$tax_args['tax_query'][] = array(
				'taxonomy'          => $term->taxonomy,
				'field'             => 'id',
				'terms'             => $term->term_id,
				'include_children'  => false,
			);
		}

		// Apply tag filters
		if ( isset( $_GET['tag'] ) && ! empty( $_GET['tag'] ) && ! Customizer::get_theme_option( 'disable_resource_filters' ) ) {
			$tax_args['tax_query'][] = array(
				'taxonomy'          => 'resource-tag',
				'field'             => 'slug',
				'terms'             => $_GET['tag'],
			);
		}

		if ( count( $tax_args['tax_query'] ) > 1 ) {
			$tax_args['tax_query']['relation'] = 'AND';
		}

		return $tax_args;
	}

	/**
	 * Template for comments, without pingbacks or trackbacks
	 */
	public static function comment_template( $comment, $args, $depth ) {
		if ( $comment->comment_type == 'pingback' || $comment->comment_type == 'trackback' ) {
			return;
		}

		$tag = ( 'div' === $args['style'] ) ? 'div' : 'li';
		?>
		<<?php echo $tag; ?> <?php comment_class( 'c-comment' ); ?> id="comment-<?php comment_ID(); ?>">
			<article class="c-comment__body">
				<?php if ( $args['avatar_size'] != 0 ) : ?>
					<figure class="c-comment__image">
						<?php echo get_avatar( $comment, $args['avatar_size'] ); ?>
					</figure>
				<?php endif; ?>

				<div class="c-comment__info">
					<h4 class="c-comment__title c-heading c-heading--h5"><?php echo get_comment_author_link(); ?></h4>
					<a href="<?php echo get_comment_link(); ?>">
						<time class="c-comment__date" datetime="<?php comment_time( 'c' ); ?>" title="<?php comment_time( 'Y-m-d H:i' ); ?>">
							<?php echo get_comment_time( get_option( 'date_format' ), false, true ); ?>
						</time>
					</a>

					<div class="c-comment__content c-content c-content--type">
						<?php comment_text(); ?>
					</div>

					<div class="c-comment__reply">
						<?php comment_reply_link( array_merge( $args, array( 'reply_text' => self::get_template_part( 'partials/icon', array( 'icon' => 'reply' ), false ) . esc_html__( 'Reply', 'chipmunk' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
					</div>

					<?php if ( ! $comment->comment_approved ) : ?>
						<p class="c-comment__note"><?php esc_html_e( 'Your comment is awaiting moderation.', 'chipmunk' ); ?></p>
					<?php endif; ?>
				</div>
			</article>
		<?php
	}

	/**
	 * Add post meta from the array
	 */
	public static function add_post_meta( $post_ID, $meta_values, $allowed_types, $unique = true ) {
		if ( ! in_array( get_post_type( $post_ID ), $allowed_types ) ) {
			return $post_ID;
		}

		foreach ( $meta_values as $meta => $value ) {
			add_post_meta( $post_ID, $meta, $value, $unique );
		}

		return $post_ID;
	}

	/**
	 * Get current page attribute
	 */
	public static function get_current_page() {
		if ( get_query_var( 'paged' ) ) {
			return get_query_var( 'paged' );
		}
		elseif ( get_query_var( 'page' ) ) {
			return get_query_var( 'page' );
		}
		else {
			return 1;
		}
	}

	/**
	 * Truncate long strings
	 */
	public static function truncate_string( $str, $chars, $to_space = true, $replacement = '&hellip;' ) {
		$str = strip_tags( $str );

		if ( $chars == 0 || $chars > strlen( $str ) ) {
			return $str;
		}

		$str = substr( $str, 0, $chars );
		$space_pos = strrpos( $str, ' ' );

		if ( $to_space && $space_pos >= 0 ) {
			$str = substr( $str, 0, strrpos( $str, ' ' ) );
		}

		return( $str . $replacement );
	}

	/**
	 * Get popular fonts from Google Fonts API
	 */
	public static function get_google_fonts( $api_key, $sort = 'popularity' ) {
		$ch = curl_init( "https://www.googleapis.com/webfonts/v1/webfonts?key=$api_key&sort=$sort" );
		curl_setopt( $ch, CURLOPT_HTTPHEADER, array( 'Content-Type: application/json' ) );
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, FALSE );

		$response = curl_exec( $ch );
		$http_code = curl_getinfo( $ch, CURLINFO_HTTP_CODE );
		curl_close( $ch );

		$fonts = json_decode( $response, true );

		if ( $http_code == 200 && ! empty( $fonts ) ) {
			return $fonts['items'];
		}

		return null;
	}

	/**
	 * Parse Google Fonts url
	 */
	public static function get_google_fonts_url( $fonts = array() ) {
		$font_families = array();

		foreach ( $fonts as $font ) {
			if ( ! array_key_exists( $font, $font_families ) ) {
				$font_families[$font] = "{$font}:400,700";
			}
		}

		$query_args = array(
			'family' => urlencode( implode( '|', array_values( $font_families ) ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);

		return esc_url( add_query_arg( $query_args, '//fonts.googleapis.com/css' ) );
	}

	/**
	 * Get file extension by content mime type
	 */
	public static function get_extension_by_mime( $mime ) {
		$extensions = array(
			'image/jpeg' 	=> '.jpeg',
			'image/jpg' 	=> '.jpg',
			'image/png' 	=> '.png',
			'image/gif' 	=> '.gif',
			'image/bmp' 	=> '.bmp',
			'image/webp' 	=> '.webp',
			'image/svg+xml' => '.svg',
		);

		return $extensions[$mime];
	}

	/**
	 * Geneterates random string
	 */
	public static function get_salt( $length = 5 ) {
		return substr( md5( rand() ), 0, $length );
	}

	/**
	 * Utility to find if key/value pair exists in array
	 */
	public static function find_key_value( $array, $key, $val ) {
		foreach ( $array as $item ) {
			if ( is_array( $item ) && self::find_key_value( $item, $key, $val ) ) {
				return $item;
			}

			if ( isset( $item[ $key ] ) && $item[ $key ] == $val ) {
				return $item;
			}
		}

		return false;
	}

	/**
	 * Utility to retrieve IP address
	 */
	public static function get_ip() {
		if ( isset( $_SERVER['HTTP_CLIENT_IP'] ) && ! empty( $_SERVER['HTTP_CLIENT_IP'] ) ) {
			$ip = $_SERVER['HTTP_CLIENT_IP'];
		}
		elseif ( isset( $_SERVER['HTTP_X_FORWARDED_FOR'] ) && ! empty( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) {
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		}
		else {
			$ip = ( isset( $_SERVER['REMOTE_ADDR'] ) ) ? $_SERVER['REMOTE_ADDR'] : '0.0.0.0';
		}

		$ip = filter_var( $ip, FILTER_VALIDATE_IP );
		$ip = ( $ip === false ) ? '0.0.0.0' : $ip;
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
	public static function format_number( $number, $precision = 1 ) {
		if ( $number >= 1000 && $number < 1000000 ) {
			$formatted = number_format( $number / 1000, $precision ) . 'K';
		}
		elseif ( $number >= 1000000 && $number < 1000000000 ) {
			$formatted = number_format( $number / 1000000, $precision ) . 'M';
		}
		elseif ( $number >= 1000000000 ) {
			$formatted = number_format( $number / 1000000000, $precision ) . 'B';
		}
		else {
			$formatted = $number; // Number is less than 1000
		}

		$formatted = preg_replace( '/\.[0]+([KMB]?)$/i', '$1', $formatted );
		return $formatted;
	}

	/**
	 * Utility function to convert hex colors to RGB arrays
	 *
	 * @param String $color - Hex color value
	 * @param Boolean $implode - Return color as a string
	 */
	public static function hex_to_rgb( $color, $implode = false ) {
		$color = str_replace( '#', '', $color );

		if ( strlen( $color ) == 6 ) {
			list( $r, $g, $b ) = array_map( 'hexdec', str_split( $color, 2 ) );

			return $implode ? implode( ', ', array( $r, $g, $b ) ) : array( $r, $g, $b );
		}

		return false;
	}
}
