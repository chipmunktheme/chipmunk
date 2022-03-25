<?php if ( Chipmunk\Helpers::is_feature_enabled( 'bookmarks', 'resource' ) && Chipmunk\Helpers::has_addon( 'members' ) ) : ?>
	<li class="c-stats__item c-stats__item--bookmarks">
		<?php echo ( new Chipmunk\Extensions\Bookmarks( get_the_ID() ) )->get_button( 'toggle_bookmark', 'c-stats__button' ); ?>
	</li>
<?php endif; ?>
