<?php
$intro_text      = chipmunk_theme_option( 'intro_text' );
$resources_count = chipmunk_theme_option( 'resources_count', 9 );
$disable_sliders = chipmunk_theme_option( 'disable_homepage_listings_sliders' );
$resources = array(
	'latest'    => chipmunk_get_latest_resources( $resources_count ),
	'featured'  => ! chipmunk_theme_option( 'disable_featured' ) ? chipmunk_get_featured_resources( $resources_count ) : new WP_Query,
	'popular'   => ! chipmunk_theme_option( 'disable_views' ) ? chipmunk_get_popular_resources( $resources_count ) : new WP_Query,
);
?>

<?php if ( $resources['latest']->have_posts() || ! empty( $intro_text ) ) : ?>
	<div class="section">
		<div class="container" data-tabs role="tablist">
			<?php if ( ! empty( $intro_text ) ) : ?>
				<h2 class="section__title"><?php echo $intro_text; ?></h2>
			<?php endif; ?>
			
			<?php if ( $resources['latest']->have_posts() ) : ?>
				<div class="heading heading_md">
					<?php if ( $resources['featured']->have_posts() ) : ?>
						<h2 class="heading__link active" data-tabs-toggle role="tab">
							<?php esc_html_e( 'Featured', 'chipmunk' ); ?>
							<span class="sr-only"> <?php esc_html_e( 'Resources', 'chipmunk' ); ?></span>
						</h2>
					<?php endif; ?>

					<?php if ( $resources['latest']->have_posts() ) : ?>
						<h2 class="heading__link<?php echo ! $resources['featured']->have_posts() ? ' active' : ''; ?>" data-tabs-toggle role="tab">
							<?php esc_html_e( 'Latest', 'chipmunk' ); ?>
							<span class="sr-only"> <?php esc_html_e( 'Resources', 'chipmunk' ); ?></span>
						</h2>
					<?php endif; ?>

					<?php if ( $resources['popular']->have_posts() ) : ?>
						<h2 class="heading__link<?php echo ! $resources['featured']->have_posts() ? '' : ' visible-sm-inline-block'; ?>" data-tabs-toggle role="tab">
							<?php esc_html_e( 'Popular', 'chipmunk' ); ?>
							<span class="sr-only"> <?php esc_html_e( 'Resources', 'chipmunk' ); ?></span>
						</h2>
					<?php endif; ?>
				</div>

				<div class="tab-content">
					<?php if ( $resources['featured']->have_posts() ) : ?>
						<div class="tile__list tabs__item<?php if ( $disable_sliders ) echo ' row'; ?> active" data-tabs-panel<?php if ( ! $disable_sliders ) echo ' data-resource-slider'; ?> role="tabpanel">
							<?php while ( $resources['featured']->have_posts() ) : $resources['featured']->the_post(); ?>

								<?php if ( $disable_sliders ) : ?>
									<?php get_template_part( 'templates/sections/resource-tile' ); ?>
								<?php else : ?>
									<div class="tile__slider">
										<?php get_template_part( 'templates/sections/resource-tile' ); ?>
									</div>
								<?php endif; ?>

							<?php endwhile; wp_reset_postdata(); ?>
						</div>
					<?php endif; ?>

					<?php if ( $resources['latest']->have_posts() ) : ?>
						<div class="tile__list tabs__item<?php if ( $disable_sliders ) echo ' row'; ?><?php echo ! $resources['featured']->have_posts() ? ' active' : ''; ?>" data-tabs-panel<?php if ( ! $disable_sliders ) echo ' data-resource-slider'; ?> role="tabpanel">
							<?php while ( $resources['latest']->have_posts() ) : $resources['latest']->the_post(); ?>

								<?php if ( $disable_sliders ) : ?>
									<?php get_template_part( 'templates/sections/resource-tile' ); ?>
								<?php else : ?>
									<div class="tile__slider">
										<?php get_template_part( 'templates/sections/resource-tile' ); ?>
									</div>
								<?php endif; ?>

							<?php endwhile; wp_reset_postdata(); ?>
						</div>
					<?php endif; ?>

					<?php if ( $resources['popular']->have_posts() ) : ?>
						<div class="tile__list tabs__item<?php if ( $disable_sliders ) echo ' row'; ?>" data-tabs-panel<?php if ( ! $disable_sliders ) echo ' data-resource-slider'; ?> role="tabpanel">
							<?php while ( $resources['popular']->have_posts() ) : $resources['popular']->the_post(); ?>

								<?php if ( $disable_sliders ) : ?>
									<?php get_template_part( 'templates/sections/resource-tile' ); ?>
								<?php else : ?>
									<div class="tile__slider">
										<?php get_template_part( 'templates/sections/resource-tile' ); ?>
									</div>
								<?php endif; ?>

							<?php endwhile; wp_reset_postdata(); ?>
						</div>
					<?php endif; ?>
				</div>
				<!-- /.tab-content -->
			<?php endif; ?>
		</div>
	</div>
	<!-- /.section -->
<?php endif ; ?>
