<?php

namespace Chipmunk;

use Timber\Timber;
use Chipmunk\Customizer;
use Chipmunk\Settings\Addons;

/**
 * Theme specific helpers.
 *
 * @package WordPress
 * @subpackage Chipmunk
 */
class Helpers {

	/**
	 * Check if Chipmunk plugin is enabled
	 *
	 * @param string $addon Addon name
	 *
	 * @return bool
	 */
	public static function isAddonEnabled( $addon ) {
		return Addons::isAddonEnabled( $addon );
	}

	/**
	 * Get theme option alias
	 *
	 * @param string $name 		Theme option name
	 * @param mixed $default 	Optional. Default value for the option

	 * @return mixed
	 */
	public static function getOption( $name, $default = false ) {
		return Customizer::getOption( $name, $default );
	}

	/**
	 * Check if option is enabled in customizer
	 *
	 * @param string $feature 		Feature name
	 * @param string $postType 	Post type name
	 * @param bool $checkType 		Optional. Whether or not to check post type
	 *
	 * @return bool
	 */
	public static function isOptionEnabled( $feature, $postType, $checkType = true ) {
		return ! self::getOption( "disable_{$postType}_{$feature}" ) && ( $checkType ? get_post_type() == $postType : true );
	}

	/**
	 * Checks if the technical requirements are met.
	 *
	 * @return array
	 */
	public static function checkRequirements() {
		$phpVersion = phpversion();
		$wpVersion = get_bloginfo('version');
		$phpMinVersion = '7.4.0';
		$wpMinVersion = '5.0';
		$notices = [];

		if ( version_compare( $phpMinVersion, $phpVersion, '>' ) ) {
			$notices[] = [
				'type' => 'error',
				'message' => sprintf(
					__( 'Chipmunk requires PHP %1$s or greater. You have %2$s.', 'chipmunk' ),
					$phpMinVersion,
					$phpVersion
				),
			];
		}

		if ( version_compare( $wpMinVersion, $wpVersion, '>' ) ) {
			$notices[] = [
				'type' => 'error',
				'message' => sprintf(
					__( 'Chipmunk requires WordPress %1$s or greater. You have %2$s.', 'chipmunk' ),
					$wpMinVersion,
					$wpVersion
				),
			];
		}

		return $notices;
	}

	/**
	 * Builds class string based on name and modifiers
	 *
	 * @param string $name 			Base class name
	 * @param ?string[]|string $modifiers,... Class name modifiers
	 *
	 * @return string
	 */
	public static function className( $name, $modifiers = null ) {
		if ( ! is_string( $name ) ) {
			return '';
		}

		$modifiers = array_slice( func_get_args(), 1 );
		$classes   = [ $name ];

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
	}

	/**
	 * Checks that the reCAPTCHA parameter sent with the registration
	 * request is valid.
	 *
	 * @param string $response Recaptcha response
	 *
	 * @return bool True if the CAPTCHA is OK, otherwise false.
	 */
	public static function verifyRecaptcha( $response ) {
		$enabled	= self::getOption( 'recaptcha_enabled' );
		$siteKey	= self::getOption( 'recaptcha_site_key' );
		$secretKey	= self::getOption( 'recaptcha_secret_key' );

		// Verify if user is logged in
		if ( is_user_logged_in() ) {
			return true;
		}

		// Verify if recaptcha is disabled
		if ( ! $enabled or ! $siteKey ) {
			return true;
		}

		if ( ! isset( $response ) or empty( $response ) ) {
			return false;
		}

		if ( $secretKey ) {
			// Verify the captcha response from Google
			$remoteResponse = wp_remote_post(
				'https://www.google.com/recaptcha/api/siteverify',
				[
					'body' => [
						'secret' => $secretKey,
						'response' => $response
					]
				]
			);

			$success = false;

			if ( $remoteResponse && is_array( $remoteResponse ) ) {
				$decodedResponse = json_decode( $remoteResponse['body'] );
				$success = $decodedResponse->success;
			}

			return $success;
		}

		return true;
	}

	/**
	 * Gets the array of socials
	 *
	 * @return array
	 */
	public static function getSocials() {
		$socials = [];

		foreach ( Customizer::getSocials() as $social ) {
			$value = self::getOption( strtolower( $social ) );

			if ( $value ) {
				$socials[ $social ] = $value;
			}
		}

		return $socials;
	}

	/**
	 * Get post counter
	 *
	 * @param string $postType 	Post type
	 * @param string $postStatus 	Post status
	 *
	 * @return int
	 */
	public static function getPostCount( $postType, $postStatus ) {
		return wp_count_posts( $postType )->$postStatus;
	}

