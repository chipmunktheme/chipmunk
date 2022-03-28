<header class="c-page-head<?php echo Chipmunk\Helpers::get_theme_option( 'sticky_header' ) ? ' is-sticky' : ''; ?>" data-placehold-height="header">
	<div class="l-container">
		<div class="c-page-head__inner">
			<?php $logo = Chipmunk\Helpers::get_theme_option( 'logo' ); ?>

			<<?php echo is_front_page() ? 'h1' : 'div'; ?> class="c-page-head__logo">
				<a href="<?php echo esc_url( home_url( '/', 'relative' ) ); ?>" rel="index">
					<?php if ( $logo ) : ?>
						<span class="u-hidden-visually"><?php bloginfo( 'name' ); ?></span>
						<img src="<?php echo esc_url( $logo ); ?>" alt="" width="24" height="24" />
					<?php else : ?>
						<?php bloginfo( 'name' ); ?>
					<?php endif; ?>
				</a>
			</<?php echo is_front_page() ? 'h1' : 'div'; ?>>

			<?php if ( has_nav_menu( 'nav-primary' ) ) : ?>
				<nav class="c-page-head__menu c-menu-primary u-visible-lg-block">
					<?php wp_nav_menu( array(
						'theme_location' => 'nav-primary',
						'container'      => '',
					) ); ?>
				</nav>
			<?php endif; ?>

			<div class="c-page-head__cta">
				<?php if ( ! Chipmunk\Helpers::get_theme_option( 'disable_search' ) ) : ?>
					<button class="c-page-head__icon" data-panel="search">
						<?php Chipmunk\Helpers::get_template_part( 'partials/icon', array( 'icon' => 'search', 'size' => 'lg' ) ); ?>
						<span class="u-hidden-visually"><?php esc_html_e( 'Search', 'chipmunk' ); ?></span>
					</button>
				<?php endif; ?>

				<?php if ( Chipmunk\Helpers::has_addon( 'members' ) ) : ?>
					<?php if ( is_user_logged_in() ) : ?>
						<?php $current_user = wp_get_current_user(); ?>

						<div class="c-menu-toolbox u-dropdown__trigger">
							<button class="c-menu-toolbox__dropdown" data-dropdown="click">
								<div class="u-avatar">
									<?php echo get_avatar( $current_user->ID, 64 ); ?>
								</div>

								<?php Chipmunk\Helpers::get_template_part( 'partials/icon', array( 'icon' => 'chevron-down', 'size' => 'sm' ) ); ?>
							</button>

							<ul class="u-dropdown u-dropdown--<?php echo esc_attr( Chipmunk\Helpers::get_theme_option( 'dropdown_theme' ) ); ?>">
								<li class="u-dropdown__item"><a href="<?php echo esc_url( Chipmunk\Addons\Members\Helpers::get_page_permalink( 'dashboard' ) ); ?>" class="u-dropdown__link"><?php esc_html_e( 'Dashboard', 'chipmunk' ); ?></a></li>
								<?php if ( apply_filters( 'chipmunk_enable_user_profiles', false ) ) : ?>
									<li class="u-dropdown__item"><a href="<?php echo esc_url( get_author_posts_url( $current_user->ID ) ); ?>" class="u-dropdown__link"><?php esc_html_e( 'Profile', 'chipmunk' ); ?></a></li>
								<?php endif; ?>
								<li class="u-dropdown__item"><a href="<?php echo esc_url( Chipmunk\Addons\Members\Helpers::get_page_permalink( 'profile' ) ); ?>" class="u-dropdown__link"><?php esc_html_e( 'Edit Profile', 'chipmunk' ); ?></a></li>
								<li class="u-dropdown__item"><?php Chipmunk\Helpers::get_template_part( 'partials/submit-button', array( 'class' => 'u-dropdown__link' ) ); ?></li>
								<li class="u-dropdown__item"><a href="<?php echo esc_url( wp_logout_url() ); ?>" class="u-dropdown__link"><?php esc_html_e( 'Logout', 'chipmunk' ); ?></a></li>
							</ul>
						</div>
					<?php else : ?>
						<a href="<?php echo esc_url( Chipmunk\Addons\Members\Helpers::get_page_permalink( 'login' ) ); ?>" class="c-button c-button--primary-outline u-visible-lg-block">
							<?php esc_html_e( 'Login', 'chipmunk' ); ?>
						</a>

						<?php if ( get_option( 'users_can_register' ) ) : ?>
							<a href="<?php echo esc_url( Chipmunk\Addons\Members\Helpers::get_page_permalink( 'register' ) ); ?>" class="c-button c-button--primary-outline u-visible-lg-block">
								<?php esc_html_e( 'Register', 'chipmunk' ); ?>
							</a>
						<?php endif; ?>
					<?php endif; ?>
				<?php else : ?>
					<?php if ( ! Chipmunk\Helpers::get_theme_option( 'disable_submissions' ) ) : ?>
						<?php Chipmunk\Helpers::get_template_part( 'partials/submit-button', array( 'class' => 'c-button c-button--primary-outline u-visible-lg-block' ) ); ?>
					<?php endif; ?>
				<?php endif; ?>

				<button class="c-page-head__icon u-hamburger u-hidden-lg" data-panel="nav">
					<span></span>
				</button>
			</div>

			<?php if ( ! Chipmunk\Helpers::get_theme_option( 'disable_search' ) ) : ?>
				<div class="c-page-head__search">
					<button type="button" data-panel="search">
						<?php Chipmunk\Helpers::get_template_part( 'partials/icon', array( 'icon' => 'close', 'size' => 'lg' ) ); ?>
						<span class="u-hidden-visually"><?php esc_html_e( 'Close', 'chipmunk' ); ?></span>
					</button>

					<?php Chipmunk\Helpers::get_template_part( 'partials/search-form', array( 'default' => true ) ); ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</header>

<?php if ( Chipmunk\Helpers::get_theme_option( 'sticky_header' ) ) : ?>
	<div class="c-page-head__placeholder"></div>
<?php endif; ?>
