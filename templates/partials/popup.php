<div class="popup">
	<div class="container">
		<div class="popup__content">
			<button class="popup__close" data-toggle="popup">
				<?php chipmunk_get_template( 'partials/icon', array( 'icon' => 'close' ) ); ?>
				<span class="sr-only"><?php esc_html_e( 'Close', 'chipmunk' ); ?></span>
			</button>

			<?php get_template_part( 'templates/sections/submit' ); ?>
		</div>

		<div class="popup__loader"></div>
	</div>
</div>
<!-- /.popup -->
