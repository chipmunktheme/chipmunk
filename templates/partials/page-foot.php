<footer class="page-foot section section_compact">
	<div class="container">
		<div class="page-foot__inner">
			<p class="page-foot__copy">
				<?php printf( esc_html__( '&copy; %1$s %2$s.', 'chipmunk' ), get_bloginfo( 'name' ), date_i18n( 'Y' ) ); ?>
			</p>

			<?php if ( ! chipmunk_theme_option( 'disable_credits' ) ) : ?>
				<p class="page-foot__credits">
					<a href="<?php echo esc_url( chipmunk_external_link( 'https://chipmunktheme.com' ) ); ?>" target="_blank" title="<?php esc_attr_e( 'Chipmunk WordPress Theme', 'chipmunk' ); ?>">
						<?php esc_html_e( 'Chipmunk WordPress Theme', 'chipmunk' ); ?>
						<img src="<?php echo get_template_directory_uri(); ?>/static/dist/images/chipmunk.png" alt="" />
					</a>
				</p>
			<?php endif; ?>
		</div>
		<!-- /.page-foot__inner -->
	</div>
	<!-- /.container -->
</footer>
<!-- /.page-foot -->
