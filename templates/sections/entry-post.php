<?php $tags = wp_get_post_tags( get_the_ID() ); ?>

<?php if ( has_post_thumbnail() and chipmunk_theme_option( 'blog_post_layout' ) == 'hero' ) : ?>
	<div class="entry__hero">
		<?php if ( has_post_thumbnail() ) : ?>
			<div class="entry__background" data-rellax data-rellax-speed="-5">
				<?php the_post_thumbnail( '1920x1080' ); ?>
			</div>
		<?php endif; ?>

		<div class="entry__details section">
			<div class="container">
				<div class="row">
					<div class="column <?php echo ! is_active_sidebar( 'blog-sidebar' ) ? 'column--lg-8 column--lg-offset-2' : ''; ?>">
						<?php chipmunk_get_template( 'partials/post-head', array( 'collections' => array(
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
					<?php the_post_thumbnail( '1280x720' ); ?>
				</div>
			<?php endif; ?>

			<div class="row">
				<div class="column <?php echo ! is_active_sidebar( 'blog-sidebar' ) ? esc_attr( chipmunk_get_columns( chipmunk_theme_option( 'content_width' ) ) ) : ''; ?>">
					<div class="entry__head">
						<?php chipmunk_get_template( 'partials/post-head', array( 'collections' => array( 'display' => true ) ) ); ?>
					</div>
				</div>
			</div>
		<?php endif; ?>

		<div class="row row_separated">
			<div class="column <?php echo ! is_active_sidebar( 'blog-sidebar' ) ? esc_attr( chipmunk_get_columns( chipmunk_theme_option( 'content_width' ) ) ) : 'column--lg-8'; ?>">
				<div class="entry__content content">
					<?php the_content(); ?>
				</div>
				<!-- /.entry -->

				<?php if ( ! chipmunk_theme_option( 'blog_disable_sharing' ) and ! chipmunk_theme_option( 'blog_disable_tags' ) ) : ?>
					<div class="entry__footer">
						<?php if ( ! empty( $tags ) and ! chipmunk_theme_option( 'blog_disable_tags' ) ) : ?>
							<div class="tag__list">
								<?php chipmunk_get_template( 'partials/post-terms', array( 'terms' => $tags, 'args' => array( 'quantity' => 5 ) ) ); ?>
							</div>
						<?php endif; ?>

						<?php if ( ! chipmunk_theme_option( 'blog_disable_tags' ) ) : ?>
							<?php get_template_part( 'templates/partials/share-box' ); ?>
						<?php endif; ?>
					</div>
				<?php endif; ?>
			</div>

			<?php if ( is_active_sidebar( 'blog-sidebar' ) ) : ?>
				<div class="column column--lg-4">
					<?php dynamic_sidebar( 'blog-sidebar' ); ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>
<!-- /.section -->
