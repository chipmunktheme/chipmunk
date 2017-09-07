<h4 class="heading heading_xl text_center"><?php esc_html_e( 'Submit', 'chipmunk' ); ?></h4>

<p class="form__message heading heading_thin" style="display: none;" data-remote-message></p>

<form action="#" method="post" enctype="multipart/form-data" class="form" novalidate data-remote-form="submit_resource" data-parsley-validate>
	<div class="form__field">
		<div class="form__child">
			<input type="text" name="name" placeholder="<?php esc_attr_e( 'Resource name', 'chipmunk' ); ?>" required>
		</div>

		<div class="form__child">
			<select name="collection" data-placeholder="<?php esc_attr_e( 'Collection', 'chipmunk' ); ?>" data-parsley-errors-container=".collection-errors" class="custom-select" required>
				<option value=""><?php esc_html_e( 'Collection', 'chipmunk' ); ?></option>
				<?php
				$collections = get_terms( array(
					'taxonomy'   => 'resource-collection',
					'orderby'    => 'name',
					'hide_empty' => false,
					'parent'     => 0,
				) );
				?>

				<?php if ( ! empty( $collections ) ) : ?>
					<?php foreach ( $collections as $collection ) : ?>
						<option value="<?php echo $collection->term_id; ?>"><?php echo $collection->name; ?></option>
					<?php endforeach; ?>
				<?php endif; ?>
			</select>

			<div class="collection-errors"></div>
		</div>
	</div>

	<div class="form__field">
		<div class="form__child">
			<input type="url" name="website" placeholder="<?php esc_attr_e( 'Website URL', 'chipmunk' ); ?>" required>
		</div>

		<div class="form__child">
			<input type="text" name="content" placeholder="<?php esc_attr_e( 'Description', 'chipmunk' ); ?>">
		</div>
	</div>

	<?php if ( ! chipmunk_theme_option( 'disable_submitter_info' ) ) : ?>
		<div class="form__field form__field_separated">
			<div class="form__child">
				<input type="text" name="submitter_name" placeholder="<?php esc_attr_e( 'Your name', 'chipmunk' ); ?>" required>
			</div>

			<div class="form__child">
				<input type="email" name="submitter_email" placeholder="<?php esc_attr_e( 'Your email', 'chipmunk' ); ?>" required>
			</div>
		</div>
	<?php endif; ?>

	<div class="form__field form__field_center">
		<?php if ( $recaptcha = chipmunk_theme_option( 'recaptcha_site_key' ) ) : ?>
			<div class="g-recaptcha" data-sitekey="<?php echo esc_attr( $recaptcha ); ?>"></div>
		<?php endif; ?>

		<?php wp_nonce_field( 'submit_resource', 'nonce', false ); ?>
		<button type="submit" class="button button_secondary"><?php esc_html_e( 'Submit', 'chipmunk' ); ?></button>
	</div>
</form>
