<?php

namespace Chipmunk\Core;

use WP_Customize_Manager;
use WP_Customize_Color_Control;
use WP_Customize_Image_Control;

use Chipmunk\Theme;
use Chipmunk\Helper\FontsTrait;

use function Chipmunk\config;

/**
 * Theme options
 */
class Options extends Theme {

	use FontsTrait;

	/**
	 * An array of Customzer sections
	 *
	 * @var array
	 */
	private $sections;

	/**
	 * Define settings access
	 *
	 * @var string
	 */
	private $capability = 'edit_theme_options';

	/**
	 * Class constructor.
	 */
	public function __construct() {
		$this->sections = [
			[
				'title'  => esc_html__( 'Site Identity', 'chipmunk' ),
				'slug'   => 'title_tagline',
				'fields' => [
					[
						'name'        => 'logo',
						'type'        => 'image',
						'label'       => esc_html__( 'Site Logo', 'chipmunk' ),
						'description' => esc_html__( 'Upload a logo for your theme. You can leave it empty to use your site name as a plain text logo.', 'chipmunk' ),
					],
				],
			],

			[
				'title'  => esc_html__( 'Visuals', 'chipmunk' ),
				'slug'   => 'visuals_section',
				'fields' => [
					[
						'name'    => 'primary_color',
						'type'    => 'color',
						'label'   => esc_html__( 'Primary Color', 'chipmunk' ),
						'default' => '#5b5c89',
					],
					[
						'name'    => 'link_color',
						'type'    => 'color',
						'label'   => esc_html__( 'Link Color', 'chipmunk' ),
						'default' => '#5b5c89',
					],
					[
						'name'    => 'background_color',
						'type'    => 'color',
						'label'   => esc_html__( 'Background Color', 'chipmunk' ),
						'default' => '#EDEDED',
					],
					[
						'name'    => 'section_color',
						'type'    => 'color',
						'label'   => esc_html__( 'Section Background Color', 'chipmunk' ),
						'default' => '#FAFAFA',
					],
					[
						'name'    => 'section_color',
						'type'    => 'color',
						'label'   => esc_html__( 'Section Border Color', 'chipmunk' ),
						'default' => '#E8E8E8',
					],
					[
						'name'    => 'primary_font',
						'type'    => 'select',
						'label'   => esc_html__( 'Primary Font', 'chipmunk' ),
						'default' => '',
						'choices' => array_merge( [ '' => esc_html__( 'System font', 'chipmunk' ) ], $this->getGoogleFonts() ),
					],
					[
						'name'    => 'heading_font',
						'type'    => 'select',
						'label'   => esc_html__( 'Heading Font', 'chipmunk' ),
						'default' => '',
						'choices' => array_merge( [ '' => esc_html__( 'System font', 'chipmunk' ) ], $this->getGoogleFonts() ),
					],
					[
						'name'        => 'content_size',
						'type'        => 'text',
						'label'       => esc_html__( 'Content Size', 'chipmunk' ),
						'default'     => '2rem',
						'description' => esc_html__( 'You can use any CSS unit here (eg. px, em, rem, vw)', 'chipmunk' ),
					],
					[
						'name'        => 'content_width',
						'type'        => 'radio',
						'label'       => esc_html__( 'Content Width', 'chipmunk' ),
						'default'     => '8',
						'description' => esc_html__( 'You can can still overwrite it by setting page templates.', 'chipmunk' ),
						'choices'     => [
							'6'  => esc_html__( 'Narrow', 'chipmunk' ),
							'8'  => esc_html__( 'Normal', 'chipmunk' ),
							'10' => esc_html__( 'Wide', 'chipmunk' ),
							'12' => esc_html__( 'Full', 'chipmunk' ),
						],
					],
					[
						'name'    => 'dropdown_theme',
						'type'    => 'radio',
						'label'   => esc_html__( 'Dropdown Color Theme', 'chipmunk' ),
						'default' => 'light',
						'choices' => [
							'light' => esc_html__( 'Light', 'chipmunk' ),
							'dark'  => esc_html__( 'Dark', 'chipmunk' ),
						],
					],
					[
						'name'        => 'logo_height',
						'type'        => 'range',
						'label'       => esc_html__( 'Logo height', 'chipmunk-lite' ),
						'default'     => 40,
						'description' => esc_html__( 'Width will be calculated automatically.', 'chipmunk' ),
						'input_attrs' => [
							'min'  => 20,
							'max'  => 100,
							'step' => 1,
						],
					],
					[
						'name'    => 'sticky_header',
						'type'    => 'checkbox',
						'label'   => esc_html__( 'Enable sticky header', 'chipmunk' ),
						'default' => false,
					],
					[
						'name'    => 'disable_section_borders',
						'type'    => 'checkbox',
						'label'   => esc_html__( 'Disable section borders', 'chipmunk' ),
						'default' => false,
					],
					[
						'name'        => 'custom_css',
						'type'        => 'textarea',
						'label'       => esc_html__( 'Custom CSS', 'chipmunk' ),
						'default'     => '',
						'description' => esc_html__( 'Quickly add some CSS to your theme by adding it to this block.', 'chipmunk' ),
					],
				],
			],

			[
				'title'  => esc_html__( 'Open Graph', 'chipmunk' ),
				'slug'   => 'og_section',
				'fields' => [
					[
						'name'  => 'disable_og',
						'type'  => 'checkbox',
						'label' => esc_html__( 'Disable Open Graph', 'chipmunk' ),
					],
					[
						'name'        => 'og_image',
						'type'        => 'image',
						'label'       => esc_html__( 'Open Graph Image', 'chipmunk' ),
						'description' => esc_html__( '1200x630 pixels', 'chipmunk' ),
					],
					[
						'name'  => 'disable_og_branding',
						'type'  => 'checkbox',
						'label' => esc_html__( 'Remove \'on [website name]\' text', 'chipmunk' ),
					],
				],
			],

			[
				'title'  => esc_html__( 'Homepage', 'chipmunk' ),
				'slug'   => 'homepage_section',
				'fields' => [
					[
						'name'        => 'intro_text',
						'type'        => 'text',
						'label'       => esc_html__( 'Intro text', 'chipmunk' ),
						'description' => esc_html__( 'Enter your site\'s tagline to show on homepage under the header. Leave empty to hide.', 'chipmunk' ),
					],
					[
						'name'        => 'resources_count',
						'type'        => 'number',
						'label'       => esc_html__( 'Latest resources count', 'chipmunk' ),
						'default'     => 9,
						'description' => esc_html__( 'Enter the max resources number to show on resource sliders.', 'chipmunk' ),
					],
					[
						'name'    => 'disable_homepage_listings',
						'type'    => 'checkbox',
						'label'   => esc_html__( 'Disable resource listings', 'chipmunk' ),
						'default' => false,
					],
					[
						'name'    => 'disable_homepage_listings_sliders',
						'type'    => 'checkbox',
						'label'   => esc_html__( 'Disable resource listings sliders', 'chipmunk' ),
						'default' => false,
					],
					[
						'name'    => 'infinite_sliders',
						'type'    => 'checkbox',
						'label'   => esc_html__( 'Make resource sliders infinite', 'chipmunk' ),
						'default' => false,
					],
					[
						'name'    => 'disable_homepage_collections',
						'type'    => 'checkbox',
						'label'   => esc_html__( 'Disable collections', 'chipmunk' ),
						'default' => false,
					],
					[
						'name'    => 'disable_homepage_posts',
						'type'    => 'checkbox',
						'label'   => esc_html__( 'Disable latest posts', 'chipmunk' ),
						'default' => false,
					],
				],
			],

			[
				'title'  => esc_html__( 'Resources', 'chipmunk' ),
				'slug'   => 'resources_section',
				'fields' => [
					[
						'name'    => 'resources_per_page',
						'type'    => 'number',
						'label'   => esc_html__( 'Number of resources per page', 'chipmunk' ),
						'default' => 18,
					],
					[
						'name'    => 'results_per_page',
						'type'    => 'number',
						'label'   => esc_html__( 'Number of search results per page', 'chipmunk' ),
						'default' => 9,
					],
					[
						'name'    => 'display_resource_as',
						'type'    => 'select',
						'label'   => esc_html__( 'Display resources as', 'chipmunk' ),
						'default' => 'card',
						'choices' => [
							'tile'       => esc_html__( 'Tile', 'chipmunk' ),
							'card'       => esc_html__( 'Card', 'chipmunk' ),
							'card_blank' => esc_html__( 'Card (blank)', 'chipmunk' ),
							'card_wide'  => esc_html__( 'List', 'chipmunk' ),
						],
					],
					[
						'name'    => 'resource_image_aspect_ratio',
						'type'    => 'select',
						'label'   => esc_html__( 'Resouce image aspect ratio', 'chipmunk' ),
						'default' => '4-3',
						'choices' => [
							''     => esc_html( 'None - Don\'t crop iamge' ),
							'9-21' => esc_html( '9 / 21' ),
							'9-16' => esc_html( '9 / 16' ),
							'2-3'  => esc_html( '2 / 3' ),
							'3-4'  => esc_html( '3 / 4' ),
							'1-1'  => esc_html( '1 / 1' ),
							'4-3'  => esc_html( '4 / 3' ),
							'3-2'  => esc_html( '3 / 2' ),
							'16-9' => esc_html( '16 / 9' ),
							'21-9' => esc_html( '21 / 9' ),
						],
					],
					[
						'name'    => 'display_resource_content_separated',
						'type'    => 'checkbox',
						'label'   => esc_html__( 'Display resource content in a separate section', 'chipmunk' ),
						'default' => false,
					],
					[
						'name'    => 'disable_featured',
						'type'    => 'checkbox',
						'label'   => esc_html__( 'Disable featured panel', 'chipmunk' ),
						'default' => false,
					],
					[
						'name'    => 'disable_resource_desc',
						'type'    => 'checkbox',
						'label'   => esc_html__( 'Disable description', 'chipmunk' ),
						'default' => false,
					],
					[
						'name'    => 'disable_resource_date',
						'type'    => 'checkbox',
						'label'   => esc_html__( 'Disable date', 'chipmunk' ),
						'default' => false,
					],
					[
						'name'    => 'disable_resource_tags',
						'type'    => 'checkbox',
						'label'   => esc_html__( 'Disable tags', 'chipmunk' ),
						'default' => false,
					],
					[
						'name'    => 'disable_resource_thumbs',
						'type'    => 'checkbox',
						'label'   => esc_html__( 'Disable thumbnails on resource list', 'chipmunk' ),
						'default' => false,
					],
					[
						'name'    => 'disable_resource_single_thumbs',
						'type'    => 'checkbox',
						'label'   => esc_html__( 'Disable thumbnails on resource page', 'chipmunk' ),
						'default' => false,
					],
					[
						'name'    => 'disable_resource_website_button',
						'type'    => 'checkbox',
						'label'   => esc_html__( 'Disable website button', 'chipmunk' ),
						'default' => false,
					],
					[
						'name'    => 'disable_resource_views',
						'type'    => 'checkbox',
						'label'   => esc_html__( 'Disable view count', 'chipmunk' ),
						'default' => false,
					],
					[
						'name'    => 'disable_resource_upvotes',
						'type'    => 'checkbox',
						'label'   => esc_html__( 'Disable upvoting', 'chipmunk' ),
						'default' => false,
					],
					[
						'name'    => 'disable_resource_sharing',
						'type'    => 'checkbox',
						'label'   => esc_html__( 'Disable sharing', 'chipmunk' ),
						'default' => false,
					],
					[
						'name'     => 'disable_resource_author',
						'type'     => 'checkbox',
						'label'    => esc_html__( 'Disable author link', 'chipmunk' ),
						'default'  => true,
						'restrict' => 'members',
					],
					[
						'name'     => 'disable_resource_bookmarks',
						'type'     => 'checkbox',
						'label'    => esc_html__( 'Disable bookmarking', 'chipmunk' ),
						'default'  => false,
						'restrict' => 'members',
					],
					[
						'name'     => 'disable_resource_ratings',
						'type'     => 'checkbox',
						'label'    => esc_html__( 'Disable ratings', 'chipmunk' ),
						'default'  => false,
						'restrict' => 'ratings',
					],
					[
						'name'    => 'disable_resource_ordering',
						'type'    => 'checkbox',
						'label'   => esc_html__( 'Disable ordering', 'chipmunk' ),
						'default' => false,
					],
					[
						'name'    => 'disable_resource_filters',
						'type'    => 'checkbox',
						'label'   => esc_html__( 'Disable filters', 'chipmunk' ),
						'default' => false,
					],
					[
						'name'     => 'restrict_guest_upvotes',
						'type'     => 'checkbox',
						'label'    => esc_html__( 'Restrict guest upvoting', 'chipmunk' ),
						'default'  => false,
						'restrict' => 'members',
					],
					[
						'name'    => 'default_resource_orderby',
						'type'    => 'select',
						'label'   => esc_html__( 'Default order by', 'chipmunk' ),
						'default' => 'date',
						'choices' => [
							'date'    => esc_html__( 'Date', 'chipmunk' ),
							'title'   => esc_html__( 'Title', 'chipmunk' ),
							'views'   => esc_html__( 'Views', 'chipmunk' ),
							'upvotes' => esc_html__( 'Upvotes', 'chipmunk' ),
							// 'ratings' => Helpers::isAddonEnabled( 'ratings' ) ? esc_html__( 'Ratings', 'chipmunk' ) : null,
						],
					],
					[
						'name'    => 'default_resource_order',
						'type'    => 'select',
						'label'   => esc_html__( 'Default order', 'chipmunk' ),
						'default' => 'desc',
						'choices' => [
							'asc'  => esc_html__( 'Ascending', 'chipmunk' ),
							'desc' => esc_html__( 'Descending', 'chipmunk' ),
						],
					],
				],
			],

			[
				'title'  => esc_html__( 'Collections', 'chipmunk' ),
				'slug'   => 'collections_section',
				'fields' => [
					[
						'name'    => 'display_collection_as',
						'type'    => 'select',
						'label'   => esc_html__( 'Display collections as', 'chipmunk' ),
						'default' => 'tile',
						'choices' => [
							'tile'       => esc_html__( 'Tile', 'chipmunk' ),
							'card'       => esc_html__( 'Card', 'chipmunk' ),
							'card_blank' => esc_html__( 'Card (blank)', 'chipmunk' ),
						],
					],
					[
						'name'    => 'disable_collection_thumbs',
						'type'    => 'checkbox',
						'label'   => esc_html__( 'Disable collection thumbs', 'chipmunk' ),
						'default' => false,
					],
					[
						'name'    => 'disable_collection_stats',
						'type'    => 'checkbox',
						'label'   => esc_html__( 'Disable collection stats', 'chipmunk' ),
						'default' => false,
					],
				],
			],

			[
				'title'  => esc_html__( 'Submissions', 'chipmunk' ),
				'slug'   => 'submissions_section',
				'fields' => [
					[
						'name'    => 'disable_submissions',
						'type'    => 'checkbox',
						'label'   => esc_html__( 'Disable user submissions', 'chipmunk' ),
						'default' => false,
					],
					[
						'name'    => 'inform_about_submissions',
						'type'    => 'checkbox',
						'label'   => esc_html__( 'Inform me about new submissions', 'chipmunk' ),
						'default' => false,
					],
					[
						'name'    => 'disable_submitter_info',
						'type'    => 'checkbox',
						'label'   => esc_html__( 'Disable asking for submitter info', 'chipmunk' ),
						'default' => false,
					],
					[
						'name'    => 'disable_submission_image_fetch',
						'type'    => 'checkbox',
						'label'   => esc_html__( 'Disable image auto-fetching', 'chipmunk' ),
						'default' => false,
					],
					[
						'name'        => 'submit_page',
						'type'        => 'dropdown-pages',
						'label'       => esc_html__( 'Submit form page', 'chipmunk' ),
						'description' => esc_html__( 'Select one if you want to display the submit form on a standard page instead of in a popup. Make sure to put [chipmunk-submit] shortode on the page.', 'chipmunk' ),
					],
					[
						'name'    => 'submit_tagline',
						'type'    => 'textarea',
						'label'   => esc_html__( 'Submission tagline', 'chipmunk' ),
						'default' => esc_html__( 'Internet is huge! Help us find great content', 'chipmunk' ),
					],
					[
						'name'  => 'submission_consent',
						'type'  => 'textarea',
						'label' => esc_html__( 'Submission consent', 'chipmunk' ),
					],
					[
						'name'    => 'submission_thanks',
						'type'    => 'textarea',
						'label'   => esc_html__( 'Submission "Thank You" message', 'chipmunk' ),
						'default' => esc_html__( 'Thank you for your contribution. The submission was sent to the website owners for review.', 'chipmunk' ),
					],
					[
						'name'    => 'submission_failure',
						'type'    => 'textarea',
						'label'   => esc_html__( 'Submission "Failure" message', 'chipmunk' ),
						'default' => esc_html__( 'Your submission could not be processed.', 'chipmunk' ),
					],
				],
			],

			[
				'title'  => esc_html__( 'Blog', 'chipmunk' ),
				'slug'   => 'blog_section',
				'fields' => [
					[
						'name'    => 'blog_layout',
						'type'    => 'select',
						'label'   => esc_html__( 'Blog list layout', 'chipmunk' ),
						'default' => 'tiles',
						'choices' => [
							'tiles'    => esc_html__( 'Tiles', 'chipmunk' ),
							'excerpts' => esc_html__( 'Excerpts', 'chipmunk' ),
							'mixed'    => esc_html__( 'Mixed', 'chipmunk' ),
						],
					],
					[
						'name'    => 'blog_post_layout',
						'type'    => 'select',
						'label'   => esc_html__( 'Blog post layout', 'chipmunk' ),
						'default' => 'hero',
						'choices' => [
							'hero'    => esc_html__( 'Hero', 'chipmunk' ),
							'no_hero' => esc_html__( 'No Hero', 'chipmunk' ),
						],
					],
					[
						'name'    => 'posts_per_page',
						'type'    => 'number',
						'label'   => esc_html__( 'Number of blog posts per page', 'chipmunk' ),
						'default' => 12,
					],
					[
						'name'    => 'post_image_aspect_ratio',
						'type'    => 'select',
						'label'   => esc_html__( 'Blog post image aspect ratio', 'chipmunk' ),
						'default' => '4-3',
						'choices' => [
							''     => esc_html( 'None - Don\'t crop iamge' ),
							'1-1'  => esc_html( '1 / 1' ),
							'4-3'  => esc_html( '4 / 3' ),
							'3-2'  => esc_html( '3 / 2' ),
							'16-9' => esc_html( '16 / 9' ),
							'21-9' => esc_html( '21 / 9' ),
						],
					],
					[
						'name'    => 'disable_post_author',
						'type'    => 'checkbox',
						'label'   => esc_html__( 'Disable author', 'chipmunk' ),
						'default' => false,
					],
					[
						'name'    => 'disable_post_sharing',
						'type'    => 'checkbox',
						'label'   => esc_html__( 'Disable sharing', 'chipmunk' ),
						'default' => false,
					],
					[
						'name'    => 'disable_post_tags',
						'type'    => 'checkbox',
						'label'   => esc_html__( 'Disable tags', 'chipmunk' ),
						'default' => false,
					],
					[
						'name'    => 'disable_post_date',
						'type'    => 'checkbox',
						'label'   => esc_html__( 'Disable date', 'chipmunk' ),
						'default' => false,
					],
					[
						'name'    => 'disable_post_views',
						'type'    => 'checkbox',
						'label'   => esc_html__( 'Disable view count', 'chipmunk' ),
						'default' => false,
					],
					[
						'name'    => 'disable_post_ratings',
						'type'    => 'checkbox',
						'label'   => esc_html__( 'Disable ratings', 'chipmunk' ),
						'default' => false,
					],
				],
			],

			[
				'title'  => esc_html__( 'Pagination', 'chipmunk' ),
				'slug'   => 'pagination_section',
				'fields' => [
					[
						'name'    => 'pagination_type',
						'type'    => 'radio',
						'label'   => esc_html__( 'Pagination type', 'chipmunk' ),
						'default' => 'standard',
						'choices' => [
							'standard'  => esc_html__( 'Standard', 'chipmunk' ),
							'load_more' => esc_html__( 'Load More', 'chipmunk' ),
							'infinite'  => esc_html__( 'Infinite scroll', 'chipmunk' ),
						],
					],
				],
			],

			[
				'title'  => esc_html__( 'Social Profiles', 'chipmunk' ),
				'slug'   => 'socials_section',
				'fields' => $this->getSocialsFields(),
			],

			[
				'title'  => esc_html__( 'ReCaptcha', 'chipmunk' ),
				'slug'   => 'recaptcha',
				'fields' => [
					[
						'name'    => 'recaptcha_enabled',
						'type'    => 'checkbox',
						'label'   => esc_html__( 'Enable reCAPTCHA', 'chipmunk' ),
						'default' => false,
					],
					[
						'name'        => 'recaptcha_site_key',
						'type'        => 'text',
						'label'       => esc_html__( 'reCAPTCHA Site key', 'chipmunk' ),
						'description' => sprintf(
							wp_kses(
								__( 'Register at <a href="%1$s" target="_blank">reCAPTCHA</a>.', 'chipmunk' ),
								[
									'a' => [
										'href'   => [],
										'target' => [],
									],
								]
							),
							esc_url( 'https://www.google.com/recaptcha/admin' )
						),
					],
					[
						'name'        => 'recaptcha_secret_key',
						'type'        => 'text',
						'label'       => esc_html__( 'reCAPTCHA Secret key', 'chipmunk' ),
						'description' => sprintf(
							wp_kses(
								__( 'Register at <a href="%1$s" target="_blank">reCAPTCHA</a>.', 'chipmunk' ),
								[
									'a' => [
										'href'   => [],
										'target' => [],
									],
								]
							),
							esc_url( 'https://www.google.com/recaptcha/admin' )
						),
					],
				],
			],

			[
				'title'  => esc_html__( 'Ads', 'chipmunk' ),
				'slug'   => 'ads_section',
				'fields' => [
					[
						'name'    => 'disable_ads',
						'type'    => 'checkbox',
						'label'   => esc_html__( 'Disable ads', 'chipmunk' ),
						'default' => false,
					],
					[
						'name'    => 'ads_only_home',
						'type'    => 'checkbox',
						'label'   => esc_html__( 'Show ads only on homepage', 'chipmunk' ),
						'default' => false,
					],
					[
						'name'  => 'ad_link',
						'type'  => 'text',
						'label' => esc_html__( 'Ad link URL', 'chipmunk' ),
					],
					[
						'name'        => 'ad_image_lg',
						'type'        => 'image',
						'label'       => esc_html__( 'Ad image (Desktop)', 'chipmunk' ),
						'description' => sprintf( esc_html__( 'We recommend using a rectangle horizontal image that is at least %1$d pixels wide.', 'chipmunk' ), 940 ),
					],
					[
						'name'        => 'ad_image_md',
						'type'        => 'image',
						'label'       => esc_html__( 'Ad image (Tablet)', 'chipmunk' ),
						'description' => sprintf( esc_html__( 'We recommend using a rectangle horizontal image that is at least %1$d pixels wide.', 'chipmunk' ), 768 ),
					],
					[
						'name'        => 'ad_image_sm',
						'type'        => 'image',
						'label'       => esc_html__( 'Ad image (Mobile)', 'chipmunk' ),
						'description' => sprintf( esc_html__( 'We recommend using a rectangle vertical image that is at least %1$d pixels wide.', 'chipmunk' ), 375 ),
					],
					[
						'name'        => 'ad_code',
						'type'        => 'textarea',
						'label'       => esc_html__( 'Ad HTML code', 'chipmunk' ),
						'description' => esc_html__( 'Insert your Google AdSense (or other) generated HTML code to display ads in designated areas.', 'chipmunk' ),
					],
				],
			],

			[
				'title'  => esc_html__( 'Newsletter', 'chipmunk' ),
				'slug'   => 'newsletter_section',
				'fields' => [
					[
						'name'    => 'disable_newsletter',
						'type'    => 'checkbox',
						'label'   => esc_html__( 'Disable newsletter', 'chipmunk' ),
						'default' => false,
					],
					[
						'name'        => 'newsletter_action',
						'type'        => 'text',
						'label'       => esc_html__( 'Form action URL', 'chipmunk' ),
						'description' => sprintf(
							wp_kses(
								__( 'We support Mailchimp, ConvertKit, Revue and AWeber. <a href="%1$s" target="_blank">Learn how to find your URL</a>.', 'chipmunk' ),
								[
									'a' => [
										'href'   => [],
										'target' => [],
									],
								]
							),
							esc_url( 'https://chipmunktheme.com/newsletter-form-url' )
						),
					],
					[
						'name'    => 'newsletter_tagline',
						'type'    => 'text',
						'label'   => esc_html__( 'Newsletter tagline', 'chipmunk' ),
						'default' => esc_html__( 'Never miss a thing! Sign up for our newsletter to stay updated.', 'chipmunk' ),
					],
					[
						'name'  => 'newsletter_consent',
						'type'  => 'textarea',
						'label' => esc_html__( 'Newsletter consent', 'chipmunk' ),
					],
				],
			],

			[
				'title'  => esc_html__( 'Theme Options', 'chipmunk' ),
				'slug'   => 'theme_section',
				'fields' => [
					[
						'name'    => 'disable_credits',
						'type'    => 'checkbox',
						'label'   => esc_html__( 'Disable theme credits', 'chipmunk' ),
						'default' => false,
					],
					[
						'name'    => 'disable_search',
						'type'    => 'checkbox',
						'label'   => esc_html__( 'Disable search', 'chipmunk' ),
						'default' => false,
					],
					[
						'name'    => 'disable_ref',
						'type'    => 'checkbox',
						'label'   => esc_html__( 'Disable "ref" attribute', 'chipmunk' ),
						'default' => false,
					],
					[
						'name'    => 'disable_nofollow',
						'type'    => 'checkbox',
						'label'   => esc_html__( 'Disable "nofollow" attribute', 'chipmunk' ),
						'default' => false,
					],
					[
						'name'    => 'disable_cookies',
						'type'    => 'checkbox',
						'label'   => esc_html__( 'Disable cookies', 'chipmunk' ),
						'default' => false,
					],
					[
						'name'        => 'about_copy',
						'type'        => 'textarea',
						'label'       => esc_html__( 'About copy (footer)', 'chipmunk' ),
						'default'     => get_bloginfo( 'description' ),
						'description' => esc_html__( 'Enter your site\'s description displayed in the footer section. You can use basic HTML tags here (<p>, <a>, <strong>, <i>).', 'chipmunk' ),
					],
					[
						'name'    => 'copyright_text',
						'type'    => 'textarea',
						'label'   => esc_html__( 'Copyright text', 'chipmunk' ),
						'default' => sprintf( esc_html__( '&copy; %1$s %2$s', 'chipmunk' ), get_bloginfo( 'name' ), date_i18n( 'Y' ) ),
					],
				],
			],
		];
	}

