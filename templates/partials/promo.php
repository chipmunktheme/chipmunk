<?php
$ad_image_lg = chipmunk_theme_option( 'ad_image_lg' );
$ad_image_md = chipmunk_theme_option( 'ad_image_md' );
$ad_image_sm = chipmunk_theme_option( 'ad_image_sm' );
$ad_link = chipmunk_theme_option( 'ad_link' );
$ad_code = chipmunk_theme_option( 'ad_code' );

$enabled = ! chipmunk_theme_option( 'disable_ads' );
$enabled_home = ( is_front_page() or ! chipmunk_theme_option( 'ads_only_home' ) );

$has_image = ( ! empty( $ad_image_lg ) or ! empty( $ad_image_md ) or ! empty( $ad_image_sm ) );
$has_content = ( $has_image or ! empty( $ad_code ) );
?>

<?php if ( $enabled and $enabled_home and $has_content ) : ?>
	<div class="section section--theme-light section--compact">
		<div class="container">
			<?php if ( $has_image and ! empty( $ad_link ) ) : ?>
				<a href="<?php echo esc_url( $ad_link ); ?>" class="section__separator" target="_blank">
					<?php if ( ! empty( $ad_image_lg ) ) : ?>
						<img src="<?php echo esc_url( $ad_image_lg ); ?>" alt="" class="visible-<?php echo ( $ad_image_md ? 'lg' : ( $ad_image_sm ? 'md' : 'sm' ) ); ?>-block">
					<?php endif; ?>

					<?php if ( ! empty( $ad_image_md ) ) : ?>
						<img src="<?php echo esc_url( $ad_image_md ); ?>" alt="" class="visible-<?php echo ( $ad_image_sm ? 'md' : 'sm' ); ?>-block hidden-<?php echo ( $ad_image_lg ? 'lg' : 'xl' ); ?>">
					<?php endif; ?>

					<?php if ( ! empty( $ad_image_sm ) ) : ?>
						<img src="<?php echo esc_url( $ad_image_sm ); ?>" alt="" class="hidden-<?php echo ( ( $ad_image_lg or $ad_image_md ) ? 'md' : 'xl' ); ?>">
					<?php endif; ?>
				</a>
			<?php endif; ?>

			<?php if ( ! empty( $ad_code ) ) : ?>
				<div class="section__separator">
					<?php echo stripslashes( $ad_code ); ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
	<!-- /.section -->
<?php endif; ?>
