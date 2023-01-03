<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Theme demo site URL
    |--------------------------------------------------------------------------
    |
    | Method that returns theme demo url.
    | Used for Merlin Theme Wizarf onboarding.
    |
    */

    'demo_url' => 'https://demos.chipmunktheme.com',


    /*
    |--------------------------------------------------------------------------
    | Theme changelog site URL
    |--------------------------------------------------------------------------
    |
    | Method that returns theme changelog url.
    | Used for linking update nag to the changelog page
    |
    */

    'changelog_url' => 'https://chipmunktheme.com/changelog',


    /*
    |--------------------------------------------------------------------------
    | Theme shop site URL
    |--------------------------------------------------------------------------
    |
    | Method that returns theme shop url.
    | Used for linking to the theme shop in various places.
    |
    */

    'shop_url' => 'https://chipmunktheme.com',


    /*
    |--------------------------------------------------------------------------
    | Theme shop item ID number
    |--------------------------------------------------------------------------
    |
    | Method that returns theme shop item id.
    | Used for checking license status and theme updates.
    |
    */

    'shop_item_id' => '893',


    /*
    |--------------------------------------------------------------------------
    | Plans available for the theme
    |--------------------------------------------------------------------------
    |
    | Method that returns a list of available plans.
    | Used for determining if theme user has access to certain parts of the theme.
    |
    */

    'plans' => [
        '1' => 'Basic',
        '2' => 'Plus',
        '3' => 'Pro',
    ],


    /*
    |--------------------------------------------------------------------------
    | Addons available for the theme
    |--------------------------------------------------------------------------
    |
    | Method that returns a list of available addons.
    | Used for determining if theme user has access to certain parts of the theme.
    |
    */

    'addons' => [
        'members' => '3',
        'ratings' => '2',
    ],


    /*
    |--------------------------------------------------------------------------
    | Social profiles supported
    |--------------------------------------------------------------------------
    |
    | Method that returns supported social profiles.
    | Used for creating option lists and displaying the list of socials.
    |
    */

    'socials' => [
        'Facebook',
        'Twitter',
        'Instagram',
        'LinkedIn',
        'Pinterest',
        'YouTube',
        'Vimeo',
        'TikTok',
        'ProductHunt',
        'Twitch',
        'Discord',
        'Email',
    ],


    /*
    |--------------------------------------------------------------------------
    | The name of the settings property
    |--------------------------------------------------------------------------
    |
    | Method that returns settings name.
    | Used for getting the name of the settings in Customizer.
    |
    */

    'settings_name' => 'settings',


    /*
    |--------------------------------------------------------------------------
    | Mininum required PHP version
    |--------------------------------------------------------------------------
    |
    | Method that returns minimum required PHP version.
    | Used for checking if environment meets given requirements.
    |
    */

    'min_php_version' => '7.4',


    /*
    |--------------------------------------------------------------------------
    | Mininum required WP version
    |--------------------------------------------------------------------------
    |
    | Method that returns minimum required WP version.
    | Used for checking if environment meets given requirements.
    |
    */

    'min_wp_version' => '5.4',


    /*
    |--------------------------------------------------------------------------
    | The Google API key
    |--------------------------------------------------------------------------
    |
    | Method that returns Google API key.
    | Used for pulling the list of Google Fonts from their API.
    |
    */

    'google_api_key' => 'AIzaSyBF71G0SfVTAJVZGC5dilfzC1PunP0qAtE',

];
