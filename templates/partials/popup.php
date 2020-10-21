<div class="popup">
	<div class="container">
		<div class="popup__content" data-popup-content>
			<div class="popup__inner">
				<?php chipmunk_get_template_part( 'sections/submit', array( 'title' => esc_html__( 'Submit', 'chipmunk' ), 'popup' => true ) ); ?>
			</div>

			<button class="popup__close" onclick="closePanels()">
				<?php chipmunk_get_template_part( 'partials/icon', array( 'icon' => 'close' ) ); ?>
				<span class="sr-only"><?php esc_html_e( 'Close', 'chipmunk' ); ?></span>
			</button>
		</div>
	</div>
</div>
<!-- /.popup -->
