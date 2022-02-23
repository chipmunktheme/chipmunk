<?php
	$resources_count    = chipmunk_theme_option( 'resources_count', 9 );
	$disable_sliders    = chipmunk_theme_option( 'disable_homepage_listings_sliders' );
	$infinite_sliders   = chipmunk_theme_option( 'infinite_sliders' );

	$sections = array(
		'featured'  => array(
			'label'     => esc_html__( 'Featured', 'chipmunk' ),
			'results'   => chipmunk_theme_option( 'disable_featured' ) ? new WP_Query : chipmunk_get_featured_resources( $resources_count ),
		),
		'latest'    => array(
			'label'     => esc_html__( 'Latest', 'chipmunk' ),
			'results'   => chipmunk_get_latest_resources( $resources_count ),
		),
		'popular'   => array(
			'label'     => esc_html__( 'Popular', 'chipmunk' ),
			'results'   => chipmunk_theme_option( 'disable_resource_views' ) ? new WP_Query : chipmunk_get_popular_resources( $resources_count ),
		),
	);

	// Get the proper tab order
	$tabs = apply_filters( 'chipmunk_resource_tabs', ['featured', 'latest', 'popular'] );

	// Filter out empty resource tabs
	$tabs = array_filter( $tabs, function ( $tab ) use ( $sections ) {
		return $sections[ $tab ]['results']->have_posts();
	} );
?>

<?php if ( ! empty( $tabs ) or ! empty( $intro_text ) ) : ?>
	<div class="section">
		<div class="container">
			<?php if ( ! empty( $tabs ) ) : ?>
				<div class="tabs section__separator" data-tabs role="tablist">
					<?php if ( count( $tabs ) > 1 ) : ?>
						<div class="tabs__title heading heading--h4">
							<?php foreach ( array_values( $tabs ) as $index => $key ) : ?>

								<strong class="heading__link<?php echo $index == 0 ? ' active' : ''; ?>" data-tabs-toggle role="tab">
									<?php echo esc_html( $sections[ $key ]['label'] ); ?>
								</strong>

							<?php endforeach; ?>
						</div>
					<?php endif; ?>

					<?php foreach ( array_values( $tabs ) as $index => $key ) : ?>

						<div class="tabs__item<?php echo $index == 0 ? ' active' : ''; ?>" data-tabs-panel role="tabpanel">
							<?php $breakpoints = array( 'sm', 'md', 'lg' ); ?>

							<?php foreach ( $breakpoints as $breakpoint_index => $breakpoint ) : ?>
								<div class="tile__wrapper visible-<?php echo esc_attr( $breakpoint ); ?>-flex <?php echo ( isset( $breakpoints[ $breakpoint_index + 1 ] ) ? 'hidden-' . $breakpoints[ $breakpoint_index + 1 ] : '' ); ?>">
									<div class="tile__list"<?php echo $disable_sliders ? '' : ' data-carousel data-carousel-infinite="' . $infinite_sliders . '"'; ?>>
										<?php $index = 1; ?>

										<div class="tile__slider">
											<div class="grid">
												<?php while ( $sections[ $key ]['results']->have_posts() ) : $sections[ $key ]['results']->the_post(); ?>

													<?php chipmunk_get_template_part( 'sections/resource-tile' ); ?>

													<?php if ( $index % ( $breakpoint_index + 1 ) == 0 && $index != $sections[ $key ]['results']->post_count ) : ?>
														</div></div><div class="tile__slider"><div class="grid">
													<?php endif; ?>

													<?php $index++; ?>

												<?php endwhile; wp_reset_postdata(); ?>
											</div>
										</div>
									</div>
									<!-- /.tile__list -->
								</div>
							<?php endforeach; ?>
						</div>
						<!-- /.tabs__item -->

					<?php endforeach; ?>
				</div>
				<!-- /.tabs -->
			<?php endif; ?>
		</div>
	</div>
	<!-- /.section -->
<?php endif ; ?>
