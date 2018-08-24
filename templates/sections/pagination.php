<?php
global $wp_query;

if ( ! $query ) {
	$query = $wp_query;
}

$paged = chipmunk_get_current_page();
?>

<?php if ( $query and $query->max_num_pages > 1 and ( ! isset( $query->query['orderby'] ) or $query->query['orderby'] != 'rand' ) ) : ?>
	<nav class="pagination">
		<div class="container">
			<?php if ( chipmunk_theme_option( 'pagination_type' ) == 'load_more' ) : ?>
				<div class="text_center">
					<button class="button button_tertiary loader" data-action="load_posts" data-post-type="<?php echo $type; ?>" data-page="<?php echo $paged + 1; ?>" data-limit="<?php echo chipmunk_theme_option( 'posts_per_page' ); ?>">
						<span><?php esc_html_e( 'Load more', 'voca' ); ?></span>
					</button>
				</div>
			<?php else : ?>
				<ul class="pagination__nav">
					<li class="pagination__item<?php echo get_previous_posts_link( null, $query->max_num_pages ) ? '' : ' pagination__item_disabled'; ?>">
						<?php $previous_link = chipmunk_get_template( 'partials/icon', array( 'icon' => 'chevron-left' ), false ) . '<span class="visible-md-inline">' . esc_html__( 'Previous', 'chipmunk' ) . '</span>'; ?>

						<?php if ( get_previous_posts_link( null, $query->max_num_pages ) ) : ?>
							<?php previous_posts_link( $previous_link, $query->max_num_pages ); ?>
						<?php else : ?>
							<?php echo $previous_link; ?>
						<?php endif; ?>
					</li>

					<li class="pagination__title"><?php printf( esc_html__( 'Page %d of %d', 'chipmunk' ), $paged, $query->max_num_pages ); ?></li>

					<li class="pagination__item<?php echo get_next_posts_link( null, $query->max_num_pages ) ? '' : ' pagination__item_disabled'; ?>">
						<?php $next_link = '<span class="visible-md-inline">' . esc_html__( 'Next', 'chipmunk' ) . '</span>' . chipmunk_get_template( 'partials/icon', array( 'icon' => 'chevron-right' ), false ); ?>

						<?php if ( get_next_posts_link( null, $query->max_num_pages ) ) : ?>
							<?php next_posts_link( $next_link, $query->max_num_pages ); ?>
						<?php else : ?>
							<?php echo $next_link; ?>
						<?php endif; ?>
					</li>
				</ul>
			<?php endif; ?>
		</div>
		<!-- /.container -->
	</nav>
	<!-- /.pagination -->
<?php endif; ?>
