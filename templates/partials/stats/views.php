<?php if ( Chipmunk\Helpers::is_feature_enabled( 'views', get_post_type() ) ) : ?>
	<li class="c-stats__item" title="<?php esc_attr_e( 'Views', 'chipmunk' ); ?>">
		<?php Chipmunk\Helpers::get_template_part( 'partials/icon', array( 'icon' => 'eye' ) ); ?>

		<?php echo Chipmunk\Helpers::format_number( Chipmunk\Extensions\Views::get_views( get_the_ID() ) ); ?>
	</li>
<?php endif; ?>
