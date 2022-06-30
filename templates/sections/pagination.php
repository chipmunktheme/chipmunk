<?php
global $wp_query;

if ( ! isset( $query ) ) {
	$query = $wp_query;
}

$paged = Chipmunk\Helpers::get_current_page();
?>

<?php if ( $query && $query->max_num_pages > 1 && ( ! isset( $query->query['orderby'] ) || $query->query['orderby'] != 'rand' ) ) : ?>
	<nav class="c-pagination l-component l-component--md">
		<?php if ( Chipmunk\Helpers::get_theme_option( 'pagination_type' ) == 'load_more' || Chipmunk\Helpers::get_theme_option( 'pagination_type' ) == 'infinite' ) : ?>
			<button class="c-pagination__button c-button c-button--primary-outline u-loader" data-action="load_posts" data-query-vars="<?php echo esc_attr( json_encode( $query->query ) ); ?>" data-page="<?php echo $paged + 1; ?>"<?php echo Chipmunk\Helpers::get_theme_option( 'pagination_type' ) == 'infinite' ? ' data-view-trigger="click"' : ''; ?>>
				<span><?php esc_html_e( 'Load more', 'chipmunk' ); ?></span>
			</button>
		<?php else : ?>
			<?php
				$previous_content = Chipmunk\Helpers::get_template_part( 'partials/icon', [ 'icon' => 'arrow-left' ], false ) . '<span class="u-visible-md-inline">' . esc_html__( 'Previous', 'chipmunk' ) . '</span>';
				$previous_link = get_previous_posts_link( $previous_content );

				$next_content = '<span class="u-visible-md-inline">' . esc_html__( 'Next', 'chipmunk' ) . '</span>' . Chipmunk\Helpers::get_template_part( 'partials/icon', [ 'icon' => 'arrow-right' ], false );
				$next_link = get_next_posts_link( $next_content, $query->max_num_pages );
			?>

			<div class="c-pagination__item<?php echo empty( $previous_link ) ? ' c-pagination__item--disabled' : ''; ?>">
				<?php echo ( $previous_link ?? "<span>$previous_content</span>" ); ?>
			</div>

			<div class="c-pagination__title">
				<?php printf( esc_html__( 'Page %d of %d', 'chipmunk' ), $paged, $query->max_num_pages ); ?>
			</div>

			<div class="c-pagination__item<?php echo empty( $next_link ) ? ' c-pagination__item--disabled' : ''; ?>">
				<?php echo ( $next_link ?? "<span>$next_content</span>" ); ?>
			</div>
		<?php endif; ?>
	</nav>
<?php endif; ?>
