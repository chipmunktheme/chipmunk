<?php

namespace Chipmunk\Addons\Ratings;

/**
 * Initializes the plugin renderers.
 *
 * @package WordPress
 * @subpackage Chipmunk
 */
class Renderers
{
    /**
     * Class constructor
     *
     * @return void
     */
    public function __construct()
    {
        // if ( \Chipmunk\Helpers::is_feature_enabled( 'ratings', 'resource' ) ) {
        add_action('chipmunk_resource_extras', array($this, 'render_rating_form'));
        // }

        // if ( \Chipmunk\Helpers::is_feature_enabled( 'ratings', 'post' ) ) {
        add_action('chipmunk_post_extras', array($this, 'render_rating_form'));
        // }
    }

    /**
     * A function for rendering the rating form.
     *
     * @return string  The template output
     */
    public function render_rating_form()
    {
        $ratings = new Ratings(get_the_ID());

        // Render form template
        \Chipmunk\Helpers::get_template_part('addons/ratings/rating-form', array(
            'ratings'    => $ratings->get_ratings(),
            'summary'    => $ratings->get_ratings_summary(),
            'max_rating' => $ratings->get_max_rating(),
        ), true);
    }
}
