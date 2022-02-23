<?php
	// Cache resource customizer options
	$options = array(
		'display_as'             => chipmunk_theme_option( 'display_resource_as' ),
		'disable_thumbs'         => chipmunk_theme_option( 'disable_resource_thumbs' ),
		'disable_website_button' => chipmunk_theme_option( 'disable_resource_website_button' ),
		'disable_desc'           => chipmunk_theme_option( 'disable_resource_desc' ),
		'disable_date'           => chipmunk_theme_option( 'disable_resource_date' ),
		'disable_tags'           => chipmunk_theme_option( 'disable_resource_tags' ),
		'disable_views'          => chipmunk_theme_option( 'disable_resource_views' ),
		'disable_upvotes'        => chipmunk_theme_option( 'disable_resource_upvotes' ),
	);

	// Resource website - custom post meta
	$website = chipmunk_get_resource_website( get_the_ID() );

	// Resource tile classes
	$classes = array(
		''           => 'tile tile--card',
		'tile'       => 'tile tile--tile',
		'card'       => 'tile tile--card',
		'card_blank' => 'tile tile--card tile--blank',
		'card_wide'  => 'tile tile--card tile--wide',
	);

	// Resource excerpt length
	$excerpt_lengths = array(
		''           => 80,
		'tile'       => 80,
		'card'       => 80,
		'card_blank' => 60,
		'card_wide'  => 200,
	);
?>

<<?php echo get_post_status() == 'publish' ? 'a href="' . get_the_permalink() . '"' : 'article'; ?> class="<?php echo esc_attr( $classes[ $options['display_as'] ] ); ?><?php echo ( $options['display_as'] == 'card_wide' ? ' grid__item' : ' grid__item grid__item--md-3 grid__item--lg-4' ); ?>">
	<?php if ( ! chipmunk_theme_option( 'disable_resource_thumbs' ) || $options['display_as'] == 'tile' ) : ?>
		<div class="tile__image <?php echo ( isset( $display_status ) and $options['display_as'] != 'tile' ) ? 'tile__image--with-status' : ''; ?>">
			<?php if ( ! $options['disable_thumbs'] && has_post_thumbnail() ) : ?>
				<?php the_post_thumbnail( '600x420' ); ?>
			<?php endif; ?>

			<?php if ( isset( $display_status ) and $options['display_as'] != 'tile' ) : ?>
				<span class="tile__status tile__status--<?php echo esc_attr( get_post_status() ); ?>">
					<?php echo esc_html( ucfirst( get_post_status() ) ); ?>
				</span>
			<?php endif; ?>
		</div>
	<?php endif; ?>

	<div class="tile__content<?php echo ( $options['display_as'] == 'tile' ? ( $options['disable_thumbs'] || ! has_post_thumbnail() ? ' tile__content--primary' : ' tile__content--dimmed' ) : '' ); ?>">
		<div class="tile__info">
			<div class="tile__head">
				<?php echo chipmunk_conditional_markup( is_front_page() or is_single(), 'h3', 'h2', 'tile__title', $options['display_as'] == 'tile' ? esc_html( chipmunk_truncate_string( get_the_title(), 60 ) ) : get_the_title() ); ?>

				<?php if ( ! $options['disable_website_button'] and ! empty( $website ) ) : ?>
					<script>
						function openURL(ev, url) {
							ev.stopPropagation();
							ev.preventDefault();

							var win = window.open(url, '_blank');
							win.focus();
						}
					</script>

					<div onclick="openURL(event, '<?php echo chipmunk_external_link( $website ); ?>');" class="tile__icon" title="<?php esc_attr_e( 'Visit website', 'chipmunk' ); ?>"><?php chipmunk_get_template_part( 'partials/icon', array( 'icon' => 'external-link' ) ); ?></div>
				<?php endif; ?>
			</div>

			<?php $content = get_the_excerpt(); ?>

			<?php if ( ! $options['disable_desc'] and ! empty( $content ) ) : ?>
				<p class="tile__copy">
					<?php echo esc_html( chipmunk_truncate_string( $content, apply_filters( 'chipmunk_resource_excerpt_length', $excerpt_lengths[ $options['display_as'] ] ) ) ); ?><span>&nbsp;<?php chipmunk_get_template_part( 'partials/icon', array( 'icon' => 'arrow-right' ) ); ?></span>
				</p>
			<?php endif; ?>

			<?php if ( isset( $display_status ) and chipmunk_theme_option( 'display_resource_as' ) == 'tile' ) : ?>
				<span class="tile__status tile__status--<?php echo esc_attr( get_post_status() ); ?>">
					<?php echo esc_html( ucfirst( get_post_status() ) ); ?>
				</span>
			<?php endif; ?>
		</div>

		<?php if ( ! $options['disable_date'] or ! $options['disable_views'] or ! $options['disable_upvotes'] ) : ?>
			<ul class="tile__stats stats">
				<?php
					$collections_args = array(
						'display'      => ( $options['display_as'] == 'card_wide' && ! $options['disable_tags'] ),
						'type'         => 'text',
						'quantity'     => 1,
						'desktop_only' => true,
					);

					chipmunk_get_template_part( 'partials/post-stats', array( 'args' => $collections_args ) );
				?>
			</ul>
		<?php endif; ?>
	</div>
</<?php echo get_post_status() == 'publish' ? 'a' : 'article'; ?>>
