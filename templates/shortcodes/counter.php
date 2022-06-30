<?php $counter = Chipmunk\Helpers::get_post_count( $attributes['type'], $attributes['status'] ); ?>

<?php if ( ! empty( $counter ) ) : ?>
	<?php echo esc_html( (string) $counter ); ?>
<?php endif; ?>
