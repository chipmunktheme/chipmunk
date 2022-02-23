<?php $tags = wp_get_post_tags( get_the_ID() ); ?>

<div class="entry" itemscope itemtype="http://schema.org/BlogPosting">
	<?php if ( has_post_thumbnail() and chipmunk_theme_option( 'blog_post_layout' ) == 'hero' ) : ?>
		<div class="entry__hero">
			<?php if ( has_post_thumbnail() ) : ?>
				<div class="entry__background" data-rellax data-rellax-speed="-5">
					<?php the_post_thumbnail( '1920x1080', array( 'itemprop' => 'image' ) ); ?>
				</div>
			<?php endif; ?>

			<div class="entry__details section">
				<div class="container">
					<div class="grid">
						<div class="grid__item <?php echo esc_attr( chipmunk_get_columns( chipmunk_theme_option( 'content_width' ) ) ); ?>">
							<?php chipmunk_get_template_part( 'partials/post-head', array( 'collections' => array(
								'display'  => true,
								'type'     => 'link',
								'quantity' => -1,
							) ) ); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /.entry__hero -->
	<?php endif; ?>

	<div class="section">
		<div class="container">
			<?php if ( ! has_post_thumbnail() or chipmunk_theme_option( 'blog_post_layout' ) == 'no_hero' ) : ?>
				<?php if ( has_post_thumbnail() ) : ?>
					<div class="entry__image">
						<?php the_post_thumbnail( '1280x720', array( 'itemprop' => 'image' ) ); ?>
					</div>
				<?php endif; ?>

				<div class="grid">
					<div class="grid__item <?php echo esc_attr( chipmunk_get_columns( chipmunk_theme_option( 'content_width' ) ) ); ?>">
						<div class="entry__head">
							<?php chipmunk_get_template_part( 'partials/post-head', array( 'collections' => array( 'display' => true ) ) ); ?>
						</div>
					</div>
				</div>
			<?php endif; ?>

			<div class="grid grid--separated">
				<div class="grid__item <?php echo esc_attr( chipmunk_get_columns( chipmunk_theme_option( 'content_width' ) ) ); ?>">
					<?php do_action( 'chipmunk_before_post_content' ); ?>

					<div class="entry__content content" itemprop="articleBody">
						<?php the_content(); ?>
					</div>
					<!-- /.entry -->

					<?php do_action( 'chipmunk_after_post_content' ); ?>

					<div class="entry__extras"><?php do_action( 'chipmunk_post_extras' ); ?></div>

					<?php do_action( 'chipmunk_before_post_footer' ); ?>

					<?php if ( chipmunk_is_feature_enabled( 'sharing', 'post' ) or chipmunk_is_feature_enabled( 'tags', 'post' ) ) : ?>
						<div class="entry__footer">
							<?php if ( ! empty( $tags ) and chipmunk_is_feature_enabled( 'tags', 'post' ) ) : ?>
								<div class="tag__list">
									<?php chipmunk_get_template_part( 'partials/post-terms', array( 'terms' => $tags, 'args' => array( 'quantity' => 5 ) ) ); ?>
								</div>
							<?php endif; ?>

							<?php if ( chipmunk_is_feature_enabled( 'sharing', 'post' ) ) : ?>
								<?php chipmunk_get_template_part( 'partials/share-box' ); ?>
							<?php endif; ?>
						</div>
					<?php endif; ?>

					<?php do_action( 'chipmunk_after_post_footer' ); ?>
				</div>
			</div>
		</div>
	</div>
	<!-- /.section -->
</div>
<!-- /.entry -->
