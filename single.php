<?php
namespace Chipmunk;

use Timber\Timber;
use Chipmunk\Extensions\Views;
use Chipmunk\Extensions\Upvotes;
use Chipmunk\Extensions\Bookmarks;
use Chipmunk\Addons\Ratings\Helpers as RatingsHelpers;

/**
 * The Template for displaying all single posts
 *
 * @package WordPress
 * @subpackage Chipmunk
 */

Views::setViews( get_the_ID() );
$context = Timber::context();
$upvotes = new Upvotes( get_the_ID() );
$bookmarks = new Bookmarks( get_the_ID() );

$context['upvote_button'] = $upvotes->getButton( 'toggle_upvote', 'c-stats__button' );
$context['upvote_counter'] = $upvotes->getContent();
$context['bookmark_button'] = $bookmarks->getButton( 'toggle_bookmark', 'c-stats__button' );
$context['average_rating'] = RatingsHelpers::get_post_rating( get_the_ID() );

Timber::render( 'single.twig', $context );
