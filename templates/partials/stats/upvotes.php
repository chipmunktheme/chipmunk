<?php if ( Chipmunk\Helpers::is_feature_enabled( 'upvotes', 'resource' ) ) : ?>
	<?php $upvotes = new Chipmunk\Extensions\Upvotes( get_the_ID() ); ?>
	<?php $upvote_button = $upvotes->get_button( 'toggle_upvote', 'c-stats__button' ); ?>
	<?php $upvote_counter = $upvotes->get_content(); ?>

	<li class="c-stats__item" title="<?php esc_attr_e( 'Upvotes', 'chipmunk' ); ?>">
		<?php if ( is_single() || Chipmunk\Customizer::get_theme_option( 'display_resource_as' ) != 'tile' ) : ?>
			<?php echo $upvote_button; ?>
		<?php else : ?>
			<?php echo $upvote_counter; ?>
		<?php endif; ?>
	</li>
<?php endif; ?>
