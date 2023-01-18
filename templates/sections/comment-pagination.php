<?php
$previous_content = Chipmunk\Helpers::get_template_part('partials/icon', ['icon' => 'arrow-left'], false) . esc_html__('Older', 'chipmunk');
$previous_link = get_previous_comments_link($previous_content);

$next_content = esc_html__('Newer', 'chipmunk') . Chipmunk\Helpers::get_template_part('partials/icon', ['icon' => 'arrow-right'], false);
$next_link = get_next_comments_link($next_content);
?>

<?php if (!empty($previous_link) || !empty($next_link)) : ?>
    <ul class="c-pagination l-component l-component--md">
        <li class="c-pagination__item<?php echo empty($previous_link) ? ' c-pagination__item--disabled' : ''; ?>">
            <?php echo $previous_link ?? "<span>$previous_content</span>"; ?>
        </li>

        <li class="c-pagination__item<?php echo empty($next_link) ? ' c-pagination__item--disabled' : ''; ?>">
            <?php echo $next_link ?? "<span>$next_content</span>"; ?>
        </li>
    </ul>
<?php endif; ?>
