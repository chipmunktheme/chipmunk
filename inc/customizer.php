<?php
/**
 * WP Customizer settings.
 *
 * @package WordPress
 * @subpackage Chipmunk
 */

if ( ! class_exists( 'ChipmunkCustomizer' ) ) :
/**
 * Create a Customizer class
 */
class ChipmunkCustomizer {
	// Define settings access
	private $capability = 'edit_theme_options';
	private $settings_name = 'chipmunk_settings';

	/**
	 * An array of Customzer sections
	 * @var array
	 */
	private $sections;

	/**
	 * An array of social profiles
	 * @var array
	 */
	private $socials;

	public function __construct() {
		$this->sections = array(
			array(
				'title'         => esc_html__( 'Site Identity', 'chipmunk' ),
				'slug'          => 'title_tagline',
				'fields'        => array(
					array(
						'name'        => 'logo',
						'type'        => 'image',
						'label'       => esc_html__( 'Site Logo', 'chipmunk' ),
						'description' => esc_html__( 'Upload a logo for your theme. You can leave it empty to use your site name as a plain text logo.', 'chipmunk' ),
					),
				),
			),

			array(
				'title'         => esc_html__( 'Visuals', 'chipmunk' ),
				'slug'          => 'visuals_section',
				'fields'        => array(
					array(
						'name'        => 'primary_color',
						'type'        => 'color',
						'label'       => esc_html__( 'Primary Color', 'chipmunk' ),
						'default'     => '#F38181',
					),
					array(
						'name'        => 'background_color',
						'type'        => 'color',
						'label'       => esc_html__( 'Background Color', 'chipmunk' ),
						'default'     => '#EDEDED',
					),
					array(
						'name'        => 'section_color',
						'type'        => 'color',
						'label'       => esc_html__( 'Section background Color', 'chipmunk' ),
						'default'     => '#FAFAFA',
					),
					array(
						'name'        => 'disable_section_borders',
						'type'        => 'checkbox',
						'label'       => esc_html__( 'Disable section borders', 'chipmunk' ),
						'default'     => false,
					),
					array(
						'name'        => 'primary_font',
						'type'        => 'select',
						'label'       => esc_html__( 'Primary Font', 'chipmunk' ),
						'default'     => 'Poppins',
						'choices'     => array(
							'System'          => esc_html__( 'System font', 'chipmunk' ),
							'Poppins'         => 'Poppins',
							'Roboto'          => 'Roboto',
							'Open Sans'       => 'Open Sans',
							'Lato'            => 'Lato',
							'Source Sans Pro' => 'Source Sans Pro',
							'Montserrat'      => 'Montserrat',
							'Raleway'         => 'Raleway',
							'PT Sans'         => 'PT Sans',
							'Lora'            => 'Lora',
							'Karla'           => 'Karla',
							'Ubuntu'          => 'Ubuntu',
							'Droid Sans'      => 'Droid Sans',
							'Nunito Sans'     => 'Nunito Sans',
						),
					),
					array(
						'name'        => 'heading_font',
						'type'        => 'select',
						'label'       => esc_html__( 'Heading Font', 'chipmunk' ),
						'default'     => 'Poppins',
						'choices'     => array(
							'System'          => esc_html__( 'System font', 'chipmunk' ),
							'Poppins'         => 'Poppins',
							'Roboto'          => 'Roboto',
							'Open Sans'       => 'Open Sans',
							'Lato'            => 'Lato',
							'Source Sans Pro' => 'Source Sans Pro',
							'Montserrat'      => 'Montserrat',
							'Raleway'         => 'Raleway',
							'PT Sans'         => 'PT Sans',
							'Lora'            => 'Lora',
							'Karla'           => 'Karla',
							'Ubuntu'          => 'Ubuntu',
							'Droid Sans'      => 'Droid Sans',
							'Nunito Sans'     => 'Nunito Sans',
						),
					),
					array(
						'name'        => 'custom_css',
						'type'        => 'textarea',
						'label'       => esc_html__( 'Custom CSS', 'chipmunk' ),
						'default'     => '',
						'description' => esc_html__( 'Quickly add some CSS to your theme by adding it to this block.', 'chipmunk' ),
					),
				),
			),

			array(
				'title'         => esc_html__( 'Open Graph', 'chipmunk' ),
				'slug'          => 'og_section',
				'fields'        => array(
					array(
						'name'        => 'disable_og',
						'type'        => 'checkbox',
						'label'       => esc_html__( 'Disable Open Graph', 'chipmunk' ),
					),
					array(
						'name'        => 'og_image',
						'type'        => 'image',
						'label'       => esc_html__( 'Open Graph Image', 'chipmunk' ),
						'description' => esc_html__( '1200x630 pixels', 'chipmunk' ),
					),
					array(
						'name'        => 'disable_og_branding',
						'type'        => 'checkbox',
						'label'       => esc_html__( 'Remove \'on [website name]\' text', 'chipmunk' ),
					),
				),
			),

			array(
				'title'         => esc_html__( 'Homepage', 'chipmunk' ),
				'slug'          => 'homepage_section',
				'fields'        => array(
					array(
						'name'        => 'intro_text',
						'type'        => 'text',
						'label'       => esc_html__( 'Intro text', 'chipmunk' ),
						'description' => esc_html__( 'Enter your site\'s tagline to show on homepage under the header. Leave empty to hide.', 'chipmunk' ),
					),
					array(
						'name'        => 'resources_count',
						'type'        => 'number',
						'label'       => esc_html__( 'Latest resources count', 'chipmunk' ),
						'default'     => 9,
						'description' => esc_html__( 'Enter the max resources number to show on resource sliders.', 'chipmunk' ),
					),
					array(
						'name'        => 'disable_homepage_listings',
						'type'        => 'checkbox',
						'label'       => esc_html__( 'Disable resource listings', 'chipmunk' ),
						'default'     => false,
					),
					array(
						'name'        => 'disable_homepage_listings_sliders',
						'type'        => 'checkbox',
						'label'       => esc_html__( 'Disable resource listings sliders', 'chipmunk' ),
						'default'     => false,
					),
					array(
						'name'        => 'disable_homepage_collections',
						'type'        => 'checkbox',
						'label'       => esc_html__( 'Disable collections', 'chipmunk' ),
						'default'     => false,
					),
					array(
						'name'        => 'disable_homepage_posts',
						'type'        => 'checkbox',
						'label'       => esc_html__( 'Disable latest posts', 'chipmunk' ),
						'default'     => false,
					),
				),
			),

			array(
				'title'         => esc_html__( 'Resources', 'chipmunk' ),
				'slug'          => 'resources_section',
				'fields'        => array(
					array(
						'name'        => 'posts_per_page',
						'type'        => 'number',
						'label'       => esc_html__( 'Number of resources per page', 'chipmunk' ),
						'default'     => 18,
					),
					array(
						'name'        => 'results_per_page',
						'type'        => 'number',
						'label'       => esc_html__( 'Number of search results per page', 'chipmunk' ),
						'default'     => 9,
					),
					array(
						'name'        => 'display_resource_as',
						'type'        => 'select',
						'label'       => esc_html__( 'Display resources as', 'chipmunk' ),
						'default'     => 'tile',
						'choices'     => array(
							'tile'        => esc_html__( 'Tile', 'chipmunk' ),
							'card'        => esc_html__( 'Card', 'chipmunk' ),
							'card_blank'  => esc_html__( 'Card (blank)', 'chipmunk' ),
						),
					),
					array(
						'name'        => 'display_resource_content_separated',
						'type'        => 'checkbox',
						'label'       => esc_html__( 'Display resource content in a separate section', 'chipmunk' ),
						'default'     => false,
					),
					array(
						'name'        => 'disable_resource_desc',
						'type'        => 'checkbox',
						'label'       => esc_html__( 'Disable resource description', 'chipmunk' ),
						'default'     => false,
					),
					array(
						'name'        => 'disable_resource_date',
						'type'        => 'checkbox',
						'label'       => esc_html__( 'Disable resource date', 'chipmunk' ),
						'default'     => false,
					),
					array(
						'name'        => 'disable_resource_tags',
						'type'        => 'checkbox',
						'label'       => esc_html__( 'Disable resource tags', 'chipmunk' ),
						'default'     => false,
					),
					array(
						'name'        => 'disable_featured',
						'type'        => 'checkbox',
						'label'       => esc_html__( 'Disable featured panel', 'chipmunk' ),
						'default'     => false,
					),
					array(
						'name'        => 'disable_resource_thumbs',
						'type'        => 'checkbox',
						'label'       => esc_html__( 'Disable resource thumbs', 'chipmunk' ),
						'default'     => false,
					),
					array(
						'name'        => 'disable_collection_thumbs',
						'type'        => 'checkbox',
						'label'       => esc_html__( 'Disable collection thumbs', 'chipmunk' ),
						'default'     => false,
					),
					array(
						'name'        => 'disable_website_button',
						'type'        => 'checkbox',
						'label'       => esc_html__( 'Disable website button', 'chipmunk' ),
						'default'     => false,
					),
					array(
						'name'        => 'disable_views',
						'type'        => 'checkbox',
						'label'       => esc_html__( 'Disable view count', 'chipmunk' ),
						'default'     => false,
					),
					array(
						'name'        => 'disable_upvotes',
						'type'        => 'checkbox',
						'label'       => esc_html__( 'Disable upvoting', 'chipmunk' ),
						'default'     => false,
					),
					array(
						'name'        => 'disable_sorting',
						'type'        => 'checkbox',
						'label'       => esc_html__( 'Disable sorting', 'chipmunk' ),
						'default'     => false,
					),
					array(
						'name'        => 'disable_filters',
						'type'        => 'checkbox',
						'label'       => esc_html__( 'Disable filters', 'chipmunk' ),
						'default'     => false,
					),
					array(
						'name'        => 'default_sort_by',
						'type'        => 'select',
						'label'       => esc_html__( 'Sort by', 'chipmunk' ),
						'default'     => 'date',
						'choices'     => array(
							'date'        => esc_html__( 'Date', 'chipmunk' ),
							'name'        => esc_html__( 'Name', 'chipmunk' ),
							'views'       => esc_html__( 'Views', 'chipmunk' ),
							'upvotes'     => esc_html__( 'Upvotes', 'chipmunk' ),
						),
					),
					array(
						'name'        => 'default_sort_order',
						'type'        => 'select',
						'label'       => esc_html__( 'Sort order', 'chipmunk' ),
						'default'     => 'desc',
						'choices'     => array(
							'asc'         => esc_html__( 'Ascending', 'chipmunk' ),
							'desc'        => esc_html__( 'Descending', 'chipmunk' ),
						),
					),
				),
			),

			array(
				'title'         => esc_html__( 'Submissions', 'chipmunk' ),
				'slug'          => 'submissions_section',
				'fields'        => array(
					array(
						'name'        => 'disable_submissions',
						'type'        => 'checkbox',
						'label'       => esc_html__( 'Disable user submissions', 'chipmunk' ),
						'default'     => false,
					),
					array(
						'name'        => 'inform_about_submissions',
						'type'        => 'checkbox',
						'label'       => esc_html__( 'Inform me about new submissions', 'chipmunk' ),
						'default'     => false,
					),
					array(
						'name'        => 'disable_submitter_info',
						'type'        => 'checkbox',
						'label'       => esc_html__( 'Disable asking for submitter info', 'chipmunk' ),
						'default'     => false,
					),
					array(
						'name'        => 'submit_tagline',
						'type'        => 'textarea',
						'label'       => esc_html__( 'Submission tagline', 'chipmunk' ),
						'default'     => esc_html__( 'Internet is huge! Help us find great content', 'chipmunk' ),
					),
					array(
						'name'        => 'submission_thanks',
						'type'        => 'textarea',
						'label'       => esc_html__( 'Submission "Thank You" message', 'chipmunk' ),
						'default'     => esc_html__( 'Thank you for your contribution. The submission was sent to the website owners for review.', 'chipmunk' ),
					),
					array(
						'name'        => 'submission_failure',
						'type'        => 'textarea',
						'label'       => esc_html__( 'Submission "Failure" message', 'chipmunk' ),
						'default'     => esc_html__( 'Your submission could not be processed.', 'chipmunk' ),
					),
				),
			),

			array(
				'title'         => esc_html__( 'Blog', 'chipmunk' ),
				'slug'          => 'blog_section',
				'fields'        => array(
					array(
						'name'        => 'blog_layout',
						'type'        => 'select',
						'label'       => esc_html__( 'Blog list layout', 'chipmunk' ),
						'default'     => 'tiles',
						'choices'     => array(
							'tiles'     => esc_html__( 'Tiles', 'chipmunk' ),
							'excerpts'  => esc_html__( 'Excerpts', 'chipmunk' ),
							'mixed'     => esc_html__( 'Mixed', 'chipmunk' ),
						),
					),
					array(
						'name'        => 'blog_posts_per_page',
						'type'        => 'number',
						'label'       => esc_html__( 'Number of blog posts per page', 'chipmunk' ),
						'default'     => 12,
					),
				),
			),

			array(
				'title'         => esc_html__( 'Social Profiles', 'chipmunk' ),
				'slug'          => 'socials_section',
				'callback'      => 'register_socials',
			),

			array(
				'title'         => esc_html__( 'ReCaptcha', 'chipmunk' ),
				'slug'          => 'recaptcha',
				'fields'        => array(
					array(
						'name'        => 'recaptcha_site_key',
						'type'        => 'text',
						'label'       => esc_html__( 'reCAPTCHA Site key', 'chipmunk' ),
						'description' => sprintf( wp_kses( __( 'Register at <a href="%1$s" target="_blank">reCAPTCHA</a>.', 'chipmunk' ), array( 'a' => array( 'href' => array(), 'target' => array() ) ) ), esc_url( 'https://www.google.com/recaptcha/admin' ) ),
					),
					array(
						'name'        => 'recaptcha_secret_key',
						'type'        => 'text',
						'label'       => esc_html__( 'reCAPTCHA Secret key', 'chipmunk' ),
						'description' => sprintf( wp_kses( __( 'Register at <a href="%1$s" target="_blank">reCAPTCHA</a>.', 'chipmunk' ), array( 'a' => array( 'href' => array(), 'target' => array() ) ) ), esc_url( 'https://www.google.com/recaptcha/admin' ) ),
					),
				),
			),

			array(
				'title'         => esc_html__( 'Ads', 'chipmunk' ),
				'slug'          => 'ads_section',
				'fields'        => array(
					array(
						'name'        => 'disable_ads',
						'type'        => 'checkbox',
						'label'       => esc_html__( 'Disable ads', 'chipmunk' ),
						'default'     => false,
					),
					array(
						'name'        => 'ads_only_home',
						'type'        => 'checkbox',
						'label'       => esc_html__( 'Show ads only on homepage', 'chipmunk' ),
						'default'     => false,
					),
					array(
						'name'        => 'ad_link',
						'type'        => 'text',
						'label'       => esc_html__( 'Ad link URL', 'chipmunk' ),
					),
					array(
						'name'        => 'ad_image_lg',
						'type'        => 'image',
						'label'       => esc_html__( 'Ad image (Desktop)', 'chipmunk' ),
						'description' => sprintf( esc_html__( 'We recommend using a rectangle horizontal image that is at least %1$d pixels wide.', 'chipmunk' ), 940 ),
					),
					array(
						'name'        => 'ad_image_md',
						'type'        => 'image',
						'label'       => esc_html__( 'Ad image (Tablet)', 'chipmunk' ),
						'description' => sprintf( esc_html__( 'We recommend using a rectangle horizontal image that is at least %1$d pixels wide.', 'chipmunk' ), 768 ),
					),
					array(
						'name'        => 'ad_image_sm',
						'type'        => 'image',
						'label'       => esc_html__( 'Ad image (Mobile)', 'chipmunk' ),
						'description' => sprintf( esc_html__( 'We recommend using a rectangle vertical image that is at least %1$d pixels wide.', 'chipmunk' ), 375 ),
					),
					array(
						'name'        => 'ad_code',
						'type'        => 'textarea',
						'label'       => esc_html__( 'Ad HTML code', 'chipmunk' ),
						'description' => esc_html__( 'Insert your Google AdSense (or other) generated HTML code to display ads in designated areas.', 'chipmunk' ),
					),
				),
			),

			array(
				'title'         => esc_html__( 'Newsletter', 'chipmunk' ),
				'slug'          => 'newsletter_section',
				'fields'        => array(
					array(
						'name'        => 'disable_newsletter',
						'type'        => 'checkbox',
						'label'       => esc_html__( 'Disable newsletter', 'chipmunk' ),
						'default'     => false,
					),
					array(
						'name'        => 'newsletter_action',
						'type'        => 'text',
						'label'       => esc_html__( 'Mailchimp form action URL', 'chipmunk' ),
						'default'     => '#',
						'description' => sprintf( wp_kses( __( 'Where do I find my <a href="%1$s" target="_blank">Mailchimp form action URL?</a>', 'chipmunk' ), array( 'a' => array( 'href' => array(), 'target' => array() ) ) ), esc_url( 'https://chipmunktheme.com/help/mailchimp-url' ) ),
					),
					array(
						'name'        => 'newsletter_tagline',
						'type'        => 'text',
						'label'       => esc_html__( 'Newsletter tagline', 'chipmunk' ),
						'default'     => esc_html__( 'Never miss a thing! Sign up for our newsletter to stay updated.', 'chipmunk' ),
					),
				),
			),

			array(
				'title'         => esc_html__( 'Theme Options', 'chipmunk' ),
				'slug'          => 'theme_section',
				'fields'        => array(
					array(
						'name'        => 'disable_credits',
						'type'        => 'checkbox',
						'label'       => esc_html__( 'Disable theme credits', 'chipmunk' ),
						'default'     => false,
					),
					array(
						'name'        => 'disable_search',
						'type'        => 'checkbox',
						'label'       => esc_html__( 'Disable search', 'chipmunk' ),
						'default'     => false,
					),
					array(
						'name'        => 'disable_ref',
						'type'        => 'checkbox',
						'label'       => esc_html__( 'Disable "ref" attribute', 'chipmunk' ),
						'default'     => false,
					),
					array(
						'name'        => 'about_copy',
						'type'        => 'textarea',
						'label'       => esc_html__( 'About copy (footer)', 'chipmunk' ),
						'default'     => get_bloginfo( 'description' ),
						'description' => esc_html__( 'Enter your site\'s description displayed in the footer section. You can use basic HTML tags here (<p>, <a>, <strong>, <i>).', 'chipmunk' ),
					),
				),
			)
		);

		$this->socials = array(
			'Twitter',
			'Facebook',
			'Google',
			'Instagram',
			'LinkedIn',
			'Pinterest',
			'Flickr',
			'Vimeo',
			'YouTube',
			'Reddit',
			'ProductHunt'
		);

		add_action( 'customize_register', array( $this, 'customize_register' ) );
	}

