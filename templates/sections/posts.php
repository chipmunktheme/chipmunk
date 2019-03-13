<?php $tax = get_queried_object(); ?>
<?php $year = get_query_var( 'year' ); ?>
<?php $month = get_query_var( 'monthnum' ); ?>
<?php $paged = chipmunk_get_current_page(); ?>
<?php $limit = chipmunk_theme_option( 'blog_posts_per_page' ); ?>
<?php $layout = ( is_single() or is_front_page() ) ? 'tiles' : chipmunk_theme_option( 'blog_layout' ); ?>

<?php if ( is_single() ) : ?>
	<?php $title = esc_html__( 'Related', 'chipmunk' ); ?>
	<?php $query = chipmunk_get_related( get_the_ID() ); ?>
<?php elseif ( is_front_page() ) : ?>
	<?php $title = esc_html__( 'Latest Posts', 'chipmunk' ); ?>
	<?php $query = chipmunk_get_posts( array( 'posts_per_page' => 3 ) ); ?>
<?php elseif ( is_date() ) : ?>
	<?php $title = date_i18n( 'F Y', strtotime( $year . '-' . $month ) ); ?>
	<?php $query = chipmunk_get_posts( array( 'posts_per_page' => $limit, 'paged' => $paged ), null, array( 'year' => $year, 'month' => $month ) ); ?>
<?php elseif ( is_category() ) : ?>
	<?php $title = sprintf( esc_html__( '%s Category', 'chipmunk' ), $tax->name ); ?>
	<?php $query = chipmunk_get_posts( array( 'posts_per_page' => $limit, 'paged' => $paged ), $tax ); ?>
<?php elseif ( is_tag() ) : ?>
	<?php $title = sprintf( esc_html__( '%s Tag', 'chipmunk' ), $tax->name ); ?>
	<?php $query = chipmunk_get_posts( array( 'posts_per_page' => $limit, 'paged' => $paged ), $tax ); ?>
<?php else : ?>
	<?php $title = esc_html__( 'Blog', 'chipmunk' ); ?>
	<?php $query = chipmunk_get_posts( array( 'posts_per_page' => $limit, 'paged' => $paged ) ); ?>
<?php endif; ?>

<?php if ( ( ! is_front_page() and ! is_single() ) or $query->have_posts() ) : ?>
	<div class="section">
		<div class="container">
			<?php if ( $title and $layout == 'tiles' ) : ?>
				<h2 class="heading heading--md"><?php echo $title; ?></h2>
			<?php endif; ?>

			<?php if ( $query->have_posts() ) : ?>
				<div class="row" data-action-element="load_posts">
					<?php $i = 0; ?>
					<?php while ( $query->have_posts() ) : $query->the_post(); ?>
						<?php if ( $layout == 'mixed' ) : ?>
							<?php if ( $i % 4 == 0 and $paged == 1 ) : ?>
								<?php get_template_part( 'templates/sections/post-excerpt' ); ?>
							<?php else : ?>
								<?php get_template_part( 'templates/sections/post-tile' ); ?>
							<?php endif; ?>

							<?php $i++; ?>
						<?php endif; ?>

						<?php if ( $layout == 'tiles' ) : ?>
							<?php get_template_part( 'templates/sections/post-tile' ); ?>
						<?php endif; ?>

						<?php if ( $layout == 'excerpts' ) : ?>
							<?php get_template_part( 'templates/sections/post-excerpt' ); ?>
						<?php endif; ?>
					<?php endwhile; ?>
				</div>
			<?php else : ?>
				<p class="text--content text--separated">
					<?php if ( current_user_can( 'publish_posts' ) ) : ?>
						<?php esc_html_e( 'Ready to publish your first post?', 'chipmunk' ); ?>

						<a href="<?php echo esc_url( admin_url( 'post-new.php?post_type=post' ) ); ?>"><?php esc_html_e( 'Get started here', 'chipmunk' ); ?></a>.
					<?php else : ?>
						<?php esc_html_e( 'Sorry, there are no posts to display yet.', 'chipmunk' ); ?>
					<?php endif; ?>
				</p>
			<?php endif; ?>
		</div>

		<?php if ( ! is_single() and ! is_front_page() ) : ?>
			<?php chipmunk_get_template( 'sections/pagination', array( 'query' => $query ) ); ?>
		<?php endif; ?>
	</div>
	<!-- /.section -->
<?php endif; ?>
