<a href="<?php echo esc_url( chipmunk_external_link( $link['url'] ) ); ?>" class="button <?php echo isset( $class ) ? esc_attr( $class ) : ''; ?>" <?php echo isset( $link['target'] ) ? 'target="' . esc_attr( $link['target'] ) . '"' : ''; ?>>
    <?php echo esc_html( $link['title'] ); ?>
</a>
