<?php
/**
 * Custom config actions
 *
 * @package WordPress
 * @subpackage Chipmunk
 */

if ( ! function_exists( 'chipmunk_scripts' ) ) :
/**
 * Enqueue front end styles and scripts
 */
function chipmunk_scripts() {
	// Load Chipmunk main stylesheet
	wp_enqueue_style( 'chipmunk-styles', CHIPMUNK_TEMPLATE_URI . '/static/dist/styles/main.min.css', array(), CHIPMUNK_VERSION );

	// Load Chipmunk main script.
	wp_enqueue_script( 'chipmunk-scripts', CHIPMUNK_TEMPLATE_URI . '/static/dist/scripts/main.min.js', array(), CHIPMUNK_VERSION, true );
}
endif;
add_action( 'wp_enqueue_scripts', 'chipmunk_scripts' );


if ( ! function_exists( 'chipmunk_admin_scripts' ) ) :
/**
 * Enqueue admin end styles and scripts
 */
function chipmunk_admin_scripts() {
	// Load Chipmunk admin stylesheet
	wp_enqueue_style( 'chipmunk-admin-styles', CHIPMUNK_TEMPLATE_URI . '/admin.css', array(), CHIPMUNK_VERSION );
}
endif;
add_action( 'admin_enqueue_scripts', 'chipmunk_admin_scripts' );


if ( ! function_exists( 'chipmunk_google_fonts' ) ) :
/**
 * Enqueue Google Fonts styles
 */
function chipmunk_google_fonts() {
	$primary_font = ChipmunkCustomizer::theme_option( 'primary_font' );

	if ( $primary_font != 'System' ) {
		wp_enqueue_style( 'chipmunk-fonts', chipmunk_get_fonts_url( $primary_font ), array(), CHIPMUNK_VERSION );
	}
}
endif;
add_action( 'wp_enqueue_scripts', 'chipmunk_google_fonts' );


if ( ! function_exists( 'chipmunk_custom_style' ) ) :
/**
 * Enqueue custom CSS styles
 */
function chipmunk_custom_style() {
	$primary_color  = ChipmunkCustomizer::theme_option( 'primary_color' );
	$primary_font   = ChipmunkCustomizer::theme_option( 'primary_font' );
	$custom_css     = ChipmunkCustomizer::theme_option( 'custom_css' );

	$custom_style   = ! empty( $custom_css ) ? $custom_css : '';
	$primary_font   = $primary_font == 'System' ? '-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen, Ubuntu, Cantarell, "Open Sans", "Helvetica Neue", sans-serif' : '"' . str_replace( '+', ' ', $primary_font ) . '"';

	$custom_style .= "
		body {
			font-family: $primary_font;
		}
	";

	if ( $primary_color and $primary_color != '#F38181' ) {
		$custom_style .= "
			.button_primary:hover,
			.button_secondary,
			.entry__content a:hover,
			.nav-primary__close:hover,
			.nav-socials__item a:hover,
			.page-head__logo,
			.pagination__item a:hover,
			.popup__close:hover,
			.popup__close:hover,
			.popup__close:hover,
			.resource__description a,
			.section_theme-primary .button_secondary:hover,
			.search-bar__icon:hover,
			.search-bar__close:hover {
				color: $primary_color;
			}

			.select2-container .select2-results__option[aria-selected=true],
			.button_primary,
			.button_secondary:hover,
			.entry[href]:hover .entry__button,
			.section_theme-primary,
			.stats__button.is-active,
			.stats__button.is-loading.is-active::before,
			.tile__content_primary,
			.tile:hover .tile__button {
				background-color: $primary_color;
			}
		";
	}

	wp_add_inline_style( 'chipmunk-styles', $custom_style );
}
endif;
add_action( 'wp_enqueue_scripts', 'chipmunk_custom_style' );


if ( ! function_exists( 'chipmunk_update_permalinks' ) ) :
/**
 * Force using postname in WP permalinks
 */
function chipmunk_update_permalinks() {
	global $wp_rewrite;

	$wp_rewrite->set_permalink_structure( '/%postname%/' );
}
endif;
add_action( 'init', 'chipmunk_update_permalinks' );


if ( ! function_exists( 'chipmunk_update_search_query' ) ) :
/**
 * Update search query
 */
function chipmunk_update_search_query( $query ) {
	if ( $query->is_search ) {
		$query->set( 'post_type', array( 'post', 'resource' ) );
		$query->set( 'posts_per_page', ChipmunkCustomizer::theme_option( 'results_per_page' ) );
	}

	return $query;
}
endif;
add_filter( 'pre_get_posts', 'chipmunk_update_search_query' );


if ( ! function_exists( 'chipmunk_update_main_query' ) ) :
/**
 * Update main query
 */
