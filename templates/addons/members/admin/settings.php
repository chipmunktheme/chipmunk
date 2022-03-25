<div class="wrap">
	<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
	<hr>

	<?php settings_errors(); ?>

	<form action="options.php" method="post">
		<?php
			settings_fields( 'chipmunk_members_pages' );
			do_settings_sections( 'chipmunk_members_pages' );
		?>

		<?php submit_button(); ?>
	</form>
</div>
