<?php
/**
 * Theme specific helpers.
 *
 * @package WordPress
 * @subpackage Chipmunk
 */

if ( ! function_exists( 'chipmunk_get_version' ) ) :
	/**
	 * Get current theme version
	 */
	function chipmunk_get_version() {
		return wp_get_theme()->get( 'Version' );
	}
endif;


if ( ! function_exists( 'chipmunk_has_plugin' ) ) :
	/**
	 * Check if Chipmunk plugin is enabled
	 */
	function chipmunk_has_plugin( $plugin ) {
		return class_exists( 'Chipmunk' . ucfirst( $plugin ) );
	}
	endif;


	if ( ! function_exists( 'chipmunk_get_plugin_option' ) ) :
	/**
	 * Check if Chipmunk plugin is enabled and get option from it
	 */
	function chipmunk_get_plugin_option( $plugin, $option ) {
		if ( ! chipmunk_has_plugin( $plugin ) ) {
			return false;
		}

		return get_option( 'chipmunk_' . strtolower( $plugin ) . '_' . $option );
	}
endif;


if ( ! function_exists( 'chipmunk_theme_option' ) ) :
	/**
	 * Get menu items
	 */
	function chipmunk_theme_option( $name, $default = false ) {
		global $customizer;

		return $customizer->theme_option( $name, $default );
	}
endif;


if ( ! function_exists( 'chipmunk_get_template' ) ) :
	/**
	 * Load a template with supplied data.
	 */
	function chipmunk_get_template($template, array $params = array(), $output = true) {
		if ( ! $output ) {
			ob_start();
		}

		if ( ! $template_file = locate_template( "templates/{$template}.php", false, false ) ) {
			trigger_error( sprintf(__( 'Error locating %s for inclusion', 'chipmunk' ), $template_file ), E_USER_ERROR );
		}

		extract( $params, EXTR_SKIP );
		require( $template_file );

		if ( ! $output ) {
			return ob_get_clean();
		}
	}
endif;


