<div class="popup">
	<div class="container">
		<div class="popup__content">
			<button class="popup__close" data-popup-toggle>
				<i class="icon icon_close"></i>
				<span class="sr-only"><?php esc_html_e( 'Close', 'chipmunk' ); ?></span>
			</button>

			<?php get_template_part( 'sections/submit' ); ?>
		</div>

		<div class="popup__loader"></div>
	</div>
</div>
<!-- /.popup -->
