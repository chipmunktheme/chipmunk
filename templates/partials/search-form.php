<form action="<?php echo esc_url(home_url('/', 'relative')); ?>" method="get" class="c-form c-form--inline<?php echo !empty($narrow) ? ' c-form--narrow' : ''; ?>" role="search" novalidate data-validate autocomplete="off">
    <div class="c-form__field">
        <input type="text" name="s" placeholder="<?php esc_attr_e('Search query...', 'chipmunk'); ?>" value="<?php echo get_search_query(); ?>" class="c-form__input<?php echo !empty($default) ? ' c-form__input--default' : ''; ?>" required minlength="3">
        <button type="submit" class="c-form__button"><?php Chipmunk\Helpers::get_template_part('partials/icon', ['icon' => 'search']); ?></button>
    </div>
</form>
