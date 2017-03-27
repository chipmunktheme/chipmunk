<?php $socials = chipmunk_get_socials(); ?>

<?php if ( ! empty( $socials ) || ! chipmunk_theme_option( 'disable_submissions' ) ) : ?>
	<div class="section section_theme-white section_separated section_compact">
		<div class="container">
			<div class="toolbox">
				<?php if ( ! empty( $socials ) ) : ?>
					<div class="toolbox__share">
						<nav class="nav-socials">
							<h5 class="nav-socials__title"><?php esc_html_e( 'Follow us', 'chipmunk' ); ?></h5>

							<ul>
								<?php foreach ( $socials as $social_key => $social_value ) : ?>
									<li class="nav-socials__item">
										<a href="<?php echo esc_url( $social_value ); ?>" title="<?php echo $social_key; ?>" target="_blank">
											<i class="icon icon_<?php echo strtolower( $social_key ); ?>" aria-hidden="true"></i>
											<span class="sr-only"><?php echo $social_key; ?></span>
										</a>
									</li>
								<?php endforeach; ?>
							</ul>
						</nav>
						<!-- /.nav-socials -->
					</div>
				<?php endif; ?>

				<?php if ( ! chipmunk_theme_option( 'disable_submissions' ) ) : ?>
					<div class="toolbox__cta<?php echo ! empty( $socials ) ? ' visible-md-flex ' : ''; ?>">
						<p<?php echo ! empty( $socials ) ? ' class="visible-lg-block"': ''; ?>><?php echo esc_html( chipmunk_theme_option( 'submit_tagline' ) ); ?></p>
						<button type="button" class="toolbox__button button button_primary" data-popup-toggle><?php esc_html_e( 'Submit', 'chipmunk' ); ?></button>
					</div>
				<?php endif; ?>
			</div>
			<!-- /.toolbox -->
		</div>
	</div>
	<!-- /.section -->
<?php endif; ?>
