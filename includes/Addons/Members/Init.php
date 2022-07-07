<?php

namespace Chipmunk\Addons\Members;

use Chipmunk\Helpers;
use Chipmunk\Addons\Members\Helpers as MembersHelpers;

/**
 * Allows users to sign-up and improve the experience of the theme
 *
 * @package WordPress
 * @subpackage Chipmunk
 */
class Init {

	/**
	 * Initializes the addon.
	 *
	 * To keep the initialization fast, only add filter and action
	 * hooks in the constructor.
	 *
	 * @param array $config
	 */
	function __construct( $config = [] ) {
		// Set config defaults
		$this->config = wp_parse_args( $config, [
			'name'         => '',
			'slug'         => '',
			'excerpt'      => '',
			'url'          => '',
		] );

		$this->transient = THEME_SLUG . '_' . $this->config['slug'] . '_init';

		// Set hooks
		$this->hooks();
	}

	/**
	 * Setup hooks
	 *
	 * @return  void
	 */
	private function hooks() {
		add_action( 'init', [ $this, 'setupAddon' ] );
		add_filter( 'chipmunk_settings_addons', [ $this, 'addSettingsAddon' ] );
	}

	/**
	 * Page initialization
	 *
	 * Creates all WordPress pages needed by the addon.
	 */
	private function registerPages() {
		$options = MembersHelpers::getOptions( 'pages' );

		// Information needed for creating the addon's pages
		$pages = [
			'login' => [
				'title' => __( 'Login', 'chipmunk' ),
				'content' => '[chipmunk-login-form]',
				'template' => 'page-narrow-width.php',
			],

			'register' => [
				'title' => __( 'Register', 'chipmunk' ),
				'content' => '[chipmunk-register-form]',
				'template' => 'page-narrow-width.php',
			],

			'lost-password' => [
				'title' => __( 'Forgot Your Password?', 'chipmunk' ),
				'content' => '[chipmunk-lost-password-form]',
				'template' => 'page-narrow-width.php',
			],

			'reset-password' => [
				'title' => __( 'Reset Password', 'chipmunk' ),
				'content' => '[chipmunk-reset-password-form]',
				'template' => 'page-narrow-width.php',
			],

			'profile' => [
				'title' => __( 'Edit Profile', 'chipmunk' ),
				'content' => '[chipmunk-profile-form]',
				'template' => 'page-narrow-width.php',
			],

			'dashboard' => [
				'title' => __( 'Dashboard', 'chipmunk' ),
				'content' => '[chipmunk-dashboard]',
				'template' => 'page-full-width.php',
			],
		];

		foreach ( $pages as $slug => $page ) {
			$normalizedSlug = str_replace( '-', '_', $slug );
			$optionSlug = "chipmunk_{$normalizedSlug}_page_id";
			$currentPage = $options[ $optionSlug ];

			if ( empty( $currentPage ) || ! get_post( $currentPage ) || get_post_status( $currentPage ) != 'publish' ) {
				// Add the page using the data from the array above
				$post_id = wp_insert_post(
					[
						'post_content'   => "<!-- wp:shortcode -->{$page['content']}<!-- /wp:shortcode -->",
						'post_name'      => $slug,
						'post_title'     => $page['title'],
						'post_status'    => 'publish',
						'post_type'      => 'page',
						'ping_status'    => 'closed',
						'comment_status' => 'closed',
						'page_template'  => $page['template'],
					]
				);

				$options[ $optionSlug ] = $post_id;
			} elseif ( get_post( $currentPage ) && get_post_status( $currentPage ) != 'publish' ) {
				wp_update_post(
					[
						'ID'             => $currentPage,
						'post_status'    => 'publish',
					],
				);
			}
		}

		// Remove and recreate rewrite rules
		flush_rewrite_rules();

		// Update page options
		MembersHelpers::setOptions( 'pages', $options );
	}

	/**
 	 * Setup main components and features of the addon
	 */
	public function setupAddon() {
		if ( ! Helpers::isAddonEnabled( $this->config['slug'] ) ) {
			return null;
		}

		if ( ! get_transient( $this->transient ) ) {
			// Register post meta
			$this->registerPages();

			// Set transient
			set_transient( $this->transient, true );
		}

		new Actions();
		new Config();
		new Redirects();
		new Renderers();
		new Settings( $this->config );
	}

	/**
 	 * Add settings addon component
	 *
	 * @return array
	 */
	public function addSettingsAddon( $addons ) {
		$addons[] = $this->config;

		return $addons;
	}
}
