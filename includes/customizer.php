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
          'name' => 'Colors',
          'slug' => 'colors_section'
        ),
        array(
          'name' => 'Social profiles',
          'slug' => 'socials_section'
        ),
        array(
          'name' => 'Ads',
          'slug' => 'ads_section'
        ),
        array(
          'name' => 'Theme options',
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
      $this->register_socials();
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
          'capability' => $this->capability,
          'title'      => $section['name'],
          'priority'   => $index + 100
        ));
      }
    }

    /**
     * Register site identity options
     */
    private function register_identity()
    {
      // Logo
      $this->customize->add_setting('chipmunk_settings[logo]', array(
        'capability' => $this->capability,
        'type'       => 'option',
      ));

      $this->customize->add_control(new WP_Customize_Image_Control($this->customize, 'logo', array(
        'label'    => 'Site Logo',
        'section'  => 'title_tagline',
        'settings' => 'chipmunk_settings[logo]'
      )));
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
     * Add setting and control for each social profile
     */
    private function register_social($social)
    {
      $social_slug = strtolower($social);

      $this->customize->add_setting('chipmunk_settings['.$social_slug.']', array(
        'capability' => $this->capability,
        'type'       => 'option'
      ));

      $this->customize->add_control($social_slug, array(
        'settings' => 'chipmunk_settings['.$social_slug.']',
        'section'  => 'socials_section',
        'label'    => $social,
        'type'     => 'text',
      ));
    }
  }
}
