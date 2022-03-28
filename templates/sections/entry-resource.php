<?php
	$content_separated = ( strlen( strip_tags( get_the_content() ) ) > 500 || Chipmunk\Helpers::get_theme_option( 'display_resource_content_separated' ) );
	$primary_website = Chipmunk\Helpers::get_resource_website( get_the_ID() );
	$website = get_post_meta( get_the_ID(), '_' . THEME_SLUG . '_resource_website', true );
	$description = '';
	$excerpt = Chipmunk\Helpers::truncate_string( get_the_excerpt(), 120 );
?>

<?php if ( is_search() ) : ?>
	<?php $description = $excerpt; ?>
<?php elseif ( $content_separated || empty( get_the_content() ) ) : ?>
	<?php if ( has_excerpt() && ( get_the_content() != get_the_excerpt() ) ) : ?>
		<?php $description = $excerpt; ?>
	<?php endif; ?>
<?php else : ?>
	<?php $description = get_the_content(); ?>
<?php endif; ?>

<div class="l-section<?php echo ( ! $wp_query->current_post || $wp_query->current_post % 2 == 0 ) ? ' l-section--theme-light' : ''; ?>">
	<div class="l-container">
		<article class="c-resource" itemscope itemtype="http://schema.org/Product">
			<meta itemprop="name" content="<?php echo esc_attr( strip_tags( get_the_title() ) ); ?>" />

			<div class="c-resource__content<?php echo esc_attr( ( ! has_post_thumbnail() || ! Chipmunk\Helpers::is_feature_enabled( 'single_thumbs', 'resource' ) ) ? ' c-resource__content--full' : '' ); ?>">
				<?php do_action( 'chipmunk_before_resource_info' ); ?>

				<div class="c-resource__info">
					<?php if ( is_single() ) : ?>
						<h1 class="c-resource__title c-heading c-heading--h2">
							<?php the_title(); ?>
						</h1>
					<?php else : ?>
						<h2 class="c-resource__title c-heading c-heading--h3">
							<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						</h2>
					<?php endif; ?>

					<?php if ( ! empty( $description ) ) : ?>
						<div class="c-resource__description c-content c-content--type" itemprop="description">
							<?php echo apply_filters( 'the_content', $description ); ?>
						</div>
					<?php endif; ?>

					<?php Chipmunk\Helpers::get_template_part( 'partials/stats', array(
						'class' => 'c-resource__tags',
						'stats' => array(
							'terms' => array(
								'term_args' => array(
									'taxonomy' => 'resource-tag',
								),
							),
						),
					) ); ?>
				</div>

				<?php do_action( 'chipmunk_after_resource_info' ); ?>

				<?php if ( ! is_search() ) : ?>
					<div class="c-resource__extras"><?php do_action( 'chipmunk_resource_extras' ); ?></div>
				<?php endif; ?>

				<?php do_action( 'chipmunk_before_resource_actions' ); ?>

				<div class="c-resource__actions">
					<?php if ( ! is_search() ) : ?>
						<?php if ( ! empty( $website ) ) : ?>
							<a href="<?php echo esc_url( Chipmunk\Helpers::render_external_link( $website ) ); ?>" class="c-resource__button c-button c-button--primary-outline" target="_blank"<?php echo Chipmunk\Helpers::get_theme_option( 'disable_nofollow' ) ? '' : ' rel="nofollow"'; ?>><?php esc_html_e( 'Visit website', 'chipmunk' ); ?></a>
						<?php endif; ?>

						<?php if ( have_rows( '_' . THEME_SLUG . '_resource_links' ) ) : ?>
							<?php while ( have_rows( '_' . THEME_SLUG . '_resource_links' ) ) : the_row(); ?>

								<?php if ( ! empty( get_sub_field( 'link' ) ) ) : ?>
									<?php Chipmunk\Helpers::get_template_part( 'partials/button', array( 'link' => get_sub_field( 'link' ), 'class' => 'resource__button c-button c-button--primary-outline' ) ); ?>
								<?php endif; ?>

							<?php endwhile; ?>
						<?php endif; ?>
					<?php else : ?>
						<a href="<?php the_permalink(); ?>" class="c-button c-button--primary-outline"><?php esc_html_e( 'Read more', 'chipmunk' ); ?></a>
					<?php endif; ?>
				</div>

				<?php do_action( 'chipmunk_after_resource_actions' ); ?>
			</div>

			<?php if ( has_post_thumbnail() && ! Chipmunk\Helpers::is_feature_enabled( 'single_thumbs', 'resource' ) ) : ?>
				<?php $media_class = Chipmunk\Helpers::class_name( 'c-media', Chipmunk\Helpers::get_theme_option( 'resource_image_aspect_ratio' ) ); ?>
				<?php $media_class = "c-resource__media $media_class"; ?>

				<?php if ( ! is_single() ) : ?>
					<a href="<?php the_permalink(); ?>" class="<?php echo esc_attr( $media_class ); ?>"><?php the_post_thumbnail( '1280x960', array( 'itemprop' => 'image' ) ); ?></a>
				<?php elseif ( ! empty( $primary_website ) ) : ?>
					<a href="<?php echo Chipmunk\Helpers::render_external_link( $primary_website ); ?>" class="<?php echo esc_attr( $media_class ); ?>" target="_blank"<?php echo Chipmunk\Helpers::get_theme_option( 'disable_nofollow' ) ? '' : ' rel="nofollow"'; ?>><?php the_post_thumbnail( '1280x960', array( 'itemprop' => 'image' ) ); ?></a>
				<?php else : ?>
					<div class="<?php echo esc_attr( $media_class ); ?>"><?php the_post_thumbnail( '1280x960', array( 'itemprop' => 'image' ) ); ?></div>
				<?php endif; ?>
			<?php endif; ?>

			<?php if ( ! is_search() ) : ?>
				<div class="c-resource__head">
					<?php do_action( 'chipmunk_before_resource_head' ); ?>

					<?php Chipmunk\Helpers::get_template_part( 'partials/stats', array(
						'class' => 'c-resource__stats',
						'stats' => array(
							'upvotes' => array(),
							'bookmarks' => array(),
							'author' => array(
								'show_link' => true,
							),
							'terms' => array(
								'term_args' => array(
									'taxonomy' => 'resource-collection',
									'quantity' => 1,
								),
							),
							'date' => array(),
							'views' => array(),
						),
					) ); ?>

					<?php if ( Chipmunk\Helpers::is_feature_enabled( 'sharing', 'resource' ) ) : ?>
						<div class="c-resource__share">
							<?php Chipmunk\Helpers::get_template_part( 'partials/share-box' ); ?>
						</div>
					<?php endif; ?>

					<?php do_action( 'chipmunk_after_resource_head' ); ?>
				</div>
			<?php endif; ?>
		</article>
	</div>
</div>

<?php if ( ! is_search() ) : ?>
	<?php if ( ! empty( get_the_content() ) && $content_separated ) : ?>
		<div class="l-section">
			<div class="l-container">
				<div class="l-wrapper">
					<div class="c-entry__content c-content c-content--type">
						<?php the_content(); ?>
					</div>
				</div>
			</div>
		</div>
	<?php endif; ?>
<?php endif; ?>
