<?php $tags = wp_get_post_tags( get_the_ID() ); ?>

<article itemscope itemtype="http://schema.org/BlogPosting">
	<?php if ( has_post_thumbnail() && Chipmunk\Customizer::get_theme_option( 'blog_post_layout' ) == 'hero' ) : ?>
		<section class="c-entry__hero">
			<?php if ( has_post_thumbnail() ) : ?>
				<div class="c-entry__background">
					<?php the_post_thumbnail( '1920x1080', array( 'itemprop' => 'image' ) ); ?>
				</div>
			<?php endif; ?>

			<div class="c-entry__details l-section">
				<div class="l-container">
					<div class="l-wrapper">
						<?php Chipmunk\Helpers::get_template_part( 'partials/post-head', array( 'collections' => array(
							'display'  => true,
							'type'     => 'link',
							'quantity' => -1,
						) ) ); ?>
					</div>
				</div>
			</div>
		</section>
	<?php endif; ?>

	<section class="l-section">
		<div class="l-container">
			<?php if ( ! has_post_thumbnail() || Chipmunk\Customizer::get_theme_option( 'blog_post_layout' ) == 'no_hero' ) : ?>
				<?php if ( has_post_thumbnail() ) : ?>
					<div class="c-entry__image">
						<?php the_post_thumbnail( '1280x720', array( 'itemprop' => 'image' ) ); ?>
					</div>
				<?php endif; ?>

				<div class="l-wrapper">
					<div class="c-entry__head">
						<?php Chipmunk\Helpers::get_template_part( 'partials/post-head', array( 'collections' => array( 'display' => true ) ) ); ?>
					</div>
				</div>
			<?php endif; ?>

			<div class="l-wrapper">
				<div class="c-entry">
					<?php do_action( 'chipmunk_before_post_content' ); ?>

					<div class="c-entry__content c-content" itemprop="articleBody">
						<?php the_content(); ?>
					</div>

					<?php do_action( 'chipmunk_after_post_content' ); ?>

					<div class="c-entry__extras"><?php do_action( 'chipmunk_post_extras' ); ?></div>

					<?php do_action( 'chipmunk_before_post_footer' ); ?>

					<?php if ( Chipmunk\Helpers::is_feature_enabled( 'sharing', 'post' ) || Chipmunk\Helpers::is_feature_enabled( 'tags', 'post' ) ) : ?>
						<div class="c-entry__footer">
							<?php if ( ! empty( $tags ) && Chipmunk\Helpers::is_feature_enabled( 'tags', 'post' ) ) : ?>
								<div class="c-tag__list">
									<?php Chipmunk\Helpers::get_template_part( 'partials/post-terms', array( 'terms' => $tags, 'args' => array( 'quantity' => 5 ), 'icon' => 'tag' ) ); ?>
								</div>
							<?php endif; ?>

							<?php if ( Chipmunk\Helpers::is_feature_enabled( 'sharing', 'post' ) ) : ?>
								<?php Chipmunk\Helpers::get_template_part( 'partials/share-box' ); ?>
							<?php endif; ?>
						</div>
					<?php endif; ?>

					<?php do_action( 'chipmunk_after_post_footer' ); ?>
				</div>
			</div>
		</div>
	</section>
</article>
