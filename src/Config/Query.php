<?php

namespace Chipmunk\Config;

use WP_Query;
use MadeByLess\Lessi\Helper\HelperTrait;
use Chipmunk\Theme;

/**
 * Query config hooks.
 */
class Query extends Theme
{
    use HelperTrait;

    /**
     * Hooks methods of this object into the WordPress ecosystem.
     */
    public function initialize()
    {
        $this->addFilter('pre_get_posts', [ $this, 'updatePerPageParams' ]);
        $this->addFilter('pre_get_posts', [ $this, 'updateSearchParams' ]);
        $this->addFilter('pre_get_posts', [ $this, 'updateAuthorParams' ]);
        $this->addFilter('pre_get_posts', [ $this, 'updateRelatedParams' ]);
        $this->addFilter('pre_get_posts', [ $this, 'updateOrderbyParams' ]);
        $this->addFilter('pre_get_posts', [ $this, 'excludeTaxChildren' ]);
    }

    /**
     * Update results per page for different queries.
     *
     * @see https://developer.wordpress.org/reference/hooks/pre_get_posts
     *
     * @param WP_Query $query
     */
    public function updatePerPageParams(WP_Query $query)
    {
        // Don't change the value it has been already set
        if (is_admin() || $query->get('posts_per_page')) {
            return $query;
        }

        // Related
        if ($query->get('related')) {
            $query->set('posts_per_page', $this->applyFilter('related_resources_count', 3));

            return $query;
        }

        // Latest
        if ($query->get('latest')) {
            $query->set('posts_per_page', $this->applyFilter('latest_posts_count', 3));

            return $query;
        }

        // Search results
        if ($query->is_search) {
            $query->set('posts_per_page', $this->getOption('results_per_page'));

            return $query;
        }

        // Posts
        if ($this->isQueryForPostType($query, 'post')) {
            $query->set('posts_per_page', $this->getOption('posts_per_page'));

            return $query;
        }

        // Resources
        if ($this->isQueryForPostType($query, 'resource')) {
            $query->set('posts_per_page', $this->getOption('resources_per_page'));

            return $query;
        }

        return $query;
    }

    /**
     * Update search params to include resources.
     *
     * @see https://developer.wordpress.org/reference/hooks/pre_get_posts
     *
     * @param WP_Query $query
     */
    public function updateSearchParams(WP_Query $query)
    {
        if (is_admin() || ! $query->is_search) {
            return $query;
        }

        // Include resources
        $query->set('post_type', [ 'post', 'resource' ]);

        // Include only published posts
        $query->set('post_status', [ 'publish' ]);

        return $query;
    }

    /**
     * Update author params to only include resources.
     *
     * @see https://developer.wordpress.org/reference/hooks/pre_get_posts
     *
     * @param WP_Query $query
     */
    public function updateAuthorParams(WP_Query $query)
    {
        if (is_admin() || ! $query->is_author) {
            return $query;
        }

        $query->set('post_type', 'resource');

        return $query;
    }

    /**
     * Update orderby params.
     *
     * @see https://developer.wordpress.org/reference/hooks/pre_get_posts
     *
     * @param WP_Query $query
     */
    public function updateRelatedParams(WP_Query $query)
    {
        global $post;

        if (is_admin() || ! $query->get('related') or empty($post)) {
            return $query;
        }

        $taxQuery = [];

        foreach (get_object_taxonomies(get_post($post->ID), 'names') as $taxonomy) {
            $terms = get_the_terms($post->ID, $taxonomy);

            if (! empty($terms)) {
                $taxQuery[] = [
                    'taxonomy' => $taxonomy,
                    'field'    => 'term_id',
                    'terms'    => array_column($terms, 'term_id'),
                    'operator' => 'IN',
                ];
            };
        }

        if (! empty($taxQuery) && count($taxQuery) > 1) {
            $taxQuery['relation'] = 'OR';
        }

        $query->set('tax_query', $taxQuery);

        return $query;
    }

    /**
     * Update orderby params for resources.
     *
     * @see https://developer.wordpress.org/reference/hooks/pre_get_posts
     *
     * @param WP_Query $query
     */
    public function updateOrderbyParams(WP_Query $query)
    {
        if (is_admin() || ! $this->isQueryForPostType($query, 'resource')) {
            return $query;
        }

        // TODO: Check if the custom ordering is working
        $customOrderby = [
            'views'   => $this->buildPrefixedThemeSlug('post_view_count'),
            'upvotes' => $this->buildPrefixedThemeSlug('upvote_count'),
            'ratings' => $this->buildPrefixedThemeSlug('rating_rank'),
        ];

        $orderby = $query->get('orderby') ?: $this->getOption('default_resource_orderby');
        $order   = $query->get('order') ?: $this->getOption('default_resource_order');

        if (array_key_exists($orderby, $customOrderby)) {
            $query->set('meta_key', $customOrderby[ $orderby ]);
            $query->set('orderby', 'meta_value_num date');
            $query->set('order', 'DESC');
        } else {
            $query->set('orderby', $orderby);
            $query->set('order', $order);
        }

        return $query;
    }

    /**
     * Exclude children from taxonomy listing for resources.
     *
     * @see https://developer.wordpress.org/reference/hooks/pre_get_posts
     *
     * @param WP_Query $query
     */
    public function excludeTaxChildren(WP_Query $query)
    {
        if (is_admin() || ! $this->isQueryForPostType($query, 'resource') || empty($query->query_vars['resource-collection'])) {
            return $query;
        }

        $query->set(
            'tax_query',
            [
                [
                    'taxonomy'         => 'resource-collection',
                    'field'            => 'slug',
                    'terms'            => $query->query_vars['resource-collection'],
                    'include_children' => false,
                ],
            ]
        );

        return $query;
    }

    /**
     * Checks if current query is quering given post type.
     *
     * @param WP_Query $query
     * @param string   $postType
     *
     * @return bool
     */
    private function isQueryForPostType(WP_Query $query, string $postType): bool
    {
        if ($postType === 'post') {
            if ($query->is_posts_page || $query->is_date) {
                return true;
            }

            if ($query->get('category_name')) {
                return true;
            }

            if ($query->get('tag')) {
                return true;
            }
        }

        if ($postType === 'resource') {
            if ($query->is_author) {
                return true;
            }

            if ($query->get('resource-collection')) {
                return true;
            }

            if ($query->get('resource-tag')) {
                return true;
            }
        }

        return $query->get('post_type') === $postType;
    }
}
