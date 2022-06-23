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

define( 'THEME_TITLE',          	'Chipmunk' );
define( 'THEME_SLUG',           	'chipmunk' );
define( 'THEME_VERSION',        	'1.17.0' );
define( 'THEME_AUTHOR',         	'Made by Less' );
define( 'THEME_TEMPLATE_URI',   	get_template_directory_uri() );
define( 'THEME_TEMPLATE_DIR',   	get_template_directory() );
define( 'THEME_DEMO_URL',       	'https://demo.chipmunktheme.com' );
define( 'THEME_SHOP_URL',       	'https://chipmunktheme.com' );
define( 'THEME_ITEM_ID',        	'893' );
define( 'THEME_ITEM_SLUG',      	'chipmunk-theme' );
define( 'THEME_DIST_PATH', 			'static/dist/' );
define( 'THEME_ASSETS_PATH', 		'assets/' );
define( 'THEME_TEMPLATES_PATH', 	'templates/' );
define( 'THEME_MANIFEST_PATH',      THEME_DIST_PATH . 'manifest.json' );
define( 'THEME_MANIFEST_DEV_PATH',  THEME_DIST_PATH . 'manifest-dev.json' );
define( 'THEME_PLANS',              array( '1' => 'Basic', '2' => 'Plus', '3' => 'Pro' ) );
define( 'THEME_ADDONS',             array( 'members' => '3', 'ratings' => '2' ) );

/*
 * Composer autoload
 */
require_once THEME_TEMPLATE_DIR . '/vendor/autoload.php';

/*
 * Initialize theme setup
 */
new Chipmunk\Setup();
