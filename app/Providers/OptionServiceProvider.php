<?php

namespace App\Providers;

use WP_Customize_Manager;
use Illuminate\Support\ServiceProvider;
use MadeByLess\Lessi\Factory\Customizer;
use MadeByLess\Lessi\Helper\FontTrait;
use MadeByLess\Lessi\Helper\HookTrait;

class OptionServiceProvider extends ServiceProvider
{
    use FontTrait;
    use HookTrait;

    /**
     * An array of Customzer sections.
     *
     * @var array
     */
    private array $sections;

    /**
     * Define settings access.
     *
     * @var string
     */
    private string $capability = 'edit_theme_options';

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->addAction('customize_register', function (WP_Customize_Manager $customize) {
            $customizer = new Customizer($customize, -100);

            // Colors
            // ----------------------------------------------------------------
            $customizer->addSection('colors', esc_html__('Colors', 'chipmunk'));

                // Color - primary
                $customizer->addColor('color_primary')
                    ->setLabel(esc_html__('Primary Color', 'chipmunk'))
                    ->setDefault('#5b5c89');

                // Color - heading
                $customizer->addColor('color_heading')
                    ->setLabel(esc_html__('Heading Color', 'chipmunk'))
                    ->setDefault('#5b5c89');

                // Color - body
                $customizer->addColor('color_body')
                    ->setLabel(esc_html__('Body Color', 'chipmunk'))
                    ->setDefault('#ededed');

                // Color - section
                $customizer->addColor('color_section')
                    ->setLabel(esc_html__('Section Color', 'chipmunk'))
                    ->setDefault('#fafafa');

            // Typography
            // ----------------------------------------------------------------
            $customizer->addSection('typography', esc_html__('Typography', 'chipmunk'));

                // Font - primary
                $customizer->addSelect('font_primary')
                    ->setLabel(esc_html__('Primary Font', 'chipmunk'))
                    ->setChoices(
                        ['' => esc_html__('System font', 'chipmunk')] +
                        $this->getGoogleFonts(config('theme.google_api_key')),
                    )
                    ->setDefault('');

                // Font - heading
                $customizer->addSelect('font_heading')
                    ->setLabel(esc_html__('Heading Font', 'chipmunk'))
                    ->setChoices(
                        ['' => esc_html__('System font', 'chipmunk')] +
                        $this->getGoogleFonts(config('theme.google_api_key')),
                    )
                    ->setDefault('');

                // Content size
                $customizer->addText('content_size')
                    ->setLabel(esc_html__('Content Size', 'chipmunk'))
                    ->setDescription(esc_html__('You can use any CSS unit here (eg. px, em, rem, vw)', 'chipmunk'))
                    ->setDefault('2rem');

            // Header
            // ----------------------------------------------------------------
            $customizer->addSection('header', esc_html__('Header', 'chipmunk'));

                // Sticky header
                $customizer->addCheckbox('is_sticky_header_enabled')
                    ->setLabel(sprintf(esc_html__('Enable %s?', 'chipmunk'), esc_html__('sticky header', 'chipmunk')))
                    ->setDefault(true);

                // Logo height
                $customizer->addRange('logo_height')
                    ->setLabel(esc_html__('Logo height', 'chipmunk'))
                    ->setDescription(esc_html__('Width will be calculated automatically.', 'chipmunk'))
                    ->setInputAttrs([
                        'min'  => 20,
                        'max'  => 100,
                        'step' => 1,
                    ])
                    ->setDefault(40);

            // Visuals
            // ----------------------------------------------------------------
            $customizer->addSection('visuals', esc_html__('Visuals', 'chipmunk'));

                // Content width
                $customizer->addRadio('content_width')
                    ->setLabel(esc_html__('Content Width', 'chipmunk'))
                    ->setDescription(esc_html__('You can can overwrite it in page settings.', 'chipmunk'))
                    ->setDefault('8')
                    ->setChoices([
                        '6'  => esc_html__('Narrow', 'chipmunk'),
                        '8'  => esc_html__('Normal', 'chipmunk'),
                        '10' => esc_html__('Wide', 'chipmunk'),
                        '12' => esc_html__('Full', 'chipmunk'),
                    ]);

                // Dropdown theme
                $customizer->addRadio('dropdown_theme')
                    ->setLabel(esc_html__('Dropdown Color Theme', 'chipmunk'))
                    ->setDefault('light')
                    ->setChoices([
                        'light' => esc_html__('Light', 'chipmunk'),
                        'dark'  => esc_html__('Dark', 'chipmunk'),
                    ]);

            // Theme
            // ----------------------------------------------------------------
            $customizer->addSection('theme', esc_html__('Theme options', 'chipmunk'));

                // Credits
                $customizer->addCheckbox('is_credits_enabled')
                    ->setLabel(sprintf(esc_html__('Enable %s?', 'chipmunk'), esc_html__('theme credits', 'chipmunk')))
                    ->setDefault(true);

                // Search
                $customizer->addCheckbox('is_search_enabled')
                    ->setLabel(sprintf(esc_html__('Enable %s?', 'chipmunk'), esc_html__('search', 'chipmunk')))
                    ->setDefault(true);

                // Ref
                $customizer->addCheckbox('is_ref_enabled')
                    ->setLabel(sprintf(esc_html__('Enable %s?', 'chipmunk'), esc_html__('"ref" attribute', 'chipmunk')))
                    ->setDefault(true);

                // Nofollow
                $customizer->addCheckbox('is_nofollow_enabled')
                    ->setLabel(sprintf(esc_html__('Enable %s?', 'chipmunk'), esc_html__('"nofollow" attribute', 'chipmunk')))
                    ->setDefault(true);

                // Cookies
                $customizer->addCheckbox('is_cookies_enabled')
                    ->setLabel(sprintf(esc_html__('Enable %s?', 'chipmunk'), esc_html__('cookies', 'chipmunk')))
                    ->setDefault(true);

                // About text
                $customizer->addTextarea('about')
                    ->setLabel(esc_html__('About text (footer)', 'chipmunk'))
                    ->setDescription(esc_html__('Enter your site\'s description displayed in the footer section. You can use basic HTML tags here (<p>, <a>, <strong>, <i>).', 'chipmunk'))
                    ->setDefault(get_bloginfo('description'));

                // Copyright text
                $customizer->addTextarea('copyright')
                    ->setLabel(esc_html__('Copyright text', 'chipmunk'))
                    ->setDefault(sprintf(esc_html__('&copy; %1$s %2$s', 'chipmunk'), get_bloginfo('name'), date_i18n('Y')));

            // Homepage
            // ----------------------------------------------------------------
            $customizer->addSection('homepage', esc_html__('Homepage', 'chipmunk'));

                // Intro text
                $customizer->addTextarea('intro_text')
                    ->setLabel(esc_html__('Intro text', 'chipmunk'))
                    ->setDefault(esc_html__('Enter your site\'s tagline to show on homepage under the header. Leave empty to hide.', 'chipmunk'));

                // Resource count
                $customizer->addNumber('')
                    ->setLabel(esc_html__('Latest resources count', 'chipmunk'))
                    ->setDescription(esc_html__('Enter the max resources number to show on resource sliders.', 'chipmunk'))
                    ->setDefault(9);

                // Resources enabled
                $customizer->addCheckbox('is_home_resources_enabled')
                    ->setLabel(sprintf(esc_html__('Enable %s?', 'chipmunk'), esc_html__('resource list', 'chipmunk')))
                    ->setDefault(true);

                // Resource sliders enabled
                $customizer->addCheckbox('is_home_resource_sliders_enabled')
                    ->setLabel(sprintf(esc_html__('Enable %s?', 'chipmunk'), esc_html__('resource sliders', 'chipmunk')))
                    ->setDefault(true);

                // Collections enabled
                $customizer->addCheckbox('is_home_collections_enabled')
                    ->setLabel(sprintf(esc_html__('Enable %s?', 'chipmunk'), esc_html__('collection list', 'chipmunk')))
                    ->setDefault(true);

                // Blog posts enabled
                $customizer->addCheckbox('is_home_posts_enabled')
                    ->setLabel(sprintf(esc_html__('Enable %s?', 'chipmunk'), esc_html__('post list', 'chipmunk')))
                    ->setDefault(true);

            // Resources
            // ----------------------------------------------------------------
            $customizer->addSection('resources', esc_html__('Resources', 'chipmunk'));

                // Separate content
                $customizer->addCheckbox('is_resource_separated_content_enabled')
                    ->setLabel(sprintf(esc_html__('Enable %s?', 'chipmunk'), esc_html__('content in a separate section', 'chipmunk')))
                    ->setDefault(true);

                // Featured
                $customizer->addCheckbox('is_resource_featured_enabled')
                    ->setLabel(sprintf(esc_html__('Enable %s?', 'chipmunk'), esc_html__('featured panel', 'chipmunk')))
                    ->setDefault(true);

                // Featured
                $customizer->addCheckbox('is_resource_featured_enabled')
                    ->setLabel(sprintf(esc_html__('Enable %s?', 'chipmunk'), esc_html__('featured panel', 'chipmunk')))
                    ->setDefault(true);

            // Open graph
            // ----------------------------------------------------------------
            $customizer->addSection('open_graph', esc_html__('Open Graph', 'chipmunk'));

                // Open Graph enabled
                $customizer->addCheckbox('is_open_graph_enabled')
                    ->setLabel(sprintf(esc_html__('Enable %s?', 'chipmunk'), esc_html__('Open Graph', 'chipmunk')))
                    ->setDefault(true);

                // Open Graph image
                $customizer->addImageUrl('open_graph_image')
                    ->setLabel(esc_html__('Open Graph Image', 'chipmunk'))
                    ->setDescription(esc_html__('1200x630 pixels', 'chipmunk'));

                // Open Graph branding
                $customizer->addCheckbox('is_open_graph_branding_enabled')
                    ->setLabel(sprintf(esc_html__('Enable %s?', 'chipmunk'), esc_html__('\'on [website name]\' suffix', 'chipmunk')))
                    ->setDefault(true);

            // Ads
            // ----------------------------------------------------------------
            $customizer->addSection('ads', esc_html__('Ads', 'chipmunk'));

                // Ads enabled
                $customizer->addCheckbox('is_ads_enabled')
                    ->setLabel(sprintf(esc_html__('Enable %s?', 'chipmunk'), esc_html__('ads', 'chipmunk')))
                    ->setDefault(true);

                // Ads enabled on homepage
                $customizer->addCheckbox('is_ads_home_only_enabled')
                    ->setLabel(sprintf(esc_html__('Enable %s?', 'chipmunk'), esc_html__('ads on homepage only', 'chipmunk')))
                    ->setDefault(false);

                // Ad link
                $customizer->addUrl('ad_link')
                    ->setLabel(esc_html__('Ad link URL', 'chipmunk'));

                // Ad image (Desktop)
                $customizer->addImageUrl('ad_image_lg')
                    ->setLabel(esc_html__('Ad image (Desktop)', 'chipmunk'))
                    ->setDescription(sprintf(esc_html__('We recommend using a rectangle horizontal image that is at least %1$d pixels wide.', 'chipmunk'), 940));

                // Ad image (Tablet)
                $customizer->addImageUrl('ad_image_md')
                    ->setLabel(esc_html__('Ad image (Tablet)', 'chipmunk'))
                    ->setDescription(sprintf(esc_html__('We recommend using a rectangle horizontal image that is at least %1$d pixels wide.', 'chipmunk'), 768));

                // Ad image (Mobile)
                $customizer->addImageUrl('ad_image_sm')
                    ->setLabel(esc_html__('Ad image (Mobile)', 'chipmunk'))
                    ->setDescription(sprintf(esc_html__('We recommend using a rectangle vertical image that is at least %1$d pixels wide.', 'chipmunk'), 375));

                // Ad code
                $customizer->addTextarea('ad_code')
                    ->setLabel(esc_html__('Ad HTML code', 'chipmunk'))
                    ->setDefault(esc_html__('Insert your Google AdSense (or other) generated HTML code to display ads in designated areas.', 'chipmunk'));
        });
    }

    /**
     * Add custom sections to Customize panel.
     *
     * @see https://developer.wordpress.org/reference/hooks/customize_register
     */
    public function addSections()
    {

        //     [
        //         'name'    => 'primary_font',
        //         'type'    => 'select',
        //         'label'   => esc_html__('Primary Font', 'chipmunk'),
        //         'default' => '',
        //         'choices' => array_merge([ '' => esc_html__('System font', 'chipmunk') ], $this->getGoogleFonts(config()->getGoogleApiKey())),
        //     ],
        //     [
        //         'name'    => 'heading_font',
        //         'type'    => 'select',
        //         'label'   => esc_html__('Heading Font', 'chipmunk'),
        //         'default' => '',
        //         'choices' => array_merge([ '' => esc_html__('System font', 'chipmunk') ], $this->getGoogleFonts(config()->getGoogleApiKey())),
        //     ],
        //     [
        //         'name'    => 'sticky_header',
        //         'type'    => 'checkbox',
        //         'label'   => esc_html__('Enable sticky header', 'chipmunk'),
        //         'default' => false,
        //     ],
        //     [
        //         'name'    => 'disable_section_borders',
        //         'type'    => 'checkbox',
        //         'label'   => esc_html__('Disable section borders', 'chipmunk'),
        //         'default' => false,
        //     ],
        // ],
        // });
    }
}
