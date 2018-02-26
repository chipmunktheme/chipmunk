<?php
	$intro_text      = chipmunk_theme_option( 'intro_text' );
	$resources_count = chipmunk_theme_option( 'resources_count', 9 );
	$disable_sliders = chipmunk_theme_option( 'disable_homepage_listings_sliders' );

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
			'results'   => chipmunk_theme_option( 'disable_views' ) ? new WP_Query : chipmunk_get_popular_resources( $resources_count ),
		),
	);

	$sections = array_filter( $sections, function( $section ) {
		return $section['results']->have_posts();
	});
?>

<?php if ( ! empty( $sections ) || ! empty( $intro_text ) ) : ?>
	<div class="section">
		<div class="container">
			<?php if ( ! empty( $intro_text ) ) : ?>
				<h2 class="section__title"><?php echo $intro_text; ?></h2>
			<?php endif; ?>

			<?php if ( ! empty( $sections ) ) : ?>
				<div class="tabs" data-tabs role="tablist">
					<?php if ( count( $sections ) > 1 ) : ?>
						<div class="tabs__title heading heading_md">
							<?php foreach ( array_keys( $sections ) as $index => $key ) : ?>

								<strong class="heading__link<?php echo $index == 0 ? ' active' : ''; ?>" data-tabs-toggle role="tab">
									<?php echo $sections[$key]['label']; ?>
								</strong>

							<?php endforeach; ?>
						</div>
					<?php endif; ?>

					<?php foreach ( array_keys( $sections ) as $index => $key ) : ?>

						<div class="tabs__item<?php echo $index == 0 ? ' active' : ''; ?>" data-tabs-panel role="tabpanel">
							<div class="tile__list"<?php echo $disable_sliders ? '' : ' data-resource-slider'; ?>>
								<?php while ( $sections[$key]['results']->have_posts() ) : $sections[$key]['results']->the_post(); ?>

									<div class="tile__slider">
										<?php get_template_part( 'templates/sections/resource-tile' ); ?>
									</div>

								<?php endwhile; wp_reset_postdata(); ?>
							</div>
						</div>

					<?php endforeach; ?>
				</div>
				<!-- /.tabs -->
			<?php endif; ?>
		</div>
	</div>
	<!-- /.section -->
<?php endif ; ?>
