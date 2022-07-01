<?php
$ad_image_lg = Chipmunk\Helpers::getOption( 'ad_image_lg' );
$ad_image_md = Chipmunk\Helpers::getOption( 'ad_image_md' );
$ad_image_sm = Chipmunk\Helpers::getOption( 'ad_image_sm' );
$ad_link = Chipmunk\Helpers::getOption( 'ad_link' );
$ad_code = Chipmunk\Helpers::getOption( 'ad_code' );

$enabled = ! Chipmunk\Helpers::getOption( 'disable_ads' );
$enabled_home = ( is_front_page() || ! Chipmunk\Helpers::getOption( 'ads_only_home' ) );

$has_image = ( ! empty( $ad_image_lg ) || ! empty( $ad_image_md ) || ! empty( $ad_image_sm ) );
$has_content = ( $has_image || ! empty( $ad_code ) );
?>

<?php if ( $enabled && $enabled_home && $has_content ) : ?>
	<div class="<?php echo Chipmunk\Helpers::class_name( 'l-section', [ 'theme-light', 'compact', 'sticky' ] ); ?>">
		<div class="l-container">
			<?php if ( $has_image && ! empty( $ad_link ) ) : ?>

				<a href="<?php echo esc_url( $ad_link ); ?>" target="_blank" class="c-promo">
					<?php if ( ! empty( $ad_image_lg ) ) : ?>
						<img src="<?php echo esc_url( $ad_image_lg ); ?>" alt="" class="u-visible-<?php echo ( $ad_image_md ? 'lg' : ( $ad_image_sm ? 'md' : 'sm' ) ); ?>-block">
					<?php endif; ?>

					<?php if ( ! empty( $ad_image_md ) ) : ?>
						<img src="<?php echo esc_url( $ad_image_md ); ?>" alt="" class="u-visible-<?php echo ( $ad_image_sm ? 'md' : 'sm' ); ?>-block u-hidden-<?php echo ( $ad_image_lg ? 'lg' : 'xl' ); ?>">
					<?php endif; ?>

					<?php if ( ! empty( $ad_image_sm ) ) : ?>
						<img src="<?php echo esc_url( $ad_image_sm ); ?>" alt="" class="u-hidden-<?php echo ( ( $ad_image_lg || $ad_image_md ) ? 'md' : 'xl' ); ?>">
					<?php endif; ?>
				</a>

			<?php elseif ( ! empty( $ad_code ) ) : ?>

				<?php echo stripslashes( $ad_code ); ?>

			<?php endif; ?>
		</div>
	</div>
<?php endif; ?>
