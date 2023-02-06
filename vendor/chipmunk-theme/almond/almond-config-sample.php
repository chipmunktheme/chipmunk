<?php

/**
 * Almond configuration file.
 *
 * @package   Almond
 * @version   @@pkg.version
 * @link      https://almondwp.com/
 * @author    Rich Tabor, from ThemeBeans.com & the team at ProteusThemes.com
 * @copyright Copyright (c) 2018, Almond of Inventionn LLC
 * @license   Licensed GPLv3 for Open Source Use
 */

if (!class_exists('Almond')) {
    return;
}

/**
 * Set directory locations, text strings, and settings.
 */
$almond = new Almond(

    $config = array(
        'directory'            => 'almond', // Location / directory where Almond is placed in your theme.
        'almond_url'           => 'almond', // The wp-admin page slug where Almond loads.
        'parent_slug'          => 'themes.php', // The wp-admin parent page slug for the admin menu item.
        'capability'           => 'manage_options', // The capability required for this menu to be displayed to the user.
        'child_action_btn_url' => 'https://codex.wordpress.org/child_themes', // URL for the 'child-action-link'.
        'dev_mode'             => true, // Enable development mode for testing.
        'ready_big_button_url' => '', // Link for the big button on the ready step.
    ),

    $strings = array(
        'admin-menu'               => esc_html__('Theme Setup', '@@textdomain'),

        /* translators: 1: Title Tag 2: Theme Name 3: Closing Title Tag */
        'title%s%s%s%s'            => esc_html__('%1$s%2$s Themes &lsaquo; Theme Setup: %3$s%4$s', '@@textdomain'),
        'return-to-dashboard'      => esc_html__('Return to the dashboard', '@@textdomain'),
        'ignore'                   => esc_html__('Disable this almond', '@@textdomain'),

        'btn-skip'                 => esc_html__('Skip', '@@textdomain'),
        'btn-next'                 => esc_html__('Next', '@@textdomain'),
        'btn-start'                => esc_html__('Start', '@@textdomain'),
        'btn-no'                   => esc_html__('Cancel', '@@textdomain'),
        'btn-child-install'        => esc_html__('Install', '@@textdomain'),
        'btn-content-install'      => esc_html__('Install', '@@textdomain'),
        'btn-import'               => esc_html__('Import', '@@textdomain'),

        /* translators: Theme Name */
        'welcome-header%s'         => esc_html__('Welcome to %s', '@@textdomain'),
        'welcome-header-success%s' => esc_html__('Hi. Welcome back', '@@textdomain'),
        'welcome%s'                => esc_html__('This almond will set up your theme, install plugins, and import content. It is optional & should take only a few minutes.', '@@textdomain'),
        'welcome-success%s'        => esc_html__('You may have already run this theme setup almond. If you would like to proceed anyway, click on the "Start" button below.', '@@textdomain'),

        'child-header'             => esc_html__('Install Child Theme', '@@textdomain'),
        'child-header-success'     => esc_html__('You\'re good to go!', '@@textdomain'),
        'child'                    => esc_html__('Let\'s build & activate a child theme so you may easily make theme changes.', '@@textdomain'),
        'child-success%s'          => esc_html__('Your child theme has already been installed and is now activated, if it wasn\'t already.', '@@textdomain'),
        'child-action-link'        => esc_html__('Learn about child themes', '@@textdomain'),
        'child-json-success%s'     => esc_html__('Awesome. Your child theme has already been installed and is now activated.', '@@textdomain'),
        'child-json-already%s'     => esc_html__('Awesome. Your child theme has been created and is now activated.', '@@textdomain'),

        'import-header'            => esc_html__('Import Content', '@@textdomain'),
        'import'                   => esc_html__('Let\'s import content to your website, to help you get familiar with the theme.', '@@textdomain'),
        'import-action-link'       => esc_html__('Advanced', '@@textdomain'),

        'ready-header'             => esc_html__('All done. Have fun!', '@@textdomain'),

        /* translators: Theme Author */
        'ready%s'                  => esc_html__('Your theme has been all set up. Enjoy your new theme by %s.', '@@textdomain'),
        'ready-action-link'        => esc_html__('Extras', '@@textdomain'),
        'ready-big-button'         => esc_html__('View your website', '@@textdomain'),
        'ready-link-1'             => sprintf('<a href="%1$s" target="_blank">%2$s</a>', 'https://wordpress.org/support/', esc_html__('Explore WordPress', '@@textdomain')),
        'ready-link-2'             => sprintf('<a href="%1$s" target="_blank">%2$s</a>', 'https://themebeans.com/contact/', esc_html__('Get Theme Support', '@@textdomain')),
        'ready-link-3'             => sprintf('<a href="%1$s">%2$s</a>', admin_url('customize.php'), esc_html__('Start Customizing', '@@textdomain')),
    )
);
