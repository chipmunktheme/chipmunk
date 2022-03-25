</div><?php /* End of .c-entry__content class */ ?>

<?php if ( $show_title ) : ?>
	<h2 class="c-heading c-heading--h2"><?php esc_html_e( 'Forgot Your Password?', 'chipmunk' ); ?></h2>
<?php endif; ?>

<?php if ( ! empty( $blocker ) ) : ?>
	<?php Chipmunk\Helpers::get_template_part( 'addons/members/partials/errors', array( 'errors' => array( $blocker ) ), true ); ?>
<?php else : ?>
	<form class="c-form" action="<?php echo esc_url( wp_lostpassword_url( $redirect_to ) ); ?>" method="post" novalidate data-validate>
		<?php Chipmunk\Helpers::get_template_part( 'addons/members/partials/errors', array( 'errors' => $errors ), true ); ?>
		<?php Chipmunk\Helpers::get_template_part( 'addons/members/partials/alerts', array( 'alerts' => $alerts ), true ); ?>

		<div class="c-form__field c-form__field--wide">
			<p class="c-form__info"><?php esc_html_e( 'Enter your username or email address and we\'ll send you a link you can use to pick a new password.', 'chipmunk' ); ?></p>
		</div>

		<div class="c-form__field c-form__field--wide">
			<input type="text" name="user_login" placeholder="<?php esc_attr_e( 'Username or Email Address', 'chipmunk' ); ?>*" required minlength="3" class="c-form__input">
		</div>

		<div class="c-form__field c-form__field--wide c-form__field--cta">
			<button type="submit" class="c-button c-button--primary-outline"><?php esc_html_e( 'Reset Password', 'chipmunk' ); ?></button>
		</div>

		<input type="hidden" name="redirect_to" value="<?php echo esc_url( $redirect_to ?? '' ); ?>">
	</form>
<?php endif; ?>

<div class="c-entry__content c-content c-content--type"><?php /* Beginning of .c-entry__content class */ ?>
