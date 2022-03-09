<?php
	global $wp_query;

	$is_single_resource = ( ( is_singular( 'resource' ) && $wp_query->current_post == 0 ) || is_search() );

	$collections = wp_get_post_terms( get_the_ID(), ( get_post_type() == 'post' ? 'category' : 'resource-collection' ) );
?>

<?php if ( Chipmunk\Helpers::is_feature_enabled( 'upvotes', 'resource' ) ) : ?>
	<?php $upvotes = new Chipmunk\Extensions\Upvotes( get_the_ID() ); ?>
	<?php $upvote_button = $upvotes->get_button( 'toggle_upvote', 'c-stats__button' ); ?>
	<?php $upvote_counter = $upvotes->get_content(); ?>

	<li class="c-stats__item" title="<?php esc_attr_e( 'Upvotes', 'chipmunk' ); ?>">
		<?php if ( $is_single_resource || Chipmunk\Customizer::get_theme_option( 'display_resource_as' ) != 'tile' ) : ?>
			<?php echo $upvote_button; ?>
		<?php else : ?>
			<?php echo $upvote_counter; ?>
		<?php endif; ?>
	</li>
<?php endif; ?>

<?php if ( Chipmunk\Helpers::is_feature_enabled( 'bookmarks', 'resource' ) && Chipmunk\Helpers::has_plugin( 'members' ) ) : ?>
	<?php if ( $is_single_resource ) : ?>
		<li class="c-stats__item">
			<?php echo ( new Chipmunk\Extensions\Bookmarks( get_the_ID() ) )->get_button( 'toggle_bookmark', 'c-stats__button' ); ?>
		</li>
	<?php endif; ?>
<?php endif; ?>

<?php if ( Chipmunk\Helpers::is_feature_enabled( 'author', 'resource' ) && $is_single_resource && Chipmunk\Helpers::has_plugin( 'members' ) ) : ?>
	<li class="c-stats__item" title="<?php esc_attr_e( 'Author', 'chipmunk' ); ?>">
		<?php Chipmunk\Helpers::get_template_part( 'partials/icon', array( 'icon' => 'user' ) ); ?>
		<span itemprop="author"><?php the_author_posts_link(); ?></span>
	</li>
<?php endif; ?>

<?php if ( isset( $args ) && $args['display'] && ! empty( $collections ) && ! is_wp_error( $collections ) ) : ?>
	<li class="c-stats__item <?php echo isset( $args['desktop_only'] ) ? 'u-visible-lg-flex' : ''; ?>">
		<?php Chipmunk\Helpers::get_template_part( 'partials/post-terms', array( 'terms' => $collections, 'args' => $args, 'icon' => ( get_post_type() == 'post' ? 'tag' : 'collection' ) ) ); ?>
	</li>
<?php endif; ?>

<?php if ( Chipmunk\Helpers::is_feature_enabled( 'date', get_post_type() ) ) : ?>
	<li class="c-stats__item" title="<?php esc_attr_e( 'Published', 'chipmunk' ); ?>: <?php the_time( 'Y-m-d H:i' ); ?>">
		<?php Chipmunk\Helpers::get_template_part( 'partials/icon', array( 'icon' => 'clock' ) ); ?>

		<time datetime="<?php the_time( 'c' ); ?>" itemprop="datePublished">
			<?php the_time( get_option( 'date_format' ) ); ?>
		</time>
	</li>
<?php endif; ?>

<?php if ( Chipmunk\Helpers::is_feature_enabled( 'views', get_post_type() ) ) : ?>
	<li class="c-stats__item" title="<?php esc_attr_e( 'Views', 'chipmunk' ); ?>">
		<?php Chipmunk\Helpers::get_template_part( 'partials/icon', array( 'icon' => 'eye' ) ); ?>

		<?php echo Chipmunk\Helpers::format_number( Chipmunk\Extensions\Views::get_views( get_the_ID() ) ); ?>
	</li>
<?php endif; ?>

<?php if ( Chipmunk\Helpers::is_feature_enabled( 'ratings', 'resource' ) &&  Chipmunk\Helpers::has_plugin( 'ratings' ) ) : ?>
	<?php $average_rating = ChipmunkRatings\Helpers::get_post_rating( get_the_ID() ); ?>

	<?php if ( ! empty( $average_rating ) && ! $is_single_resource ) : ?>
		<li class="c-stats__item" title="<?php esc_attr_e( 'Ratings', 'chipmunk' ); ?>">
			<?php Chipmunk\Helpers::get_template_part( 'partials/icon', array( 'icon' => 'star' ) ); ?>

			<?php echo esc_html( $average_rating ); ?>
		</li>
	<?php endif; ?>
<?php endif; ?>
