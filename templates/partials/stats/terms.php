<?php if (Chipmunk\Helpers::is_feature_enabled('terms', get_post_type())) : ?>
    <?php $taxonomy = $term_args['taxonomy'] ?? 'category'; ?>
    <?php $terms = wp_get_post_terms(get_the_ID(), $taxonomy); ?>

    <?php if (!empty($terms) && !is_wp_error($terms)) : ?>
        <li class="c-stats__item c-stats__item--terms<?php echo isset($term_args['desktop_only']) ? ' u-visible-lg-flex' : ''; ?>" title="<?php esc_attr_e('Terms', 'chipmunk'); ?>">
            <?php Chipmunk\Helpers::get_template_part('partials/icon', ['icon' => $taxonomy == 'resource-collection' ? 'collection' : 'tag']); ?>
            <?php echo Chipmunk\Helpers::display_term_list($terms, $term_args ?? []); ?>
        </li>
    <?php endif; ?>
<?php endif; ?>
