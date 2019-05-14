<?php $counter = chipmunk_get_post_count( $attributes['type'], $attributes['status'] ); ?>

<?php if ( ! empty( $counter ) ) : ?>
	<?php echo esc_html( $counter ); ?>
<?php endif; ?>
