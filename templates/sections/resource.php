<?php $content_separated = ( strlen( strip_tags( get_the_content() ) ) > 500 or chipmunk_theme_option( 'display_resource_content_separated' ) ); ?>
<?php $resource_website = get_post_meta( get_the_ID(), '_' . THEME_SLUG . '_resource_website', true ); ?>
<?php $description = ''; ?>
<?php $excerpt = chipmunk_truncate_string( get_the_excerpt(), 120 ); ?>
<?php $tags = wp_get_post_terms( get_the_ID(), 'resource-tag' ); ?>

<?php if ( is_search() ) : ?>
	<?php $description = $excerpt; ?>
<?php elseif ( $content_separated ) : ?>
	<?php if ( has_excerpt() and ( get_the_content() != get_the_excerpt() ) ) : ?>
		<?php $description = $excerpt; ?>
	<?php endif; ?>
<?php else : ?>
	<?php $description = get_the_content(); ?>
<?php endif; ?>

<div class="section<?php echo ( ! $wp_query->current_post or $wp_query->current_post % 2 == 0 ) ? ' section--theme-light' : ''; ?>">
	<div class="container">
		<article class="resource row">
			<div class="resource__content column column--lg-<?php echo has_post_thumbnail() ? '6' : '12'; ?>">
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
					<?php echo chipmunk_conditional_markup( is_single(), 'h1', 'h2', 'resource__title heading heading--lg', is_single() ? get_the_title() : '<a href="' . esc_url( get_the_permalink() ) . '">' . get_the_title() . '</a>' ); ?>

					<?php if ( ! empty( $description ) ) : ?>
						<div class="resource__description">
							<?php echo wp_kses_post( wpautop( do_shortcode( $description ) ) ); ?>
						</div>
					<?php endif; ?>

					<?php if ( ! empty( $tags ) and ! chipmunk_theme_option( 'disable_resource_tags' ) ) : ?>
						<div class="resource__tags tag__list">
							<?php chipmunk_get_template( 'partials/post-terms', array( 'terms' => $tags ) ); ?>
						</div>
					<?php endif; ?>
				</div>

				<div class="resource__actions">
					<?php if ( ! empty( $resource_website ) ) : ?>
						<a href="<?php echo esc_url( chipmunk_external_link( $resource_website ) ); ?>" class="button button--primary-outline" target="_blank" rel="nofollow"><?php esc_html_e( 'Visit website', 'chipmunk' ); ?></a>
					<?php endif; ?>

					<?php if ( ! is_search() ) : ?>
						<?php if ( chipmunk_is_feature_enabled( 'sharing', 'resource' ) ) : ?>
							<?php get_template_part( 'templates/partials/share-box' ); ?>
						<?php endif; ?>

						<?php if ( chipmunk_is_feature_enabled( 'sharing', 'post' ) ) : ?>
							<?php get_template_part( 'templates/partials/share-box' ); ?>
						<?php endif; ?>
					<?php endif; ?>
				</div>
			</div>

			<?php if ( has_post_thumbnail() ) : ?>
				<aside class="resource__image column column--lg-6">
					<?php if ( is_single() ) : ?>
						<?php if ( ! empty( $resource_website ) ) : ?>
							<a href="<?php echo esc_url( chipmunk_external_link( $resource_website ) ); ?>" class="resource__media" target="_blank" rel="nofollow"><?php the_post_thumbnail( '1280x960' ); ?></a>
						<?php else : ?>
							<span class="resource__media"><?php the_post_thumbnail( '1280x960' ); ?></span>
						<?php endif; ?>
					<?php else : ?>
						<a href="<?php the_permalink(); ?>" class="resource__media"><?php the_post_thumbnail( '1280x960' ); ?></a>
					<?php endif; ?>
				</aside>
			<?php endif; ?>
		</article>
		<!-- /.resource -->
	</div>
</div>
<!-- /.section -->

<?php if ( ! is_search() ) : ?>
	<?php if ( ! empty( get_the_content() ) and $content_separated ) : ?>
		<div class="section">
			<div class="container">
				<div class="row">
					<div class="column <?php echo esc_attr( chipmunk_get_columns( chipmunk_theme_option( 'content_width' ) ) ); ?>">
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
<?php endif; ?>
