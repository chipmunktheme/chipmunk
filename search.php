<?php
namespace Chipmunk;

use Timber\Timber;
use Chipmunk\Helpers;

/**
 * Search results page
 *
 * @package WordPress
 * @subpackage Chipmunk
 */

// If the search query is shorter than 3 letters redirect to homepage
if ( strlen( get_search_query() ) < 3 || Helpers::getOption( 'disable_search' ) ) {
	wp_redirect( home_url( '/', 'relative' ) ); exit;
}

Timber::render( [ 'search.twig', 'index.twig' ], Timber::context() );
