<?php $resource_website = get_post_meta( get_the_ID(), '_' . CHIPMUNK_THEME_SLUG . '_resource_website', true ); ?>

<div class="section<?php echo ( ! $wp_query->current_post or $wp_query->current_post % 2 == 0 ) ? ' section_theme-white section_separated' : ' section_theme-gray'; ?>">
	<div class="container">
		<article class="resource row">
			<div class="resource__content column column_lg-6">
				<ul class="resource__stats stats">
					<?php get_template_part( 'partials/post-stats' ); ?>
				</ul>

				<div class="resource__info">
					<?php echo chipmunk_conditional_markup( is_single(), 'h1', 'h2', 'resource__title heading heading_lg', is_single() ? get_the_title() : '<a href="' . get_the_permalink() . '">' . get_the_title() . '</a>' ); ?>

					<?php $content = is_search() ? chipmunk_truncate_string( get_the_excerpt(), 120 ) : get_the_content(); ?>

					<?php if ( ! empty( $content ) ) : ?>
						<p class="resource__description"><?php echo do_shortcode( $content ); ?></p>
					<?php endif; ?>
				</div>

				<div class="resource__actions">
					<?php if ( ! empty( $resource_website ) ) : ?>
						<a href="<?php echo chipmunk_external_link( $resource_website ); ?>" class="button button_secondary" target="_blank"><?php _e( 'Visit website', 'chipmunk' ); ?></a>
					<?php endif; ?>

					<?php get_template_part( 'partials/share-box' ); ?>
				</div>
			</div>

			<?php if ( has_post_thumbnail() ) : ?>
				<aside class="resource__image column column_lg-6">
					<?php if ( is_single() ) : ?>
						<?php if ( ! empty( $resource_website ) ) : ?>
							<a href="<?php echo chipmunk_external_link( $resource_website ); ?>" target="_blank"><?php the_post_thumbnail( 'xl' ); ?></a>
						<?php else : ?>
							<?php the_post_thumbnail( 'xl' ); ?>
						<?php endif; ?>
					<?php else : ?>
						<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'xl' ); ?></a>
					<?php endif; ?>
				</aside>
			<?php endif; ?>
		</article>
		<!-- /.resource -->
	</div>
</div>
<!-- /.section -->
