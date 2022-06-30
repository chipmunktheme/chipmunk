<?php $tax = get_queried_object(); ?>
<?php $year = get_query_var( 'year' ); ?>
<?php $month = get_query_var( 'monthnum' ); ?>
<?php $paged = Chipmunk\Helpers::get_current_page(); ?>
<?php $limit = Chipmunk\Helpers::get_theme_option( 'blog_posts_per_page' ); ?>
<?php $layout = ( is_single() || is_front_page() ) ? 'tiles' : Chipmunk\Helpers::get_theme_option( 'blog_layout' ); ?>

<?php if ( is_single() ) : ?>
	<?php $title = esc_html__( 'Related', 'chipmunk' ); ?>
	<?php $query = Chipmunk\Query::get_related( get_the_ID(), [ 'posts_per_page' => apply_filters( 'chipmunk_related_posts_count', 3 ) ] ); ?>
<?php elseif ( is_front_page() ) : ?>
	<?php $title = esc_html__( 'Latest Posts', 'chipmunk' ); ?>
	<?php $query = Chipmunk\Query::get_posts( [ 'posts_per_page' => apply_filters( 'chipmunk_latest_posts_count', 3 ) ] ); ?>
<?php elseif ( is_date() ) : ?>
	<?php $title = date_i18n( 'F Y', strtotime( $year . '-' . $month ) ); ?>
	<?php $query = Chipmunk\Query::get_posts( [ 'posts_per_page' => $limit, 'paged' => $paged ], null, [ 'year' => $year, 'month' => $month ] ); ?>
<?php elseif ( is_category() ) : ?>
	<?php $title = sprintf( esc_html__( '%s Category', 'chipmunk' ), $tax->name ); ?>
	<?php $query = Chipmunk\Query::get_posts( [ 'posts_per_page' => $limit, 'paged' => $paged ], $tax ); ?>
<?php elseif ( is_tag() ) : ?>
	<?php $title = sprintf( esc_html__( '%s Tag', 'chipmunk' ), $tax->name ); ?>
	<?php $query = Chipmunk\Query::get_posts( [ 'posts_per_page' => $limit, 'paged' => $paged ], $tax ); ?>
<?php else : ?>
	<?php $title = esc_html__( 'Blog', 'chipmunk' ); ?>
	<?php $query = Chipmunk\Query::get_posts( [ 'posts_per_page' => $limit, 'paged' => $paged ] ); ?>
<?php endif; ?>

<?php if ( ( ! is_front_page() && ! is_single() ) || $query->have_posts() ) : ?>
	<div class="l-section">
		<div class="l-container">
			<?php if ( ( ! empty( $title ) && $layout == 'tiles' ) || ! $query->have_posts() ) : ?>
				<div class="l-component l-header">
					<?php if ( ! empty( $title ) ) : ?>
						<h2 class="c-heading c-heading--h4"><?php echo $title; ?></h2>
					<?php endif; ?>

					<?php if ( ! $query->have_posts() ) : ?>
						<p class="l-header__copy">
							<?php esc_html_e( 'Sorry, there are no posts to display yet.', 'chipmunk' ); ?>
						</p>
					<?php endif; ?>
				</div>
			<?php endif; ?>

			<?php if ( $query->have_posts() ) : ?>
				<div class="l-component">
					<div class="c-tile__list c-tile__list--separated" data-action-element="load_posts">
						<?php $i = 0; ?>

						<?php while ( $query->have_posts() ) : $query->the_post(); ?>
							<?php if ( $layout == 'excerpts' || ( $layout == 'mixed' && ( $i % 4 == 0 && $paged == 1 ) ) ) : ?>
								<?php Chipmunk\Helpers::get_template_part( 'sections/excerpt-post' ); ?>
							<?php else : ?>
								<?php Chipmunk\Helpers::get_template_part( 'sections/tile-post' ); ?>
							<?php endif; ?>

							<?php $i++; ?>
						<?php endwhile; ?>
					</div>
				</div>
			<?php endif; ?>

			<?php if ( ! is_single() && ! is_front_page() ) : ?>
				<?php Chipmunk\Helpers::get_template_part( 'sections/pagination', [ 'query' => $query ] ); ?>
			<?php endif; ?>
		</div>
	</div>
<?php endif; ?>
