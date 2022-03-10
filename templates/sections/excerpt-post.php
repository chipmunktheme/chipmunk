<div class="c-entry c-entry__tile l-wrapper">
	<?php if ( has_post_thumbnail() ) : ?>
		<a href="<?php the_permalink(); ?>" class="c-entry__image">
			<?php the_post_thumbnail( '1280x720' ); ?>
		</a>
	<?php endif; ?>

	<div class="c-entry__head">
		<?php Chipmunk\Helpers::get_template_part( 'partials/post-head' ); ?>
	</div>

	<?php if ( ! empty( get_the_content() ) ) : ?>
		<div class="c-entry__description c-content">
			<?php echo esc_html( get_the_excerpt() ); ?>
		</div>
	<?php endif; ?>

	<a href="<?php the_permalink(); ?>" class="c-button c-button--primary-outline">
		<?php esc_html_e( 'Read more', 'chipmunk' ); ?>
	</a>
</div>
