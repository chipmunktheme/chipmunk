<?php if (Chipmunk\Helpers::is_feature_enabled('ratings', get_post_type()) && Chipmunk\Helpers::is_addon_enabled('ratings')) : ?>
    <?php $average_rating = Chipmunk\Addons\Ratings\Helpers::get_post_rating(get_the_ID()); ?>

    <?php if (!empty($average_rating)) : ?>
        <li class="c-stats__item c-stats__item--ratings" title="<?php esc_attr_e('Ratings', 'chipmunk'); ?>">
            <?php Chipmunk\Helpers::get_template_part('partials/icon', ['icon' => 'star']); ?>
            <?php echo esc_html($average_rating); ?>
        </li>
    <?php endif; ?>
<?php endif; ?>
