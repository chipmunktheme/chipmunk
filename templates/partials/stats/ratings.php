<?php if ( Chipmunk\Helpers::is_feature_enabled( 'ratings', get_post_type() ) && Chipmunk\Helpers::has_plugin( 'ratings' ) ) : ?>
	<?php $average_rating = ChipmunkRatings\Helpers::get_post_rating( get_the_ID() ); ?>

	<?php if ( ! empty( $average_rating ) ) : ?>
		<li class="c-stats__item" title="<?php esc_attr_e( 'Ratings', 'chipmunk' ); ?>">
			<?php Chipmunk\Helpers::get_template_part( 'partials/icon', array( 'icon' => 'star' ) ); ?>
			<?php echo esc_html( $average_rating ); ?>
		</li>
	<?php endif; ?>
<?php endif; ?>