	/**
	 * Get Chipmunk theme option
	 */
	public function theme_option( $name, $default = false ) {
		$options = ( get_option( $this->settings_name ) ) ? get_option( $this->settings_name ) : null;

		// return the option if it exists
		if ( isset( $options[$name] ) && ! empty( $options[$name] ) ) {
			return apply_filters( $this->settings_name . '_$name', $options[$name] );
		}

		// return default if it exists
		if ( $default ) {
			return apply_filters( $this->settings_name . '_$name', $default );
		}

		// return field default if it exists
		return apply_filters( $this->settings_name . '_$name', $this->find_default_by_name( $name ) );
	}

	/**
	 * Get section list
	 */
	public function get_sections() {
		return $this->sections;
	}

	/**
	 * Get social list
	 */
	public function get_socials() {
		return $this->socials;
	}

	/**
	 * Init customization options
	 */
	public function customize_register( $wp_customize ) {
		// Store global customize object
		$this->customize = $wp_customize;

		// Manipulate setting sections
		$this->remove_sections();
		$this->add_sections();
	}

	/**
	 * Remove unnecessary sections from Customize panel
	 */
	private function remove_sections() {
		$this->customize->remove_section( 'themes' );
		$this->customize->remove_section( 'static_front_page' );
	}

	/**
	 * Add custom sections to Customize panel
	 */
	private function add_sections() {
		foreach ( $this->sections as $index => $section ) {
			$this->customize->add_section( $section['slug'], array(
				'capability'  => $this->capability,
				'title'       => $section['title'],
				'priority'    => $index + 100
			) );

			if ( ! empty( $section['callback'] ) ) {
				call_user_func( array( $this, $section['callback'] ) );
			}

			if ( ! empty( $section['fields'] ) ) {
				foreach( $section['fields'] as $field ) {
					$this->register_field( $section, $field );
				}
			}
		}
	}

