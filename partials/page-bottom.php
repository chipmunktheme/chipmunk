<div class="page-foot section section_theme-white">
	<div class="container">
		<div class="row">
			<div class="column column_md-3 column_lg-5">
				<h5 class="heading heading_sm"><?php esc_html_e( 'About', 'chipmunk' ); ?></h5>

				<?php if ( $about_copy = ChipmunkCustomizer::theme_option( 'about_copy' ) ) : ?>
					<div class="page-foot__description">
						<?php echo wp_kses_post( wpautop( $about_copy ) ); ?>
					</div>
				<?php endif; ?>
			</div>

			<div class="column column_md-2 column_md-offset-1 column_lg-2 column_lg-offset-3">
				<h5 class="heading heading_sm"><?php esc_html_e( 'Navigation', 'chipmunk' ); ?></h5>

				<ul class="nav-secondary">
					<?php $menu_items = chipmunk_get_menu_items( 'nav-secondary' ); ?>

					<?php if ( ! empty( $menu_items ) ) : ?>
						<?php foreach ( $menu_items as $menu_item ) : ?>
							<li class="nav-secondary__item">
								<a href="<?php echo $menu_item->url; ?>"><?php echo $menu_item->title; ?></a>
							</li>
						<?php endforeach; ?>
					<?php endif; ?>

					<?php if ( ! ChipmunkCustomizer::theme_option( 'disable_submissions' ) ) : ?>
						<li class="nav-secondary__item">
							<button type="button" data-popup-toggle><?php esc_html_e( 'Submit', 'chipmunk' ); ?></button>
						</li>
					<?php endif; ?>
				</ul>
			</div>

			<div class="column column_lg-2 visible-lg-block">
				<h5 class="heading heading_sm"><?php esc_html_e( 'Follow', 'chipmunk' ); ?></h5>

				<ul class="nav-secondary">
					<?php foreach ( ChipmunkCustomizer::$socials as $social ) : ?>
						<?php $social_slug = strtolower( $social ); ?>

						<?php if ( ChipmunkCustomizer::theme_option( $social_slug ) ) : ?>
							<li class="nav-secondary__item">
								<a href="<?php echo esc_url( ChipmunkCustomizer::theme_option( $social_slug ) ); ?>" target="_blank" rel="nofollow"><?php echo $social; ?></a>
							</li>
						<?php endif; ?>
					<?php endforeach; ?>
				</ul>
			</div>
		</div>
	</div>
</div>
<!-- /.section -->
