<div class="c-entry__tile l-wrapper">
	<?php if ( has_post_thumbnail() ) : ?>
		<a href="<?php the_permalink(); ?>" class="c-entry__image">
			<?php the_post_thumbnail( '1280x720' ); ?>
		</a>
	<?php endif; ?>

	<div class="c-entry__head">
		<?php Chipmunk\Helpers::get_template_part( 'partials/post-head', array( 'collections' => array(
			'display'  => true,
			'type'     => 'link',
			'quantity' => -1,
		) ) ); ?>

		<?php if ( ! empty( get_the_content() ) ) : ?>
			<div class="c-entry__content c-content">
				<?php echo esc_html( Chipmunk\Helpers::truncate_string( get_the_excerpt(), 250 ) ); ?>
			</div>
		<?php endif; ?>

		<a href="<?php the_permalink(); ?>" class="c-entry__button c-button c-button--primary-outline">
			<?php esc_html_e( 'Read more', 'chipmunk' ); ?>
		</a>
	</div>
</div>
