<header class="page-head"<?php echo chipmunk_theme_option( 'sticky_header' ) ? 'data-sticky="#head-trigger"' : ''; ?>>
	<div class="container">
		<div class="page-head__inner">
			<?php $logo = chipmunk_theme_option( 'logo' ); ?>

			<?php ob_start(); ?>
			<a href="<?php echo esc_url( home_url( '/', 'relative' ) ); ?>" rel="index">
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
					<?php get_template_part( 'templates/partials/nav' ); ?>

					<button type="button" class="nav-primary__close hidden-lg" data-toggle="nav">
						<?php chipmunk_get_template( 'partials/icon', array( 'icon' => 'close' ) ); ?>
						<span class="sr-only"><?php esc_html_e( 'Close', 'chipmunk' ); ?></span>
					</button>
				</div>
				<!-- /.nav-primary__inner -->
			</nav>
			<!-- /.nav-primary -->

			<div class="page-head__cta">
				<?php if ( ! chipmunk_theme_option( 'disable_search' ) ) : ?>
					<button type="button" class="page-head__search" data-toggle="search">
						<?php chipmunk_get_template( 'partials/icon', array( 'icon' => 'search' ) ); ?>
						<span class="sr-only"><?php esc_html_e( 'Search', 'chipmunk' ); ?></span>
					</button>
				<?php endif; ?>

				<?php if ( chipmunk_has_plugin( 'Members' ) ) : ?>
					<?php if ( is_user_logged_in() ) : ?>
						<a href="<?php echo esc_url( ChipmunkMembers::get_page_permalink( 'dashboard' ) ); ?>" class="button button--secondary visible-lg-block">
							<?php esc_html_e( 'Dashboard', 'chipmunk' ); ?>
						</a>

						<a href="<?php echo esc_url( wp_logout_url() ); ?>" class="button button--secondary visible-lg-block">
							<?php esc_html_e( 'Logout', 'chipmunk' ); ?>
						</a>
					<?php else : ?>
						<a href="<?php echo esc_url( ChipmunkMembers::get_page_permalink( 'login' ) ); ?>" class="button button--secondary visible-lg-block">
							<?php esc_html_e( 'Login', 'chipmunk' ); ?>
						</a>

						<?php if ( get_option( 'users_can_register' ) ) : ?>
							<a href="<?php echo esc_url( ChipmunkMembers::get_page_permalink( 'register' ) ); ?>" class="button button--secondary visible-lg-block">
								<?php esc_html_e( 'Register', 'chipmunk' ); ?>
							</a>
						<?php endif; ?>
					<?php endif; ?>
				<?php else : ?>
					<?php if ( ! chipmunk_theme_option( 'disable_submissions' ) ) : ?>
						<button type="button" class="button button--secondary visible-lg-block" data-popup="#submit">
							<?php esc_html_e( 'Submit', 'chipmunk' ); ?>
						</button>
					<?php endif; ?>
				<?php endif; ?>

				<button type="button" class="page-head__trigger button button--secondary hidden-lg" data-toggle="nav">
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

<?php if ( chipmunk_theme_option( 'sticky_header' ) ) : ?>
	<div class="page-head__trigger" id="head-trigger"></div>
<?php endif; ?>
