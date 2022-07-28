<?php

namespace Chipmunk\Helper;

/**
 * Provides methods related to posts
 */
trait PostTrait {

	/**
	 * Add post meta from the array
	 *
	 * @param int   $postId  ID of the post
	 * @param array $meta    Array of key => value pairs of meta to add to the post
	 * @param array $allowed Array of allowed post types
	 * @param bool  $unique  Optional. Whether the same key should not be added.
	 *
	 * @return int
	 */
	protected function addPostMeta( $postId, $meta, $allowed, $unique = true ) {
		if ( ! in_array( get_post_type( $postId ), $allowed ) ) {
			return $postId;
		}

		foreach ( $meta as $key => $value ) {
			add_post_meta( $postId, $key, $value, $unique );
		}

		return $postId;
	}
}
