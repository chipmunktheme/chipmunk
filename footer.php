<?php
use LogicException;
use Timber\Timber;

/**
 * Third party plugins that hijack the theme will call wp_footer() to get the footer template.
 * We use this to end our output buffer (started in header.php) and render into the view/page-plugin.twig template.
 *
 * @package WordPress
 * @subpackage Chipmunk
 */

$timberContext = $GLOBALS['timberContext']; // @codingStandardsIgnoreFile
if ( ! isset( $timberContext ) ) {
	throw new LogicException( __( 'Timber context not set in footer.' ) );
}
$timberContext['content'] = ob_get_contents();
ob_end_clean();

Timber::render( 'single.twig', $timberContext );
