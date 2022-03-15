<?php if ( ! empty( Chipmunk\Customizer::get_theme_option( 'submit_page' ) ) ) : ?>
	<a href="<?php echo esc_url( get_permalink( Chipmunk\Customizer::get_theme_option( 'submit_page' ) ) ); ?>" class="<?php echo esc_attr( ! empty( $class ) ? $class : '' ); ?>">
		<?php esc_html_e( 'Submit', 'chipmunk' ); ?>
	</a>
<?php else : ?>
	<button type="button" data-popup="#submit" class="<?php echo esc_attr( ! empty( $class ) ? $class : '' ); ?>">
		<?php esc_html_e( 'Submit', 'chipmunk' ); ?>
	</button>
<?php endif; ?>
