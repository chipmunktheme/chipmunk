<?php $action = esc_url( chipmunk_theme_option( 'newsletter_action' ) ); ?>
<?php $email_field = 'email'; ?>
<?php $args = array(); ?>

<?php if ( strpos( $action, 'list-manage.com' ) ) : ?>
	<?php $email_field = 'EMAIL'; ?>
<?php endif; ?>

<?php if ( strpos( $action, 'convertkit.com' ) ) : ?>
	<?php $email_field = 'email_address'; ?>
<?php endif; ?>

<?php if ( strpos( $action, 'getrevue.co' ) ) : ?>
	<?php $email_field = 'member[email]'; ?>
<?php endif; ?>

<?php if ( strpos( $action, 'aweber.com' ) ) : ?>
	<?php $args = wp_parse_args( wp_parse_url( $action )['query'] ); ?>
	<?php $args['meta_required'] = 'email'; ?>
	<?php $args['redirect'] = ''; ?>
<?php endif; ?>

<?php if ( ! chipmunk_theme_option( 'disable_newsletter' ) and ! empty( $action ) ) : ?>
	<div class="section section--theme-primary text--center">
		<div class="container">
			<div class="column column--lg-8 column--lg-offset-2">
				<h4 class="heading heading--xl"><?php esc_html_e( 'Newsletter', 'chipmunk' ); ?></h4>
				<p class="heading heading--thin"><?php echo esc_html( chipmunk_theme_option( 'newsletter_tagline' ) ); ?></p>
			</div>

			<div class="row">
				<form action="<?php echo stripslashes( trim( $action, '" ' ) ); ?>" method="post" class="form form--compact column column--md-4 column--md-offset-1 column--lg-6 column--lg-offset-3 mt-sm-2" target="_blank" novalidate data-validate>
					<div class="form__field">
						<input type="email" name="<?php echo $email_field; ?>" placeholder="<?php esc_html_e( 'Email address', 'chipmunk' ); ?>" class="form__input" required>
					</div>

					<?php if ( ! empty( chipmunk_theme_option( 'newsletter_consent' ) ) ) : ?>
						<div class="form__field" data-consent>
							<?php chipmunk_get_template( 'partials/checkbox', array( 'name' => 'consent', 'label' => chipmunk_theme_option( 'newsletter_consent' ), 'required' => true ) ); ?>
						</div>
					<?php endif; ?>

					<div class="form__field form__field--center">
						<button type="submit" class="button button--white-outline"><?php esc_html_e( 'Join now', 'chipmunk' ); ?></button>
					</div>

					<?php if ( ! empty( $args ) ) : ?>
						<?php foreach ( $args as $key => $value ) : ?>
							<input type="hidden" name="<?php echo esc_attr( $key ); ?>" value="<?php echo esc_attr( $value ); ?>">
						<?php endforeach; ?>
					<?php endif; ?>
				</form>
			</div>
		</div>
	</div>
	<!-- /.section -->
<?php endif; ?>
