<?php $socials = Chipmunk\Helpers::get_socials(); ?>

<div class="c-page-foot l-section l-section--theme-light">
	<div class="l-container">
		<div class="c-page-foot__inner">
			<div class="c-page-foot__column">
				<h5 class="c-page-foot__heading c-heading c-heading--h6"><?php esc_html_e( 'About', 'chipmunk' ); ?></h5>

				<?php if ( $about_copy = Chipmunk\Customizer::get_theme_option( 'about_copy' ) ) : ?>
					<div class="c-page-foot__description c-content">
						<?php echo do_shortcode( wp_kses_post( wpautop( $about_copy ) ) ); ?>
					</div>
				<?php endif; ?>
			</div>

			<?php $menu_items = Chipmunk\Helpers::get_menu_items( 'nav-secondary' ); ?>

			<?php if ( ! empty( $menu_items ) || ! Chipmunk\Customizer::get_theme_option( 'disable_submissions' ) ) : ?>
				<div class="c-page-foot__column">
					<h5 class="c-page-foot__heading c-heading c-heading--h6"><?php esc_html_e( 'Navigation', 'chipmunk' ); ?></h5>

					<ul class="c-menu-secondary">
						<?php if ( ! empty( $menu_items ) ) : ?>
							<?php foreach ( $menu_items as $menu_item ) : ?>
								<li class="c-menu-secondary__item">
									<a href="<?php echo $menu_item->url; ?>"<?php echo ( ! empty( $menu_item->target ) ? ' target="' . $menu_item->target . '"' : ''); ?> class="c-menu-secondary__link">
										<?php echo $menu_item->title; ?>
									</a>
								</li>
							<?php endforeach; ?>
						<?php endif; ?>

						<?php if ( ! Chipmunk\Customizer::get_theme_option( 'disable_submissions' ) ) : ?>
							<li class="c-menu-secondary__item">
								<?php Chipmunk\Helpers::get_template_part( 'partials/submit-button', array( 'class' => 'nav-secondary__link' ) ); ?>
							</li>
						<?php endif; ?>
					</ul>
				</div>
			<?php endif; ?>

			<?php if ( ! empty( $socials ) ) : ?>
				<div class="c-page-foot__column u-visible-lg-flex">
					<h5 class="c-page-foot__heading c-heading c-heading--h6"><?php esc_html_e( 'Follow', 'chipmunk' ); ?></h5>

					<ul class="c-menu-secondary">
						<?php foreach ( $socials as $social_key => $social_value ) : ?>
							<li class="c-menu-secondary__item">
								<a href="<?php echo esc_url( $social_value ); ?>" target="_blank" rel="nofollow" class="c-menu-secondary__link">
									<?php echo $social_key; ?>
								</a>
							</li>
						<?php endforeach; ?>
					</ul>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>
