<?php
$ad_image_lg = ChipmunkCustomizer::theme_option('ad_image_lg');
$ad_image_md = ChipmunkCustomizer::theme_option('ad_image_md');
$ad_image_sm = ChipmunkCustomizer::theme_option('ad_image_sm');
$enabled = !ChipmunkCustomizer::theme_option('disable_ads');

$enabled_home = (is_front_page() or !ChipmunkCustomizer::theme_option('ads_only_home'));
$has_image = ($ad_image_lg or $ad_image_md or $ad_image_sm);
$has_content = ($has_image or $ad_code = ChipmunkCustomizer::theme_option('ad_code'));
?>

<?php if ($enabled and $enabled_home and $has_content) : ?>
  <div class="promo">
    <div class="container">
      <?php if ($has_image and $ad_link = ChipmunkCustomizer::theme_option('ad_link')) : ?>
        <a href="<?php echo $ad_link; ?>" target="_blank">
          <?php if ($ad_image_lg) : ?>
            <img src="<?php echo ChipmunkCustomizer::theme_option('ad_image_lg'); ?>" alt="" class="visible-<?php echo ($ad_image_md ? 'lg' : ($ad_image_sm ? 'md' : 'xs')); ?>-block">
          <?php endif; ?>

          <?php if ($ad_image_md) : ?>
            <img src="<?php echo ChipmunkCustomizer::theme_option('ad_image_md'); ?>" alt="" class="visible-<?php echo ($ad_image_sm ? 'md' : 'xs'); ?>-block hidden-<?php echo ($ad_image_lg ? 'lg' : 'xl'); ?>">
          <?php endif; ?>

          <?php if ($ad_image_sm) : ?>
            <img src="<?php echo ChipmunkCustomizer::theme_option('ad_image_sm'); ?>" alt="" class="hidden-<?php echo (($ad_image_lg or $ad_image_md) ? 'md' : 'xl'); ?>">
          <?php endif; ?>
        </a>
      <?php endif; ?>

      <?php if (isset($ad_code)) : ?>
        <?php echo stripslashes($ad_code); ?>
      <?php endif; ?>
    </div>
  </div>
  <!-- /.promo -->
<?php endif; ?>
