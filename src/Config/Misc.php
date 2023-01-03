<?php

namespace Chipmunk\Config;

use MadeByLess\Lessi\Helper\HelperTrait;
use Chipmunk\Theme;
use Chipmunk\Helper\AddonTrait;
use Chipmunk\Helper\PostTrait;

/**
 * Miscellaneous config hooks.
 */
class Misc extends Theme
{
    use AddonTrait;
    use HelperTrait;
    use PostTrait;

    /**
     * Hooks methods of this object into the WordPress ecosystem.
     */
    public function initialize()
    {
        $this->addAction('wp_insert_post', [ $this, 'addDefaultMeta' ]);
        $this->addFilter('the_content', [ $this, 'normalizeContentWhitespace' ], 10, 1);
        $this->addFilter('user_contactmethods', [ $this, 'addContactMethods' ], 99, 2);
    }

    /**
     * Sets default meta values for likes, upvotes and ratings.
     *
     * @see https://developer.wordpress.org/reference/hooks/wp_insert_post
     *
     * @param int $postId
     */
    public function addDefaultMeta(int $postId)
    {
        $meta = [
            $this->buildPrefixedThemeSlug('post_view_count') => 0,
            $this->buildPrefixedThemeSlug('upvote_count') => 0,
        ];

        if ($this->isAddonEnabled('ratings')) {
            $meta[ $this->buildPrefixedThemeSlug('rating_count') ] = 0;
            $meta[ $this->buildPrefixedThemeSlug('rating_average') ] = 0;
            $meta[ $this->buildPrefixedThemeSlug('rating_rank') ] = 0;
        }

        $this->addPostMeta($postId, $meta, [ 'post', 'resource' ]);
    }

    /**
     * Normalize EOL characters and strip duplicate whitespace.
     *
     * @see https://developer.wordpress.org/reference/hooks/the_content
     *
     * @param string $content
     */
    public function normalizeContentWhitespace(string $content): string
    {
        return normalize_whitespace($content);
    }

    /**
     * Changes the user contact methods.
     *
     * @see https://developer.wordpress.org/reference/hooks/user_contactmethods
     *
     * @param string[] $methods
     */
    public function addContactMethods(array $methods): array
    {
        $socials    = config()->getSocials();
        $socials    = array_filter($socials, fn($el) => $el !== 'Email');
        $socialKeys = array_map(fn($el) => sanitize_title($socials[ $el ]), array_keys($socials));

        return array_merge($methods, array_combine($socialKeys, $socials));
    }
}
