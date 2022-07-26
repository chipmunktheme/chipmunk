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

namespace Chipmunk;

use Piotrkulpinski\Framework\Exceptions\Exception;
use Chipmunk\Theme;

require_once 'vendor/autoload.php';

try {
	$theme = new Theme();
	$theme->initialize();

} catch ( Exception $e ) {
	$theme::catcher( $e );
}

// $theme->getConfig( 'name' );
// $theme->getOption( 'primary_font' );
// $theme->addAction( 'action', 'methodName' );
// $theme->addFilter( 'filter', 'methodName' );