	/**
	 * Creates a title for post and pages OG tags
	 *
	 * @return string
	 */
	public static function getOgTitle() {
		if ( ! self::getOption( 'disable_og_branding' ) ) {
			return sprintf( esc_html__( '%s on %s', 'chipmunk' ), get_the_title(), get_bloginfo( 'name' ) );
		}

		return get_the_title();
	}

	/**
	 * Creates meta description for post and pages
	 *
	 * @return string
	 */
	public static function getMetaDescription() {
		global $post;

		if ( is_front_page() ) {
			$description = get_bloginfo( 'description' );
		}

		elseif ( is_single() || is_page() ) {
			$description = self::getCustomExcerpt( $post->post_content, $post->post_excerpt );
			$description = strip_tags( $description );
			$description = str_replace( '"', '\'', $description );
		}

		return $description ?? '';
	}

	/**
	 * Creates a custom excerpt function

	 * @param string $text 		A fallback content text to make the excerpt from
	 * @param string $excerpt 	The primary excerpt to return if not empty
	 *
	 * @return string
	 */
	public static function getCustomExcerpt( $text, $excerpt ) {
		if ( ! empty( $excerpt ) ) {
			return $excerpt;
		}

		$text = strip_shortcodes( $text );
		$text = apply_filters( 'the_content', $text );
		$text = str_replace( ']]>', ']]&gt;', $text );
		$text = strip_tags( $text );

		$excerptLength = apply_filters( 'excerpt_length', 55 );
		$excerptMore = apply_filters( 'excerpt_more', ' ' . '[...]' );
		$words = preg_split( "/[\n
			]+/", $text, $excerptLength + 1, PREG_SPLIT_NO_EMPTY );

		if ( count( $words ) > $excerptLength ) {
			array_pop( $words );
			$text = implode( ' ', $words );
			$text = $text . $excerptMore;
		}
		else {
			$text = implode( ' ', $words );
		}

		$text = str_replace( '"', '\'', strip_tags( $text ) );

		return apply_filters( 'wp_trim_excerpt', $text );
	}