	/**
	 * Hooks methods of this object into the WordPress ecosystem
	 *
	 * @return void
	 */
	public function initialize(): void {
		if ( is_customize_preview() ) {
			$this->addAction( 'customize_register', [ $this, 'addSections' ] );
		}
	}

	/**
	 * Add custom sections to Customize panel
	 *
	 * @param WP_Customize_Manager $customize
	 */
	public function addSections( WP_Customize_Manager $customize ) {
		foreach ( $this->sections as $index => $section ) {
			$customize->add_section(
				$section['slug'],
				[
					'capability' => $this->capability,
					'title'      => $section['title'],
					'priority'   => $index + 100,
				]
			);

			if ( ! empty( $section['fields'] ) ) {
				foreach ( $section['fields'] as $field ) {
					$this->registerField( $customize, $section, $field );
				}
			}
		}
	}

	/**
	 * Add setting and control for each field
	 *
	 * @param WP_Customize_Manager $customize
	 * @param array                $section
	 * @param array                $field
	 */
	private function registerField( WP_Customize_Manager $customize, array $section, array $field ) {
		// Plugin restricted fields
		// if ( ! empty( $field['restrict'] ) && ! Helpers::isAddonEnabled( $field['restrict'] ) ) {
		// 	return null;
		// }

		$settingArgs = [
			'capability' => $this->capability,
			'type'       => 'option',
			'default'    => $field['default'] ?? null,
		];

		$controlArgs = [
			'label'       => $field['label'],
			'section'     => $section['slug'],
			'settings'    => config()->getSettingsName() . "[$field[name]]",
			'description' => $field['description'] ?? null,
			'choices'     => array_filter( $field['choices'] ?? [] ),
			'input_attrs' => array_filter( $field['input_attrs'] ?? [] ),
		];

		$customize->add_setting( config()->getSettingsName() . "[$field[name]]", $settingArgs );

		switch ( $field['type'] ) {
			case 'color':
				$control = new WP_Customize_Color_Control( $customize, $field['name'], $controlArgs );
				$customize->add_control( $control );
				break;

			case 'image':
				$control = new WP_Customize_Image_Control( $customize, $field['name'], $controlArgs );
				$customize->add_control( $control );
				break;

			default:
				$controlArgs['type'] = $field['type'];
				$customize->add_control( $field['name'], $controlArgs );
		}
	}

	/**
	 * Gets social fields list
	 *
	 * @return array
	 */
	private function getSocialsFields(): array {
		$socialFields = [];

		foreach ( config()->getSocials() as $social ) {
			$slug = strtolower( $social );

			$socialFields[] = [
				'name'  => $slug,
				'type'  => 'url',
				'label' => $social,
			];
		}

		return $socialFields;
	}
}
