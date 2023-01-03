<?php

namespace Chipmunk\Addons\Ratings;

/**
 * AJAX action callbacks
 *
 * @package WordPress
 * @subpackage Chipmunk
 */
class Actions
{
    /**
     * Class constructor
     *
     * @return void
     */
    public function __construct()
    {
        // Handlers for ajax actions
        add_action('wp_ajax_chipmunk_submit_rating', array($this, 'submit_rating'));
        add_action('wp_ajax_nopriv_chipmunk_submit_rating', array($this, 'submit_rating'));
    }

    /**
     * Process rating submission callback
     */
    public function submit_rating()
    {
        $ratings = new Ratings($_REQUEST['actionPostId'], $_REQUEST['actionRating']);
        $ratings->process();
    }
}
