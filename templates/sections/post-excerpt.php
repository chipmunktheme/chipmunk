<div class="entry__tile column <?php echo esc_attr( chipmunk_get_columns( chipmunk_theme_option( 'content_width' ) ) ); ?>">
	<?php if ( has_post_thumbnail() ) : ?>
		<a href="<?php the_permalink(); ?>" class="entry__image">
			<?php the_post_thumbnail( '1280x720' ); ?>
		</a>
	<?php endif; ?>

	<div class="entry__head">
		<?php chipmunk_get_template( 'partials/post-head', array( 'collections' => array(
			'display'  => true,
			'type'     => 'link',
			'quantity' => -1,
		) ) ); ?>

		<?php if ( ! empty( get_the_content() ) ) : ?>
			<div class="entry__content content">
				<?php echo esc_html( chipmunk_truncate_string( get_the_excerpt(), 250 ) ); ?>
			</div>
			<!-- /.entry__content -->
		<?php endif; ?>

		<a href="<?php the_permalink(); ?>" class="entry__button button button--primary-outline">
			<?php esc_html_e( 'Read more', 'chipmunk' ); ?>
		</a>
	</div>
	<!-- /.entry__head -->
</div>
