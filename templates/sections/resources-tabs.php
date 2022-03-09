<?php
	$resources_count    = Chipmunk\Customizer::get_theme_option( 'resources_count', 9 );
	$disable_sliders    = Chipmunk\Customizer::get_theme_option( 'disable_homepage_listings_sliders' );
	$infinite_sliders   = Chipmunk\Customizer::get_theme_option( 'infinite_sliders' );

	$sections = array(
		'featured'  => array(
			'label'     => esc_html__( 'Featured', 'chipmunk' ),
			'results'   => Chipmunk\Customizer::get_theme_option( 'disable_featured' ) ? new \WP_Query : Chipmunk\Query::get_featured_resources( $resources_count ),
		),
		'latest'    => array(
			'label'     => esc_html__( 'Latest', 'chipmunk' ),
			'results'   => Chipmunk\Query::get_latest_resources( $resources_count ),
		),
		'popular'   => array(
			'label'     => esc_html__( 'Popular', 'chipmunk' ),
			'results'   => Chipmunk\Customizer::get_theme_option( 'disable_resource_views' ) ? new \WP_Query : Chipmunk\Query::get_popular_resources( $resources_count ),
		),
	);

	// Get the proper tab order
	$tabs = apply_filters( 'chipmunk_resource_tabs', array( 'featured', 'latest', 'popular' ) );

	// Filter out empty resource tabs
	$tabs = array_filter( $tabs, function ( $tab ) use ( $sections ) {
		return $sections[ $tab ]['results']->have_posts();
	} );
?>

<?php if ( ! empty( $tabs ) || ! empty( $intro_text ) ) : ?>
	<div class="l-section">
		<div class="l-container">
			<?php if ( ! empty( $tabs ) ) : ?>
				<div class="c-tabs" data-tabs role="tablist">
					<?php if ( count( $tabs ) > 1 ) : ?>
						<div class="c-tabs__title c-heading c-heading--h5">
							<?php foreach ( array_values( $tabs ) as $index => $key ) : ?>

								<a href="#<?php echo sanitize_title( $sections[ $key ]['label'] ); ?>" class="c-heading__link<?php echo $index == 0 ? ' is-active' : ''; ?>" data-tabs-toggle role="tab">
									<?php echo esc_html( $sections[ $key ]['label'] ); ?>
								</a>

							<?php endforeach; ?>
						</div>
					<?php endif; ?>

					<?php foreach ( array_values( $tabs ) as $index => $key ) : ?>

						<div class="c-tabs__item<?php echo $index == 0 ? ' is-active' : ''; ?>" data-tabs-panel role="tabpanel" id="<?php echo sanitize_title( $sections[ $key ]['label'] ); ?>">
							<div class="c-tile__list"<?php echo $disable_sliders ? '' : " data-carousel='{ \"wrapAround\": " . json_encode( $infinite_sliders ) . " }'"; ?>>
								<?php while ( $sections[ $key ]['results']->have_posts() ) : $sections[ $key ]['results']->the_post(); ?>

									<?php Chipmunk\Helpers::get_template_part( 'sections/resource-tile' ); ?>

								<?php endwhile; wp_reset_postdata(); ?>
							</div>
						</div>

					<?php endforeach; ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
<?php endif ; ?>
