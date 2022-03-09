<?php
	// Cache resource customizer options
	$options = array(
		'display_as'             => Chipmunk\Customizer::get_theme_option( 'display_resource_as' ),
		'disable_thumbs'         => Chipmunk\Customizer::get_theme_option( 'disable_resource_thumbs' ),
		'disable_website_button' => Chipmunk\Customizer::get_theme_option( 'disable_resource_website_button' ),
		'disable_desc'           => Chipmunk\Customizer::get_theme_option( 'disable_resource_desc' ),
		'disable_date'           => Chipmunk\Customizer::get_theme_option( 'disable_resource_date' ),
		'disable_tags'           => Chipmunk\Customizer::get_theme_option( 'disable_resource_tags' ),
		'disable_views'          => Chipmunk\Customizer::get_theme_option( 'disable_resource_views' ),
		'disable_upvotes'        => Chipmunk\Customizer::get_theme_option( 'disable_resource_upvotes' ),
	);

	// Resource website - custom post meta
	$website = Chipmunk\Helpers::get_resource_website( get_the_ID() );

	// Resource tile classes
	$tile_classes = array(
		''           => array( 'card' ),
		'tile'       => array( 'tile' ),
		'card'       => array( 'card' ),
		'card_blank' => array( 'blank' ),
		'card_wide'  => array( 'wide' ),
	);

	$tile_class = Chipmunk\Helpers::class_name( 'c-tile', $tile_classes[ $options['display_as'] ] );
?>

<<?php echo get_post_status() == 'publish' ? 'a href="' . get_the_permalink() . '"' : 'div'; ?> class="<?php echo esc_attr( $tile_class ); ?>">
	<div class="c-tile__inner">
		<?php if ( ! $options['disable_thumbs'] || $options['display_as'] == 'tile' ) : ?>
			<div class="c-tile__image">
				<?php if ( ! $options['disable_thumbs'] && has_post_thumbnail() ) : ?>
					<?php the_post_thumbnail( '600x420' ); ?>
				<?php endif; ?>

				<?php if ( ! empty( $display_status ) && $options['display_as'] != 'tile' ) : ?>
					<span class="c-tile__status c-tile__status--<?php echo esc_attr( get_post_status() ); ?>">
						<?php echo esc_html( ucfirst( get_post_status() ) ); ?>
					</span>
				<?php endif; ?>
			</div>
		<?php endif; ?>

		<div class="c-tile__content<?php echo ( $options['display_as'] == 'tile' ? ( $options['disable_thumbs'] || ! has_post_thumbnail() ? ' c-tile__content--primary' : ' c-tile__content--dimmed' ) : '' ); ?>">
			<div class="c-tile__head">
				<<?php echo ( is_front_page() || is_single() ) ? 'h3' : 'h2'; ?> class="c-tile__title c-heading c-heading--h5">
					<?php the_title(); ?>

					<?php if ( ! empty( $display_status ) && $options['display_as'] == 'tile' ) : ?>
						(<?php echo esc_html( ucfirst( get_post_status() ) ); ?>)
					<?php endif; ?>
				</<?php echo ( is_front_page() || is_single() ) ? 'h3' : 'h2'; ?>>

				<?php if ( ! $options['disable_website_button'] && ! empty( $website ) ) : ?>
					<script>
						function openURL(ev, url) {
							ev.stopPropagation();
							ev.preventDefault();

							var win = window.open(url, '_blank');
							win.focus();
						}
					</script>

					<div onclick="openURL(event, '<?php echo Chipmunk\Helpers::render_external_link( $website ); ?>');" class="c-tile__icon" title="<?php esc_attr_e( 'Visit website', 'chipmunk' ); ?>"><?php Chipmunk\Helpers::get_template_part( 'partials/icon', array( 'icon' => 'external-link' ) ); ?></div>
				<?php endif; ?>

				<?php if ( ! $options['disable_desc'] ) : ?>
					<p class="c-tile__copy"><?php echo esc_html( get_the_excerpt() ); ?></p>
				<?php endif; ?>
			</div>

			<?php if ( ! $options['disable_date'] || ! $options['disable_views'] || ! $options['disable_upvotes'] ) : ?>
				<ul class="c-tile__stats c-stats">
					<?php
						$collections_args = array(
							'display'      => ( $options['display_as'] == 'card_wide' && ! $options['disable_tags'] ),
							'type'         => 'text',
							'quantity'     => 1,
							'desktop_only' => true,
						);

						Chipmunk\Helpers::get_template_part( 'partials/post-stats', array( 'args' => $collections_args ) );
					?>
				</ul>
			<?php endif; ?>
		</div>
	</div>
</<?php echo get_post_status() == 'publish' ? 'a' : 'div'; ?>>
