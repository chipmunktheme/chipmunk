<?php
global $wp_query;

if ( ! isset( $query ) ) {
	$query = $wp_query;
}

$paged = chipmunk_get_current_page();
?>

<?php if ( $query and $query->max_num_pages > 1 and ( ! isset( $query->query['orderby'] ) or $query->query['orderby'] != 'rand' ) ) : ?>
	<nav class="pagination">
		<div class="container">
			<?php if ( chipmunk_theme_option( 'pagination_type' ) == 'load_more' or chipmunk_theme_option( 'pagination_type' ) == 'infinite' ) : ?>
				<div class="text--center">
					<button class="button button--primary-outline loader" data-action="load_posts" data-query-vars="<?php echo esc_attr( json_encode( $query->query ) ); ?>" data-page="<?php echo $paged + 1; ?>"<?php echo chipmunk_theme_option( 'pagination_type' ) == 'infinite' ? ' data-view-trigger="click"' : ''; ?>>
						<span><?php esc_html_e( 'Load more', 'chipmunk' ); ?></span>
					</button>
				</div>
			<?php else : ?>
				<ul class="pagination__nav">
					<?php
						$previous_content = chipmunk_get_template( 'partials/icon', array( 'icon' => 'chevron-left' ), false ) . '<span class="visible-md-inline">' . esc_html__( 'Previous', 'chipmunk' ) . '</span>';
						$previous_link = get_previous_posts_link( $previous_content, $query->max_num_pages );

						$next_content = '<span class="visible-md-inline">' . esc_html__( 'Next', 'chipmunk' ) . '</span>' . chipmunk_get_template( 'partials/icon', array( 'icon' => 'chevron-right' ), false );
						$next_link = get_next_posts_link( $next_content, $query->max_num_pages );
					?>

					<li class="pagination__item<?php echo empty( $previous_link ) ? ' pagination__item--disabled' : ''; ?>">
						<?php echo isset( $previous_link ) ? $previous_link : $previous_content; ?>
					</li>

					<li class="pagination__title">
						<?php printf( esc_html__( 'Page %d of %d', 'chipmunk' ), $paged, $query->max_num_pages ); ?>
					</li>

					<li class="pagination__item<?php echo empty( $next_link ) ? ' pagination__item--disabled' : ''; ?>">
						<?php echo isset( $next_link ) ? $next_link : $next_content; ?>
					</li>
				</ul>
			<?php endif; ?>
		</div>
		<!-- /.container -->
	</nav>
	<!-- /.pagination -->
<?php endif; ?>
