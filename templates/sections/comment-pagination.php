<?php
	$previous_content = chipmunk_get_template( 'partials/icon', array( 'icon' => 'chevron-left' ), false ) . esc_html__( 'Older', 'chipmunk' );
	$previous_link = get_previous_comments_link( $previous_content );

	$next_content = esc_html__( 'Newer', 'chipmunk' ) . chipmunk_get_template( 'partials/icon', array( 'icon' => 'chevron-right' ), false );
	$next_link = get_next_comments_link( $next_content );
?>

<?php if ( ! empty( $previous_link ) or ! empty( $next_link ) ) : ?>
	<ul class="pagination pagination__nav">
		<li class="pagination__item<?php echo empty( $previous_link ) ? ' pagination__item--disabled' : ''; ?>">
			<?php echo isset( $previous_link ) ? $previous_link : $previous_content; ?>
		</li>

		<li class="pagination__item<?php echo empty( $next_link ) ? ' pagination__item--disabled' : ''; ?>">
			<?php echo isset( $next_link ) ? $next_link : $next_content; ?>
		</li>
	</ul>
	<!-- /.pagination -->
<?php endif; ?>
