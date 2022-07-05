<?php

namespace Chipmunk\Config;

use Chipmunk\Customizer;
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
		add_action( 'wp_insert_post', [ $this, 'addDefaultMeta' ] );
		add_action( 'wp_head', [ $this, 'addOgTags' ] );
		add_action( 'after_setup_theme', [ $this, 'setupComments' ] );
		add_filter( 'the_content', [ $this, 'normalizeContentWhitespace' ], 10, 1 );
		add_filter( 'user_contactmethods', [ $this, 'addContactMethods' ], 99, 2 );
	}

	/**
	 * Set default meta values for likes, upvotes and ratings
	 *
	 * @return mixed
	 */
	public static function addDefaultMeta( $postId ) {
		$defaut = [
			'_' . THEME_SLUG . '_post_view_count'   => 0,
			'_' . THEME_SLUG . '_upvote_count'      => 0,
		];

		if ( Helpers::isAddonEnabled( 'ratings' ) ) {
			$defaut = array_merge( $defaut, [
				'_' . THEME_SLUG . '_rating_count'   => 0,
				'_' . THEME_SLUG . '_rating_average' => 0,
				'_' . THEME_SLUG . '_rating_rank'    => 0,
			] );
		}

		return Helpers::addPostMeta( $postId, $defaut, [ 'post', 'resource' ] );
	}

	/**
	 * Add Open Graph tags
	 */
	public static function addOgTags() {
		if ( Helpers::getOption( 'disable_og' ) ) {
			return null;
		}

		$siteImage = Helpers::getOption( 'og_image' );

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
			<?php if ( ! empty( $siteImage ) ) : ?>
				<meta property="og:image" content="<?php echo $siteImage; ?>">
				<meta property="og:image:width" content="1200">
				<meta property="og:image:height" content="630">
			<?php endif; ?>

			<?php
		}
		elseif ( is_single() || is_page() ) {
			global $post;

			if ( get_the_post_thumbnail( $post->ID, 'xl' ) ) {
				$thumbnailId	= get_post_thumbnail_id( $post->ID );
				$thumbnail		= wp_get_attachment_image_src( $thumbnailId, 'xl' );
				$image			= $thumbnail[0];
			}
			?>

			<!-- / Twitter Card -->
			<meta name="twitter:card" content="<?php echo isset( $image ) ? 'summary_large_image' : 'summary'; ?>">

			<!-- / FB Open Graph -->
			<meta property="og:type" content="article">
			<meta property="og:url" content="<?php the_permalink(); ?>">
			<meta property="og:title" content="<?php echo Helpers::getOgTitle(); ?>">
			<meta property="og:description" content="<?php echo Helpers::getMetaDescription(); ?>">
			<meta property="og:image" content="<?php echo isset( $image ) ? $image : $siteImage; ?>">
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
	public static function setupComments() {
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
	public static function normalizeContentWhitespace( $content ) {
		return normalize_whitespace( $content );
	}

	/**
	 * Changes the user contact methods
	 *
	 * @return array
	 */
	public static function addContactMethods() {
		$socials = Customizer::getSocials();
		$socials = array_filter( $socials, fn( $el ) => $el != 'Email' );
		$socialKeys = array_map( fn( $el ) => sanitize_title( $socials[ $el ] ), array_keys( $socials ) );

		return array_combine( $socialKeys, $socials );
	}
}
