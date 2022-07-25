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
	private $postType;

	/**
	 * Determine whether allow creating new terms or not
	 *
	 * @var boolean
	 */
	private $allowNewTerms = false;

	/**
	 * Required fields from the form
	 *
	 * @var array
	 */
	private $required = array( 'name' );

	/**
	 * A meta field name to store post info in
	 *
	 * @var string
	 */
	private $metaPrefix = '_' . THEME_SLUG . '_resource';

	/**
	 * Used to register custom hooks
	 *
	 * @param string $postType
	 */
	function __construct( $postType, $allowNewTerms = false ) {
		$this->postType      = $postType;
		$this->allowNewTerms = $allowNewTerms;
	}

	/**
	 * Fetches the OG Image from the url
	 *
	 * @param  string $url
	 *
	 * @return string/null
	 */
	private function fetchOgImage( $url ) {
		if ( empty( $url ) ) {
			return null;
		}

		// Fetch the OG Data
		$ogData = OpenGraph::fetch( $url );

		if ( ! empty( $ogData ) && ! empty( $ogData->image ) ) {
			return str_starts_with( $ogData->image, '/' ) ? $url . $ogData->image : $ogData->image;
		}
	}

	/**
	 * Get submitter user ID
	 *
	 * @param  string $email
	 *
	 * @return integer/null
	 */
	private function getSubmitterId( $email ) {
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
	private function uploadThumbnail( $url ) {
		require_once ABSPATH . 'wp-admin/includes/image.php';

		$response = wp_remote_request( $url );

		if ( is_wp_error( $response ) || $response['response']['code'] != 200 ) {
			return false;
		}

		$fileExtension = Helpers::getExtensionByMime( $response['headers']['content-type'] );
		$wpUploadDir   = wp_upload_dir();
		$upload        = wp_upload_bits( basename( $url ) . $fileExtension, null, $response['body'] );

		if ( ! empty( $upload['error'] ) ) {
			return false;
		}

		$filePath        = $upload['file'];
		$fileName        = basename( $filePath );
		$fileType        = wp_check_filetype( $fileName, null );
		$attachmentTitle = sanitize_file_name( pathinfo( $fileName, PATHINFO_FILENAME ) );

		// Set up our images post data
		$attachmentInfo = array(
			'guid'           => $wpUploadDir['url'] . '/' . $fileName,
			'post_mime_type' => $fileType['type'],
			'post_title'     => $attachmentTitle,
			'post_content'   => '',
			'post_status'    => 'inherit',
		);

		// Attach/upload image
		$attachmentId = wp_insert_attachment( $attachmentInfo, $filePath );

		// Generate the necessary attachment data, filesize, height, width etc.
		$attachmentData = wp_generate_attachment_metadata( $attachmentId, $filePath );

		// Add the above meta data data to our new image post
		wp_update_attachment_metadata( $attachmentId, $attachmentData );

		return $attachmentId;
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
	 * @param  int          $objectId
	 * @param  string/array $terms
	 * @param  string       $axonomy
	 */
	private function setTerms( $objectId, $terms, $taxonomy ) {
		if ( empty( $terms ) ) {
			return null;
		}

		if ( is_string( $terms ) ) {
			// Explode terms to an array
			$terms = array_map( 'trim', explode( ',', $terms ) );

			// Change the term names into the proper term ids from the DB
			$terms = array_filter(
				array_map(
					function ( $term ) use ( $taxonomy ) {
						if ( $tax = get_term_by( 'name', $term, $taxonomy ) ) {
							  return $tax->term_id;
						}

						if ( $this->allowNewTerms ) {
							$tax = wp_insert_term( $term, $taxonomy );
							return ! is_wp_error( $tax ) ? $tax['term_id'] : null;
						}

						return null;
					},
					$terms
				)
			);
		}

		@ wp_set_object_terms( $objectId, $terms, $taxonomy );
	}

	/**
	 * Sets post thumbnail
	 *
	 * @param  int $objectId
	 * @param  int $thumbnailId
	 */
	private function set_thumbnail( $objectId, $thumbnailId ) {
		if ( empty( $thumbnailId ) ) {
			return null;
		}

		@ set_post_thumbnail( $objectId, $thumbnailId );
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
		$metaKeyLinks     = '_links';
		$metaKeyFeatured  = '_is_featured';
		$metaKeySubmitter = '_submitter';

		// Meta values
		if ( ! empty( $data->url ) ) {
			$data->url = rtrim( $data->url, '/' );

			$link = array(
				'title'  => apply_filters( 'chipmunk_submission_website_label', __( 'Visit website', 'chipmunk' ) ),
				'url'    => $data->url,
				'target' => '_blank',
			);

			$data->meta[ $this->metaPrefix . $metaKeyLinks ]             = '1';
			$data->meta[ $this->metaPrefix . $metaKeyLinks . '_0_link' ] = $link;
		}

		if ( ! ( $data->author = $this->getSubmitterId( $data->submitterEmail ?? '' ) ) && ! empty( $data->submitterEmail ) && ! empty( $data->submitterName ) ) {
			$data->meta[ $this->metaPrefix . $metaKeySubmitter ] = "{$data->submitterName} <{$data->submitterEmail}>";
		}

		if ( ! empty( $data->featured ) ) {
			$data->meta[ $this->metaPrefix . $metaKeyFeatured ] = $data->featured ?? 0;
		}

		// Post array
		$post_array = array(
			'postType'     => $this->postType ?? 'post',
			'post_status'  => $data->status ?? 'pending',
			'post_title'   => $data->name ?? '',
			'post_content' => $data->content ?? '',
			'post_author'  => $data->author ?? '',
			'meta_input'   => $data->meta ?? null,
		);

		if ( $postId = @wp_insert_post( $post_array ) ) {
			// Set thumbnail
			if ( ! empty( $data->url ) && ! Helpers::getOption( 'disable_submission_image_fetch' ) ) {
				if ( $ogImage = $this->fetchOgImage( $data->url ) ) {
					if ( $thumbnailId = $this->uploadThumbnail( $ogImage ) ) {
						$this->set_thumbnail( $postId, $thumbnailId );
					}
				}
			}

			// Set terms
			$this->setTerms( $postId, $data->collections ?? array(), 'resource-collection' );
			$this->setTerms( $postId, $data->tags ?? array(), 'resource-tag' );

			// Return inserted post ID
			return $postId;
		}
	}
}
