<?php
	$resources_count    = Chipmunk\Helpers::getOption( 'resources_count', 9 );
	$disable_sliders    = Chipmunk\Helpers::getOption( 'disable_homepage_listings_sliders' );
	$infinite_sliders   = Chipmunk\Helpers::getOption( 'infinite_sliders' );

	$sections = [
		'featured'  => [
			'label'     => esc_html__( 'Featured', 'chipmunk' ),
			'results'   => Chipmunk\Helpers::getOption( 'disable_featured' )
				? new \WP_Query
				: Chipmunk\Query::get_resources( [
					'posts_per_page'    => $resources_count,
					'meta_query'        => [
						'featured'          => [
							'key'               => '_' . THEME_SLUG . '_resource_is_featured',
							'value'             => [ '1', 'on' ],
							'compare'           => 'IN',
						],
						'views'             => [
							'key'               => '_' . THEME_SLUG . '_post_view_count',
						],
					],
					'orderby'           => 'rand',
				] ),
		],
		'latest'    => [
			'label'     => esc_html__( 'Latest', 'chipmunk' ),
			'results'   => Chipmunk\Query::get_resources( [
				'posts_per_page'    => $resources_count,
				'orderby'           => 'date',
				'order'             => 'DESC',
			] ),
		],
		'popular'   => [
			'label'     => esc_html__( 'Popular', 'chipmunk' ),
			'results'   => ! Chipmunk\Helpers::isFeatureEnabled( 'views', 'resource', false )
				? new \WP_Query
				: Chipmunk\Query::get_resources( [
					'posts_per_page'    => $resources_count,
					'meta_key'          => '_' . THEME_SLUG . '_post_view_count',
					'orderby'           => 'meta_value_num',
					'order'             => 'DESC',
				] ),
		],
	];

	// Get the proper tab order
	$tabs = apply_filters( 'chipmunk_resource_tabs', [ 'featured', 'latest', 'popular' ] );

	// Filter out empty resource tabs
	$tabs = array_filter( $tabs, fn ( $tab ) => $sections[ $tab ]['results']->have_posts() );
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

									<?php Chipmunk\Helpers::get_template_part( 'sections/tile-resource' ); ?>

								<?php endwhile; wp_reset_postdata(); ?>
							</div>
						</div>

					<?php endforeach; ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
<?php endif ; ?>
