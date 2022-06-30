<a href="<?php echo esc_url( Chipmunk\Helpers::render_external_link( $link['url'] ) ); ?>" class="c-button <?php echo esc_attr( $class ?? '' ); ?>" <?php echo isset( $link['target'] ) ? 'target="' . esc_attr( $link['target'] ) . '"' : ''; ?>>
	<?php echo esc_html( $link['title'] ); ?>
</a>
