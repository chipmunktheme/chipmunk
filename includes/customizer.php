<?php

if (!class_exists('ChipmunkCustomizer'))
{
  class ChipmunkCustomizer
  {
    public function __construct()
    {
      // Define settings access
      $this->capability = 'edit_theme_options';

      // Define settings sections
      $this->sections = array(
        array(
          'name' => 'Visuals',
          'slug' => 'visuals_section'
        ),
        array(
          'name' => 'Resources',
          'slug' => 'resources_section'
        ),
        array(
          'name' => 'Submissions',
          'slug' => 'submissions_section'
        ),
        array(
          'name' => 'Social Profiles',
          'slug' => 'socials_section'
        ),
        array(
          'name' => 'Ads',
          'slug' => 'ads_section'
        ),
        array(
          'name' => 'Newsletter',
          'slug' => 'newsletter_section'
        ),
        array(
          'name' => 'Theme Options',
          'slug' => 'theme_section'
        )
      );

      // Define social services
      $this->socials = array(
        'Twitter',
        'Facebook',
        'Google',
        'Instagram',
        'Pinterest',
        'Flickr',
        'Vimeo',
        'YouTube',
        'Reddit',
        'ProductHunt'
      );

      add_action('customize_register', array(&$this, 'customize_register'));
    }

    /**
     * Init customization options
     */
    public function customize_register($wp_customize)
    {
      // Store global customize object
      $this->customize = $wp_customize;

      // Manipulate setting sections
      $this->remove_sections();
      $this->add_sections();

      // Add settings fields and controls
      $this->register_identity();
      $this->register_visuals();
      $this->register_resources();
      $this->register_submissions();
      $this->register_socials();
      $this->register_ads();
      $this->register_newsletter();
      $this->register_theme();
    }

    /**
     * Remove unnecessary sections from Customize panel
     */
    private function remove_sections()
    {
      $this->customize->remove_section('themes');
      $this->customize->remove_section('static_front_page');
    }

    /**
     * Add custom sections to Customize panel
     */
    private function add_sections()
    {
      foreach($this->sections as $index => $section) {
        $this->customize->add_section($section['slug'], array(
          'capability'  => $this->capability,
          'title'       => $section['name'],
          'priority'   => $index + 100
        ));
      }
    }

    /**
     * Register site identity options
     */
    private function register_identity()
    {
      // Site Logo
      $this->customize->add_setting('chipmunk_settings[logo]', array(
        'capability'  => $this->capability,
        'type'        => 'option',
      ));

      $this->customize->add_control(new WP_Customize_Image_Control($this->customize, 'logo', array(
        'label'       => 'Site Logo',
        'section'     => 'title_tagline',
        'settings'    => 'chipmunk_settings[logo]',
        'description' => 'Upload a logo for your theme. You can leave it empty to use your site name as a plain text logo.'
      )));
    }

    /**
     * Register site visual options
     */
    private function register_visuals()
    {
      // Primary Color
      $this->customize->add_setting('chipmunk_settings[primary_color]', array(
        'capability'  => $this->capability,
        'type'        => 'option',
        'default'     => '#F38181'
      ));

      $this->customize->add_control(new WP_Customize_Color_Control($this->customize, 'primary_color', array(
        'label'    => 'Primary Color',
        'section'  => 'visuals_section',
        'settings' => 'chipmunk_settings[primary_color]'
      )));

      // Primary Font
      $this->customize->add_setting('chipmunk_settings[primary_font]', array(
        'capability'  => $this->capability,
        'type'        => 'option',
        'default'     => 'Poppins'
      ));

      $this->customize->add_control('primary_font', array(
        'label'    => 'Primary Font',
        'section'  => 'visuals_section',
        'settings' => 'chipmunk_settings[primary_font]',
        'type'     => 'select',
        'choices'  => array(
          'Poppins'   => 'Poppins',
          'Lato'      => 'Lato',
          'Open+Sans' => 'Open Sans',
        ),
      ));

      // Custom CSS
      $this->customize->add_setting('chipmunk_settings[custom_css]', array(
        'capability'  => $this->capability,
        'type'        => 'option',
      ));

      $this->customize->add_control('custom_css', array(
        'label'       => 'Custom CSS',
        'section'     => 'visuals_section',
        'settings'    => 'chipmunk_settings[custom_css]',
        'description' => 'Quickly add some CSS to your theme by adding it to this block.',
        'type'        => 'textarea',
      ));
    }

    /**
     * Register site resources options
     */
    private function register_resources()
    {
      // Latest resources count
      $this->customize->add_setting('chipmunk_settings[latest_resources_count]', array(
        'capability'  => $this->capability,
        'type'        => 'option',
      ));

      $this->customize->add_control('latest_resources_count', array(
        'label'       => 'Latest resources count',
        'section'     => 'resources_section',
        'settings'    => 'chipmunk_settings[latest_resources_count]',
        'description' => 'Enter the max resources number to show on Latest/Popular panel.',
        'type'        => 'number',
      ));

      // Disable collection thumbs
      $this->customize->add_setting('chipmunk_settings[disable_collection_thumbs]', array(
        'capability'  => $this->capability,
        'type'        => 'option',
      ));

      $this->customize->add_control('disable_collection_thumbs', array(
        'label'       => 'Disable collection thumbs',
        'section'     => 'resources_section',
        'settings'    => 'chipmunk_settings[disable_collection_thumbs]',
        'type'        => 'checkbox',
      ));
    }

    /**
     * Register site submissions options
     */
    private function register_submissions()
    {
      // Disable user submissions
      $this->customize->add_setting('chipmunk_settings[disable_submissions]', array(
        'capability'  => $this->capability,
        'type'        => 'option',
      ));

      $this->customize->add_control('disable_submissions', array(
        'label'       => 'Disable user submissions',
        'section'     => 'submissions_section',
        'settings'    => 'chipmunk_settings[disable_submissions]',
        'type'        => 'checkbox',
      ));

      // Submission "Thank You" message
      $this->customize->add_setting('chipmunk_settings[submission_thanks]', array(
        'capability'  => $this->capability,
        'type'        => 'option',
      ));

      $this->customize->add_control('submission_thanks', array(
        'type'     => 'textarea',
        'label'    => 'Submission "Thank You" message',
        'section'  => 'submissions_section',
        'settings' => 'chipmunk_settings[submission_thanks]'
      ));
    }

    /**
     * Register social profile settings
     */
    private function register_socials()
    {
      foreach($this->socials as $social) {
        $this->register_social($social);
      }
    }

    /**
     * Register advertisement settings
     */
    private function register_ads()
    {
      // Disable ads
      $this->customize->add_setting('chipmunk_settings[disable_ads]', array(
        'capability'  => $this->capability,
        'type'        => 'option',
      ));

      $this->customize->add_control('disable_ads', array(
        'label'       => 'Disable ads',
        'section'     => 'ads_section',
        'settings'    => 'chipmunk_settings[disable_ads]',
        'type'        => 'checkbox',
      ));

      // Show ads only on homepage
      $this->customize->add_setting('chipmunk_settings[ads_only_home]', array(
        'capability'  => $this->capability,
        'type'        => 'option',
      ));

      $this->customize->add_control('ads_only_home', array(
        'label'       => 'Show ads only on homepage',
        'section'     => 'ads_section',
        'settings'    => 'chipmunk_settings[ads_only_home]',
        'type'        => 'checkbox',
      ));

      // Ad image
      $this->customize->add_setting('chipmunk_settings[ad_image]', array(
        'capability'  => $this->capability,
        'type'        => 'option',
      ));

      $this->customize->add_control(new WP_Customize_Image_Control($this->customize, 'ad_image', array(
        'label'       => 'Ad image',
        'section'     => 'ads_section',
        'settings'    => 'chipmunk_settings[ad_image]',
        'description' => ''
      )));

      // Ad link URL
      $this->customize->add_setting('chipmunk_settings[ad_link]', array(
        'capability'  => $this->capability,
        'type'        => 'option',
      ));

      $this->customize->add_control('ad_link', array(
        'type'        => 'text',
        'label'       => 'Ad link URL',
        'section'     => 'ads_section',
        'settings'    => 'chipmunk_settings[ad_link]',
        'description' => ''
      ));
    }

    /**
     * Register site newsletter options
     */
    private function register_newsletter()
    {
      // Disable newsletter
      $this->customize->add_setting('chipmunk_settings[disable_newsletter]', array(
        'capability'  => $this->capability,
        'type'        => 'option',
      ));

      $this->customize->add_control('disable_newsletter', array(
        'label'       => 'Disable newsletter',
        'section'     => 'newsletter_section',
        'settings'    => 'chipmunk_settings[disable_newsletter]',
        'type'        => 'checkbox',
      ));

      // Newsletter action
      $this->customize->add_setting('chipmunk_settings[newsletter_action]', array(
        'capability'  => $this->capability,
        'type'        => 'option',
      ));

      $this->customize->add_control('newsletter_action', array(
        'type'        => 'text',
        'label'       => 'Mailchimp form action URL',
        'description' => '<a href="http://chipmunktheme.com/help/mailchimp-url" target="_blank">Where do I find my MailChimp form action URL?</a>',
        'section'     => 'newsletter_section',
        'settings'    => 'chipmunk_settings[newsletter_action]'
      ));

      // Newsletter tagline
      $this->customize->add_setting('chipmunk_settings[newsletter_tagline]', array(
        'capability'  => $this->capability,
        'type'        => 'option',
      ));

      $this->customize->add_control('newsletter_tagline', array(
        'type'     => 'text',
        'label'    => 'Newsletter tagline',
        'section'  => 'newsletter_section',
        'settings' => 'chipmunk_settings[newsletter_tagline]'
      ));
    }

    /**
     * Register site theme options
     */
    private function register_theme()
    {
      // Disable theme credits
      $this->customize->add_setting('chipmunk_settings[disable_credits]', array(
        'capability'  => $this->capability,
        'type'        => 'option',
      ));

      $this->customize->add_control('disable_credits', array(
        'label'       => 'Disable theme credits',
        'section'     => 'theme_section',
        'settings'    => 'chipmunk_settings[disable_credits]',
        'type'        => 'checkbox',
      ));

      // Disable search
      $this->customize->add_setting('chipmunk_settings[disable_search]', array(
        'capability'  => $this->capability,
        'type'        => 'option',
      ));

      $this->customize->add_control('disable_search', array(
        'label'       => 'Disable search',
        'section'     => 'theme_section',
        'settings'    => 'chipmunk_settings[disable_search]',
        'type'        => 'checkbox',
      ));

      // Disable featured panel
      $this->customize->add_setting('chipmunk_settings[disable_featured]', array(
        'capability'  => $this->capability,
        'type'        => 'option',
      ));

      $this->customize->add_control('disable_featured', array(
        'label'       => 'Disable featured panel',
        'section'     => 'theme_section',
        'settings'    => 'chipmunk_settings[disable_featured]',
        'type'        => 'checkbox',
      ));

      // Disable view count
      $this->customize->add_setting('chipmunk_settings[disable_views]', array(
        'capability'  => $this->capability,
        'type'        => 'option',
      ));

      $this->customize->add_control('disable_views', array(
        'label'       => 'Disable view count',
        'section'     => 'theme_section',
        'settings'    => 'chipmunk_settings[disable_views]',
        'type'        => 'checkbox',
      ));

      // About copy (footer)
      $this->customize->add_setting('chipmunk_settings[about_copy]', array(
        'capability'  => $this->capability,
        'type'        => 'option',
      ));

      $this->customize->add_control('about_copy', array(
        'label'       => 'About copy (footer)',
        'section'     => 'theme_section',
        'settings'    => 'chipmunk_settings[about_copy]',
        'description' => esc_html('Enter your site\'s description displayed in the footer section. You can use basic HTML tags here (<p>, <a>, <strong>, <i>).'),
        'type'        => 'textarea',
      ));

      // Tracking code
      $this->customize->add_setting('chipmunk_settings[tracking_code]', array(
        'capability'  => $this->capability,
        'type'        => 'option',
      ));

      $this->customize->add_control('tracking_code', array(
        'label'       => 'Tracking code',
        'section'     => 'theme_section',
        'settings'    => 'chipmunk_settings[tracking_code]',
        'description' => 'Paste your Google Analytics (or other) tracking code here. It will be inserted before the closing body tag of your theme.',
        'type'        => 'textarea',
      ));
    }

    /**
     * Add setting and control for each social profile
     */
    private function register_social($social)
    {
      $social_slug = strtolower($social);

      $this->customize->add_setting('chipmunk_settings['.$social_slug.']', array(
        'capability'  => $this->capability,
        'type'        => 'option'
      ));

      $this->customize->add_control($social_slug, array(
        'settings' => 'chipmunk_settings['.$social_slug.']',
        'section'  => 'socials_section',
        'label'    => $social,
        'type'     => 'url',
      ));
    }
  }
}
