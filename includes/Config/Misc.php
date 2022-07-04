<?php

namespace Chipmunk\Config;

use Chipmunk\Helpers;

/**
 * Miscellaneous config hooks
 *
 * @package WordPress
 * @subpackage Chipmunk
 */
class Misc {

	/**
 	 * Used to register custom hooks
	 */
	function __construct() {
		add_action( 'wp_insert_post', [ $this, 'add_default_meta' ] );
		add_action( 'wp_head', [ $this, 'add_og_tags' ] );
		add_action( 'after_setup_theme', [ $this, 'setup_comments' ] );
		add_filter( 'the_content', [ $this, 'normalize_content_whitespace' ], 10, 1 );
	}

	/**
	 * Set default meta values for likes, upvotes and ratings
	 *
	 * @return mixed
	 */
	public static function add_default_meta( $post_ID ) {
		$defaut_values = [
			'_' . THEME_SLUG . '_post_view_count'   => 0,
			'_' . THEME_SLUG . '_upvote_count'      => 0,
		];

		if ( Helpers::isAddonEnabled( 'ratings' ) ) {
			$defaut_values = array_merge( $defaut_values, [
				'_' . THEME_SLUG . '_rating_count'   => 0,
				'_' . THEME_SLUG . '_rating_average' => 0,
				'_' . THEME_SLUG . '_rating_rank'    => 0,
			] );
		}

		return Helpers::addPostMeta( $post_ID, $defaut_values, [ 'post', 'resource' ] );
	}

	/**
	 * Add Open Graph tags
	 */
	public static function add_og_tags() {
		if ( Helpers::getOption( 'disable_og' ) ) {
			return null;
		}

		$site_image = Helpers::getOption( 'og_image' );

		if ( is_front_page() ) {
			?>

			<!-- / Twitter Card -->
			<meta name="twitter:card" content="summary">

			<!-- / FB Open Graph -->
			<meta property="og:type" content="website">
			<meta property="og:site_name" content="<?php bloginfo( 'name' ); ?>">
			<meta property="og:url" content="<?php echo esc_url( home_url( '/' ) ); ?>">
			<meta property="og:title" content="<?php bloginfo( 'name' ); ?>">
			<meta property="og:description" content="<?php bloginfo( 'description' ); ?>">
			<?php if ( ! empty( $site_image ) ) : ?>
				<meta property="og:image" content="<?php echo $site_image; ?>">
				<meta property="og:image:width" content="1200">
				<meta property="og:image:height" content="630">
			<?php endif; ?>

			<?php
		}
		elseif ( is_single() || is_page() ) {
			global $post;

			if ( get_the_post_thumbnail( $post->ID, 'xl' ) ) {
				$thumbnail_id     = get_post_thumbnail_id( $post->ID );
				$thumbnail_object = wp_get_attachment_image_src( $thumbnail_id, 'xl' );
				$image            = $thumbnail_object[0];
			}
			?>

			<!-- / Twitter Card -->
			<meta name="twitter:card" content="<?php echo isset( $image ) ? 'summary_large_image' : 'summary'; ?>">

			<!-- / FB Open Graph -->
			<meta property="og:type" content="article">
			<meta property="og:url" content="<?php the_permalink(); ?>">
			<meta property="og:title" content="<?php echo Helpers::getOgTitle(); ?>">
			<meta property="og:description" content="<?php echo Helpers::getMetaDescription(); ?>">
			<meta property="og:image" content="<?php echo isset( $image ) ? $image : $site_image; ?>">
			<meta property="og:image:width" content="1200">
			<meta property="og:image:height" content="630">
			<meta property="og:site_name" content="<?php bloginfo( 'name' ); ?>">

			<?php
		}
	}

	/**
	 * Theme configuration setup
	 * Load comment reply link in case of page and post pages
	 * if threaded comments are enabled
	 *
	 * @hook after_setup_theme
	 */
	public static function setup_comments() {
		// add threaded comments
		if ( ! is_admin() ) {
			if ( is_singular() && get_option( 'thread_comments' ) ) {
				wp_enqueue_script( 'comment-reply' );
			}
		}
	}

	/**
	 * Normalize EOL characters and strip duplicate whitespace.
	 *
	 * @return string
	 */
	public static function normalize_content_whitespace( $content ) {
		return normalize_whitespace( $content );
	}
}
