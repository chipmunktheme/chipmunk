<?php
	$content_separated = ( strlen( strip_tags( get_the_content() ) ) > 500 or chipmunk_theme_option( 'display_resource_content_separated' ) );
	$primary_website = chipmunk_get_resource_website( get_the_ID() );
	$website = get_post_meta( get_the_ID(), '_' . THEME_SLUG . '_resource_website', true );
	$description = '';
	$excerpt = chipmunk_truncate_string( get_the_excerpt(), 120 );
	$tags = wp_get_post_terms( get_the_ID(), 'resource-tag' );
?>

<?php if ( is_search() ) : ?>
	<?php $description = $excerpt; ?>
<?php elseif ( $content_separated or empty( get_the_content() ) ) : ?>
	<?php if ( has_excerpt() and ( get_the_content() != get_the_excerpt() ) ) : ?>
		<?php $description = $excerpt; ?>
	<?php endif; ?>
<?php else : ?>
	<?php $description = get_the_content(); ?>
<?php endif; ?>

<div class="section<?php echo ( ! $wp_query->current_post or $wp_query->current_post % 2 == 0 ) ? ' section--theme-light' : ''; ?>">
	<div class="container">
		<article class="resource" itemscope itemtype="http://schema.org/Product">
			<meta itemprop="name" content="<?php the_title(); ?>" />
			
			<div class="resource__main row">
				<div class="resource__content column column--lg-<?php echo esc_attr( has_post_thumbnail() ? '6' : '12' ); ?>">
					<?php do_action( 'chipmunk_before_resource_info' ); ?>

					<div class="resource__info">
						<?php echo chipmunk_conditional_markup( is_single(), 'h1', 'h2', 'resource__title heading heading--lg', is_single() ? get_the_title() : '<a href="' . esc_url( get_the_permalink() ) . '">' . get_the_title() . '</a>' ); ?>

						<?php if ( ! empty( $description ) ) : ?>
							<div class="resource__description" itemprop="description">
								<?php echo wp_kses_post( apply_filters( 'the_content', $description ) ); ?>
							</div>
						<?php endif; ?>

						<?php if ( ! empty( $tags ) and ! chipmunk_theme_option( 'disable_resource_tags' ) ) : ?>
							<div class="resource__tags tag__list">
								<?php chipmunk_get_template( 'partials/post-terms', array( 'terms' => $tags ) ); ?>
							</div>
						<?php endif; ?>
					</div>

					<?php do_action( 'chipmunk_after_resource_info' ); ?>

					<?php if ( ! is_search() ) : ?>
						<div class="resource__extras"><?php do_action( 'chipmunk_resource_extras' ); ?></div>
					<?php endif; ?>

					<?php do_action( 'chipmunk_before_resource_actions' ); ?>

					<div class="resource__actions">
						<?php if ( ! is_search() ) : ?>
							<?php if ( ! empty( $website ) ) : ?>
								<a href="<?php echo esc_url( chipmunk_external_link( $website ) ); ?>" class="resource__button button button--primary-outline" target="_blank"<?php echo chipmunk_theme_option( 'disable_nofollow' ) ? '' : ' rel="nofollow"'; ?>><?php esc_html_e( 'Visit website', 'chipmunk' ); ?></a>
							<?php endif; ?>

							<?php if ( have_rows( '_' . THEME_SLUG . '_resource_links' ) ) : ?>
								<?php while ( have_rows( '_' . THEME_SLUG . '_resource_links' ) ) : the_row(); ?>

									<?php if ( ! empty( get_sub_field( 'link' ) ) ) : ?>
										<?php chipmunk_get_template( 'partials/button', array( 'link' => get_sub_field( 'link' ), 'class' => 'resource__button button button--primary-outline' ) ); ?>
									<?php endif; ?>

								<?php endwhile; ?>
							<?php endif; ?>
						<?php else : ?>
							<a href="<?php the_permalink(); ?>" class="button button--secondary-outline"><?php esc_html_e( 'Read more', 'chipmunk' ); ?> &rarr;</a>
						<?php endif; ?>
					</div>

					<?php do_action( 'chipmunk_after_resource_actions' ); ?>
				</div>

				<?php if ( has_post_thumbnail() ) : ?>
					<aside class="resource__image column column--lg-6">
						<?php if ( is_single() ) : ?>
							<?php if ( ! empty( $primary_website ) ) : ?>
								<a href="<?php echo chipmunk_external_link( $primary_website ); ?>" class="resource__media" target="_blank"<?php echo chipmunk_theme_option( 'disable_nofollow' ) ? '' : ' rel="nofollow"'; ?>><?php the_post_thumbnail( '1280x960', array( 'itemprop' => 'image' ) ); ?></a>
							<?php else : ?>
								<span class="resource__media"><?php the_post_thumbnail( '1280x960', array( 'itemprop' => 'image' ) ); ?></span>
							<?php endif; ?>
						<?php else : ?>
							<a href="<?php the_permalink(); ?>" class="resource__media"><?php the_post_thumbnail( '1280x960', array( 'itemprop' => 'image' ) ); ?></a>
						<?php endif; ?>
					</aside>
				<?php endif; ?>
			</div>

			<?php if ( ! is_search() ) : ?>
				<div class="resource__head">
					<?php do_action( 'chipmunk_before_resource_stats' ); ?>

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

					<?php if ( chipmunk_is_feature_enabled( 'sharing', 'resource' ) ) : ?>
						<div class="resource__share">
							<?php get_template_part( 'templates/partials/share-box' ); ?>
						</div>
					<?php endif; ?>

					<?php do_action( 'chipmunk_after_resource_stats' ); ?>
				</div>
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
