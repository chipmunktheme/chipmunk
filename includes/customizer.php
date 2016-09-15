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
          'title' => __('Visuals', 'chipmunk'),
          'slug' => 'visuals_section'
        ),
        array(
          'title' => __('Resources', 'chipmunk'),
          'slug' => 'resources_section'
        ),
        array(
          'title' => __('Submissions', 'chipmunk'),
          'slug' => 'submissions_section'
        ),
        array(
          'title' => __('Social Profiles', 'chipmunk'),
          'slug' => 'socials_section'
        ),
        array(
          'title' => __('Ads', 'chipmunk'),
          'slug' => 'ads_section'
        ),
        array(
          'title' => __('Newsletter', 'chipmunk'),
          'slug' => 'newsletter_section'
        ),
        array(
          'title' => __('Theme Options', 'chipmunk'),
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
          'title'       => $section['title'],
          'priority'    => $index + 100
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
        'label'       => __('Site Logo', 'chipmunk'),
        'section'     => 'title_tagline',
        'settings'    => 'chipmunk_settings[logo]',
        'description' => __('Upload a logo for your theme. You can leave it empty to use your site name as a plain text logo.', 'chipmunk'),
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
        'label'    => __('Primary Color', 'chipmunk'),
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
        'label'    => __('Primary Font', 'chipmunk'),
        'section'  => 'visuals_section',
        'settings' => 'chipmunk_settings[primary_font]',
        'type'     => 'select',
        'choices'  => array(
          ''            => __('System font', 'chipmunk'),
          'Poppins'     => 'Poppins',
          'Lato'        => 'Lato',
          'Open+Sans'   => 'Open Sans',
          'PT+Sans'     => 'PT Sans',
          'Roboto'      => 'Roboto',
          'Montserrat'  => 'Montserrat',
        ),
      ));

      // Custom CSS
      $this->customize->add_setting('chipmunk_settings[custom_css]', array(
        'capability'  => $this->capability,
        'type'        => 'option',
      ));

      $this->customize->add_control('custom_css', array(
        'label'       => __('Custom CSS', 'chipmunk'),
        'section'     => 'visuals_section',
        'settings'    => 'chipmunk_settings[custom_css]',
        'description' => __('Quickly add some CSS to your theme by adding it to this block.', 'chipmunk'),
        'type'        => 'textarea',
      ));
    }

    /**
     * Register site resources options
     */
    private function register_resources()
    {
      // Latest resources count
      $this->customize->add_setting('chipmunk_settings[resources_count]', array(
        'capability'  => $this->capability,
        'type'        => 'option',
        'default'     => 9,
      ));

      $this->customize->add_control('resources_count', array(
        'label'       => __('Latest resources count', 'chipmunk'),
        'section'     => 'resources_section',
        'settings'    => 'chipmunk_settings[resources_count]',
        'description' => __('Enter the max resources number to show on resource sliders.', 'chipmunk'),
        'type'        => 'number',
      ));

      // Number of resources per page
      $this->customize->add_setting('chipmunk_settings[posts_per_page]', array(
        'capability'  => $this->capability,
        'type'        => 'option',
        'default'     => 18,
      ));

      $this->customize->add_control('posts_per_page', array(
        'label'       => __('Number of resources per page', 'chipmunk'),
        'section'     => 'resources_section',
        'settings'    => 'chipmunk_settings[posts_per_page]',
        'type'        => 'number',
      ));

      // Number of search results per page
      $this->customize->add_setting('chipmunk_settings[results_per_page]', array(
        'capability'  => $this->capability,
        'type'        => 'option',
        'default'     => 9,
      ));

      $this->customize->add_control('results_per_page', array(
        'label'       => __('Number of search results per page', 'chipmunk'),
        'section'     => 'resources_section',
        'settings'    => 'chipmunk_settings[results_per_page]',
        'type'        => 'number',
      ));

      // Disable resource description
      $this->customize->add_setting('chipmunk_settings[disable_resource_desc]', array(
        'capability'  => $this->capability,
        'type'        => 'option',
      ));

      $this->customize->add_control('disable_resource_desc', array(
        'label'       => __('Disable resource description', 'chipmunk'),
        'section'     => 'resources_section',
        'settings'    => 'chipmunk_settings[disable_resource_desc]',
        'type'        => 'checkbox',
      ));

      // Disable featured panel
      $this->customize->add_setting('chipmunk_settings[disable_featured]', array(
        'capability'  => $this->capability,
        'type'        => 'option',
      ));

      $this->customize->add_control('disable_featured', array(
        'label'       => __('Disable featured panel', 'chipmunk'),
        'section'     => 'resources_section',
        'settings'    => 'chipmunk_settings[disable_featured]',
        'type'        => 'checkbox',
      ));

      // Disable view count
      $this->customize->add_setting('chipmunk_settings[disable_views]', array(
        'capability'  => $this->capability,
        'type'        => 'option',
      ));

      $this->customize->add_control('disable_views', array(
        'label'       => __('Disable view count', 'chipmunk'),
        'section'     => 'resources_section',
        'settings'    => 'chipmunk_settings[disable_views]',
        'type'        => 'checkbox',
      ));

      // Disable collection thumbs
      $this->customize->add_setting('chipmunk_settings[disable_collection_thumbs]', array(
        'capability'  => $this->capability,
        'type'        => 'option',
      ));

      $this->customize->add_control('disable_collection_thumbs', array(
        'label'       => __('Disable collection thumbs', 'chipmunk'),
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
        'label'       => __('Disable user submissions', 'chipmunk'),
        'section'     => 'submissions_section',
        'settings'    => 'chipmunk_settings[disable_submissions]',
        'type'        => 'checkbox',
      ));

      // Inform me about new submissions
      $this->customize->add_setting('chipmunk_settings[inform_about_submissions]', array(
        'capability'  => $this->capability,
        'type'        => 'option',
        'default'     => true,
      ));

      $this->customize->add_control('inform_about_submissions', array(
        'label'       => __('Inform me about new submissions', 'chipmunk'),
        'section'     => 'submissions_section',
        'settings'    => 'chipmunk_settings[inform_about_submissions]',
        'type'        => 'checkbox',
      ));

      // TODO: Will be released in future versions
      // Disable asking for submitter info
      // $this->customize->add_setting('chipmunk_settings[disable_submitter_info]', array(
      //   'capability'  => $this->capability,
      //   'type'        => 'option',
      // ));
      //
      // $this->customize->add_control('disable_submitter_info', array(
      //   'label'       => __('Disable asking for submitter info', 'chipmunk'),
      //   'section'     => 'submissions_section',
      //   'settings'    => 'chipmunk_settings[disable_submitter_info]',
      //   'type'        => 'checkbox',
      // ));

      // Submission tagline
      $this->customize->add_setting('chipmunk_settings[submit_tagline]', array(
        'capability'  => $this->capability,
        'type'        => 'option',
        'default'     => __('Internet is huge! Help us find great content', 'chipmunk'),
      ));

      $this->customize->add_control('submit_tagline', array(
        'type'     => 'text',
        'label'    => __('Submission tagline', 'chipmunk'),
        'section'  => 'submissions_section',
        'settings' => 'chipmunk_settings[submit_tagline]'
      ));

      // Submission "Thank You" message
      $this->customize->add_setting('chipmunk_settings[submission_thanks]', array(
        'capability'  => $this->capability,
        'type'        => 'option',
        'default'     => __('Thank you for your contribution. The submission was sent to the website owners for review.', 'chipmunk'),
      ));

      $this->customize->add_control('submission_thanks', array(
        'type'     => 'textarea',
        'label'    => __('Submission "Thank You" message', 'chipmunk'),
        'section'  => 'submissions_section',
        'settings' => 'chipmunk_settings[submission_thanks]'
      ));

      // Submission "Failure" message
      $this->customize->add_setting('chipmunk_settings[submission_failure]', array(
        'capability'  => $this->capability,
        'type'        => 'option',
        'default'     => __('Your submission could not be processed.', 'chipmunk'),
      ));

      $this->customize->add_control('submission_failure', array(
        'type'     => 'textarea',
        'label'    => __('Submission "Failure" message', 'chipmunk'),
        'section'  => 'submissions_section',
        'settings' => 'chipmunk_settings[submission_failure]'
      ));

      // reCAPTCHA Site key
      $this->customize->add_setting('chipmunk_settings[recaptcha_site_key]', array(
        'capability'  => $this->capability,
        'type'        => 'option',
      ));

      $this->customize->add_control('recaptcha_site_key', array(
        'type'        => 'text',
        'label'       => __('reCAPTCHA Site key', 'chipmunk'),
        'section'     => 'submissions_section',
        'settings'    => 'chipmunk_settings[recaptcha_site_key]',
        'description' => sprintf(__('Register at <a href="%1$s" target="_blank">reCAPTCHA</a>.', 'chipmunk'), esc_url('https://www.google.com/recaptcha/admin')),
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
        'label'       => __('Disable ads', 'chipmunk'),
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
        'label'       => __('Show ads only on homepage', 'chipmunk'),
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
        'label'       => __('Ad image', 'chipmunk'),
        'section'     => 'ads_section',
        'settings'    => 'chipmunk_settings[ad_image]',
      )));

      // Ad link URL
      $this->customize->add_setting('chipmunk_settings[ad_link]', array(
        'capability'  => $this->capability,
        'type'        => 'option',
      ));

      $this->customize->add_control('ad_link', array(
        'type'        => 'text',
        'label'       => __('Ad link URL', 'chipmunk'),
        'section'     => 'ads_section',
        'settings'    => 'chipmunk_settings[ad_link]',
      ));

      // Ad HTML code
      $this->customize->add_setting('chipmunk_settings[ad_code]', array(
        'capability'  => $this->capability,
        'type'        => 'option',
      ));

      $this->customize->add_control('ad_code', array(
        'type'        => 'textarea',
        'label'       => __('Ad HTML code', 'chipmunk'),
        'section'     => 'ads_section',
        'settings'    => 'chipmunk_settings[ad_code]',
        'description' => __('Insert your Google AdSense (or other) generated HTML code to display ads in designated areas.', 'chipmunk'),
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
        'label'       => __('Disable newsletter', 'chipmunk'),
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
        'label'       => __('Newsletter form action URL', 'chipmunk'),
        'description' => sprintf(__('Where do I find my newsletter form action URL? <a href="%1$s" target="_blank">Mailchimp</a> | <a href="%2$s" target="_blank">Campaign Monitor</a>', 'chipmunk'), esc_url('http://chipmunktheme.com/help/mailchimp-url'), esc_url('http://chipmunktheme.com/help/campaign-monitor-url')),
        'section'     => 'newsletter_section',
        'settings'    => 'chipmunk_settings[newsletter_action]'
      ));

      // Newsletter tagline
      $this->customize->add_setting('chipmunk_settings[newsletter_tagline]', array(
        'capability'  => $this->capability,
        'type'        => 'option',
        'default'     => __('Never miss a thing! Sign up for our newsletter to stay updated.', 'chipmunk'),
      ));

      $this->customize->add_control('newsletter_tagline', array(
        'type'     => 'text',
        'label'    => __('Newsletter tagline', 'chipmunk'),
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
        'label'       => __('Disable theme credits', 'chipmunk'),
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
        'label'       => __('Disable search', 'chipmunk'),
        'section'     => 'theme_section',
        'settings'    => 'chipmunk_settings[disable_search]',
        'type'        => 'checkbox',
      ));

      // About copy (footer)
      $this->customize->add_setting('chipmunk_settings[about_copy]', array(
        'capability'  => $this->capability,
        'type'        => 'option',
        'default'     => get_bloginfo('description'),
      ));

      $this->customize->add_control('about_copy', array(
        'label'       => __('About copy (footer)', 'chipmunk'),
        'section'     => 'theme_section',
        'settings'    => 'chipmunk_settings[about_copy]',
        'description' => esc_html(__('Enter your site\'s description displayed in the footer section. You can use basic HTML tags here (<p>, <a>, <strong>, <i>).', 'chipmunk')),
        'type'        => 'textarea',
      ));

      // Tracking code
      $this->customize->add_setting('chipmunk_settings[tracking_code]', array(
        'capability'  => $this->capability,
        'type'        => 'option',
      ));

      $this->customize->add_control('tracking_code', array(
        'label'       => __('Tracking code', 'chipmunk'),
        'section'     => 'theme_section',
        'settings'    => 'chipmunk_settings[tracking_code]',
        'description' => __('Paste your Google Analytics (or other) tracking code here. It will be inserted before the closing body tag of your theme.', 'chipmunk'),
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
