<?php
global $wp_query, $paged;

$main_query = $wp_query;
$wp_query   = isset( $custom_query ) ? $custom_query : $wp_query;
$paged      = chipmunk_get_current_page();
?>

<?php if ( $wp_query and $wp_query->max_num_pages > 1 and ( ! isset( $wp_query->query['orderby'] ) or $wp_query->query['orderby'] != 'rand' ) ) : ?>
	<nav class="pagination">
		<div class="container">
			<ul class="pagination__nav">
				<li class="pagination__item<?php echo get_previous_posts_link( null, $wp_query->max_num_pages ) ? '' : ' pagination__item_disabled'; ?>">
					<?php $previous_link = '<i class="icon icon_arrow-left" aria-hidden="true"></i><span class="visible-md-inline">' . __( 'Previous', 'chipmunk' ) . '</span>'; ?>

					<?php if ( get_previous_posts_link( null, $wp_query->max_num_pages ) ) : ?>
						<?php previous_posts_link( $previous_link, $wp_query->max_num_pages ); ?>
					<?php else : ?>
						<?php echo $previous_link; ?>
					<?php endif; ?>
				</li>

				<li class="pagination__title"><?php printf( __( 'Page %d of %d', 'chipmunk' ), $paged, $wp_query->max_num_pages ); ?></li>

				<li class="pagination__item<?php echo get_next_posts_link( null, $wp_query->max_num_pages ) ? '' : ' pagination__item_disabled'; ?>">
					<?php $next_link = '<span class="visible-md-inline">' . __( 'Next', 'chipmunk' ) . '</span><i class="icon icon_arrow-right" aria-hidden="true"></i>'; ?>

					<?php if ( get_next_posts_link( null, $wp_query->max_num_pages ) ) : ?>
						<?php next_posts_link( $next_link, $wp_query->max_num_pages ); ?>
					<?php else : ?>
						<?php echo $next_link; ?>
					<?php endif; ?>
				</li>
			</ul>
		</div>
		<!-- /.container -->
	</nav>
	<!-- /.pagination -->
<?php endif; ?>

<?php $wp_query = $main_query; ?>
