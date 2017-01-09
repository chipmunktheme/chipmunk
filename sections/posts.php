<?php $paged = chipmunk_get_current_page(); ?>
<?php $custom_query = chipmunk_get_posts( ChipmunkCustomizer::theme_option( 'blog_posts_per_page' ), $paged ); ?>

<div class="section section_theme-gray">
	<div class="container">
		<?php if ( 'tiles' == ChipmunkCustomizer::theme_option( 'blog_layout' ) ) : ?>
			<h1 class="section__title heading heading_md"><?php _e( 'Blog', 'chipmunk' ); ?></h1>
		<?php endif; ?>

		<?php if ( $custom_query->have_posts() ) : ?>
			<div class="row">
				<?php $i = 0; ?>
				<?php while ( $custom_query->have_posts() ) : $custom_query->the_post(); ?>

					<?php if ( 'mixed' == ChipmunkCustomizer::theme_option( 'blog_layout' ) ) : ?>
						<?php if ( $i % 4 == 0 ) : ?>
							<?php get_template_part( 'sections/post-excerpt' ); ?>
						<?php else : ?>
							<?php get_template_part( 'sections/post-tile' ); ?>
						<?php endif; ?>
					<?php endif; ?>

					<?php if ( 'tiles' == ChipmunkCustomizer::theme_option( 'blog_layout' ) ) : ?>
						<?php get_template_part( 'sections/post-tile' ); ?>
					<?php endif; ?>

					<?php if ( 'excerpts' == ChipmunkCustomizer::theme_option( 'blog_layout' ) ) : ?>
						<?php get_template_part( 'sections/post-excerpt' ); ?>
					<?php endif; ?>

					<?php $i++; ?>
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

	<?php include locate_template( 'sections/pagination.php' ); ?>
	<?php get_template_part( 'sections/promo' ); ?>
</div>
<!-- /.section -->
