<?php if (Chipmunk::theme_option('ad_image') or Chipmunk::theme_option('ad_code')) : ?>
  <div class="promo">
    <div class="container">
      <?php if (Chipmunk::theme_option('ad_image') and Chipmunk::theme_option('ad_link')) : ?>
        <a href="<?php echo Chipmunk::theme_option('ad_link'); ?>" target="_blank">
          <img src="<?php echo Chipmunk::theme_option('ad_image'); ?>" alt="" />
        </a>
      <?php endif; ?>

      <?php if (Chipmunk::theme_option('ad_code')) : ?>
        <?php echo stripslashes(Chipmunk::theme_option('ad_code')); ?>
      <?php endif; ?>
    </div>
  </div>
  <!-- /.promo -->
<?php endif; ?>
