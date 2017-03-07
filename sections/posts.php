<?php $term = get_queried_object(); ?>
<?php $paged = chipmunk_get_current_page(); ?>
<?php $layout = is_single() ? 'tiles' : ChipmunkCustomizer::theme_option( 'blog_layout' ); ?>

<?php if ( is_single() ) : ?>
	<?php $custom_query = chipmunk_get_related_posts( get_the_ID() ); ?>
<?php elseif ( is_front_page() ) : ?>
	<?php $custom_query = chipmunk_get_posts( 3 ); ?>
<?php else : ?>
	<?php $custom_query = chipmunk_get_posts( ChipmunkCustomizer::theme_option( 'blog_posts_per_page' ), $paged, isset( $term->term_id ) ? $term : null ); ?>
<?php endif; ?>

<?php if ( ! is_front_page() || $custom_query->have_posts() ) : ?>
	<div class="section section_theme-gray">
		<div class="container">
			<?php if ( is_single() ) : ?>
				<h2 class="section__title heading heading_md"><?php _e( 'Related', 'chipmunk' ); ?></h2>
			<?php elseif ( is_front_page() ) : ?>
				<h2 class="section__title heading heading_md"><?php _e( 'Latest Posts', 'chipmunk' ); ?></h2>
			<?php else : ?>
				<?php if ( $term && $layout == 'tiles' ) : ?>
					<h1 class="section__title heading heading_md"><?php echo $term->taxonomy == 'category' ? sprintf( __( '%s Category', 'chipmunk' ), single_term_title( null, false ) ) : __( 'Blog', 'chipmunk' ); ?></h1>
				<?php endif; ?>
			<?php endif; ?>

			<?php if ( $custom_query->have_posts() ) : ?>
				<div class="row">
					<?php $i = 0; ?>
					<?php while ( $custom_query->have_posts() ) : $custom_query->the_post(); ?>

						<?php if ( $layout == 'mixed' ) : ?>
							<?php if ( $i % 4 == 0 && $paged == 1 ) : ?>
								<?php get_template_part( 'sections/post-excerpt' ); ?>
							<?php else : ?>
								<?php get_template_part( 'sections/post-tile' ); ?>
							<?php endif; ?>

							<?php $i++; ?>
						<?php endif; ?>

						<?php if ( $layout == 'tiles' ) : ?>
							<?php get_template_part( 'sections/post-tile' ); ?>
						<?php endif; ?>

						<?php if ( $layout == 'excerpts' ) : ?>
							<?php get_template_part( 'sections/post-excerpt' ); ?>
						<?php endif; ?>
					<?php endwhile; ?>
				</div>
			<?php else : ?>
				<?php if ( current_user_can( 'publish_posts' ) ) : ?>
					<p class="text_content text_separated"><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'chipmunk' ), esc_url( admin_url( 'post-new.php?post_type=post' ) ) ); ?></p>
				<?php else : ?>
					<p class="text_content text_separated"><?php _e( 'Sorry, there are no posts to display yet.', 'chipmunk' ); ?></p>
				<?php endif; ?>
			<?php endif; ?>
		</div>

		<?php if ( ! is_single() && ! is_front_page() ) : ?>
			<?php include locate_template( 'sections/pagination.php' ); ?>
		<?php endif; ?>
	</div>
	<!-- /.section -->
<?php endif; ?>
