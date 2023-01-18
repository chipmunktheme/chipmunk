<?php $stat_output = ''; ?>

<?php foreach ($stats as $stat => $args) : ?>
    <?php if (isset($args)) : ?>
        <?php $stat_output .= Chipmunk\Helpers::get_template_part("partials/stats/$stat", $args, false); ?>
    <?php endif; ?>
<?php endforeach; ?>

<?php if (!empty($stat_output)) : ?>
    <ul class="c-stats <?php echo esc_attr($class ?? ''); ?>">
        <?php echo $stat_output; ?>
    </ul>
<?php endif; ?>
