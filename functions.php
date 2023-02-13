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

define('THEME_TITLE',              'Chipmunk');
define('THEME_SLUG',               'chipmunk');
define('THEME_ITEM_SLUG',          'chipmunk-theme');
define('THEME_TEMPLATE_URI',       get_template_directory_uri());
define('THEME_TEMPLATE_DIR',       get_template_directory());
define('THEME_SHOP_URL',           'https://chipmunktheme.com');
define('THEME_API_URL',            'https://api.lemonsqueezy.com/v1');
define('THEME_DIST_PATH',          'static/dist/');
define('THEME_ASSETS_PATH',        'assets/');
define('THEME_TEMPLATES_PATH',     'templates/');
define('THEME_MANIFEST_PATH',      THEME_DIST_PATH . 'manifest.json');
define('THEME_VARIANTS',           unserialize(base64_decode('YTozOntpOjEwODc0O2E6Mjp7czo0OiJuYW1lIjtzOjU6IkJhc2ljIjtzOjY6ImFkZG9ucyI7YTowOnt9fWk6MTA4NzU7YToyOntzOjQ6Im5hbWUiO3M6NDoiUGx1cyI7czo2OiJhZGRvbnMiO2E6MTp7aTowO3M6NzoicmF0aW5ncyI7fX1pOjEwODc2O2E6Mjp7czo0OiJuYW1lIjtzOjM6IlBybyI7czo2OiJhZGRvbnMiO2E6Mjp7aTowO3M6NzoicmF0aW5ncyI7aToxO3M6NzoibWVtYmVycyI7fX19')));

/*
 * Composer autoload
 */
require_once THEME_TEMPLATE_DIR . '/vendor/autoload.php';

/*
 * Initialize theme setup
 */
new Chipmunk\Setup();
