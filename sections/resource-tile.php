<?php
	$is_column = ( ! is_front_page() or chipmunk_theme_option( 'disable_homepage_listings_sliders' ) );
	$tile_classes = array(
		''           => 'tile tile_card',
		'tile'       => 'tile',
		'card'       => 'tile tile_card',
		'card_blank' => 'tile tile_card tile_blank',
	);
?>

<a href="<?php the_permalink(); ?>" class="<?php echo $tile_classes[chipmunk_theme_option( 'display_resource_as' )]; ?><?php echo $is_column ? ' column column_md-3 column_lg-4' : ''; ?>">
	<div class="tile__image">
		<?php if ( has_post_thumbnail() ) : ?>
			<?php the_post_thumbnail( 'chipmunk-sm' ); ?>
		<?php endif; ?>
	</div>

	<div class="tile__content<?php echo ( chipmunk_theme_option( 'display_resource_as' ) == 'tile' ? ( chipmunk_theme_option( 'disable_resource_thumbs' ) ? ' tile__content_primary' : ' tile__content_dimmed' ) : '' ); ?>">
		<div class="tile__info">
			<?php echo chipmunk_conditional_markup( is_front_page() || is_single(), 'h3', 'h2', 'tile__title', chipmunk_theme_option( 'display_resource_as' ) == 'tile' ? get_the_title() : esc_html( chipmunk_truncate_string( get_the_title(), 60 ) ) ); ?>

			<?php $content = get_the_content(); ?>

			<?php if ( ! chipmunk_theme_option( 'disable_resource_desc' ) and ! empty( $content ) ) : ?>
				<p class="tile__copy"><?php echo esc_html( chipmunk_truncate_string( $content, ( chipmunk_theme_option( 'display_resource_as' ) == 'card_blank' ? 80 : 60 ) ) ); ?><span>&nbsp;<i class="icon icon_arrow" aria-hidden="true"></i></span></p>
			<?php endif; ?>
		</div>

		<?php if ( ! chipmunk_theme_option( 'disable_resource_date' ) or ! chipmunk_theme_option( 'disable_views' ) or ! chipmunk_theme_option( 'disable_upvotes' ) ) : ?>
			<ul class="tile__stats stats">
				<?php
					$collections_args = array(
						'display'  => false,
					);

					include locate_template( 'partials/post-stats.php' );
				?>
			</ul>
		<?php endif; ?>
	</div>
</a>
