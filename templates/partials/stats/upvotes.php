<?php if ( Chipmunk\Helpers::is_feature_enabled( 'upvotes', 'resource' ) ) : ?>
	<?php $upvotes = new Chipmunk\Extensions\Upvotes( get_the_ID() ); ?>
	<?php $upvote_button = $upvotes->get_button( 'toggle_upvote', 'c-stats__button' ); ?>
	<?php $upvote_counter = $upvotes->get_content(); ?>

	<?php if ( is_single() || Chipmunk\Helpers::get_theme_option( 'display_resource_as' ) != 'tile' ) : ?>
		<li class="c-stats__item c-stats__item--upvotes">
			<?php echo $upvote_button; ?>
		</li>
	<?php else : ?>
		<li class="c-stats__item c-stats__item--upvotes" title="<?php esc_attr_e( 'Upvotes', 'chipmunk' ); ?>">
			<?php echo $upvote_counter; ?>
		</li>
	<?php endif; ?>
<?php endif; ?>
