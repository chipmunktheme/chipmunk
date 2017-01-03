<?php
/**
 * Custom config actions
 *
 * @package WordPress
 * @subpackage Chipmunk
 */

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


if ( ! function_exists( 'chipmunk_upload_mimes' ) ) :
/**
* Allow SVG upload
*/
function chipmunk_upload_mimes( $mimes ) {
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}
endif;
add_filter( 'upload_mimes', 'chipmunk_upload_mimes' );


if ( ! function_exists( 'chipmunk_update_search_query' ) ) :
/**
* Update search query
*/
function chipmunk_update_search_query( $query ) {
	if ( $query->is_search ) {
		$query->set( 'post_type', 'resource' );
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


if ( ! function_exists( 'chipmunk_add_og_tags' ) ) :
/**
* Add facebook's Open Graph tags
*/
function chipmunk_add_og_tags() {
	$site_image = ( $logo = ChipmunkCustomizer::theme_option( 'logo' ) ) ? $logo : CHIPMUNK_TEMPLATE_URI . '/static/dist/images/chipmunk.png';

	if ( is_single() or is_page() ) {
		global $post;

		if ( get_the_post_thumbnail( $post->ID, 'xl' ) ) {
			$thumbnail_id     = get_post_thumbnail_id( $post->ID );
			$thumbnail_object = wp_get_attachment_image_src( $thumbnail_id, 'xl' );
			$image            = $thumbnail_object[0];
		}

		$description = ChipmunkHelpers::custom_excerpt( $post->post_content, $post->post_excerpt );
		$description = strip_tags( $description );
		$description = str_replace( '"', '\'', $description );
		?>

		<!-- / FB Open Graph -->
		<meta property="og:type" content="article">
		<meta property="og:url" content="<?php the_permalink(); ?>">
		<meta property="og:title" content="<?php the_title(); ?> on <?php bloginfo( 'name' ); ?>">
		<meta property="og:description" content="<?php echo $description ?>">
		<meta property="og:image" content="<?php echo isset( $image ) ? $image : $site_image; ?>">
		<meta property="og:site_name" content="<?php echo get_bloginfo( 'name' ); ?>">

		<!-- / Twitter Cards -->
		<meta name="twitter:card" content="<?php echo isset( $image ) ? 'summary_large_image' : 'summary'; ?>">
		<meta name="twitter:title" content="<?php the_title(); ?> on <?php bloginfo( 'name' ); ?>">
		<meta name="twitter:description" content="<?php echo $description ?>">
		<meta name="twitter:image" content="<?php echo isset( $image ) ? $image : $site_image; ?>">

		<?php
	} elseif ( is_front_page() ) {
		?>

		<!-- / FB Open Graph -->
		<meta property="og:type" content="website">
		<meta property="og:url" content="<?php echo get_bloginfo( 'url' ); ?>">
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
}
endif;
add_action( 'wp_head', 'chipmunk_add_og_tags' );
