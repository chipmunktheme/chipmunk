<?php
$socials_empty = true;

foreach ( ChipmunkCustomizer::$socials as $social ) {
	if ( ChipmunkCustomizer::theme_option( strtolower( $social ) ) ) {
		$socials_empty = false;
	}
}
?>

<?php if ( ! $socials_empty || ! ChipmunkCustomizer::theme_option( 'disable_submissions' ) ) : ?>
	<div class="section section_theme-white section_separated section_compact">
		<div class="container">
			<div class="toolbox">
				<?php if ( ! $socials_empty ) : ?>
					<div class="toolbox__share">
						<nav class="nav-socials">
							<h5 class="nav-socials__title"><?php esc_html_e( 'Follow us', 'chipmunk' ); ?></h5>

							<ul>
								<?php foreach ( ChipmunkCustomizer::$socials as $social ) : ?>
									<?php $social_slug = strtolower( $social ); ?>
									<?php $social_value = ChipmunkCustomizer::theme_option( $social_slug ); ?>

									<?php if ( $social_value ) : ?>
										<li class="nav-socials__item">
											<a href="<?php echo esc_url( $social_value ); ?>" title="<?php echo $social; ?>" target="_blank">
												<i class="icon icon_<?php echo $social_slug; ?>" aria-hidden="true"></i>
												<span class="sr-only"><?php echo $social; ?></span>
											</a>
										</li>
									<?php endif; ?>
								<?php endforeach; ?>
							</ul>
						</nav>
						<!-- /.nav-socials -->
					</div>
				<?php endif; ?>

				<?php if ( ! ChipmunkCustomizer::theme_option( 'disable_submissions' ) ) : ?>
					<div class="toolbox__cta<?php echo ! $socials_empty ? ' visible-md-flex ' : ''; ?>">
						<p<?php echo ! $socials_empty ? ' class="visible-lg-block"': ''; ?>><?php echo esc_html( ChipmunkCustomizer::theme_option( 'submit_tagline' ) ); ?></p>
						<button type="button" class="toolbox__button button button_primary" data-popup-toggle><?php esc_html_e( 'Submit', 'chipmunk' ); ?></button>
					</div>
				<?php endif; ?>
			</div>
			<!-- /.toolbox -->
		</div>
	</div>
	<!-- /.section -->
<?php endif; ?>
