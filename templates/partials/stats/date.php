<?php if ( Chipmunk\Helpers::is_feature_enabled( 'date', get_post_type() ) ) : ?>
	<li class="c-stats__item" title="<?php esc_attr_e( 'Published', 'chipmunk' ); ?>: <?php the_time( 'Y-m-d H:i' ); ?>">
		<?php Chipmunk\Helpers::get_template_part( 'partials/icon', array( 'icon' => 'clock' ) ); ?>

		<time datetime="<?php the_time( 'c' ); ?>" itemprop="datePublished">
			<?php the_time( get_option( 'date_format' ) ); ?>
		</time>
	</li>
<?php endif; ?>
