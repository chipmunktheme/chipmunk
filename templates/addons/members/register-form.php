</div><?php /* End of .c-entry__content class */ ?>

<?php if ($show_title) : ?>
    <h2 class="c-heading c-heading--h2"><?php esc_html_e('Register', 'chipmunk'); ?></h2>
<?php endif; ?>

<?php if (!empty($blocker)) : ?>
    <?php Chipmunk\Helpers::get_template_part('addons/members/partials/errors', ['errors' => [$blocker]], true); ?>
<?php else : ?>
    <form class="c-form" action="<?php echo esc_url(wp_registration_url()); ?>" method="post" novalidate data-validate>
        <?php Chipmunk\Helpers::get_template_part('addons/members/partials/errors', ['errors' => $errors], true); ?>
        <?php Chipmunk\Helpers::get_template_part('addons/members/partials/alerts', ['alerts' => $alerts], true); ?>

        <div class="c-form__field c-form__field--wide">
            <input type="text" name="username" placeholder="<?php esc_attr_e('Username', 'chipmunk'); ?>*" required class="c-form__input">
        </div>

        <div class="c-form__field c-form__field--wide">
            <input type="email" name="email" placeholder="<?php esc_attr_e('Email address', 'chipmunk'); ?>*" required class="c-form__input">
        </div>

        <div class="c-form__field">
            <input type="password" name="password" id="pass1" placeholder="<?php esc_attr_e('Password', 'chipmunk'); ?>*" required minlength="6" class="c-form__input">
        </div>

        <div class="c-form__field">
            <input type="password" name="password2" id="pass2" placeholder="<?php esc_attr_e('Confirm password', 'chipmunk'); ?>*" required minlength="6" data-parsley-equalto="#pass1" class="c-form__input">
        </div>

        <?php if (!empty(Chipmunk\Helpers::get_theme_option('recaptcha_enabled')) && Chipmunk\Helpers::get_theme_option('recaptcha_site_key')) : ?>
            <div class="c-form__field c-form__field--wide">
                <div class="g-recaptcha" id="register-recaptcha"></div>
            </div>
        <?php endif; ?>

        <div class="c-form__field c-form__field--wide c-form__field--cta">
            <button type="submit" class="c-button c-button--primary-outline"><?php esc_html_e('Register', 'chipmunk'); ?></button>
        </div>

        <div class="c-form__field c-form__field--wide c-form__field--cta">
            <a href="<?php echo esc_url(wp_login_url()); ?>" class="c-form__link">
                <?php esc_html_e('Already have an account?', 'chipmunk'); ?>
            </a>
        </div>
    </form>
<?php endif; ?>

<div class="c-entry__content c-content c-content--type"><?php /* Beginning of .c-entry__content class */ ?>
