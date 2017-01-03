<?php

if ( !class_exists( 'ChipmunkUpvotes' ) )
{
	class ChipmunkUpvotes
	{
		public static $db_post_key          = '_chipmunk_post_upvote_count';
		public static $db_user_key          = '_chipmunk_user_upvote_count';
		public static $db_user_upvoted_key  = '_chipmunk_user_liked';
		public static $db_user_ip_key       = '_chipmunk_user_ip';

		/**
		* Output the upvote button
		*/
		public static function get_button( $post_id, $class = '' )
		{
			$action = 'process_upvote';
			$nonce = wp_create_nonce( $action );

			$count = ChipmunkUpvotes::get_post_upvote_count( $post_id );
			$counter = ChipmunkUpvotes::get_upvote_counter( $count );

			if ( ChipmunkUpvotes::already_liked( $post_id ) )
			{
				$class = $class . ' is-active';
				$title = __( 'Remove Upvote', 'chipmunk' );
			}
			else
			{
				$title = __( 'Upvote', 'chipmunk' );
			}

			$output = "<button class='$class' title='$title' data-action='$action' data-nonce='$nonce' data-post-id='$post_id'>$counter</button>";
			return $output;
		}

		/**
		* Output the upvote counter
		*/
		public static function get_counter( $post_id )
		{
			$count = ChipmunkUpvotes::get_post_upvote_count( $post_id );
			$counter = ChipmunkUpvotes::get_upvote_counter( $count );

			$output = "$counter";
			return $output;
		}

		/**
		* Processes upvotes
		*/
		public static function process_upvote( $post_id )
		{
			$count = ChipmunkUpvotes::get_post_upvote_count( $post_id );

			// Like the post
			if ( !ChipmunkUpvotes::already_liked( $post_id ) )
			{
				// user is logged in
				if ( is_user_logged_in() )
				{
					$user_id = get_current_user_id();
					$post_users = ChipmunkUpvotes::post_user_upvotes( $user_id, $post_id );

					// Update User & Post
					$user_count = ChipmunkUpvotes::get_user_upvote_count( $user_id );
					update_user_option( $user_id, ChipmunkUpvotes::$db_user_key, ++$user_count );

					if ( $post_users )
					{
						update_post_meta( $post_id, ChipmunkUpvotes::$db_user_upvoted_key, $post_users );
					}
				}

				// user is anonymous
				else
				{
					$user_ip = ChipmunkUpvotes::get_ip();
					$post_users = ChipmunkUpvotes::post_ip_upvotes( $user_ip, $post_id );

					// Update Post
					if ( $post_users )
					{
						update_post_meta( $post_id, ChipmunkUpvotes::$db_user_ip_key, $post_users );
					}
				}

				$count += 1;
				$response['status'] = 'liked';
			}

		 // Unlike the post
			else
			{
				// user is logged in
				if ( is_user_logged_in() )
				{
					$user_id = get_current_user_id();
					$post_users = ChipmunkUpvotes::post_user_upvotes( $user_id, $post_id );

					// Update User
					$user_count = ChipmunkUpvotes::get_user_upvote_count( $user_id );

					if ($user_count > 0)
					{
						update_user_option( $user_id, ChipmunkUpvotes::$db_user_key, --$user_count );
					}

					// Update Post
					if ( $post_users )
					{
						$uid_key = array_search( $user_id, $post_users );
						unset( $post_users[$uid_key] );
						update_post_meta( $post_id, ChipmunkUpvotes::$db_user_upvoted_key, $post_users );
					}
				}

				// user is anonymous
				else
				{
					$user_ip = ChipmunkUpvotes::get_ip();
					$post_users = ChipmunkUpvotes::post_ip_upvotes( $user_ip, $post_id );

					// Update Post
					if ( $post_users )
					{
						$uip_key = array_search( $user_ip, $post_users );
						unset( $post_users[$uip_key] );
						update_post_meta( $post_id, ChipmunkUpvotes::$db_user_ip_key, $post_users );
					}
				}

				$count = ( $count > 0 ) ? --$count : 0; // Prevent negative number
				$response['status'] = 'unliked';
			}

			update_post_meta( $post_id, ChipmunkUpvotes::$db_post_key, $count );
			$response['counter'] = ChipmunkUpvotes::get_upvote_counter( $count );

			wp_send_json( $response );
		}

		/**
		* Utility to test if the post is already liked
		*/
		private static function already_liked( $post_id )
		{
			$post_users = NULL;
			$user_id = NULL;

			if ( is_user_logged_in() )
			{ // user is logged in
				$user_id = get_current_user_id();
				$post_meta_users = get_post_meta( $post_id, ChipmunkUpvotes::$db_user_upvoted_key );
				if ( count( $post_meta_users ) != 0 )
				{
					$post_users = $post_meta_users[0];
				}
			}
			else
			{ // user is anonymous
				$user_id = ChipmunkUpvotes::get_ip();
				$post_meta_users = get_post_meta( $post_id, ChipmunkUpvotes::$db_user_ip_key );
				if ( count( $post_meta_users ) != 0 )
				{ // meta exists, set up values
					$post_users = $post_meta_users[0];
				}
			}
			if ( is_array( $post_users ) && in_array( $user_id, $post_users ) )
			{
				return true;
			}
			else
			{
				return false;
			}
		}

		/**
		* Utility retrieves post meta user likes (user id array),
		* then adds new user id to retrieved array
		*/
		private static function post_user_upvotes( $user_id, $post_id )
		{
			$post_users = '';
			$post_meta_users = get_post_meta( $post_id, ChipmunkUpvotes::$db_user_upvoted_key );
			if ( count( $post_meta_users ) != 0 )
			{
				$post_users = $post_meta_users[0];
			}
			if ( !is_array( $post_users ) )
			{
				$post_users = array();
			}
			if ( !in_array( $user_id, $post_users ) )
			{
				$post_users['user-' . $user_id] = $user_id;
			}
			return $post_users;
		}

		/**
		* Utility retrieves post meta ip likes (ip array),
		* then adds new ip to retrieved array
		*/
		private static function post_ip_upvotes( $user_ip, $post_id )
		{
			$post_users = '';
			$post_meta_users = get_post_meta( $post_id, ChipmunkUpvotes::$db_user_ip_key );

			// Retrieve post information
			if ( count( $post_meta_users ) != 0 )
			{
				$post_users = $post_meta_users[0];
			}
			if ( !is_array( $post_users ) )
			{
				$post_users = array();
			}
			if ( !in_array( $user_ip, $post_users ) )
			{
				$post_users['ip-' . $user_ip] = $user_ip;
			}
			return $post_users;
		}

		/**
		* Utility to retrieve IP address
		*/
		private static function get_ip()
		{
			if ( isset( $_SERVER['HTTP_CLIENT_IP'] ) && ! empty( $_SERVER['HTTP_CLIENT_IP'] ) )
			{
				$ip = $_SERVER['HTTP_CLIENT_IP'];
			}
			elseif ( isset( $_SERVER['HTTP_X_FORWARDED_FOR'] ) && ! empty( $_SERVER['HTTP_X_FORWARDED_FOR'] ) )
			{
				$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
			}
			else
			{
				$ip = ( isset( $_SERVER['REMOTE_ADDR'] ) ) ? $_SERVER['REMOTE_ADDR'] : '0.0.0.0';
			}

			$ip = filter_var( $ip, FILTER_VALIDATE_IP );
			$ip = ( $ip === false ) ? '0.0.0.0' : $ip;
			return $ip;
		}

		/**
		* Utility retrieves upvote count for post,
		* returns appropriate number
		*/
		private static function get_post_upvote_count( $post_id )
		{
			$count = get_post_meta( $post_id, ChipmunkUpvotes::$db_post_key, true );
			$count = ( isset( $count ) && is_numeric( $count ) ) ? $count : 0;

			return $count;
		}

		/**
		* Utility retrieves upvote count for user,
		* returns appropriate number
		*/
		private static function get_user_upvote_count( $user_id )
		{
			$count = get_user_option( ChipmunkUpvotes::$db_user_key, $user_id );
			$count = ( isset( $count ) && is_numeric( $count ) ) ? $count : 0;

			return $count;
		}

		/**
		* Utility retrieves count plus count options,
		* returns appropriate format based on options
		*/
		private static function get_upvote_counter( $count )
		{
			$counter = ( is_numeric( $count ) && $count > 0 ) ? ChipmunkHelpers::format_number( $count ) : 0;
			$counter = "<i class='icon icon_arrow-up'></i> $counter";

			return $counter;
		}
	}
}
