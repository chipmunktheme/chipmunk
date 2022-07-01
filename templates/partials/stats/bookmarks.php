<?php if ( Chipmunk\Helpers::isFeatureEnabled( 'bookmarks', 'resource' ) && Chipmunk\Helpers::is_addon_enabled( 'members' ) ) : ?>
	<li class="c-stats__item c-stats__item--bookmarks">
		<?php echo ( new Chipmunk\Extensions\Bookmarks( get_the_ID() ) )->get_button( 'toggle_bookmark', 'c-stats__button' ); ?>
	</li>
<?php endif; ?>
