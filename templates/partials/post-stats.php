<?php
global $wp_query;

$collections = wp_get_post_terms( get_the_ID(), ( get_post_type() == 'post' ? 'category' : 'resource-collection' ) );
?>

<?php if ( isset( $args ) && $args['display'] && $collections ) : ?>
	<li class="stats__item <?php echo $args['desktop_only'] ? 'visible-lg-block' : ''; ?>">
		<?php chipmunk_get_template( 'partials/post-terms', array( 'terms' => $collections, 'args' => $args ) ); ?>
	</li>
<?php endif; ?>

<?php if ( chipmunk_is_feature_enabled( 'date', get_post_type() ) ) : ?>
	<li class="stats__item" title="<?php esc_attr_e( 'Published', 'chipmunk' ); ?>: <?php echo get_the_date( 'j F Y' ); ?>">
		<?php chipmunk_get_template( 'partials/icon', array( 'icon' => 'clock' ) ); ?>

		<time datetime="<?php echo get_the_date( 'c' ); ?>"><?php echo get_the_date( 'M j, Y' ); ?></time>
	</li>
<?php endif; ?>

<?php if ( chipmunk_is_feature_enabled( 'views', get_post_type() ) ) : ?>
	<li class="stats__item" title="<?php esc_attr_e( 'Views', 'chipmunk' ); ?>">
		<?php chipmunk_get_template( 'partials/icon', array( 'icon' => 'eye' ) ); ?>

		<?php echo chipmunk_format_number( chipmunk_get_views( get_the_ID() ) ); ?>
	</li>
<?php endif; ?>

<?php if ( chipmunk_is_feature_enabled( 'upvotes', 'resource' ) ) : ?>
	<?php $upvotes = new ChipmunkUpvotes( get_the_ID() ); ?>
	<?php $upvote_button = $upvotes->get_button( 'toggle_upvote', 'stats__button' ); ?>
	<?php $upvote_counter = $upvotes->get_content(); ?>

	<?php if ( ( is_singular( 'resource' ) && $wp_query->current_post == 0 ) or is_search() ) : ?>
		<li class="stats__item"><?php echo $upvote_button; ?></li>
	<?php else : ?>
		<?php if ( chipmunk_theme_option( 'display_resource_as' ) != 'tile' ) : ?>
			<li class="stats__item stats__item--sided"><?php echo $upvote_button; ?></li>
		<?php else : ?>
			<li class="stats__item" title="<?php esc_attr_e( 'Upvotes', 'chipmunk' ); ?>"><?php echo $upvote_counter; ?></li>
		<?php endif; ?>
	<?php endif; ?>
<?php endif; ?>

<?php if ( chipmunk_has_plugin( 'members' ) && chipmunk_is_feature_enabled( 'bookmarks', 'resource' ) ) : ?>
	<?php if ( ( is_singular( 'resource' ) && $wp_query->current_post == 0 ) or is_search() ) : ?>
		<li class="stats__item">
			<?php echo ( new ChipmunkBookmarks( get_the_ID() ) )->get_button( 'toggle_bookmark', 'stats__button' ); ?>
		</li>
	<?php endif; ?>
<?php endif; ?>
