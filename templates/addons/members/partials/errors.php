<?php if (!empty($errors)) : ?>
    <?php foreach ($errors as $error) : ?>
        <div class="c-form__field c-form__field--wide">
            <p class="c-form__info c-form__info--error">
                <?php echo esc_html($error); ?>
            </p>
        </div>
    <?php endforeach; ?>
<?php endif; ?>
