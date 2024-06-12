<h2><?php $subject; ?></h2>

<p>
    <strong><?php esc_html_e('Title', 'chipmunk'); ?>:</strong><br>
    <?php echo $post->post_title; ?>
</p>

<p>
    <strong><?php esc_html_e('Collection', 'chipmunk'); ?>:</strong><br>
    <?php echo implode(', ', array_column(get_the_terms($post->ID, 'resource-collection'), 'name')); ?>
</p>

<p>
    <strong><?php esc_html_e('Website URL', 'chipmunk'); ?>:</strong><br>
    <a href="<?php echo esc_url(Chipmunk\Helpers::render_external_link(get_post_meta($post->ID, '_' . THEME_SLUG . '_resource_website', true))); ?>" target="_blank"><?php esc_html_e('Visit website', 'chipmunk'); ?></a>
</p>

<?php if (!empty($submitter)) : ?>
    <p>
        <strong><?php esc_html_e('Submitter', 'chipmunk'); ?>:</strong><br>
        <?php echo esc_html($submitter); ?>
    </p>
<?php endif; ?>

<?php if (!empty($post->post_content)) : ?>
    <p>
        <strong><?php esc_html_e('Description', 'chipmunk'); ?>:</strong><br>
        <?php echo strip_tags($post->post_content); ?>
    </p>
<?php endif; ?>

<p>
    <a href="<?php echo admin_url('post.php?post=' . $post->ID . '&action=edit'); ?>"><strong>&raquo; <?php esc_html_e('Review submission', 'chipmunk'); ?></strong></a>
</p>
