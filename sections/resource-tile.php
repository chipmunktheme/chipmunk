<a href="<?php the_permalink(); ?>" class="tile<?php echo ( ChipmunkCustomizer::theme_option( 'display_resource_cards' ) ? ' tile_card' : '' ); ?><?php echo ( ( is_home() and !ChipmunkCustomizer::theme_option( 'disable_homepage_listings_sliders' ) ) ? '' : ' column column_md-3 column_lg-4' ); ?>">
	<div class="tile__image">
		<?php if ( has_post_thumbnail() ) : ?>
			<?php the_post_thumbnail( 'sm' ); ?>
		<?php endif; ?>
	</div>

	<div class="tile__content<?php echo ( !ChipmunkCustomizer::theme_option( 'display_resource_cards' ) ? ( ChipmunkCustomizer::theme_option( 'disable_resource_thumbs' ) ? ' tile__content_primary' : ' tile__content_dimmed' ) : '' ); ?>">
		<div class="tile__info">
			<?php echo chipmunk_conditional_markup( is_front_page() || is_single(), 'h3', 'h2', 'tile__title', get_the_title( ) ); ?>

			<?php $content = get_the_content(); ?>

			<?php if ( ! ChipmunkCustomizer::theme_option( 'disable_resource_desc' ) and !empty( $content ) ) : ?>
				<p class="tile__copy"><?php echo chipmunk_truncate_string( $content, ( ChipmunkCustomizer::theme_option( 'display_resource_cards' ) ? 80 : 60 ) ); ?>&nbsp;<i class="icon icon_arrow"></i></p>
			<?php endif; ?>
		</div>

		<?php if ( ! ChipmunkCustomizer::theme_option( 'disable_resource_date' ) or ! ChipmunkCustomizer::theme_option( 'disable_views' ) or ! ChipmunkCustomizer::theme_option( 'disable_upvotes' ) ) : ?>
			<ul class="tile__stats stats">
				<?php get_template_part( 'partials/resource-stats' ); ?>
			</ul>
		<?php endif; ?>
	</div>
</a>
