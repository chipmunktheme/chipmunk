<?php $socials = chipmunk_get_socials(); ?>

<div class="page-foot section section--theme-light">
	<div class="container">
		<div class="grid">
			<div class="grid__item grid__item--md-3 grid__item--lg-<?php echo empty( $socials ) ? '10 text-right' : '8'; ?>">
				<h5 class="page-foot__heading heading heading--h5"><?php esc_html_e( 'About', 'chipmunk' ); ?></h5>

				<?php if ( $about_copy = chipmunk_theme_option( 'about_copy' ) ) : ?>
					<div class="page-foot__description">
						<?php echo do_shortcode( wp_kses_post( wpautop( $about_copy ) ) ); ?>
					</div>
				<?php endif; ?>
			</div>

			<?php $menu_items = chipmunk_get_menu_items( 'nav-secondary' ); ?>

			<?php if ( ! empty( $menu_items ) || ! chipmunk_theme_option( 'disable_submissions' ) ) : ?>
				<div class="grid__item grid__item--md-2 grid__item--lg-2 <?php echo empty( $socials ) ? 'text-right' : ''; ?>">
					<h5 class="page-foot__heading heading heading--h5"><?php esc_html_e( 'Navigation', 'chipmunk' ); ?></h5>

					<ul class="nav-secondary">
						<?php if ( ! empty( $menu_items ) ) : ?>
							<?php foreach ( $menu_items as $menu_item ) : ?>
								<li class="nav-secondary__item">
									<a href="<?php echo $menu_item->url; ?>"<?php echo ( ! empty( $menu_item->target ) ? ' target="' . $menu_item->target . '"' : ''); ?>><?php echo $menu_item->title; ?></a>
								</li>
							<?php endforeach; ?>
						<?php endif; ?>

						<?php if ( ! chipmunk_theme_option( 'disable_submissions' ) ) : ?>
							<li class="nav-secondary__item">
								<?php chipmunk_get_template_part( 'partials/submit-button' ); ?>
							</li>
						<?php endif; ?>
					</ul>
				</div>
			<?php endif; ?>

			<?php if ( ! empty( $socials ) ) : ?>
				<div class="grid__item grid__item--lg-2 visible-lg-block">
					<h5 class="page-foot__heading heading heading--h5"><?php esc_html_e( 'Follow', 'chipmunk' ); ?></h5>

					<ul class="nav-secondary">
						<?php foreach ( $socials as $social_key => $social_value ) : ?>
							<li class="nav-secondary__item">
								<a href="<?php echo esc_url( $social_value ); ?>" target="_blank" rel="nofollow"><?php echo $social_key; ?></a>
							</li>
						<?php endforeach; ?>
					</ul>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>
<!-- /.section -->
