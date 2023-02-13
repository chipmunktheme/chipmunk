<?php

namespace Chipmunk\Vendors;

use Almond as AlmondWizard;

/**
 * Configure MerlinWP plugin
 *
 * @package WordPress
 * @subpackage Chipmunk
 */
class Almond
{
    /**
     * Create a new Merlin Config object
     *
     * @return void
     */
    function __construct()
    {
        new AlmondWizard(
            // Config settings
            [
                'directory'            => 'vendor/chipmunk-theme/almond', // Location / directory where Merlin WP is placed in your theme.
                'child_action_btn_url' => 'https://developer.wordpress.org/themes/advanced-topics/child-themes', // URL for the 'child-action-link'.
                'dev_mode'             => false, // Enable development mode for testing.
            ],

            // Strings
            [
                'admin-menu'               => esc_html__('Theme Setup', 'chipmunk'),

                /* translators: 1: Title Tag 2: Theme Name 3: Closing Title Tag */
                'title%s%s%s%s'            => esc_html__('%1$s%2$s Theme wizard &lsaquo; Theme Setup: %3$s%4$s', 'chipmunk'),
                'return-to-dashboard'      => esc_html__('Return to the dashboard', 'chipmunk'),
                'ignore'                   => esc_html__('Disable this wizard', 'chipmunk'),

                'btn-skip'                 => esc_html__('Skip', 'chipmunk'),
                'btn-next'                 => esc_html__('Next', 'chipmunk'),
                'btn-start'                => esc_html__('Start', 'chipmunk'),
                'btn-no'                   => esc_html__('Cancel', 'chipmunk'),
                'btn-plugins-install'      => esc_html__('Install', 'chipmunk'),
                'btn-child-install'        => esc_html__('Install', 'chipmunk'),
                'btn-content-install'      => esc_html__('Install', 'chipmunk'),
                'btn-import'               => esc_html__('Import', 'chipmunk'),
                'btn-license-activate'     => esc_html__('Activate', 'chipmunk'),
                'btn-license-skip'         => esc_html__('Later', 'chipmunk'),

                /* translators: Theme Name */
                'license-header%s'         => esc_html__('Activate %s', 'chipmunk'),
                /* translators: Theme Name */
                'license-header-success%s' => esc_html__('%s is Activated', 'chipmunk'),
                /* translators: Theme Name */
                'license%s'                => esc_html__('Enter your license key to enable remote updates and theme support.', 'chipmunk'),
                'license-label'            => esc_html__('License key', 'chipmunk'),
                'license-success%s'        => esc_html__('The theme is already registered, so you can go to the next step!', 'chipmunk'),
                'license-json-success%s'   => esc_html__('Your theme is activated! Remote updates and theme support are enabled.', 'chipmunk'),
                'license-tooltip'          => esc_html__('Need help?', 'chipmunk'),

                /* translators: Theme Name */
                'welcome-header%s'         => esc_html__('Welcome to %s', 'chipmunk'),
                'welcome-header-success%s' => esc_html__('Hi. Welcome back', 'chipmunk'),
                'welcome%s'                => esc_html__('This wizard will set up your theme, import the demo content and activate the license. It should only take a few minutes.', 'chipmunk'),
                'welcome-success%s'        => esc_html__('You may have already run this theme setup wizard. If you would like to proceed anyway, click on the "Start" button below.', 'chipmunk'),

                'child-header'             => esc_html__('Install Child Theme', 'chipmunk'),
                'child-header-success'     => esc_html__('You\'re good to go!', 'chipmunk'),
                'child'                    => esc_html__('Let\'s build & activate a child theme so you may easily make theme changes.', 'chipmunk'),
                'child-success%s'          => esc_html__('Your child theme has already been installed and is now activated, if it wasn\'t already.', 'chipmunk'),
                'child-action-link'        => esc_html__('Learn about child themes', 'chipmunk'),
                'child-json-success%s'     => esc_html__('Awesome. Your child theme has already been installed and is now activated.', 'chipmunk'),
                'child-json-already%s'     => esc_html__('Awesome. Your child theme has been created and is now activated.', 'chipmunk'),

                'plugins-header'           => esc_html__('Install Plugins', 'chipmunk'),
                'plugins-header-success'   => esc_html__('You\'re up to speed!', 'chipmunk'),
                'plugins'                  => esc_html__('Let\'s install some essential WordPress plugins to get your site up to speed.', 'chipmunk'),
                'plugins-success%s'        => esc_html__('The required WordPress plugins are all installed and up to date. Press "Next" to continue the setup wizard.', 'chipmunk'),
                'plugins-action-link'      => esc_html__('Advanced', 'chipmunk'),

                'import-header'            => esc_html__('Import Content', 'chipmunk'),
                'import'                   => esc_html__('Let\'s import content to your website, to help you get familiar with the theme.', 'chipmunk'),
                'import-action-link'       => esc_html__('Advanced', 'chipmunk'),

                'ready-header'             => esc_html__('All done. Have fun!', 'chipmunk'),

                /* translators: Theme Author */
                'ready%s'                  => esc_html__('Your theme has been all set up. Enjoy your new theme.', 'chipmunk'),
                'ready-action-link'        => esc_html__('Extras', 'chipmunk'),
                'ready-big-button'         => esc_html__('View your website', 'chipmunk'),
            ]
        );

        add_action('admin_head', [$this, 'add_almond_styles']);
        add_filter('almond_import_files', [$this, 'import_almond_files']);
        add_action('almond_after_all_import', [$this, 'after_import_almond_files']);
    }

    /**
     * Set up custom styles for the Merlin wizard
     *
     * @return void
     */
    public static function add_almond_styles()
    {
        echo '<style>
			.almond__body {
                flex-direction: column;
			}

			.almond__button--knockout {
				margin-top: 1em;
				padding-right: 35px;
				background-color: #fafafa;
			}

			.almond__button--knockout:hover {
				background-color: #fafafa;
			}

			.almond__button--knockout .chevron {
				right: 20px;
			}

			.almond__button--external::after {
				opacity: 1;
				margin-left: 10px;
			}

			.almond__button:focus {
				box-shadow: none;
			}

			.almond__content .icon svg {
				width: auto !important;
			}
		</style>';
    }

    /**
     * Import theme files required for the wizard to work
     *
     * @return array
     */
    public static function import_almond_files()
    {
        return [
            [
                'import_file_name'             => __('Demo Import', 'chipmunk'),
                'import_file_url'              => THEME_SHOP_URL . '/content/content.xml',
                'import_customizer_file_url'   => THEME_SHOP_URL . '/content/customizer.dat',
            ],
        ];
    }

    /**
     * Execute custom code after the whole import has finished.
     *
     * @return void
     */
    public static function after_import_almond_files()
    {
        $header_nav = get_term_by('name', 'Header nav', 'nav_menu');
        $footer_nav = get_term_by('name', 'Footer nav', 'nav_menu');

        set_theme_mod(
            'nav_menu_locations',
            [
                'nav-primary' => $header_nav->term_id,
                'nav-secondary' => $footer_nav->term_id,
            ]
        );
    }
}