function chipmunk_update_main_query( $query ) {
	if ( $query->is_tax and is_tax() ) {
		$query->set( 'posts_per_page', ChipmunkCustomizer::theme_option( 'posts_per_page' ) );
	}

	return $query;
}
endif;
add_filter( 'pre_get_posts', 'chipmunk_update_main_query' );


if ( ! function_exists( 'chipmunk_exclude_tax_children' ) ) :
/**
 * Exclude children from taxonomy listing
 */
function chipmunk_exclude_tax_children( $query ) {
	if ( isset( $query->query_vars['resource-collection'] ) ) {
		$query->set( 'tax_query', array( array(
			'taxonomy'          => 'resource-collection',
			'field'             => 'slug',
			'terms'             => $query->query_vars['resource-collection'],
			'include_children'  => false,
		) ) );
	}
}
endif;
add_filter( 'pre_get_posts', 'chipmunk_exclude_tax_children' );


if ( ! function_exists( 'chipmunk_set_default_meta' ) ) :
/**
 * Set default meta values for likes and upvotes
 */
function chipmunk_set_default_meta( $post_ID ) {
	$defaut_values = array(
		'_' . CHIPMUNK_THEME_SLUG . '_post_view_count' 	 => 0,
		'_' . CHIPMUNK_THEME_SLUG . '_post_upvote_count' => 0,
	);

	foreach ( $defaut_values as $meta => $value ) {
		$current_value = get_post_meta( $post_ID, $meta );

		if ( empty( $current_value ) && ! wp_is_post_revision( $post_ID ) ) {
		    add_post_meta( $post_ID, $meta, $value );
		}
	}

	return $post_ID;
}
endif;
add_action( 'wp_insert_post', 'chipmunk_set_default_meta' );


if ( ! function_exists( 'chipmunk_add_og_tags' ) ) :
/**
 * Add facebook's Open Graph tags
 */
function chipmunk_add_og_tags() {
	$site_image = ( $logo = ChipmunkCustomizer::theme_option( 'og_image' ) ) ? $logo : CHIPMUNK_TEMPLATE_URI . '/static/dist/images/chipmunk-og.png';

	if ( is_front_page() ) {
		?>

		<!-- / FB Open Graph -->
		<meta property="og:type" content="website">
		<meta property="og:url" content="<?php echo esc_url( home_url() ); ?>">
		<meta property="og:title" content="<?php bloginfo( 'name' ); ?>">
		<meta property="og:description" content="<?php bloginfo( 'description' ); ?>">
		<meta property="og:image" content="<?php echo $site_image; ?>">

		<!-- / Twitter Cards -->
		<meta name="twitter:card" content="summary">
		<meta name="twitter:title" content="<?php bloginfo( 'name' ); ?>">
		<meta name="twitter:description" content="<?php bloginfo( 'description' ); ?>">
		<meta name="twitter:image" content="<?php echo $site_image; ?>">

		<?php
	}
	elseif ( is_single() or is_page() ) {
		global $post;

		if ( get_the_post_thumbnail( $post->ID, 'xl' ) ) {
			$thumbnail_id     = get_post_thumbnail_id( $post->ID );
			$thumbnail_object = wp_get_attachment_image_src( $thumbnail_id, 'xl' );
			$image            = $thumbnail_object[0];
		}

		$description = chipmunk_custom_excerpt( $post->post_content, $post->post_excerpt );
		$description = strip_tags( $description );
		$description = str_replace( '"', '\'', $description );
		?>

		<!-- / FB Open Graph -->
		<meta property="og:type" content="article">
		<meta property="og:url" content="<?php the_permalink(); ?>">
		<meta property="og:title" content="<?php printf( __( '%s on %s', 'chipmunk' ), get_the_title(), get_bloginfo( 'name' ) ); ?>">
		<meta property="og:description" content="<?php echo $description ?>">
		<meta property="og:image" content="<?php echo isset( $image ) ? $image : $site_image; ?>">
		<meta property="og:site_name" content="<?php echo get_bloginfo( 'name' ); ?>">

		<!-- / Twitter Cards -->
		<meta name="twitter:card" content="<?php echo isset( $image ) ? 'summary_large_image' : 'summary'; ?>">
		<meta name="twitter:title" content="<?php printf( __( '%s on %s', 'chipmunk' ), get_the_title(), get_bloginfo( 'name' ) ); ?>">
		<meta name="twitter:description" content="<?php echo $description ?>">
		<meta name="twitter:image" content="<?php echo isset( $image ) ? $image : $site_image; ?>">

		<?php
	}
}
endif;
add_action( 'wp_head', 'chipmunk_add_og_tags' );
