</div><?php /* End of .c-entry__content class */ ?>

<?php if ($show_title) : ?>
    <h2 class="c-heading c-heading--h2"><?php esc_html_e('Login', 'chipmunk'); ?></h2>
<?php endif; ?>

<?php if (!empty($blocker)) : ?>
    <?php Chipmunk\Helpers::get_template_part('addons/members/partials/errors', ['errors' => [$blocker]], true); ?>
<?php else : ?>
    <form class="c-form" action="<?php echo esc_url(site_url('wp-login.php')); ?>" method="post" novalidate data-validate>
        <?php Chipmunk\Helpers::get_template_part('addons/members/partials/errors', ['errors' => $errors], true); ?>
        <?php Chipmunk\Helpers::get_template_part('addons/members/partials/alerts', ['alerts' => $alerts], true); ?>

        <div class="c-form__field c-form__field--wide">
            <input type="text" name="log" placeholder="<?php esc_attr_e('Username or Email Address', 'chimpunk'); ?>*" required minlength="3" class="c-form__input">
        </div>

        <div class="c-form__field c-form__field--wide">
            <input type="password" name="pwd" placeholder="<?php esc_attr_e('Password', 'chimpunk'); ?>*" required class="c-form__input">
        </div>

        <div class="c-form__field c-form__field--wide c-form__field--cta">
            <button type="submit" class="c-button c-button--primary-outline"><?php esc_html_e('Login', 'chipmunk'); ?></button>

            <label class="c-form__checkbox"><input type="checkbox" name="rememberme" value="forever"> <?php esc_attr_e('Remember me', 'chimpunk'); ?></label>
        </div>

        <div class="c-form__field c-form__field--wide c-form__field--cta">
            <a href="<?php echo esc_url(wp_lostpassword_url($redirect_to ?? '')); ?>" class="c-form__link">
                <?php esc_html_e('Forgot your password?', 'chipmunk'); ?>
            </a>

            <?php if (get_option('users_can_register')) : ?>
                <a href="<?php echo esc_url(wp_registration_url()); ?>" class="c-form__link">
                    <?php esc_html_e('Register an account', 'chipmunk'); ?>
                </a>
            <?php endif; ?>
        </div>

        <input type="hidden" name="redirect_to" value="<?php echo esc_url($redirect_to ?? ''); ?>">
    </form>
<?php endif; ?>

<div class="c-entry__content c-content c-content--type"><?php /* Beginning of .c-entry__content class */ ?>
