<?php $socials = Chipmunk\Helpers::get_socials(); ?>

<?php if ( ! empty( $socials ) || ! Chipmunk\Customizer::get_theme_option( 'disable_submissions' ) ) : ?>
	<div class="l-section l-section--theme-light l-section--compact">
		<div class="l-container">
			<div class="c-toolbox">
				<?php if ( ! empty( $socials ) ) : ?>
					<div class="c-toolbox__share">
						<nav class="c-menu-socials">
							<h5 class="c-menu-socials__title"><?php esc_html_e( 'Follow us', 'chipmunk' ); ?></h5>

							<ul class="c-menu-socials__list">
								<?php foreach ( $socials as $social_key => $social_value ) : ?>
									<li class="c-menu-socials__item">
										<a href="<?php echo esc_url( $social_value ); ?>" class="c-menu-socials__link" title="<?php echo $social_key; ?>" target="_blank">
											<?php Chipmunk\Helpers::get_template_part( 'partials/icon', array( 'icon' => 'social-' . strtolower( $social_key ) ) ); ?>
											<span class="u-hidden-visually"><?php echo $social_key; ?></span>
										</a>
									</li>
								<?php endforeach; ?>
							</ul>
						</nav>
					</div>
				<?php endif; ?>

				<?php if ( ! Chipmunk\Customizer::get_theme_option( 'disable_submissions' ) ) : ?>
					<div class="c-toolbox__cta<?php echo ! empty( $socials ) ? ' u-visible-md-flex ' : ''; ?>">
						<p<?php echo ! empty( $socials ) ? ' class="u-visible-lg-block"': ''; ?>><?php echo esc_html( Chipmunk\Customizer::get_theme_option( 'submit_tagline' ) ); ?></p>
						<?php Chipmunk\Helpers::get_template_part( 'partials/submit-button', array( 'class' => 'c-toolbox__button c-button c-button--primary' ) ); ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
<?php endif; ?>
