<?php Chipmunk\Helpers::get_template_part( 'partials/icon', array( 'icon' => $icon ?? 'tag' ) ); ?>

<?php echo Chipmunk\Helpers::display_term_list( $terms, $args ?? array() ); ?>
