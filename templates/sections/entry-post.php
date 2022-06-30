<article itemscope itemtype="http://schema.org/BlogPosting">
	<?php if ( has_post_thumbnail() && Chipmunk\Helpers::get_theme_option( 'blog_post_layout' ) == 'hero' ) : ?>
		<section class="c-entry__hero">
			<?php the_post_thumbnail( '1920x1080', [ 'itemprop' => 'image' ] ); ?>

			<div class="c-entry__details l-section">
				<div class="l-container">
					<div class="l-wrapper">
						<?php Chipmunk\Helpers::get_template_part( 'partials/post-head' ); ?>
					</div>
				</div>
			</div>
		</section>
	<?php endif; ?>

	<section class="l-section">
		<div class="l-container">
			<div class="l-wrapper">
				<div class="c-entry">
					<?php if ( ! has_post_thumbnail() || Chipmunk\Helpers::get_theme_option( 'blog_post_layout' ) == 'no_hero' ) : ?>
						<?php if ( has_post_thumbnail() ) : ?>
							<div class="c-entry__image c-media c-media--16-9">
								<?php the_post_thumbnail( '1280x720', [ 'itemprop' => 'image' ] ); ?>
							</div>
						<?php endif; ?>

						<div class="c-entry__head">
							<?php Chipmunk\Helpers::get_template_part( 'partials/post-head' ); ?>
						</div>
					<?php endif; ?>

					<?php do_action( 'chipmunk_before_post_content' ); ?>

					<div class="c-entry__content c-content c-content--type" itemprop="articleBody">
						<?php the_content(); ?>
					</div>

					<?php do_action( 'chipmunk_after_post_content' ); ?>

					<div class="c-entry__extras"><?php do_action( 'chipmunk_post_extras' ); ?></div>

					<?php do_action( 'chipmunk_before_post_footer' ); ?>

					<?php if ( Chipmunk\Helpers::is_feature_enabled( 'sharing', 'post' ) || Chipmunk\Helpers::is_feature_enabled( 'tags', 'post' ) ) : ?>
						<div class="c-entry__footer">
							<?php if ( Chipmunk\Helpers::is_feature_enabled( 'sharing', 'post' ) ) : ?>
								<?php Chipmunk\Helpers::get_template_part( 'partials/share-box' ); ?>
							<?php endif; ?>

							<?php Chipmunk\Helpers::get_template_part( 'partials/stats', [
								'stats' => [
									'terms' => [
										'term_args' => [
											'taxonomy' => 'post_tag',
										],
									],
								],
							] ); ?>
						</div>
					<?php endif; ?>

					<?php do_action( 'chipmunk_after_post_footer' ); ?>
				</div>
			</div>
		</div>
	</section>
</article>
