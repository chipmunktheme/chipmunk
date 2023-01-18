<?php $action = esc_url(Chipmunk\Helpers::get_theme_option('newsletter_action')); ?>
<?php $email_field = 'email'; ?>
<?php $args = []; ?>

<?php if (strpos($action, 'list-manage.com')) : ?>
    <?php $email_field = 'EMAIL'; ?>
<?php endif; ?>

<?php if (strpos($action, 'convertkit.com')) : ?>
    <?php $email_field = 'email_address'; ?>
<?php endif; ?>

<?php if (strpos($action, 'getrevue.co')) : ?>
    <?php $email_field = 'member[email]'; ?>
<?php endif; ?>

<?php if (strpos($action, 'aweber.com')) : ?>
    <?php $args = wp_parse_args(wp_parse_url($action)['query']); ?>
    <?php $args['meta_required'] = 'email'; ?>
    <?php $args['redirect'] = ''; ?>
<?php endif; ?>

<?php if (!Chipmunk\Helpers::get_theme_option('disable_newsletter') && !empty($action)) : ?>
    <div class="l-section l-section--theme-primary">
        <div class="l-container">
            <div class="l-wrapper">
                <div class="c-lead c-lead--center">
                    <h4 class="c-lead__title c-heading c-heading--h1"><?php esc_html_e('Newsletter', 'chipmunk'); ?></h4>
                    <p class="c-lead__content c-content c-content--type"><?php echo esc_html(Chipmunk\Helpers::get_theme_option('newsletter_tagline')); ?></p>

                    <form action="<?php echo stripslashes(trim($action, '" ')); ?>" method="post" class="c-lead__cta c-form c-form--inline c-form--narrow" target="_blank" novalidate data-validate>
                        <div class="c-form__field">
                            <input type="email" name="<?php echo $email_field; ?>" placeholder="<?php esc_html_e('Email address', 'chipmunk'); ?>" class="c-form__input" required autocomplete="off">
                            <button type="submit" class="c-form__button"><?php Chipmunk\Helpers::get_template_part('partials/icon', ['icon' => 'arrow-right']); ?></button>
                        </div>

                        <?php if (!empty(Chipmunk\Helpers::get_theme_option('newsletter_consent'))) : ?>
                            <label class="c-form__field c-form__checkbox" data-consent>
                                <input type="checkbox" name="consent" required>
                                <p><?php echo esc_html(Chipmunk\Helpers::get_theme_option('newsletter_consent')); ?></p>
                            </label>
                        <?php endif; ?>
                        <?php if (!empty($args)) : ?>
                            <?php foreach ($args as $key => $value) : ?>
                                <input type="hidden" name="<?php echo esc_attr($key); ?>" value="<?php echo esc_attr($value); ?>">
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
