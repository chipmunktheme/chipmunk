<?php chipmunk_get_template_part( 'partials/icon', array( 'icon' => 'tag' ) ); ?>

<?php echo chipmunk_display_term_list( $terms, isset( $args ) ? $args : array() ); ?>
