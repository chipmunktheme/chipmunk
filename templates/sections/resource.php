<?php $resource_website = get_post_meta( get_the_ID(), '_' . THEME_SLUG . '_resource_website', true ); ?>
<?php $content = is_search() ? chipmunk_truncate_string( get_the_excerpt(), 120 ) : get_the_content(); ?>
<?php $tags = wp_get_post_terms( get_the_ID(), 'resource-tag' ); ?>

<div class="section<?php echo ( ! $wp_query->current_post or $wp_query->current_post % 2 == 0 ) ? ' section_theme-light' : ''; ?>">
	<div class="container">
		<article class="resource row">
			<div class="resource__content column column_lg-6">
				<ul class="resource__stats stats">
					<?php
						$collections_args = array(
							'display'  => true,
							'type'     => 'link',
							'quantity' => 1,
						);

						chipmunk_get_template( 'partials/post-stats', array( 'args' => $collections_args ) );
					?>
				</ul>

				<div class="resource__info">
					<?php echo chipmunk_conditional_markup( is_single(), 'h1', 'h2', 'resource__title heading heading_lg', is_single() ? get_the_title() : '<a href="' . esc_url( get_the_permalink() ) . '">' . get_the_title() . '</a>' ); ?>

					<?php if ( ! empty( $content ) && ( is_search() || ! chipmunk_theme_option( 'display_resource_content_separated' ) ) ) : ?>
						<div class="resource__description"><?php echo wp_kses_post( wpautop( do_shortcode( $content ) ) ); ?></div>
					<?php endif; ?>

					<?php if ( ! empty( $tags ) && ! chipmunk_theme_option( 'disable_resource_tags' ) ) : ?>
						<div class="resource__tags" title="<?php esc_attr_e( 'Tags', 'chipmunk' ); ?>">
							<?php chipmunk_get_template( 'partials/icon', array( 'icon' => 'tag' ) ); ?>

							<?php echo chipmunk_display_collections( $tags ); ?>
						</div>
					<?php endif; ?>
				</div>

				<div class="resource__actions">
					<?php if ( ! empty( $resource_website ) ) : ?>
						<a href="<?php echo esc_url( chipmunk_external_link( $resource_website ) ); ?>" class="button button_secondary" target="_blank" rel="nofollow"><?php esc_html_e( 'Visit website', 'chipmunk' ); ?></a>
					<?php endif; ?>

					<?php get_template_part( 'templates/partials/share-box' ); ?>
				</div>
			</div>

			<?php if ( has_post_thumbnail() ) : ?>
				<aside class="resource__image column column_lg-6">
					<?php if ( is_single() ) : ?>
						<?php if ( ! empty( $resource_website ) ) : ?>
							<a href="<?php echo esc_url( chipmunk_external_link( $resource_website ) ); ?>" target="_blank" rel="nofollow"><?php the_post_thumbnail( 'chipmunk-xl' ); ?></a>
						<?php else : ?>
							<?php the_post_thumbnail( 'chipmunk-xl' ); ?>
						<?php endif; ?>
					<?php else : ?>
						<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'chipmunk-xl' ); ?></a>
					<?php endif; ?>
				</aside>
			<?php endif; ?>
		</article>
		<!-- /.resource -->
	</div>
</div>
<!-- /.section -->

<?php if ( ! empty( get_the_content() ) && ! is_search() && chipmunk_theme_option( 'display_resource_content_separated' ) ) : ?>
	<div class="section">
		<div class="container">
			<div class="row">
				<div class="column column_lg-8 column_lg-offset-2">
					<div class="entry__content content">
						<?php the_content(); ?>
					</div>
					<!-- /.entry -->
				</div>
			</div>
		</div>
	</div>
	<!-- /.section -->
<?php endif; ?>
