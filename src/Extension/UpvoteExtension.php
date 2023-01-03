<?php

namespace Chipmunk\Extension;

use Timber\Timber;
use MadeByLess\Lessi\Factory\Singleton;
use MadeByLess\Lessi\Helper\HelperTrait;
use Chipmunk\Helper\AddonTrait;
use Chipmunk\Helper\OptionTrait;

/**
 * Upvote extension class
 */
class UpvoteExtension extends Singleton
{
    use AddonTrait;
    use HelperTrait;
    use OptionTrait;

    /**
     * Database key name for upvotes
     *
     * @var string
     */
    private string $dbKey;

    /**
     * Database key name for upvote counters
     *
     * @var string
     */
    private string $dbKeyCount;

    /**
     * Current post ID
     *
     * @var int|null
     */
    private ?int $postId;

    /**
     * Currently logged in user or IP address
     *
     * @var int|string
     */
    private $userId;

    /**
     * Class constructor.
     */
    public function __construct()
    {
        $useIP = ! ( $this->isAddonEnabled('members') && $this->getOption('restrict_guest_upvotes') );

        $this->dbKey = $this->buildPrefixedThemeSlug('upvote');
        $this->dbKeyCount = $this->buildPrefixedThemeSlug('upvote_count');
        $this->userId = get_current_user_id() ?: ( $useIP ? $this->getIP() : null );
    }

    /**
     * Sets the post ID for the class
     *
     * @param int $postId
     */
    public function setPostId(int $postId)
    {
        $this->postId = intval(wp_filter_kses($postId));
    }

    /**
     * Output the upvote button
     *
     * @param string $action
     * @param string $class
     *
     * @return string
     */
    public function getButton(string $action, string $class = ''): string
    {
        $upvoted = $this->isUpvoted();
        $content = $this->getContent($upvoted);

        if ($upvoted) {
            $class .= ' is-active';
            $title  = esc_html__('Remove upvote', 'chipmunk');
        } else {
            $title = esc_html__('Upvote', 'chipmunk');
        }

        return "<span class='$class' title='$title' data-action='$action' data-action-event='click' data-action-post-id='$this->postId'>$content</span>";
    }

    /**
     * Retrieves proper content template
     *
     * @return string
     */
    public function getContent(): string
    {
        $icon  = Timber::compile('partials/icon.twig', [ 'icon' => 'thumbs-up' ]);
        $label = $this->formatNumber($this->getUpvoteCount() ?? 0);

        return "<span>{$icon}{$label}</span>";
    }

    /**
     * Toggles post upvote status
     *
     * @return array
     */
    private function toggleUpvote(): array
    {
        $upvoted = $this->isUpvoted();
        $counter = (int) get_post_meta($this->postId, $this->dbKeyCount, true) ?: 0;

        // Remove upvote from the post
        if ($upvoted) {
            delete_post_meta($this->postId, $this->dbKey, $this->userId);
            update_post_meta($this->postId, $this->dbKeyCount, $counter > 0 ? --$counter : 0);

            $response['status'] = 'remove';
        }

        // Upvote the post
        else {
            add_post_meta($this->postId, $this->dbKey, $this->userId);
            update_post_meta($this->postId, $this->dbKeyCount, ++$counter);

            $response['status'] = 'add';
        }

        // Set proper resounse params
        $response['post']    = $this->postId;
        $response['content'] = $this->getContent(! $upvoted);

        return $response;
    }

    /**
     * Tests if the post is already upvoted
     *
     * @return bool
     */
    private function isUpvoted(): bool
    {
        return in_array($this->userId, get_post_meta($this->postId, $this->dbKey));
    }

    /**
     * Utility retrieves upvote count for post,
     * returns appropriate number
     *
     * @return int
     */
    private function getUpvoteCount(): int
    {
        return (int) get_post_meta($this->postId, $this->dbKeyCount, true) ?: 0;
    }

    /**
     * Processes the upvote request
     */
    public function process()
    {
        // Check required attributes
        if (empty($this->postId) || empty($this->userId)) {
            wp_send_json_error(__('Not permitted.', 'chipmunk'));
        }

        // Set proper Post meta values
        $params = $this->toggleUpvote();

        // Return success response
        wp_send_json_success($params);
    }
}
