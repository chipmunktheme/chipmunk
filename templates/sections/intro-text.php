<?php $intro_text = chipmunk_theme_option( 'intro_text' ); ?>

<?php if ( ! empty( $intro_text ) ) : ?>
	<div class="section section--intro">
		<div class="container">
			<h2 class="section__title section__separator heading heading--h1">
				<?php echo apply_filters( 'the_content', $intro_text ); ?>
			</h2>
		</div>
	</div>
<?php endif; ?>
