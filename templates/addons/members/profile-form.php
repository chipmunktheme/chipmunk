</div><?php /* End of .c-entry__content class */ ?>

<?php if ( $show_title ) : ?>
	<h2 class="c-heading c-heading--h2"><?php esc_html_e( 'Edit Profile', 'chipmunk' ); ?></h2>
<?php endif; ?>

<?php if ( ! empty( $blocker ) ) : ?>
	<?php Chipmunk\Helpers::get_template_part( 'addons/members/partials/errors', array( 'errors' => array( $blocker ) ), true ); ?>
<?php else : ?>
	<form class="c-form" action="<?php the_permalink(); ?>" method="post" novalidate data-validate>
		<?php Chipmunk\Helpers::get_template_part( 'addons/members/partials/errors', array( 'errors' => $errors ), true ); ?>
		<?php Chipmunk\Helpers::get_template_part( 'addons/members/partials/alerts', array( 'alerts' => $alerts ), true ); ?>

		<div class="c-form__field c-form__field--wide">
			<input type="email" name="email" placeholder="<?php esc_attr_e( 'Email address', 'chimpunk' ); ?>*" value="<?php echo esc_attr( $userdata->user_email ); ?>" required class="c-form__input">
		</div>

		<div class="c-form__field">
			<input type="text" name="first_name" placeholder="<?php esc_attr_e( 'First name', 'chimpunk' ); ?>" value="<?php echo esc_attr( $usermeta['first_name'] ); ?>" class="c-form__input">
		</div>

		<div class="c-form__field">
			<input type="text" name="last_name" placeholder="<?php esc_attr_e( 'Last name', 'chimpunk' ); ?>" value="<?php echo esc_attr( $usermeta['last_name'] ); ?>" class="c-form__input">
		</div>

		<div class="c-form__field c-form__field--wide">
			<input type="url" name="url" placeholder="<?php esc_attr_e( 'Website', 'chimpunk' ); ?>" value="<?php echo esc_attr( $userdata->user_url ); ?>" class="c-form__input">
		</div>

		<div class="c-form__field c-form__field--wide">
			<textarea rows="1" name="description" placeholder="<?php esc_attr_e( 'Description', 'chipmunk' ); ?>" class="c-form__input" data-dynamic-rows="10"><?php echo esc_attr( $usermeta['description'] ); ?></textarea>
		</div>

		<?php if ( ! empty( $usersocials ) ) : ?>
			<h3 class="c-form__field c-form__field--wide c-form__field--separated c-heading c-heading--h3"><?php esc_html_e( 'Socials', 'chipmunk' ); ?></h3>

			<?php foreach ( $usersocials as $social_key => $social ) : ?>
				<div class="c-form__field c-form__field--wide">
					<input type="url" name="<?php echo esc_attr( $social_key ); ?>" placeholder="<?php echo esc_attr( $social ); ?>" value="<?php echo esc_attr( isset( $usermeta[$social_key] ) ? $usermeta[$social_key] : '' ); ?>" class="c-form__input">
				</div>
			<?php endforeach; ?>
		<?php endif; ?>

		<div class="c-form__field c-form__field--wide c-form__field--cta">
			<input type="hidden" name="action" value="chipmunk_update_user" />
			<input type="hidden" name="user_id" value="<?php echo $userdata->ID; ?>">

			<button type="submit" class="c-button c-button--primary-outline"><?php esc_html_e( 'Update', 'chipmunk' ); ?></button>
		</div>
	</form>
<?php endif; ?>

<div class="c-entry__content c-content c-content--type"><?php /* Beginning of .c-entry__content class */ ?>
