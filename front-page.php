<?php
namespace Chipmunk;

use Timber\Timber;

/**
 * The Template for displaying the front page
 *
 * @package WordPress
 * @subpackage Chipmunk
 */

Timber::render( 'front.twig', Timber::context() );
