<aside class="overlay hidden-lg">
    <div class="container">
        <div class="overlay__inner">
			<?php if ( has_nav_menu( 'nav-primary' ) ) : ?>
				<nav class="overlay__nav">
					<?php wp_nav_menu( array(
						'theme_location' => 'nav-primary',
						'container'      => '',
						'menu_class'     => 'nav-mobile menu',
						'show_toggles'   => true,
					) ); ?>
				</nav>
			<?php endif; ?>

			<?php if ( chipmunk_has_plugin( 'members' ) ) : ?>
				<div class="overlay__bottom">
					<?php if ( is_user_logged_in() ) : ?>
						<?php chipmunk_get_template_part( 'partials/submit-button', array( 'class' => 'button button--primary-outline' ) ); ?>
					<?php else : ?>
						<a href="<?php echo esc_url( ChipmunkMembers::get_page_permalink( 'login' ) ); ?>" class="button button--primary-outline">
							<?php esc_html_e( 'Login', 'chipmunk' ); ?>
						</a>

						<a href="<?php echo esc_url( ChipmunkMembers::get_page_permalink( 'register' ) ); ?>" class="button button--primary-outline">
							<?php esc_html_e( 'Register', 'chipmunk' ); ?>
						</a>
					<?php endif; ?>
				</div>
			<?php elseif ( ! chipmunk_theme_option( 'disable_submissions' ) ) : ?>
				<div class="overlay__bottom">
					<?php chipmunk_get_template_part( 'partials/submit-button', array( 'class' => 'button button--primary-outline' ) ); ?>
				</div>
			<?php endif; ?>
        </div>
    </div>
</aside>
