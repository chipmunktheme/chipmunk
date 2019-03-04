<div class="section">
	<div class="container">
		<?php echo chipmunk_conditional_markup( is_front_page(), 'h2', 'h1', 'heading heading--md', esc_html__( 'Collections', 'chipmunk' ) ); ?>

		<div class="row">
			<?php
			$collections = get_terms( array(
				'taxonomy'    => 'resource-collection',
				'orderby'     => 'name',
				'pad_counts'  => true,
			) );

			// Remove children from the listing
			// http://wordpress.stackexchange.com/a/48630/58550
			$collections = wp_list_filter( $collections, array( 'parent' => 0 ) );
			?>

			<?php if ( ! empty( $collections ) ) : ?>
				<?php foreach ( $collections as $collection ) : ?>
					<?php chipmunk_get_template( 'sections/collection-tile', array( 'collection' => $collection ) ); ?>
				<?php endforeach; ?>
			<?php else : ?>
				<div class="column">
					<p class="text--content text--separated">
						<?php if ( current_user_can( 'publish_posts' ) ) : ?>
							<?php esc_html_e( 'Ready to publish your first collection?', 'chipmunk' ); ?>

							<a href="<?php echo esc_url( admin_url( 'edit-tags.php?taxonomy=resource-collection&post_type=resource' ) ); ?>"><?php esc_html_e( 'Get started here', 'chipmunk' ); ?></a>.
						<?php else : ?>
							<?php esc_html_e( 'Sorry, there are no collections to display yet.', 'chipmunk' ); ?>
						<?php endif; ?>
					</p>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>
<!-- /.section -->
