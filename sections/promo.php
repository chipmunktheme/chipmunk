<?php $enabled = !Chipmunk::theme_option('disable_ads'); ?>
<?php $enabled_home = is_home() or !Chipmunk::theme_option('ads_only_home'); ?>
<?php $has_content = $ad_image = Chipmunk::theme_option('ad_image') or $ad_code = Chipmunk::theme_option('ad_code'); ?>

<?php if ($enabled and $enabled_home and $has_content) : ?>
  <div class="promo">
    <div class="container">
      <?php if (isset($ad_image) and $ad_link = Chipmunk::theme_option('ad_link')) : ?>
        <a href="<?php echo $ad_link; ?>" target="_blank">
          <img src="<?php echo $ad_image; ?>" alt="" />
        </a>
      <?php endif; ?>

      <?php if (isset($ad_code)) : ?>
        <?php echo stripslashes($ad_code); ?>
      <?php endif; ?>
    </div>
  </div>
  <!-- /.promo -->
<?php endif; ?>
