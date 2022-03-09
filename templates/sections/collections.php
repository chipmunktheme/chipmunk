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

<div class="l-section">
	<div class="l-container">
		<div class="l-component l-header">
			<<?php echo is_front_page() ? 'h2' : 'h1'; ?> class="c-heading c-heading--h4">
				<?php esc_html_e( 'Collections', 'chipmunk' ); ?>
			</<?php echo is_front_page() ? 'h2' : 'h1'; ?>>

			<?php if ( empty( $collections ) ) : ?>
				<p class="l-header__copy">
					<?php esc_html_e( 'Sorry, there are no collections to display yet.', 'chipmunk' ); ?>
				</p>
			<?php endif; ?>
		</div>

		<?php if ( ! empty( $collections ) ) : ?>
			<div class="l-component">
				<div class="c-tile__list">
					<?php foreach ( $collections as $collection ) : ?>
						<?php Chipmunk\Helpers::get_template_part( 'sections/collection-tile', array( 'collection' => $collection ) ); ?>
					<?php endforeach; ?>
				</div>
			</div>
		<?php endif; ?>
	</div>
</div>
