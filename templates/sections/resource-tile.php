<?php
	$is_column = ( ! is_front_page() );
	$resource_website = get_post_meta( get_the_ID(), '_' . THEME_SLUG . '_resource_website', true );
	$tile_classes = array(
		''           => 'tile tile--card',
		'tile'       => 'tile',
		'card'       => 'tile tile--card',
		'card_blank' => 'tile tile--card tile--blank',
	);
?>

<<?php echo get_post_status() == 'publish' ? 'a href="' . get_the_permalink() . '"' : 'article'; ?> class="<?php echo $tile_classes[chipmunk_theme_option( 'display_resource_as' )]; ?><?php echo $is_column ? ' column column--md-3 column--lg-4' : ''; ?>">
	<div class="tile__image <?php echo ( isset( $display_status ) and chipmunk_theme_option( 'display_resource_as' ) != 'tile' ) ? 'tile__image--with-status' : ''; ?>">
		<?php if ( has_post_thumbnail() ) : ?>
			<?php the_post_thumbnail( '600x420' ); ?>
		<?php endif; ?>

		<?php if ( isset( $display_status ) and chipmunk_theme_option( 'display_resource_as' ) != 'tile' ) : ?>
			<span class="tile__status tile__status--<?php echo esc_attr( get_post_status() ); ?>">
				<?php echo esc_html( ucfirst( get_post_status() ) ); ?>
			</span>
		<?php endif; ?>
	</div>

	<div class="tile__content<?php echo ( chipmunk_theme_option( 'display_resource_as' ) == 'tile' ? ( chipmunk_theme_option( 'disable_resource_thumbs' ) ? ' tile__content--primary' : ' tile__content--dimmed' ) : '' ); ?>">
		<div class="tile__info">
			<div class="tile__head">
				<?php echo chipmunk_conditional_markup( is_front_page() or is_single(), 'h3', 'h2', 'tile__title', chipmunk_theme_option( 'display_resource_as' ) == 'tile' ? esc_html( chipmunk_truncate_string( get_the_title(), 60 ) ) : get_the_title() ); ?>

				<?php if ( ! chipmunk_theme_option( 'disable_website_button' ) and ! empty( $resource_website ) ) : ?>
					<script>
						function openURL(ev, url) {
							ev.stopPropagation();
							ev.preventDefault();

							var win = window.open(url, '_blank');
							win.focus();
						}
					</script>

					<div onclick="openURL(event, '<?php echo esc_url( chipmunk_external_link( $resource_website ) ); ?>');" class="tile__icon" title="<?php esc_attr_e( 'Visit website', 'chipmunk' ); ?>"><?php chipmunk_get_template( 'partials/icon', array( 'icon' => 'external-link' ) ); ?></div>
				<?php endif; ?>
			</div>

			<?php $content = get_the_excerpt(); ?>

			<?php if ( ! chipmunk_theme_option( 'disable_resource_desc' ) and ! empty( $content ) ) : ?>
				<p class="tile__copy"><?php echo esc_html( chipmunk_truncate_string( $content, ( chipmunk_theme_option( 'display_resource_as' ) == 'card_blank' ? 80 : 60 ) ) ); ?><span>&nbsp;<?php chipmunk_get_template( 'partials/icon', array( 'icon' => 'arrow-right' ) ); ?></span></p>
			<?php endif; ?>

			<?php if ( isset( $display_status ) and chipmunk_theme_option( 'display_resource_as' ) == 'tile' ) : ?>
				<span class="tile__status tile__status--<?php echo esc_attr( get_post_status() ); ?>">
					<?php echo esc_html( ucfirst( get_post_status() ) ); ?>
				</span>
			<?php endif; ?>
		</div>

		<?php if ( ! chipmunk_theme_option( 'disable_resource_date' ) or ! chipmunk_theme_option( 'disable_views' ) or ! chipmunk_theme_option( 'disable_upvotes' ) ) : ?>
			<ul class="tile__stats stats">
				<?php
					$collections_args = array(
						'display'  => false,
					);

					chipmunk_get_template( 'partials/post-stats', array( 'args' => $collections_args ) );
				?>
			</ul>
		<?php endif; ?>
	</div>
</<?php echo get_post_status() == 'publish' ? 'a' : 'article'; ?>>
