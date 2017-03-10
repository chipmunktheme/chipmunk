<div class="section section_theme-gray">
	<div class="container">
		<?php echo chipmunk_conditional_markup( is_front_page(), 'h2', 'h1', 'heading heading_md', __( 'Collections', 'chipmunk' ) ); ?>

		<div class="row">
			<?php
			$collections = get_terms( 'resource-collection', array(
				'orderby'     => 'name',
				'hide_empty'  => 0,
				'pad_counts'  => true,
			) );

			// Remove children from the listing
			// http://wordpress.stackexchange.com/a/48630/58550
			$collections = wp_list_filter( $collections, array( 'parent' => 0 ) );
			?>

			<?php if ( ! empty( $collections ) ) : ?>
				<?php foreach ( $collections as $collection ) : ?>
					<?php include locate_template( 'sections/collection-tile.php' ); ?>
				<?php endforeach; ?>
			<?php else : ?>
				<div class="column">
					<?php if ( current_user_can( 'publish_posts' ) ) : ?>
						<p class="text_content text_separated"><?php printf( __( 'Ready to publish your first collection? <a href="%1$s">Get started here</a>.', 'chipmunk' ), esc_url( admin_url( 'edit-tags.php?taxonomy=resource-collection&post_type=resource' ) ) ); ?></p>
					<?php else : ?>
						<p class="text_content text_separated"><?php _e( 'Sorry, there are no collections to display yet.', 'chipmunk' ); ?></p>
					<?php endif; ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>
<!-- /.section -->
