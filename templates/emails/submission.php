<h3><?php printf( esc_html__( '%s: New user submission', 'chipmunk' ), $name ); ?></h3>

<p>
	<strong><?php esc_html_e( 'Title', 'chipmunk' ); ?>:</strong><br>
	<?php echo $post->post_title; ?>
</p>

<p>
	<strong><?php esc_html_e( 'Collection', 'chipmunk' ); ?>:</strong><br>
	<?php echo implode( ', ', array_map( 'chipmunk_get_term_name', get_the_terms( $post->ID, 'resource-collection' ) ) ); ?>
</p>

<p>
	<strong><?php esc_html_e( 'Website URL', 'chipmunk' ); ?>:</strong><br>
	<a href="<?php echo esc_url( chipmunk_external_link( get_post_meta( $post->ID, '_' . THEME_SLUG . '_resource_website', true ) ) ); ?>" target="_blank"><?php esc_html_e( 'Visit website', 'chipmunk' ); ?></a>
</p>

<?php if ( ! empty( $post->post_content ) ) : ?>
	<p>
		<strong><?php esc_html_e( 'Description', 'chipmunk' ); ?>:</strong><br>
		<?php echo strip_tags( $post->post_content ); ?>
	</p>
<?php endif; ?>

<p>
	<a href="<?php echo admin_url( 'post.php?post=' . $post_id . '&action=edit' ); ?>"><strong>&raquo; <?php esc_html_e( 'Review submission', 'chipmunk' ); ?></strong></a>
</p>
