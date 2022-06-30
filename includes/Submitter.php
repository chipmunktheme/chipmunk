<?php

namespace Chipmunk;

use Chipmunk\Helpers;
use Chipmunk\Vendors\OpenGraph;

/**
 * Submits resource to the database
 *
 * @package WordPress
 * @subpackage Chipmunk
 */
class Submitter {

	/**
	 * Post type of the submission
	 *
	 * @var string
	 */
	private $post_type;

	/**
	 * Determine whether allow creating new terms or not
	 *
	 * @var boolean
	 */
	private $allow_new_terms = false;

	/**
	 * Required fields from the form
	 *
	 * @var array
	 */
	private $required = [ 'name' ];

	/**
	 * A meta field name to store post info in
	 *
	 * @var string
	 */
	private $meta_prefix = '_' . THEME_SLUG . '_resource';

	/**
 	 * Used to register custom hooks
	 *
	 * @param string $post_type
	 */
	function __construct( $post_type, $allow_new_terms = false ) {
		$this->post_type = $post_type;
		$this->allow_new_terms = $allow_new_terms;
	}

	/**
	 * Fetches the OG Image from the url
	 *
	 * @param  string $url
	 *
	 * @return string/null
	 */
	private function fetch_og_image( $url ) {
		if ( empty( $url ) ) {
			return null;
		}

		// Fetch the OG Data
		$og_data = OpenGraph::fetch( $url );

		if ( ! empty( $og_data ) && ! empty( $og_data->image ) ) {
			return str_starts_with( $og_data->image, '/' ) ? $url . $og_data->image : $og_data->image;
		}
	}

	/**
	 * Get submitter user ID
	 *
	 * @param  string $email
	 *
	 * @return integer/null
	 */
	private function get_submitter_id( $email ) {
		if ( is_user_logged_in() ) {
			return get_current_user_id();
		}

		if ( ! empty( $email ) && $user = get_user_by( 'email', $email ) ) {
			return $user->ID;
		}

		return null;
	}

	/**
	 * Uploads thumbnail image from URL
	 *
	 * @return int
	 */
	private function upload_thumbnail( $url ) {
		require_once ABSPATH . 'wp-admin/includes/image.php';

		$response = wp_remote_request( $url );

		if ( is_wp_error( $response ) || $response['response']['code'] != 200 ) {
			return false;
		}

		$file_extension = Helpers::get_extension_by_mime( $response['headers']['content-type'] );
		$wp_upload_dir = wp_upload_dir();
		$upload = wp_upload_bits( basename( $url ) . $file_extension, null, $response['body'] );

		if ( ! empty( $upload['error'] ) ) {
			return false;
		}

		$file_path = $upload['file'];
		$file_name = basename( $file_path );
		$file_type = wp_check_filetype( $file_name, null );
		$attachment_title = sanitize_file_name( pathinfo( $file_name, PATHINFO_FILENAME ) );

		// Set up our images post data
		$attachment_info = [
			'guid'           => $wp_upload_dir['url'] . '/' . $file_name,
			'post_mime_type' => $file_type['type'],
			'post_title'     => $attachment_title,
			'post_content'   => '',
			'post_status'    => 'inherit',
		];

		// Attach/upload image
		$attachment_id = wp_insert_attachment( $attachment_info, $file_path );

		// Generate the necessary attachment data, filesize, height, width etc.
		$attachment_data = wp_generate_attachment_metadata( $attachment_id, $file_path );

		// Add the above meta data data to our new image post
		wp_update_attachment_metadata( $attachment_id,  $attachment_data );

		return $attachment_id;
	}

	/**
	 * Validates data against the rewquired fields
	 *
	 * @param  object $data
	 *
	 * @return boolean
	 */
	private function validate( $data ) {
		foreach ( $this->required as $field ) {
			if ( empty( $data->{$field} ) ) {
				return false;
			}
		}

		return true;
	}

	/**
	 * Sets post terms from an comma separated values
	 *
	 * @param  int $object_id
	 * @param  string/array $terms
	 * @param  string $axonomy
	 */
	private function set_terms( $object_id, $terms, $taxonomy ) {
		if ( empty( $terms ) ) {
			return null;
		}

		if ( is_string( $terms ) ) {
			// Explode terms to an array
			$terms = array_map( 'trim', explode( ',', $terms ) );

			// Change the term names into the proper term ids from the DB
			$terms = array_filter( array_map( function ( $term ) use ( $taxonomy ) {
				if ( $tax = get_term_by( 'name', $term, $taxonomy ) ) {
					return $tax->term_id;
				}

				if ( $this->allow_new_terms ) {
					$tax = wp_insert_term( $term, $taxonomy );
					return ! is_wp_error( $tax ) ? $tax['term_id'] : null;
				}

				return null;
			}, $terms ) );
		}

		@ wp_set_object_terms( $object_id, $terms, $taxonomy );
	}

	/**
	 * Sets post thumbnail
	 *
	 * @param  int $object_id
	 * @param  int $thumbnail_id
	 */
	private function set_thumbnail( $object_id, $thumbnail_id ) {
		if ( empty( $thumbnail_id ) ) {
			return null;
		}

		@ set_post_thumbnail( $object_id, $thumbnail_id );
	}

	/**
	 * Submit a post into the database and adds related terms and thumbnail
	 *
	 * @param  object $data
	 */
	public function submit( $data ) {
		// Validate data
		if ( ! $this->validate( $data ) ) {
			return false;
		}

		// Meta keys
		$meta_key_links = '_links';
		$meta_key_featured = '_is_featured';
		$meta_key_submitter = '_submitter';

		// Meta values
		if ( ! empty( $data->url ) ) {
			$data->url = rtrim( $data->url, '/' );

			$link = [
				'title' 	=> apply_filters( 'chipmunk_submission_website_label', __( 'Visit website', 'chipmunk' ) ),
				'url' 		=> $data->url,
				'target' 	=> '_blank',
			];

			$data->meta[ $this->meta_prefix . $meta_key_links ] = '1';
			$data->meta[ $this->meta_prefix . $meta_key_links . '_0_link' ] = $link;
		}

		if ( ! ( $data->author = $this->get_submitter_id( $data->submitter_email ?? '' ) ) && ! empty( $data->submitter_email ) && ! empty( $data->submitter_name ) ) {
			$data->meta[ $this->meta_prefix . $meta_key_submitter ] = "{$data->submitter_name} <{$data->submitter_email}>";
		}

		if ( ! empty( $data->featured ) ) {
			$data->meta[ $this->meta_prefix . $meta_key_featured ] = $data->featured ?? 0;
		}

		// Post array
		$post_array = [
			'post_type'     => $this->post_type ?? 'post',
			'post_status'   => $data->status ?? 'pending',
			'post_title'    => $data->name ?? '',
			'post_content'  => $data->content ?? '',
			'post_author'   => $data->author ?? '',
			'meta_input'    => $data->meta ?? null,
		];

		if ( $post_id = @wp_insert_post( $post_array) ) {
			// Set thumbnail
			if ( ! empty( $data->url ) && ! Helpers::get_theme_option( 'disable_submission_image_fetch' ) ) {
				if ( $og_image = $this->fetch_og_image( $data->url ) ) {
					if ( $thumbnail_id = $this->upload_thumbnail( $og_image ) ) {
						$this->set_thumbnail( $post_id, $thumbnail_id );
					}
				}
			}

			// Set terms
			$this->set_terms( $post_id, $data->collections ?? [], 'resource-collection' );
			$this->set_terms( $post_id, $data->tags ?? [], 'resource-tag' );

			// Return inserted post ID
			return $post_id;
		}
	}
}
