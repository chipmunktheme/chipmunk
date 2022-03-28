<div class="c-overlay u-hidden-lg">
	<div class="c-overlay__inner">
		<?php if ( has_nav_menu( 'nav-primary' ) ) : ?>
			<nav class="c-overlay__menu">
				<?php wp_nav_menu( array(
					'theme_location' => 'nav-primary',
					'container'      => '',
					'menu_class'     => 'c-menu-mobile menu',
					'show_toggles'   => true,
				) ); ?>
			</nav>
		<?php endif; ?>

		<?php if ( Chipmunk\Helpers::has_addon( 'members' ) ) : ?>
			<div class="c-overlay__bottom">
				<?php if ( is_user_logged_in() ) : ?>
					<?php Chipmunk\Helpers::get_template_part( 'partials/submit-button', array( 'class' => 'c-button c-button--primary-outline' ) ); ?>
				<?php else : ?>
					<a href="<?php echo esc_url( Chipmunk\Addons\Members\Helpers::get_page_permalink( 'login' ) ); ?>" class="c-button c-button--primary-outline">
						<?php esc_html_e( 'Login', 'chipmunk' ); ?>
					</a>

					<a href="<?php echo esc_url( Chipmunk\Addons\Members\Helpers::get_page_permalink( 'register' ) ); ?>" class="c-button c-button--primary-outline">
						<?php esc_html_e( 'Register', 'chipmunk' ); ?>
					</a>
				<?php endif; ?>
			</div>
		<?php elseif ( ! Chipmunk\Helpers::get_theme_option( 'disable_submissions' ) ) : ?>
			<div class="c-overlay__bottom">
				<?php Chipmunk\Helpers::get_template_part( 'partials/submit-button', array( 'class' => 'c-button c-button--primary-outline' ) ); ?>
			</div>
		<?php endif; ?>
	</div>
</div>
