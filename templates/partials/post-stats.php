<?php
	global $wp_query;

	$is_single_resource = ( ( is_singular( 'resource' ) && $wp_query->current_post == 0 ) or is_search() );

	$collections = wp_get_post_terms( get_the_ID(), ( get_post_type() == 'post' ? 'category' : 'resource-collection' ) );
?>

<?php if ( isset( $args ) && $args['display'] && $collections ) : ?>
	<li class="stats__item <?php echo isset( $args['desktop_only'] ) ? 'visible-lg-block' : ''; ?>">
		<?php chipmunk_get_template_part( 'partials/post-terms', array( 'terms' => $collections, 'args' => $args ) ); ?>
	</li>
<?php endif; ?>

<?php if ( chipmunk_is_feature_enabled( 'date', get_post_type() ) ) : ?>
	<li class="stats__item" title="<?php esc_attr_e( 'Published', 'chipmunk' ); ?>: <?php echo get_the_date( 'j F Y' ); ?>">
		<?php chipmunk_get_template_part( 'partials/icon', array( 'icon' => 'clock' ) ); ?>

		<time datetime="<?php echo get_the_date( 'c' ); ?>" itemprop="datePublished"><?php echo get_the_date( chipmunk_theme_option( 'use_system_date_format' ) ? get_option( 'date_format' ) : 'M j, Y' ); ?></time>
	</li>
<?php endif; ?>

<?php if ( chipmunk_is_feature_enabled( 'views', get_post_type() ) ) : ?>
	<li class="stats__item" title="<?php esc_attr_e( 'Views', 'chipmunk' ); ?>">
		<?php chipmunk_get_template_part( 'partials/icon', array( 'icon' => 'eye' ) ); ?>

		<?php echo chipmunk_format_number( chipmunk_get_views( get_the_ID() ) ); ?>
	</li>
<?php endif; ?>

<?php if ( chipmunk_is_feature_enabled( 'ratings', 'resource' ) &&  chipmunk_has_plugin( 'ratings' ) ) : ?>
	<?php $average_rating = ChipmunkRatings\Helpers::get_post_rating( get_the_ID() ); ?>

	<?php if ( ! empty( $average_rating ) && ! $is_single_resource ) : ?>
		<li class="stats__item">
			<?php chipmunk_get_template_part( 'partials/icon', array( 'icon' => 'star' ) ); ?>

			<?php echo esc_html( $average_rating ); ?>
		</li>
	<?php endif; ?>
<?php endif; ?>

<?php if ( chipmunk_is_feature_enabled( 'upvotes', 'resource' ) ) : ?>
	<?php $upvotes = new ChipmunkUpvotes( get_the_ID() ); ?>
	<?php $upvote_button = $upvotes->get_button( 'toggle_upvote', 'stats__button' ); ?>
	<?php $upvote_counter = $upvotes->get_content(); ?>

	<?php if ( $is_single_resource ) : ?>
		<li class="stats__item"><?php echo $upvote_button; ?></li>
	<?php else : ?>
		<?php if ( chipmunk_theme_option( 'display_resource_as' ) != 'tile' ) : ?>
			<li class="stats__item stats__item--sided"><?php echo $upvote_button; ?></li>
		<?php else : ?>
			<li class="stats__item" title="<?php esc_attr_e( 'Upvotes', 'chipmunk' ); ?>"><?php echo $upvote_counter; ?></li>
		<?php endif; ?>
	<?php endif; ?>
<?php endif; ?>

<?php if ( chipmunk_is_feature_enabled( 'bookmarks', 'resource' ) && chipmunk_has_plugin( 'members' ) ) : ?>
	<?php if ( $is_single_resource ) : ?>
		<li class="stats__item">
			<?php echo ( new ChipmunkBookmarks( get_the_ID() ) )->get_button( 'toggle_bookmark', 'stats__button' ); ?>
		</li>
	<?php endif; ?>
<?php endif; ?>
