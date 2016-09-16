<?php

if (!class_exists('ChipmunkCustomizer'))
{
  class ChipmunkCustomizer
  {
    // Define settings access
    public static $capability = 'edit_theme_options';
    public static $settings_name = 'chipmunk_settings';

    // Define settings sections
    public static $sections = array();

    // Define social services
    public static $socials = array();

    public function __construct()
    {
      self::$sections = array(
        array(
          'title'         => __('Site Identity', 'chipmunk'),
          'slug'          => 'title_tagline',
          'fields'        => array(
            array(
              'name'        => 'logo',
              'type'        => 'image',
              'label'       => __('Site Logo', 'chipmunk'),
              'description' => __('Upload a logo for your theme. You can leave it empty to use your site name as a plain text logo.', 'chipmunk'),
            ),
          ),
        ),

        array(
          'title'         => __('Visuals', 'chipmunk'),
          'slug'          => 'visuals_section',
          'fields'        => array(
            array(
              'name'        => 'primary_color',
              'type'        => 'color',
              'label'       => __('Primary Color', 'chipmunk'),
              'default'     => '#F38181',
            ),
            array(
              'name'        => 'primary_font',
              'type'        => 'select',
              'label'       => __('Primary Font', 'chipmunk'),
              'default'     => 'Poppins',
              'choices'     => array(
                ''            => __('System font', 'chipmunk'),
                'Poppins'     => 'Poppins',
                'Lato'        => 'Lato',
                'Open+Sans'   => 'Open Sans',
                'PT+Sans'     => 'PT Sans',
                'Roboto'      => 'Roboto',
                'Montserrat'  => 'Montserrat',
              ),
            ),
            array(
              'name'        => 'custom_css',
              'type'        => 'textarea',
              'label'       => __('Custom CSS', 'chipmunk'),
              'default'     => '',
              'description' => __('Quickly add some CSS to your theme by adding it to this block.', 'chipmunk'),
            ),
          ),
        ),

        array(
          'title'         => __('Resources', 'chipmunk'),
          'slug'          => 'resources_section',
          'fields'        => array(
            array(
              'name'        => 'resources_count',
              'type'        => 'number',
              'label'       => __('Latest resources count', 'chipmunk'),
              'default'     => 9,
              'description' => __('Enter the max resources number to show on resource sliders.', 'chipmunk'),
            ),
            array(
              'name'        => 'posts_per_page',
              'type'        => 'number',
              'label'       => __('Number of resources per page', 'chipmunk'),
              'default'     => 18,
            ),
            array(
              'name'        => 'results_per_page',
              'type'        => 'number',
              'label'       => __('Number of search results per page', 'chipmunk'),
              'default'     => 9,
            ),
            array(
              'name'        => 'disable_resource_desc',
              'type'        => 'checkbox',
              'label'       => __('Disable resource description', 'chipmunk'),
              'default'     => false,
            ),
            array(
              'name'        => 'disable_featured',
              'type'        => 'checkbox',
              'label'       => __('Disable featured panel', 'chipmunk'),
              'default'     => false,
            ),
            array(
              'name'        => 'disable_views',
              'type'        => 'checkbox',
              'label'       => __('Disable view count', 'chipmunk'),
              'default'     => false,
            ),
            array(
              'name'        => 'disable_collection_thumbs',
              'type'        => 'checkbox',
              'label'       => __('Disable collection thumbs', 'chipmunk'),
              'default'     => false,
            ),
          ),
        ),

        array(
          'title'         => __('Submissions', 'chipmunk'),
          'slug'          => 'submissions_section',
          'fields'        => array(
            array(
              'name'        => 'disable_submissions',
              'type'        => 'checkbox',
              'label'       => __('Disable user submissions', 'chipmunk'),
              'default'     => false,
            ),
            array(
              'name'        => 'inform_about_submissions',
              'type'        => 'checkbox',
              'label'       => __('Inform me about new submissions', 'chipmunk'),
              'default'     => true,
            ),
            // TODO: Will be released in future versions
            // array(
            //   'name'        => 'disable_submitter_info',
            //   'type'        => 'checkbox',
            //   'label'       => __('Disable asking for submitter info', 'chipmunk'),
            //   'default'     => false,
            // ),
            array(
              'name'        => 'submit_tagline',
              'type'        => 'textarea',
              'label'       => __('Submission tagline', 'chipmunk'),
              'default'     => __('Internet is huge! Help us find great content', 'chipmunk'),
            ),
            array(
              'name'        => 'submission_thanks',
              'type'        => 'textarea',
              'label'       => __('Submission "Thank You" message', 'chipmunk'),
              'default'     => __('Thank you for your contribution. The submission was sent to the website owners for review.', 'chipmunk'),
            ),
            array(
              'name'        => 'submission_failure',
              'type'        => 'textarea',
              'label'       => __('Submission "Failure" message', 'chipmunk'),
              'default'     => __('Your submission could not be processed.', 'chipmunk'),
            ),
            array(
              'name'        => 'recaptcha_site_key',
              'type'        => 'text',
              'label'       => __('reCAPTCHA Site key', 'chipmunk'),
              'description' => sprintf(__('Register at <a href="%1$s" target="_blank">reCAPTCHA</a>.', 'chipmunk'), esc_url('https://www.google.com/recaptcha/admin')),
            ),
          ),
        ),

        array(
          'title'         => __('Social Profiles', 'chipmunk'),
          'slug'          => 'socials_section',
          'callback'      => 'register_socials',
        ),

        array(
          'title'         => __('Ads', 'chipmunk'),
          'slug'          => 'ads_section',
          'fields'        => array(
            array(
              'name'        => 'disable_ads',
              'type'        => 'checkbox',
              'label'       => __('Disable ads', 'chipmunk'),
              'default'     => false,
            ),
            array(
              'name'        => 'ads_only_home',
              'type'        => 'checkbox',
              'label'       => __('Show ads only on homepage', 'chipmunk'),
              'default'     => false,
            ),
            array(
              'name'        => 'ad_image',
              'type'        => 'image',
              'label'       => __('Ad image', 'chipmunk'),
            ),
            array(
              'name'        => 'ad_link',
              'type'        => 'text',
              'label'       => __('Ad link URL', 'chipmunk'),
            ),
            array(
              'name'        => 'ad_code',
              'type'        => 'textarea',
              'label'       => __('Ad HTML code', 'chipmunk'),
              'description' => __('Insert your Google AdSense (or other) generated HTML code to display ads in designated areas.', 'chipmunk'),
            ),
          ),
        ),

        array(
          'title'         => __('Newsletter', 'chipmunk'),
          'slug'          => 'newsletter_section',
          'fields'        => array(
            array(
              'name'        => 'disable_newsletter',
              'type'        => 'checkbox',
              'label'       => __('Disable newsletter', 'chipmunk'),
              'default'     => false,
            ),
            array(
              'name'        => 'newsletter_action',
              'type'        => 'text',
              'label'       => __('Newsletter form action URL', 'chipmunk'),
              'description' => sprintf(__('Where do I find my newsletter form action URL? <a href="%1$s" target="_blank">Mailchimp</a> | <a href="%2$s" target="_blank">Campaign Monitor</a>', 'chipmunk'), esc_url('http://chipmunktheme.com/help/mailchimp-url'), esc_url('http://chipmunktheme.com/help/campaign-monitor-url')),
            ),
            array(
              'name'        => 'newsletter_tagline',
              'type'        => 'text',
              'label'       => __('Newsletter tagline', 'chipmunk'),
              'default'     => __('Never miss a thing! Sign up for our newsletter to stay updated.', 'chipmunk'),
            ),
          ),
        ),

        array(
          'title'         => __('Theme Options', 'chipmunk'),
          'slug'          => 'theme_section',
          'fields'        => array(
            array(
              'name'        => 'disable_credits',
              'type'        => 'checkbox',
              'label'       => __('Disable theme credits', 'chipmunk'),
              'default'     => false,
            ),
            array(
              'name'        => 'disable_search',
              'type'        => 'checkbox',
              'label'       => __('Disable search', 'chipmunk'),
              'default'     => false,
            ),
            array(
              'name'        => 'about_copy',
              'type'        => 'textarea',
              'label'       => __('About copy (footer)', 'chipmunk'),
              'default'     => get_bloginfo('description'),
              'description' => esc_html(__('Enter your site\'s description displayed in the footer section. You can use basic HTML tags here (<p>, <a>, <strong>, <i>).', 'chipmunk')),
            ),
            array(
              'name'        => 'tracking_code',
              'type'        => 'textarea',
              'label'       => __('Tracking code', 'chipmunk'),
              'description' => __('Paste your Google Analytics (or other) tracking code here. It will be inserted before the closing body tag of your theme.', 'chipmunk'),
            ),
          ),
        )
      );

      self::$socials = array(
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
     * Get Chipmunk theme option
     */
    public static function theme_option($name, $default = false)
    {
      $options = (get_option(self::$settings_name)) ? get_option(self::$settings_name) : null;

      // return the option if it exists
      if (isset($options[$name]) && !empty($options[$name])) {
        return apply_filters(self::$settings_name.'_$name', $options[$name]);
      }

      // return default if it exists
      if ($default) {
        return apply_filters(self::$settings_name.'_$name', $default);
      }

      // return field default if it exists
      return apply_filters(self::$settings_name.'_$name', self::find_default_by_name($name));
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
      $this->populate_sections();
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
      foreach(self::$sections as $index => $section)
        $this->customize->add_section($section['slug'], array(
          'capability'  => self::$capability,
          'title'       => $section['title'],
          'priority'    => $index + 100
        ));
    }

    /**
     * Populate custom sections with customization options
     */
    private function populate_sections()
    {
      foreach(self::$sections as $index => $section)
      {
        if (!empty($section['callback']))
          call_user_func(array(&$this, $section['callback']));

        if (!empty($section['fields']))
          foreach($section['fields'] as $field)
            $this->register_field($section, $field);
      }
    }

    /**
     * Register social profile settings
     */
    private function register_socials()
    {
      foreach(self::$socials as $social)
        $this->register_social($social);
    }

    /**
     * Add setting and control for each social profile
     */
    private function register_social($social)
    {
      $social_slug = strtolower($social);

      $this->customize->add_setting(self::$settings_name.'['.$social_slug.']', array(
        'capability'  => self::$capability,
        'type'        => 'option'
      ));

      $this->customize->add_control($social_slug, array(
        'settings' => self::$settings_name.'['.$social_slug.']',
        'section'  => 'socials_section',
        'label'    => $social,
        'type'     => 'url',
      ));
    }

    /**
     * Add setting and control for each field
     */
    private function register_field($section, $field)
    {
      $setting_args = array(
        'capability'  => self::$capability,
        'type'        => 'option',
        'default'     => !empty($field['default']) ? $field['default'] : null,
      );
      $control_args = array(
        'label'       => $field['label'],
        'section'     => $section['slug'],
        'settings'    => self::$settings_name.'['.$field['name'].']',
        'description' => !empty($field['description']) ? $field['description'] : null,
        'choices'     => !empty($field['choices']) ? $field['choices'] : null,
      );

      $this->customize->add_setting(self::$settings_name.'['.$field['name'].']', $setting_args);

      switch ($field['type'])
      {
        case 'color':
          $this->customize->add_control(new WP_Customize_Color_Control($this->customize, $field['name'], $control_args));
          break;

        case 'image':
          $this->customize->add_control(new WP_Customize_Image_Control($this->customize, $field['name'], $control_args));
          break;

        default:
          $control_args['type'] = $field['type'];
          $this->customize->add_control($field['name'], $control_args);
      }
    }

    /**
     * Search for field by given name
     */
    private static function find_default_by_name($name)
    {
      foreach (self::$sections as $section)
        if (!empty($section['fields']))
          foreach($section['fields'] as $field)
            if ($field['name'] === $name and !empty($field['default']))
              return $field['default'];

      return false;
    }
  }
}
