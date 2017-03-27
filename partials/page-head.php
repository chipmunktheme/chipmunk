<header class="page-head">
	<div class="container">
		<div class="page-head__inner">
			<?php $logo = chipmunk_theme_option( 'logo' ); ?>

			<?php ob_start(); ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="index">
				<?php if ( $logo ) : ?>
					<span class="sr-only"><?php bloginfo( 'name' ); ?></span>
					<img src="<?php echo esc_url( $logo ); ?>" alt="" />
				<?php else : ?>
					<?php bloginfo( 'name' ); ?>
				<?php endif; ?>
			</a>
			<?php $content = ob_get_clean(); ?>

			<?php echo chipmunk_conditional_markup( is_front_page(), 'h1', 'div', 'page-head__logo', $content ); ?>

			<nav class="nav-primary">
				<div class="nav-primary__inner">
					<?php get_template_part( 'partials/nav' ); ?>

					<button type="button" class="nav-primary__close hidden-lg" data-nav-toggle>
						<i class="icon icon_close" aria-hidden="true"></i>
						<span class="sr-only"><?php esc_html_e( 'Close', 'chipmunk' ); ?></span>
					</button>
				</div>
				<!-- /.nav-primary__inner -->
			</nav>
			<!-- /.nav-primary -->

			<div class="page-head__cta">
				<?php if ( ! chipmunk_theme_option( 'disable_search' ) ) : ?>
					<button type="button" class="page-head__search" data-search-toggle>
						<i class="icon icon_search" aria-hidden="true"></i>
						<span class="sr-only"><?php esc_html_e( 'Search', 'chipmunk' ); ?></span>
					</button>
				<?php endif; ?>

				<?php if ( ! chipmunk_theme_option( 'disable_submissions' ) ) : ?>
					<button type="button" class="button button_secondary visible-lg-block" data-popup-toggle>
						<?php esc_html_e( 'Submit', 'chipmunk' ); ?>
					</button>
				<?php endif; ?>

				<button type="button" class="page-head__trigger button button_secondary hidden-lg" data-nav-toggle>
					<?php esc_html_e( 'Menu', 'chipmunk' ); ?>
				</button>
			</div>
			<!-- /.page-head__cta -->
		</div>
		<!-- /.page-head__inner -->
	</div>
	<!-- /.container -->
</header>
<!-- /.page-head -->
