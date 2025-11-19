<?php

/**
 * Chipmunk: Theme specific functionalities
 *
 * Author:       Piotr Kulpinski
 * Author URI:   https://kulpinski.dev
 *
 * @package WordPress
 * @subpackage Chipmunk
 */

define('THEME_TITLE',              'Chipmunk');
define('THEME_SLUG',               'chipmunk');
define('THEME_ITEM_SLUG',          'chipmunk-theme');
define('THEME_TEMPLATE_URI',       get_template_directory_uri());
define('THEME_TEMPLATE_DIR',       get_template_directory());
define('THEME_SHOP_URL',           'https://chipmunktheme.com');
define('THEME_DIST_PATH',          'static/dist/');
define('THEME_ASSETS_PATH',        'assets/');
define('THEME_TEMPLATES_PATH',     'templates/');
define('THEME_MANIFEST_PATH',      THEME_DIST_PATH . 'manifest.json');

/*
 * Composer autoload
 */
require_once THEME_TEMPLATE_DIR . '/vendor/autoload.php';

/*
 * Initialize theme setup
 */
new Chipmunk\Setup();
