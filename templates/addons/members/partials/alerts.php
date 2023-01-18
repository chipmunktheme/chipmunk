<?php if (!empty($alerts)) : ?>
    <?php foreach ($alerts as $alert) : ?>
        <div class="c-form__field c-form__field--wide">
            <p class="c-form__info c-form__info--<?php echo esc_attr($alert['type']); ?>">
                <?php echo esc_html($alert['message']); ?>
            </p>
        </div>
    <?php endforeach; ?>
<?php endif; ?>