	/**
	 * Register social profile settings
	 */
	private function register_socials() {
		foreach( $this->socials as $social ) {
			$this->register_social( $social );
		}
	}

	/**
	 * Add setting and control for each social profile
	 */
	private function register_social( $social ) {
		$social_slug = strtolower( $social );

		$this->customize->add_setting( $this->settings_name . '[' . $social_slug . ']', array(
			'capability'  => $this->capability,
			'type'        => 'option'
		) );

		$this->customize->add_control( $social_slug, array(
			'settings' => $this->settings_name . '[' . $social_slug . ']',
			'section'  => 'socials_section',
			'label'    => $social,
			'type'     => 'url',
			'default'  => '#',
		) );
	}

	/**
	 * Add setting and control for each field
	 */
	private function register_field( $section, $field ) {
		$setting_args = array(
			'capability'  => $this->capability,
			'type'        => 'option',
			'default'     => ! empty( $field['default'] ) ? $field['default'] : null,
		);
		$control_args = array(
			'label'       => $field['label'],
			'section'     => $section['slug'],
			'settings'    => $this->settings_name . '[' . $field['name'] . ']',
			'description' => ! empty( $field['description'] ) ? $field['description'] : null,
			'choices'     => ! empty( $field['choices'] ) ? $field['choices'] : null,
		);

		$this->customize->add_setting( $this->settings_name . '[' . $field['name'] . ']', $setting_args );

		switch ( $field['type'] ) {
			case 'color':
				$this->customize->add_control( new WP_Customize_Color_Control( $this->customize, $field['name'], $control_args ) );
				break;

			case 'image':
				$this->customize->add_control( new WP_Customize_Image_Control( $this->customize, $field['name'], $control_args ) );
				break;

			default:
				$control_args['type'] = $field['type'];
				$this->customize->add_control( $field['name'], $control_args );
		}
	}

	/**
	 * Search for field by given name
	 */
	private function find_default_by_name( $name ) {
		foreach ( $this->sections as $section ) {
			if ( ! empty( $section['fields'] ) ) {
				foreach( $section['fields'] as $field ) {
					if ( $field['name'] === $name and ! empty( $field['default'] ) and ! is_bool( $field['default'] ) ) {
						return $field['default'];
					}
				}
			}
		}

		return false;
	}
}
endif;
