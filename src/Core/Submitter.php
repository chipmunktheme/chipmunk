<?php

namespace Chipmunk\Core;

use MadeByLess\Lessi\Helper\FileTrait;
use MadeByLess\Lessi\Helper\HelperTrait;
use MadeByLess\Lessi\Helper\HookTrait;
use MadeByLess\Lessi\Helper\MediaTrait;
use Chipmunk\ThirdParty\OpenGraph;
use Chipmunk\Helper\OptionTrait;

/**
 * Submits resource to the database
 */
class Submitter
{
    use FileTrait;
    use HelperTrait;
    use HookTrait;
    use MediaTrait;
    use OptionTrait;

    /**
     * Post type of the submission
     *
     * @var string
     */
    private string $postType;

    /**
     * Determine whether allow creating new terms or not
     *
     * @var bool
     */
    private bool $allowNewTerms = false;

    /**
     * Required fields from the form
     *
     * @var array
     */
    private array $required = [ 'name' ];

    /**
     * Used to register custom hooks
     *
     * @param string $postType
     */
    public function __construct($postType, $allowNewTerms = false)
    {
        $this->postType      = $postType;
        $this->allowNewTerms = $allowNewTerms;
    }

    /**
     * Fetches the OG Image from the url
     *
     * @param string $url
     *
     * @return string|null
     */
    private function fetchOgImage(string $url): ?string
    {
        if (empty($url)) {
            return null;
        }

        // Fetch the OG Data
        $ogData = OpenGraph::fetch($url);

        if (! empty($ogData) && ! empty($ogData->image)) {
            return str_starts_with($ogData->image, '/') ? $url . $ogData->image : $ogData->image;
        }

        return null;
    }

    /**
     * Uploads thumbnail image from URL
     *
     * @param string|null $url
     *
     * @return ?int
     */
    private function uploadThumbnail(?string $url): ?int
    {
        require_once ABSPATH . 'wp-admin/includes/image.php';

        $response = wp_remote_request($url);

        if (! $this->isValidResponse($response)) {
            return null;
        }

        $fileExtension = $this->getExtensionByMime(wp_remote_retrieve_header($response, 'content-type'));
        $uploadDir     = wp_upload_dir();
        $upload        = wp_upload_bits(basename($url) . $fileExtension, null, wp_remote_retrieve_body($response));

        if (! empty($upload['error'])) {
            return null;
        }

        $filePath        = $upload['file'];
        $fileName        = basename($filePath);
        $fileType        = wp_check_filetype($fileName, null);
        $attachmentTitle = sanitize_file_name(pathinfo($fileName, PATHINFO_FILENAME));

        // Set up our images post data
        $attachmentInfo = [
            'guid'           => $this->getPath($uploadDir['url'], $fileName),
            'post_mime_type' => $fileType['type'],
            'post_title'     => $attachmentTitle,
            'post_content'   => '',
            'post_status'    => 'inherit',
        ];

        // Attach/upload image
        $attachmentId = wp_insert_attachment($attachmentInfo, $filePath);

        // Generate the necessary attachment data, filesize, height, width etc.
        $attachmentData = wp_generate_attachment_metadata($attachmentId, $filePath);

        // Add the above meta data data to our new image post
        wp_update_attachment_metadata($attachmentId, $attachmentData);

        return $attachmentId;
    }

    /**
     * Validates data against the rewquired fields
     *
     * @param object $data
     *
     * @return bool
     */
    private function validate(object $data): bool
    {
        foreach ($this->required as $field) {
            if (empty($data->{$field})) {
                return false;
            }
        }

        return true;
    }

    /**
     * Sets post terms from an comma separated values
     *
     * @param int          $objectId
     * @param string|array $terms
     * @param string       $axonomy
     */
    private function setTerms($objectId, $terms, $taxonomy)
    {
        if (empty($terms)) {
            return null;
        }

        if (is_string($terms)) {
            // Explode terms to an array
            $terms = array_map('trim', explode(',', $terms));

            // Change the term names into the proper term ids from the DB
            $terms = array_filter(
                array_map(
                    function ($term) use ($taxonomy) {
                        if ($tax = get_term_by('name', $term, $taxonomy)) {
                              return $tax->term_id;
                        }

                        if ($this->allowNewTerms) {
                            $tax = wp_insert_term($term, $taxonomy);
                            return ! is_wp_error($tax) ? $tax['term_id'] : null;
                        }

                        return null;
                    },
                    $terms
                )
            );
        }

        @wp_set_object_terms($objectId, $terms, $taxonomy);
    }

    /**
     * Sets post thumbnail
     *
     * @param int $objectId
     * @param int $thumbnailId
     *
     * @return bool
     */
    private function setThumbnail(int $objectId, int $thumbnailId): bool
    {
        if (empty($thumbnailId)) {
            return false;
        }

        return @set_post_thumbnail($objectId, $thumbnailId);
    }

    /**
     * Submit a post into the database and adds related terms and thumbnail
     *
     * @param object $data
     */
    public function submit(object $data): ?int
    {
        // Validate data
        if (! $this->validate($data)) {
            return null;
        }

        // Meta values
        if (! empty($data->url)) {
            $data->url = rtrim($data->url, '/');

            $link = [
                'title'  => $this->applyFilter('submission_website_label', __('Visit website', 'chipmunk')),
                'url'    => $data->url,
                'target' => '_blank',
            ];

            $data->meta[ $this->buildPrefixedThemeSlug('links') ]        = '1';
            $data->meta[ $this->buildPrefixedThemeSlug('links_0_link') ] = $link;
        }

        if (! ( $data->author = $this->getCurrentUserOrByEmail($data->submitterEmail) ) && ! empty($data->submitterEmail) && ! empty($data->submitterName)) {
            $data->meta[ $this->buildPrefixedThemeSlug('submitter') ] = "{$data->submitterName} <{$data->submitterEmail}>";
        }

        if (! empty($data->featured)) {
            $data->meta[ $this->buildPrefixedThemeSlug('is_featured') ] = $data->featured ?? 0;
        }

        // Post array
        $post_array = [
            'post_type'    => $this->postType ?? 'post',
            'post_status'  => $data->status ?? 'pending',
            'post_title'   => $data->name ?? '',
            'post_content' => $data->content ?? '',
            'post_author'  => $data->author ?? '',
            'meta_input'   => $data->meta ?? null,
        ];

        if ($postId = @wp_insert_post($post_array)) {
            // Set thumbnail
            if (! empty($data->url) && ! $this->getOption('disable_submission_image_fetch')) {
                if ($ogImage = $this->fetchOgImage($data->url)) {
                    if ($thumbnailId = $this->uploadThumbnail($ogImage)) {
                        $this->setThumbnail($postId, $thumbnailId);
                    }
                }
            }

            // Set terms
            $this->setTerms($postId, $data->collections ?? [], 'resource-collection');
            $this->setTerms($postId, $data->tags ?? [], 'resource-tag');

            // Return inserted post ID
            return $postId;
        }
    }
}
