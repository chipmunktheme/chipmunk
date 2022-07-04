</div><?php /* End of .c-entry__content class */ ?>

<?php if ( $show_title ) : ?>
	<h2 class="c-heading c-heading--h2"><?php esc_html_e( 'Reset Password', 'chipmunk' ); ?></h2>
<?php endif; ?>

<?php if ( ! empty( $blocker ) ) : ?>
	<?php Chipmunk\Helpers::get_template_part( 'addons/members/partials/errors', [ 'errors' => [ $blocker ] ], true ); ?>
<?php else : ?>
	<form class="c-form" action="<?php echo site_url( 'wp-login.php?action=' . $action ); ?>" method="post" novalidate data-validate>
		<?php Chipmunk\Helpers::get_template_part( 'addons/members/partials/errors', [ 'errors' => $errors ], true ); ?>
		<?php Chipmunk\Helpers::get_template_part( 'addons/members/partials/alerts', [ 'alerts' => $alerts ], true ); ?>

		<div class="c-form__field c-form__field--wide">
			<input type="password" name="pass1" id="pass1" placeholder="<?php esc_attr_e( 'New password', 'chipmunk' ); ?>*" required class="c-form__input">
		</div>

		<div class="c-form__field c-form__field--wide">
			<input type="password" name="pass2" id="pass2" placeholder="<?php esc_attr_e( 'Confirm password', 'chipmunk' ); ?>*" required data-parsley-equalto="#pass1" class="c-form__input">
		</div>

		<div class="c-form__field c-form__field--wide">
			<p class="c-form__info"><?php echo wp_get_password_hint(); ?></p>
		</div>

		<div class="c-form__field c-form__field--wide c-form__field--cta">
			<button type="submit" class="c-button c-button--primary-outline"><?php esc_html_e( 'Reset Password', 'chipmunk' ); ?></button>
		</div>

		<input type="hidden" name="rp_key" value="<?php echo esc_attr( $key ); ?>" />
		<input type="hidden" name="rp_login" value="<?php echo esc_attr( $login ); ?>" />
	</form>
<?php endif; ?>

<div class="c-entry__content c-content c-content--type"><?php /* Beginning of .c-entry__content class */ ?>
