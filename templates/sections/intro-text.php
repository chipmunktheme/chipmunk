<?php $intro_text = chipmunk_theme_option( 'intro_text' ); ?>

<?php if ( ! empty( $intro_text ) ) : ?>
	<div class="section section--intro">
		<div class="container">
			<h2 class="section__title section__separator heading heading--xl">
				<?php echo do_shortcode( wp_kses_post( $intro_text ) ); ?>
			</h2>
		</div>
	</div>
<?php endif; ?>
