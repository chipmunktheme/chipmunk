<?php if ( Chipmunk\Helpers::isFeatureEnabled( 'author', get_post_type() ) ) : ?>
	<li class="c-stats__item c-stats__item--author" title="<?php esc_attr_e( 'Author', 'chipmunk' ); ?>">
		<?php if ( ! empty( $show_avatar ) ) : ?>
			<div class="u-avatar"><?php echo get_avatar( get_the_author_meta( 'ID' ), 32 ); ?></div>
		<?php else : ?>
			<?php Chipmunk\Helpers::get_template_part( 'partials/icon', [ 'icon' => 'user' ] ); ?>
		<?php endif; ?>

		<span itemprop="author">
			<?php if ( ! empty( $show_link ) ) : ?>
				<?php the_author_posts_link(); ?>
			<?php else : ?>
					<?php the_author(); ?>
			<?php endif; ?>
		</span>
	</li>
<?php endif; ?>