if ( ! function_exists( 'chipmunk_check_requirements' ) ) :
	/**
	 * Checks if the technical requirements are met.
	 */
	function chipmunk_check_requirements() {
		global $wp_version;

		$php_min_version = '5.3.0';
		$wp_min_version = '4.0';
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
endif;


if ( ! function_exists( 'chipmunk_get_columns' ) ) :
	/**
	 * Get proper column class
	 */
	function chipmunk_get_columns( $columns, $total = 12 ) {
		$class = '';
		$offset = round( ( $total - $columns ) / 2 );

		if ( $columns < 8 ) {
			$class .= 'column--md-4 column--md-offset-1 ';
		}

		$class .= "column--lg-$columns column--lg-offset-$offset";

		return $class;
	}
endif;


if ( ! function_exists( 'chipmunk_get_socials' ) ) :
	/**
	 * Get posts
	 */
	function chipmunk_get_socials() {
		global $customizer;
		$socials = array();

		foreach ( $customizer->get_socials() as $social ) {
			$value = chipmunk_theme_option( strtolower( $social ) );

			if ( $value ) {
				$socials[$social] = $value;
			}
		}

		return $socials;
	}
endif;


if ( ! function_exists( 'chipmunk_og_title' ) ) :
	/**
	 * Create title for post and pages OG tags
	 */
	function chipmunk_og_title() {
		if ( ! chipmunk_theme_option( 'disable_og_branding' ) ) {
			$title = sprintf( esc_html__( '%s on %s', 'chipmunk' ), get_the_title(), get_bloginfo( 'name' ) );
		}
		else {
			$title = get_the_title();
		}

		return $title;
	}
endif;


if ( ! function_exists( 'chipmunk_meta_description' ) ) :
	/**
	 * Create meta description for post and pages
	 */
	function chipmunk_meta_description() {
		global $post;

		if ( is_front_page() ) {
			$description = get_bloginfo( 'description' );
		}

		elseif ( is_single() or is_page() ) {
			$description = chipmunk_custom_excerpt( $post->post_content, $post->post_excerpt );
			$description = strip_tags( $description );
			$description = str_replace( '"', '\'', $description );
		}

		return isset( $description ) ? $description : '';
	}
endif;


if ( ! function_exists( 'chipmunk_custom_excerpt' ) ) :
	/**
	 * Custom excerpt function
	 */
	function chipmunk_custom_excerpt( $text, $excerpt ) {
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
endif;


if ( ! function_exists( 'chipmunk_inform_admin' ) ) :
	/**
	 * Send email to website owner after resource is submitted
	 */
	function chipmunk_inform_admin( $post_id ) {
		$post       = get_post( $post_id );
		$name       = get_bloginfo( 'name' );
		$admin      = get_bloginfo( 'admin_email' );
		$headers    = array( 'Content-Type: text/html; charset=UTF-8' );

		$subject    = sprintf( esc_html__( '%s: New user submission', 'chipmunk' ), $name );
		$template   = chipmunk_get_template( 'emails/submission', array( 'subject' => $subject, 'post' => $post ), false );

		wp_mail( $admin, $subject, $template, $headers );
	}
endif;


if ( ! function_exists( 'chipmunk_verify_recaptcha' ) ) :
	/**
	 * Checks that the reCAPTCHA parameter sent with the registration
	 * request is valid.
	 *
	 * @return bool True if the CAPTCHA is OK, otherwise false.
	 */
	function chipmunk_verify_recaptcha( $response ) {
		$enabled    = chipmunk_theme_option( 'recaptcha_enabled' );
		$site_key   = chipmunk_theme_option( 'recaptcha_site_key' );
		$secret_key = chipmunk_theme_option( 'recaptcha_secret_key' );

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
endif;


if ( ! function_exists( 'chipmunk_get_menu_items' ) ) :
	/**
	 * Get menu items
	 */
	function chipmunk_get_menu_items( $location ) {
		if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[$location] ) ) {
			$menu = wp_get_nav_menu_object( $locations[$location] );

			if ( $menu ) {
				return wp_get_nav_menu_items( $menu->term_id );
			}
		}

		return false;
	}
endif;


if ( ! function_exists( 'chipmunk_get_taxonomy_hierarchy' ) ) :
	/**
	 * Recursively get taxonomy and its children
	 */
	function chipmunk_get_taxonomy_hierarchy( $taxonomy, $args = array(), $parent = 0 ) {
		$children = array();
		$taxonomy = is_array( $taxonomy ) ? array_shift( $taxonomy ) : $taxonomy;

		$terms = get_terms( $taxonomy, wp_parse_args( $args, array( 'parent' => $parent ) ) );

		foreach ( $terms as $term ) {
			$term->children = chipmunk_get_taxonomy_hierarchy( $taxonomy, $args, $term->term_id );

			$children[$term->term_id] = $term;
		}

		return $children;
	}
endif;


if ( ! function_exists( 'chipmunk_display_terms' ) ) :
	/**
	 * Recursively display taxonomy and its children
	 */
	function chipmunk_display_terms( $terms, $level = 0 ) {
		foreach ( $terms as $term ) {
			echo '<option value="'. $term->term_id . '">' . str_repeat( '&horbar;', $level ) . ( $level ? '&nbsp;' : '' ) . $term->name . '</option>';

			if ( $term->children ) {
				chipmunk_display_terms( $term->children, $level + 1 );
			}
		}
	}
endif;


if ( ! function_exists( 'chipmunk_get_related' ) ) :
	/**
	 * Get related resources
	 */
	function chipmunk_get_related( $post_id, $limit = 3 ) {
		$tax_query = array();

		$post = get_post( $post_id );
		$taxonomies = get_object_taxonomies( $post, 'names' );

		foreach ( $taxonomies as $taxonomy ) {
			$terms = get_the_terms( $post_id, $taxonomy );

			if ( ! empty( $terms ) ) {
				$tax_query[] = array(
					'taxonomy'    => $taxonomy,
					'field'       => 'term_id',
					'terms'       => array_map( 'chipmunk_get_term_id', $terms ),
					'operator'    => 'IN',
				);
			};
		}

		if ( count( $tax_query ) > 1 ) {
			$tax_query['relation'] = 'OR';
		}

		$args = array(
			'post_type'         => get_post_type( $post_id ),
			'post_status'       => 'publish',
			'post__not_in'      => array( $post_id ),
			'posts_per_page'    => $limit,
			'tax_query'         => $tax_query,
			'orderby'           => 'rand',
		);

		return new WP_Query( $args );
	}
endif;


if ( ! function_exists( 'chipmunk_get_posts' ) ) :
	/**
	 * Get posts
	 */
	function chipmunk_get_posts( $args, $tax = null, $date = null ) {
		$defaults = array(
			'post_type'         => 'post',
			'post_status'       => 'publish',
			'posts_per_page'    => -1,
		);

		// Apply taxonomy params
		if ( isset( $tax ) ) {
			$defaults['tax_query'] = array(
				array(
					'taxonomy'          => $tax->taxonomy,
					'field'             => 'id',
					'terms'             => $tax->term_id,
					'include_children'  => false,
				),
			);
		}

		// Apply date params
		if ( isset( $date ) ) {
			$defaults['date_query'] = array(
				array(
					'year'  => $date['year'],
					'month' => $date['month'],
				),
			);
		}

		return new WP_Query( wp_parse_args( $args, $defaults ) );
	}
endif;


if ( ! function_exists( 'chipmunk_get_resources' ) ) :
	/**
	 * Get resources
	 */
	function chipmunk_get_resources( $limit = -1, $paged = false, $term = null ) {
		$args = array(
			'post_type'         => 'resource',
			'post_status'       => 'publish',
			'posts_per_page'    => $limit,
			'paged'             => $paged,
		);

		$sort_args = array();
		$tax_query = array();

		// Apply sorting options
		if ( isset( $_GET['sort'] ) and ! empty( $_GET['sort'] ) and ! chipmunk_theme_option( 'disable_resource_sorting' ) ) {
			$sort_params = explode( '-', $_GET['sort'] );
			$sort_orderby = $sort_params[0];
			$sort_order = $sort_params[1];
		}
		else {
			$sort_orderby = chipmunk_theme_option( 'default_sort_by' );
			$sort_order = chipmunk_theme_option( 'default_sort_order' );
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
		}

		$sort_args['order'] = $sort_order;

		// Apply taxonomy options
		if ( is_tax() and isset( $term ) ) {
			$tax_query[] = array(
				'taxonomy'          => $term->taxonomy,
				'field'             => 'id',
				'terms'             => $term->term_id,
				'include_children'  => false,
			);
		}

		// Apply tag filters
		if ( isset( $_GET['tag'] ) and ! empty( $_GET['tag'] ) and ! chipmunk_theme_option( 'disable_resource_filters' ) ) {
			$tax_query[] = array(
				'taxonomy'          => 'resource-tag',
				'field'             => 'slug',
				'terms'             => $_GET['tag'],
			);
		}

		if ( count( $tax_query ) > 1 ) {
			$tax_query['relation'] = 'AND';
		}

		return new WP_Query( array_merge( $args, $sort_args, array( 'tax_query' => $tax_query ) ) );
	}
endif;


if ( ! function_exists( 'chipmunk_get_latest_resources' ) ) :
	/**
	 * Get latest resources
	 */
	function chipmunk_get_latest_resources( $limit = -1, $paged = false ) {
		$args = array(
			'post_type'         => 'resource',
			'post_status'       => 'publish',
			'posts_per_page'    => $limit,
			'paged'             => $paged,
			'orderby'           => 'date',
			'order'             => 'DESC',
		);

		return new WP_Query( $args );
	}
endif;


if ( ! function_exists( 'chipmunk_get_featured_resources' ) ) :
	/**
	 * Get featured resources
	 */
	function chipmunk_get_featured_resources( $limit = -1, $paged = false ) {
		$args = array(
			'post_type'         => 'resource',
			'post_status'       => 'publish',
			'posts_per_page'    => $limit,
			'paged'             => $paged,
			'meta_query'        => array(
				'featured'          => array(
					'key'               => '_' . THEME_SLUG . '_resource_is_featured',
					'value'             => 'on',
				),
				'views'             => array(
					'key'               => '_' . THEME_SLUG . '_post_view_count',
				),
			),
			'orderby'           => 'rand',
		);

		return new WP_Query( $args );
	}
endif;


if ( ! function_exists( 'chipmunk_get_popular_resources' ) ) :
	/**
	 * Get popular resources
	 */
	function chipmunk_get_popular_resources( $limit = -1, $paged = false ) {
		$args = array(
			'post_type'         => 'resource',
			'post_status'       => 'publish',
			'posts_per_page'    => $limit,
			'paged'             => $paged,
			'meta_key'          => '_' . THEME_SLUG . '_post_view_count',
			'orderby'           => 'meta_value_num',
			'order'             => 'DESC',
		);

		return new WP_Query( $args );
	}
endif;


if ( ! function_exists( 'chipmunk_get_post_count' ) ) :
	/**
	 * Get post counter
	 */
	function chipmunk_get_post_count( $post_type, $post_status ) {
		$counter = wp_count_posts( $post_type );

		return $counter->$post_status;
	}
endif;


if ( ! function_exists( 'chipmunk_get_users' ) ) :
	/**
	 * Get users
	 */
	function chipmunk_get_users( $limit = -1 ) {
		$args = array(
			'role__in' => array( 'Administrator', 'Editor', 'Author' ),
			'number'   => $limit,
			'orderby'  => 'ID',
			'order'    => 'ASC',
		);

		return new WP_User_Query( $args );
	}
endif;


if ( ! function_exists( 'chipmunk_conditional_markup' ) ) :
	/**
	 * Conditional Markup
	 */
	function chipmunk_conditional_markup( $condition, $tagTrue, $tagFalse, $class, $content ) {
		if ( $condition ) {
			return "<$tagTrue class='$class'>$content</$tagTrue>";
		}
		else {
			return "<$tagFalse class='$class'>$content</$tagFalse>";
		}
	}
endif;


if ( ! function_exists( 'chipmunk_display_term_list' ) ) :
	/**
	 * Conditionally display post terms
	 */
	function chipmunk_display_term_list( $terms, $args = array() ) {
		$args = array_merge( array(
			'type'     => 'link',
			'quantity' => -1,
		), $args );

		$output = '';
		$count = count( $terms );

		if ( $args['quantity'] > 0 && $args['quantity'] < $count ) {
			// shuffle( $terms );
		}

		foreach ( $terms as $key => $term ) {
			if ( $args['quantity'] < 0 || $args['quantity'] > $key ) {
				if ( $args['type'] == 'link' ) {
					$output .= '<a href="' . esc_url( get_term_link( $term->term_id ) ) . '" class="tag" title="' . esc_attr( $term->name ) . '">' . esc_html( chipmunk_truncate_string( $term->name, 25 ) ) . '</a>';
				}

				if ( $args['type'] == 'text' ) {
					$output .= '<span class="tag">' . esc_html( chipmunk_truncate_string( $term->name, 25 ) ) . '</span>';
				}
			}
		}

		return $output;
	}
endif;


if ( ! function_exists( 'chipmunk_external_link' ) ) :
	/**
	 * Create external links
	 */
	function chipmunk_external_link( $url ) {
		if ( ! chipmunk_theme_option( 'disable_ref' ) ) {
			$title = str_replace( '-', '', sanitize_title( get_bloginfo( 'name' ) ) );
			$prefix = ( preg_match( '(\&|\?)', $url ) === 1 ) ? '&ref=' : '?ref=';

			return $url . $prefix . $title;
		}

		return $url;
	}
endif;


if ( ! function_exists( 'chipmunk_is_feature_enabled' ) ) :
	/**
	 * Check if feature is enabled in customizer
	 */
	function chipmunk_is_feature_enabled( $feature, $post_type ) {
		return ! chipmunk_theme_option( "disable_{$post_type}_{$feature}" ) && get_post_type() == $post_type;
	}
endif;


if ( ! function_exists( 'chipmunk_get_term_id' ) ) :
	/**
	 * Map terms with term ID
	 */
	function chipmunk_get_term_id( $term ) {
		return $term->term_id;
	}
endif;


if ( ! function_exists( 'chipmunk_get_term_name' ) ) :
	/**
	 * Map terms with term name
	 */
	function chipmunk_get_term_name( $term ) {
		return $term->name;
	}
endif;


if ( ! function_exists( 'chipmunk_truncate_string' ) ) :
	/**
	 * Truncate long strings
	 */
	function chipmunk_truncate_string( $str, $chars, $to_space = true, $replacement = '&hellip;' ) {
		$str = strip_tags( $str );

		if ( $chars > strlen( $str ) ) {
			return $str;
		}

		$str = substr( $str, 0, $chars );
		$space_pos = strrpos( $str, ' ' );

		if ( $to_space && $space_pos >= 0 ) {
			$str = substr( $str, 0, strrpos( $str, ' ' ) );
		}

		return( $str . $replacement );
	}
endif;


if ( ! function_exists( 'chipmunk_format_number' ) ) :
	/**
	 * Utility function to format the numbers,
	 * appending "K" if one thousand or greater,
	 * "M" if one million or greater,
	 * and "B" if one billion or greater (unlikely).
	 *
	 * @param Number $precision - how many decimal points to display (1.25K)
	 */
	function chipmunk_format_number( $number, $precision = 1 ) {
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
endif;


if ( ! function_exists( 'chipmunk_hex_to_rgb' ) ) :
	/**
	 * Utility function to convert hex colors to RGB arrays
	 *
	 * @param String $color - Hex color value
	 * @param Boolean $implode - Return color as a string
	 */
	function chipmunk_hex_to_rgb( $color, $implode = false ) {
		$color = str_replace( '#', '', $color );

		if ( strlen( $color ) == 6 ) {
			list( $r, $g, $b ) = array_map( 'hexdec', str_split( $color, 2 ) );

			return $implode ? implode( ', ', array( $r, $g, $b ) ) : array( $r, $g, $b );
		}

		return false;
	}
endif;


if ( ! function_exists( 'chipmunk_get_fonts_url' ) ) :
	/**
	 * Parse Google Fonts url
	 */
	function chipmunk_get_fonts_url( $fonts = array() ) {
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
endif;


if ( ! function_exists( 'chipmunk_upload_attachment' ) ) :
	/**
	 * Upload attachment image from URL
	 */
	function chipmunk_upload_attachment( $url ) {
		require_once ABSPATH . 'wp-admin/includes/image.php';

		if ( ! class_exists( 'WP_Http' ) ) {
			include_once( ABSPATH . WPINC . '/class-http.php' );
		}

		$http = new WP_Http();
		$response = $http->request( $url );
		$wp_upload_dir = wp_upload_dir();

		if ( $response['response']['code'] != 200 ) {
			return false;
		}

		$upload = wp_upload_bits( basename( $url ), null, $response['body'] );

		if ( ! empty( $upload['error'] ) ) {
			return false;
		}

		$file_path = $upload['file'];
		$file_name = basename( $file_path );
		$file_type = wp_check_filetype( $file_name, null );
		$attachment_title = sanitize_file_name( pathinfo( $file_name, PATHINFO_FILENAME ) );

		// Set up our images post data
		$attachment_info = array(
			'guid'           => $wp_upload_dir['url'] . '/' . $file_name,
			'post_mime_type' => $file_type['type'],
			'post_title'     => $attachment_title,
			'post_content'   => '',
			'post_status'    => 'inherit',
		);

		// Attach/upload image
		$attachment_id = wp_insert_attachment( $attachment_info, $file_path );

		// Generate the necessary attachment data, filesize, height, width etc.
		$attachment_data = wp_generate_attachment_metadata( $attachment_id, $file_path );

		// Add the above meta data data to our new image post
		wp_update_attachment_metadata( $attachment_id,  $attachment_data );

		return $attachment_id;
	}
endif;


if ( ! function_exists( 'chipmunk_find_key_value' ) ) :
	/**
	 * Utility to find if key/value pair exists in array
	 */
	function chipmunk_find_key_value( $array, $key, $val ) {
		foreach ( $array as $item ) {
			if ( is_array( $item ) && chipmunk_find_key_value( $item, $key, $val ) ) {
				return true;
			}

			if ( isset( $item[$key] ) && $item[$key] == $val ) {
				return true;
			}
		}

		return false;
	}
endif;


if ( ! function_exists( 'chipmunk_get_ip' ) ) :
	/**
	 * Utility to retrieve IP address
	 */
	function chipmunk_get_ip() {
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
endif;


if ( ! function_exists( 'chipmunk_get_current_page' ) ) :
	/**
	 * Get current page attribute
	 */
	function chipmunk_get_current_page() {
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
endif;
