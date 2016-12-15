<?php

if (!class_exists('ChipmunkUpvotes'))
{
  class ChipmunkUpvotes
  {
    public static $db_key_prefix = '_chipmunk_upvote';

    public function __construct()
    {
    }

    /**
     * Processes like/unlike
     * @since    0.5
     */
    private function process_simple_like() {
    	// Test if javascript is disabled
    	$disabled = (isset($_REQUEST['disabled']) && $_REQUEST['disabled'] == true) ? true : false;

      // Base variables
    	$post_id = (isset($_REQUEST['post_id']) && is_numeric($_REQUEST['post_id'])) ? $_REQUEST['post_id'] : '';
    	$result = array();
    	$post_users = NULL;
    	$like_count = 0;

      // Get plugin options
    	if ($post_id != '')
      {
    		$count = get_post_meta($post_id, "_post_like_count", true); // like count
    		$count = (isset($count) && is_numeric($count)) ? $count : 0;

    		if (!ChipmunkUpvotes::already_liked($post_id))
        { // Like the post
    			if (is_user_logged_in())
          { // user is logged in
    				$user_id = get_current_user_id();
    				$post_users = post_user_likes($user_id, $post_id);

  					// Update User & Post
  					$user_like_count = get_user_option("_user_like_count", $user_id);
  					$user_like_count =  (isset($user_like_count) && is_numeric($user_like_count)) ? $user_like_count : 0;
  					update_user_option($user_id, "_user_like_count", ++$user_like_count);

  					if ($post_users)
            {
  						update_post_meta($post_id, "_user_liked", $post_users);
  					}
    			}
          else
          { // user is anonymous
    				$user_ip = get_ip();
    				$post_users = post_ip_likes($user_ip, $post_id);

    				// Update Post
    				if ($post_users)
            {
  						update_post_meta($post_id, "_user_IP", $post_users);
    				}
    			}
    			$like_count = ++$count;
    			$response['status'] = "liked";
    		}
        else
        { // Unlike the post
    			if (is_user_logged_in())
          { // user is logged in
    				$user_id = get_current_user_id();
    				$post_users = post_user_likes($user_id, $post_id);

    				// Update User
  					$user_like_count = get_user_option("_user_like_count", $user_id);
  					$user_like_count =  (isset($user_like_count) && is_numeric($user_like_count)) ? $user_like_count : 0;

  					if ($user_like_count > 0)
            {
  						update_user_option($user_id, '_user_like_count', --$user_like_count);
  					}

    				// Update Post
    				if ($post_users)
            {
    					$uid_key = array_search($user_id, $post_users);
    					unset($post_users[$uid_key]);
  						update_post_meta($post_id, "_user_liked", $post_users);
    				}
    			}
          else
          { // user is anonymous
    				$user_ip = get_ip();
    				$post_users = post_ip_likes($user_ip, $post_id);
    				// Update Post
    				if ($post_users)
            {
    					$uip_key = array_search($user_ip, $post_users);
    					unset($post_users[$uip_key]);
  						update_post_meta($post_id, "_user_IP", $post_users);
    				}
    			}
    			$like_count = ($count > 0) ? --$count : 0; // Prevent negative number
    			$response['status'] = "unliked";
    		}

  			update_post_meta($post_id, "_post_like_count", $like_count);
  			update_post_meta($post_id, "_post_like_modified", date('Y-m-d H:i:s'));
    		$response['count'] = ChipmunkUpvotes::get_like_count($like_count);

    		if ($disabled == true)
        {
  				wp_redirect(get_permalink($post_id));
  				exit();
    		}
        else
        {
    			wp_send_json($response);
    		}
    	}
    }

    /**
     * Utility to test if the post is already liked
     * @since    0.5
     */
    private function already_liked($post_id)
    {
    	$post_users = NULL;
    	$user_id = NULL;
    	if (is_user_logged_in())
      { // user is logged in
    		$user_id = get_current_user_id();
    		$post_meta_users = get_post_meta($post_id, "_user_liked");
    		if (count($post_meta_users) != 0)
        {
    			$post_users = $post_meta_users[0];
    		}
    	}
      else
      { // user is anonymous
    		$user_id = get_ip();
    		$post_meta_users = get_post_meta($post_id, "_user_IP");
    		if (count($post_meta_users) != 0)
        { // meta exists, set up values
    			$post_users = $post_meta_users[0];
    		}
    	}
    	if (is_array($post_users) && in_array($user_id, $post_users))
      {
    		return true;
    	}
      else
      {
    		return false;
    	}
    }

    /**
     * Output the like button
     * @since    0.5
     */
    public static function get_button($post_id)
    {
      $action = 'process_upvote';
    	$nonce = wp_create_nonce('simple-likes-nonce'); // Security
  		$post_id_class = esc_attr(' sl-button-' . $post_id);
  		$like_count = get_post_meta($post_id, "_post_like_count", true);
  		$like_count = (isset($like_count) && is_numeric($like_count)) ? $like_count : 0;
    	$count = ChipmunkUpvotes::get_like_count($like_count);
    	// Loader
    	$loader = '<span id="sl-loader"></span>';
    	// Liked/Unliked Variables
    	if (ChipmunkUpvotes::already_liked($post_id))
      {
    		$class = esc_attr(' liked');
    		$title = __('Remove Upvote', 'chipmunk');
    	}
      else
      {
    		$class = '';
    		$title = __('Upvote', 'chipmunk');
    	}
    	$output = '<button data-action="'.$action.'" data-nonce="'.$nonce.'" data-post-id="'.$post_id.'">'.$count.'</button>';
    	return $output;
    }

    /**
     * Utility retrieves post meta user likes (user id array),
     * then adds new user id to retrieved array
     * @since    0.5
     */
    private function post_user_likes($user_id, $post_id)
    {
    	$post_users = '';
    	$post_meta_users = get_post_meta($post_id, "_user_liked");
    	if (count($post_meta_users) != 0)
      {
    		$post_users = $post_meta_users[0];
    	}
    	if (!is_array($post_users))
      {
    		$post_users = array();
    	}
    	if (!in_array($user_id, $post_users))
      {
    		$post_users['user-' . $user_id] = $user_id;
    	}
    	return $post_users;
    }

    /**
     * Utility retrieves post meta ip likes (ip array),
     * then adds new ip to retrieved array
     * @since    0.5
     */
    private function post_ip_likes($user_ip, $post_id)
    {
    	$post_users = '';
    	$post_meta_users = get_post_meta($post_id, "_user_IP");
    	// Retrieve post information
    	if (count($post_meta_users) != 0)
      {
    		$post_users = $post_meta_users[0];
    	}
    	if (!is_array($post_users))
      {
    		$post_users = array();
    	}
    	if (!in_array($user_ip, $post_users))
      {
    		$post_users['ip-' . $user_ip] = $user_ip;
    	}
    	return $post_users;
    }

    /**
     * Utility to retrieve IP address
     * @since    0.5
     */
    private function get_ip()
    {
    	if (isset($_SERVER['HTTP_CLIENT_IP']) && ! empty($_SERVER['HTTP_CLIENT_IP']))
      {
    		$ip = $_SERVER['HTTP_CLIENT_IP'];
    	}
      elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && ! empty($_SERVER['HTTP_X_FORWARDED_FOR']))
      {
    		$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    	}
      else
      {
    		$ip = (isset($_SERVER['REMOTE_ADDR'])) ? $_SERVER['REMOTE_ADDR'] : '0.0.0.0';
    	}
    	$ip = filter_var($ip, FILTER_VALIDATE_IP);
    	$ip = ($ip === false) ? '0.0.0.0' : $ip;
    	return $ip;
    }

    /**
     * Utility function to format the button count,
     * appending "K" if one thousand or greater,
     * "M" if one million or greater,
     * and "B" if one billion or greater (unlikely).
     * $precision = how many decimal points to display (1.25K)
     * @since    0.5
     */
    private function format_count($number)
    {
    	$precision = 2;

    	if ($number >= 1000 && $number < 1000000)
      {
    		$formatted = number_format($number/1000, $precision).'K';
    	}
      else if ($number >= 1000000 && $number < 1000000000)
      {
    		$formatted = number_format($number/1000000, $precision).'M';
    	}
      else if ($number >= 1000000000)
      {
    		$formatted = number_format($number/1000000000, $precision).'B';
    	}
      else
      {
    		$formatted = $number; // Number is less than 1000
    	}

    	$formatted = str_replace('.00', '', $formatted);

    	return $formatted;
    }

    /**
     * Utility retrieves count plus count options,
     * returns appropriate format based on options
     * @since    0.5
     */
    private function get_like_count($like_count)
    {
    	$like_text = __('Upvote', 'chipmunk');
    	if (is_numeric($like_count) && $like_count > 0)
      {
    		$number = format_count($like_count);
    	}
      else
      {
    		$number = $like_text;
    	}
    	$count = '<span class="sl-count">' . $number . '</span>';
    	return $count;
    }
	}
}
