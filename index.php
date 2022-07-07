<?php
namespace Chipmunk;

use Timber\Timber;
use Timber\User;

/**
 * The main template file
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists
 *
 * @package WordPress
 * @subpackage Chipmunk
 */

global $wp_query;

$context = Timber::context();
$context['queried_object'] = ['name' => 'post'];
$context['title'] = get_the_archive_title();
$context['description'] = get_the_archive_description();
$context['posts'] = Timber::get_posts();

if ( get_query_var( 'author_name' ) ) {
	$author            = User::build( get_user_by( 'slug', get_query_var( 'author_name' ) ) );
	$context['author'] = $author;
	$context['title']  = 'Author Archives: ' . $author->name();
}

Timber::render( 'index.twig', $context );