	/**
	 * Gets menu items from specified location
	 *
	 * @param string $location Menu location
	 *
	 * @return array
	 */
	public static function getMenuItems( $location ) {
		if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $location ] ) ) {
			$menu = wp_get_nav_menu_object( $locations[ $location ] );

			if ( $menu ) {
				return wp_get_nav_menu_items( $menu->term_id );
			}
		}

		return false;
	}

	/**
	 * Recursively get taxonomy and its children
	 *
	 * @param string $taxonomy 	Taxonomy name
	 * @param array $args 		A list of args used to query taxonomy
	 * @param int $parent 		ID of a taxonomy parent to query from
	 *
	 * @return ?array
	 */
	public static function getTaxonomyHierarchy( $taxonomy, $args = [], $parent = 0 ) {
		$children = [];
		$taxonomy = is_array( $taxonomy ) ? array_shift( $taxonomy ) : $taxonomy;

		$terms = get_terms( $taxonomy, wp_parse_args( $args, [ 'parent' => $parent ] ) );

		if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
			foreach ( $terms as $term ) {
				$term->children = self::getTaxonomyHierarchy( $taxonomy, $args, $term->term_id );

				$children[ $term->term_id ] = $term;
			}

			return $children;
		}

		return null;
	}

	/**
	 * Recursively returns taxonomy options
	 *
	 * @param string $taxonomy 	Taxonomy name
	 * @param array $terms 	Term list
	 * @param int $lever 	Current level of the recursive call
	 *
	 * @return string
	 */
	public static function getTermOptions( $taxonomy, $terms = [], $level = 0 ) {
		$output = '';

		if ( empty( $terms ) ) {
			$terms = self::getTaxonomyHierarchy( $taxonomy );
		}

		foreach ( $terms as $term ) {
			$output .= '<option value="'. $term->name . '">' . str_repeat( '&horbar;', $level ) . ( $level ? '&nbsp;' : '' ) . $term->name . '</option>';

			if ( $term->children ) {
				$output .= self::getTermOptions( $taxonomy, $term->children, $level + 1 );
			}
		}

		return $output;
	}

	/**
	 * Conditionally returns post terms
	 *
	 * @param array $terms 	Terms list
	 * @param array $args 	Argument list
	 *
	 * @return string
	 */
	public static function getTermList( $terms, $args = [] ) {
		$args = wp_parse_args( $args, [
			'type'     => 'link',
			'quantity' => -1,
		] );

		$output = '';

		// Max length of post term (set 0 to display full term)
		$termMaxLength = apply_filters( 'chipmunk_term_max_length', 25 );

		if ( $args['quantity'] > 0 && $args['quantity'] < count( $terms ) && apply_filters( 'chipmunk_shuffle_terms', false ) ) {
			shuffle( $terms );
		}

		foreach ( $terms as $key => $term ) {
			if ( $args['quantity'] < 0 || $args['quantity'] > $key ) {
				if ( $args['type'] == 'link' ) {
					$output .= '<a href="' . esc_url( get_term_link( $term->term_id ) ) . '">' . esc_html( self::truncateString( $term->name, $termMaxLength ) ) . '</a>';
				}

				if ( $args['type'] == 'text' ) {
					$output .= '<span>' . esc_html( self::truncateString( $term->name, $termMaxLength ) ) . '</span>';
				}
			}
		}

		return $output;
	}

	/**
	 * Get resource links
	 *
	 * @param int $postId ID of the resource
	 *
	 * @return ?string
	 */
	public static function getResourceLinks( $postId ) {
		$keyPrefix = '_' . THEME_SLUG . '_resource_';
		$links = [];

		$metaWebsite = get_post_meta( $postId, $keyPrefix . 'website', true );
		$metaLinks = get_field( $keyPrefix . 'links',  $postId );

		if ( ! empty( $metaWebsite ) ) {
			$links[] = [
				'title' 	=> apply_filters( 'chipmunk_submission_website_label', __( 'Visit website', 'chipmunk' ) ),
				'url' 		=> $metaWebsite,
				'target' 	=> '_blank',
			];
		}

		if ( ! empty( $metaLinks ) ) {
			$links = array_merge( $links, array_column( $metaLinks, 'link' ) );
		}

		return $links;
	}

	/**
	 * Creates an external links
	 *
	 * @param string $url URL to convert to an external one
	 *
	 * @return string
	 */
	public static function getExternalUrl( $url ) {
		if ( ! self::getOption( 'disable_ref' ) ) {
			$title = str_replace( '-', '', sanitize_title( get_bloginfo( 'name' ) ) );
			$prefix = ( preg_match( '(\&|\?)', $url ) === 1 ) ? '&ref=' : '?ref=';

			return $url . $prefix . $title;
		}

		return $url;
	}

	/**
	 * Template for comments, without pingbacks or trackbacks
	 *
	 * @param object $comment Comment object
	 * @param array $args Argument list
	 * @param int $depth Current depth of the comment
	 *
	 * @return void
	 */
	public static function commentTemplate( $comment, $args, $depth ) {
		if ( $comment->comment_type == 'pingback' || $comment->comment_type == 'trackback' ) {
			return null;
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
						<?php comment_reply_link( array_merge( $args, [ 'reply_text' => Timber::compile( 'partials/icon.twig', [ 'icon' => 'reply' ] ) . esc_html__( 'Reply', 'chipmunk' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ] ) ); ?>
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
	 *
	 * @param int $postId 		ID of the post
	 * @param array $meta 		Array of key => value pairs of meta to add to the post
	 * @param array $allowed 	Array of allowed post types
	 * @param bool $unique 		Optional. Whether the same key should not be added.
	 *
	 * @return int
	 */
	public static function addPostMeta( $postId, $meta, $allowed, $unique = true ) {
		if ( ! in_array( get_post_type( $postId ), $allowed ) ) {
			return $postId;
		}

		foreach ( $meta as $key => $value ) {
			add_post_meta( $postId, $key, $value, $unique );
		}

		return $postId;
	}

	/**
	 * Truncates long strings
	 *
	 * @param string $str 		String to be truncated
	 * @param int $chars 		Character limit
	 * @param bool $toSpace 	Optional. Whether to cut the the closest space or not
	 * @param string $suffix 	Optional. String to add to the end of truncated text
	 *
	 * @return string
	 */
	public static function truncateString( $str, $chars, $toSpace = true, $suffix = '&hellip;' ) {
		$str = strip_tags( $str );

		if ( $chars == 0 || $chars > strlen( $str ) ) {
			return $str;
		}

		$str = substr( $str, 0, $chars );
		$spacePos = strrpos( $str, ' ' );

		if ( $toSpace && $spacePos >= 0 ) {
			$str = substr( $str, 0, strrpos( $str, ' ' ) );
		}

		return $str . $suffix;
	}

	/**
	 * Gets popular fonts from Google Fonts API
	 *
	 * @param string $apiKey 	Google Fonts API Key
	 * @param array $sort 		Optional. Sort option to pass to the Google Fonts API
	 *
	 * @return ?array
	 */
	public static function getGoogleFonts( $apiKey, $sort = 'popularity' ) {
		$ch = curl_init( "https://www.googleapis.com/webfonts/v1/webfonts?key=$apiKey&sort=$sort" );
		curl_setopt( $ch, CURLOPT_HTTPHEADER, [ 'Content-Type: application/json' ] );
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, FALSE );

		$response = curl_exec( $ch );
		$httpCode = curl_getinfo( $ch, CURLINFO_HTTP_CODE );
		curl_close( $ch );

		$fonts = json_decode( $response, true );

		if ( $httpCode == 200 && ! empty( $fonts ) ) {
			return $fonts['items'];
		}

		return null;
	}

	/**
	 * Parses Google Fonts url
	 *
	 * @param array $fonts Array of Google Font names
	 *
	 * @return ?string
	 */
	public static function getGoogleFontsUrl( $fonts ) {
		if ( ! is_array( $fonts ) ) {
			return null;
		}

		$fontFamilies = [];

		foreach ( $fonts as $font ) {
			if ( ! array_key_exists( $font, $fontFamilies ) ) {
				$fontFamilies[ $font ] = "{$font}:400,700";
			}
		}

		$args = [
			'family' => urlencode( implode( '|', array_values( $fontFamilies ) ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		];

		return add_query_arg( $args, '//fonts.googleapis.com/css' );
	}

	/**
	 * Gets file extension by content mime type
	 *
	 * @param string $mime Mime type name to search
	 *
	 * @return ?string
	 */
	public static function getExtensionByMime( $mime ) {
		$extensions = [
			'image/jpeg' 	=> '.jpeg',
			'image/jpg' 	=> '.jpg',
			'image/png' 	=> '.png',
			'image/gif' 	=> '.gif',
			'image/bmp' 	=> '.bmp',
			'image/webp' 	=> '.webp',
			'image/svg+xml' => '.svg',
		];

		return $extensions[ $mime ] ?? null;
	}

    /**
     * Pulls the image content into the svg markup
	 *
	 * @param string $path File path
	 *
	 * @return string
     */
	public static function getSvgContent( $path ) {
		if ( ! empty( $path ) && $svgFile = @ file_get_contents( $path ) ) {
			$position = strpos( $svgFile, '<svg' );
			return substr( $svgFile, $position );
		}

		return "<img src='$path' alt='' />";
	}

    /**
     * Converts svg content to base64 encoded
	 *
	 * @param string $path File path
	 *
	 * @return ?string
     */
	public static function svgToBase64( $path ) {
		if ( ! empty( $path ) && $svgFile = @ file_get_contents( $path ) ) {
			return 'data:image/svg+xml;base64,' . base64_encode( $svgFile );
		}

		return null;
	}

	/**
	 * Geneterates random string
	 *
	 * @param int $length Optional. Lenght of the generated string
	 *
	 * @return string
	 */
	public static function getSalt( $length = 5 ) {
		return bin2hex( random_bytes( $length ) );
	}

	/**
	 * Utility to find if key/value pair exists in array
	 *
	 * @param array $array 		Haystack
	 * @param string $key 		Needle key
	 * @param string $value 	Needle value
	 *
	 * @return mixed
	 */
	public static function findKeyValue( $array, $key, $val ) {
		foreach ( $array as $item ) {
			if ( is_array( $item ) && self::findKeyValue( $item, $key, $val ) ) {
				return $item;
			}

			if ( isset( $item[ $key ] ) && $item[ $key ] == $val ) {
				return $item;
			}
		}

		return null;
	}

	/**
	 * Retrieves user's IP address
	 *
	 * @return string
	 */
	public static function getIp() {
		if ( isset( $_SERVER['HTTP_CLIENT_IP'] ) && ! empty( $_SERVER['HTTP_CLIENT_IP'] ) ) {
			$ip = $_SERVER['HTTP_CLIENT_IP'];
		}
		elseif ( isset( $_SERVER['HTTP_X_FORWARDED_FOR'] ) && ! empty( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) {
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		}
		else {
			$ip = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
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
	 * @param int $number  		Number to format
	 * @param int $precision 	How many decimal points to display (1.25K)
	 *
	 * @return string
	 */
	public static function formatNumber( $number, $precision = 1 ) {
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

		return preg_replace( '/\.[0]+([KMB]?)$/i', '$1', $formatted );
	}

	/**
	 * Utility function to convert hex colors to RGB arrays
	 *
	 * @param string $color 	Hex color value
	 * @param bool $implode 	Return color as a string
	 *
	 * @return ?string
	 */
	public static function hexToRgb( $color, $implode = false ) {
		$color = str_replace( '#', '', $color );

		if ( strlen( $color ) == 6 ) {
			list( $r, $g, $b ) = array_map( 'hexdec', str_split( $color, 2 ) );

			return $implode ? implode( ', ', [ $r, $g, $b ] ) : [ $r, $g, $b ];
		}

		return null;
	}
}
