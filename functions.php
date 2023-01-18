<?php

/**
 * Chipmunk: Theme specific functionalities
 *
 * Author:       Made by Less
 * Author URI:   https://madebyless.com
 *
 * @package WordPress
 * @subpackage Chipmunk
 */

$variants = [
    36455 => [
        'name' => 'Basic',
        'addons' => [],
    ],
    36456 => [
        'name' => 'Basic',
        'addons' => [],
    ],
    36457 => [
        'name' => 'Plus',
        'addons' => ['ratings'],
    ],
    36458 => [
        'name' => 'Pro',
        'addons' => ['ratings', 'members'],
    ],
];

define('THEME_TITLE',              'Chipmunk');
define('THEME_SLUG',               'chipmunk');
define('THEME_ITEM_SLUG',          'chipmunk-theme');
define('THEME_TEMPLATE_URI',       get_template_directory_uri());
define('THEME_TEMPLATE_DIR',       get_template_directory());
define('THEME_DEMO_URL',           'https://demo.chipmunktheme.com');
define('THEME_SHOP_URL',           'https://staging.chipmunktheme.com');
define('THEME_API_URL',            'https://api.lemonsqueezy.com/v1');
define('THEME_DIST_PATH',          'static/dist/');
define('THEME_ASSETS_PATH',        'assets/');
define('THEME_TEMPLATES_PATH',     'templates/');
define('THEME_MANIFEST_PATH',      THEME_DIST_PATH . 'manifest.json');
define('THEME_VARIANTS',           $variants);

/*
 * Composer autoload
 */
require_once THEME_TEMPLATE_DIR . '/vendor/autoload.php';

/*
 * Initialize theme setup
 */
new Chipmunk\Setup();
