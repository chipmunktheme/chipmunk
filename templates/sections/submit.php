<?php $action = 'submit_resource'; ?>
<?php $salt = Chipmunk\Helpers::get_salt( 5 ); ?>
<?php $alignment = isset( $popup ) ? 'center' : 'left'; ?>
<?php $required_fields = apply_filters( 'chipmunk_submission_required_fields', [ 'name', 'collection', 'url' ] ); ?>

<?php if ( ! empty( $title ) ) : ?>
	<div class="l-component">
		<h4 class="c-heading c-heading--h1 u-text--<?php echo esc_attr( $alignment ); ?>"><?php echo esc_html( $title ); ?></h4>
	</div>
<?php endif; ?>

<form action="#" class="c-form u-loader <?php echo esc_attr( ! empty( $popup ) ? 'l-component l-component--md' : '' ); ?>" novalidate data-validate data-action="<?php echo $action; ?>" data-action-event="submit">
	<p class="c-form__message c-content c-content--type" data-action-message="<?php echo $action; ?>"></p>

	<input type="hidden" name="filter" value="">
	<?php wp_nonce_field( $action, 'nonce', false ); ?>

	<div class="c-form__content" data-action-element="<?php echo $action; ?>">
		<div class="c-form__field">
			<input type="text" name="name" placeholder="<?php esc_attr_e( 'Resource name', 'chipmunk' ); ?>" class="c-form__input" <?php echo in_array( 'name', $required_fields ) ? 'required' : ''; ?>>
		</div>

		<div class="c-form__field">
			<div class="c-form__select">
				<select name="collection" class="c-form__input" <?php echo in_array( 'collection', $required_fields ) ? 'required' : ''; ?>>
					<option value=""><?php esc_html_e( 'Collection', 'chipmunk' ); ?></option>
					<?php
						$collections = Chipmunk\Helpers::get_taxonomy_hierarchy( 'resource-collection', [
							'hide_empty' => false,
						] );
					?>

					<?php if ( ! empty( $collections ) ) : ?>
						<?php Chipmunk\Helpers::display_terms( $collections ); ?>
					<?php endif; ?>
				</select>
			</div>

			<div class="c-form__error" data-validate-message="collection"></div>
		</div>

		<div class="c-form__field">
			<input type="url" name="url" placeholder="<?php esc_attr_e( 'Website URL', 'chipmunk' ); ?>" class="c-form__input" <?php echo in_array( 'url', $required_fields ) ? 'required' : ''; ?>>
		</div>

		<div class="c-form__field">
			<textarea rows="1" name="content" placeholder="<?php esc_attr_e( 'Description', 'chipmunk' ); ?>" class="c-form__input" <?php echo in_array( 'content', $required_fields ) ? 'required' : ''; ?> data-dynamic-rows></textarea>
		</div>

		<?php if ( ! Chipmunk\Helpers::get_theme_option( 'disable_submitter_info' ) && ! is_user_logged_in() ) : ?>
			<div class="c-form__field">
				<input type="text" name="submitter_name" placeholder="<?php esc_attr_e( 'Your name', 'chipmunk' ); ?>" class="c-form__input" required>
			</div>

			<div class="c-form__field">
				<input type="email" name="submitter_email" placeholder="<?php esc_attr_e( 'Your email', 'chipmunk' ); ?>" class="c-form__input" required>
			</div>
		<?php endif; ?>

		<?php if ( ! empty( Chipmunk\Helpers::get_theme_option( 'submission_consent' ) ) ) : ?>
			<label class="c-form__field c-form__field--wide c-form__checkbox" data-consent>
				<input type="checkbox" name="consent" required>
				<p><?php echo esc_html( Chipmunk\Helpers::get_theme_option( 'submission_consent' ) ); ?></p>
			</label>
		<?php endif; ?>

		<?php if ( ! empty( Chipmunk\Helpers::get_theme_option( 'recaptcha_enabled' ) ) && ! is_user_logged_in() ) : ?>
			<div class="c-form__field c-form__field--wide c-form__field--<?php echo esc_attr( $alignment ); ?>">
				<div class="g-recaptcha" id="submit-recaptcha"></div>
			</div>
		<?php endif; ?>

		<div class="c-form__field c-form__field--wide c-form__field--cta c-form__field--<?php echo esc_attr( $alignment ); ?>">
			<button type="submit" class="c-button c-button--primary-outline"><?php esc_html_e( 'Submit', 'chipmunk' ); ?></button>
		</div>
	</div>
</form>
