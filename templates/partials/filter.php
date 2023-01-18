<div class="c-filter">
    <?php if (!empty($title)) : ?>
        <h4 class="c-filter__title"><?php echo esc_html($title); ?>:</h4>
    <?php endif; ?>

    <div class="c-filter__select c-form__select">
        <select data-filter="<?php echo esc_attr($filter); ?>" class="c-form__input c-form__input--default">
            <?php if (!empty($placeholder)) : ?>
                <option value=""><?php echo esc_html($placeholder); ?></option>
            <?php endif; ?>

            <?php foreach ($options as $option) : ?>
                <option value="<?php echo esc_attr($option['value']); ?>" <?php echo $option['selected'] ? ' selected' : ''; ?>>
                    <?php echo esc_html($option['title']); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
</div>
