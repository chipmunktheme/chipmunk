<?php
/**
 * Theme specific functionalities
 *
 * @package WordPress
 * @subpackage Chipmunk
 */

use Chipmunk\Theme;
use Chipmunk\Config;

/**
 * Register The Auto Loader
 *
 * Composer provides a convenient, automatically generated class loader for
 * our theme. We will simply require it into the script here so that we
 * don't have to worry about manually loading any of our classes later on.
 */
if ( ! file_exists( $composer = __DIR__ . '/vendor/autoload.php' ) ) {
    wp_die( __( 'Error locating autoloader. Please run <code>composer install</code>.', 'chipmunk' ) );
}

require_once $composer;

/**
 * Register The Theme
 *
 * The first thing we will do is schedule a new Theme application container
 * to boot when WordPress is finished loading the theme.
 */
try {
	$theme = new Theme();
	$theme->initialize();

} catch ( Throwable $e ) {
	$theme->catcher( $e );
}

/**
 * Create a global config function
 *
 * The main function responsible for returning the one true Config
 * Instance to functions everywhere.
 *
 * @return Config
 */
function config() {
	return Config::getInstance();
}
