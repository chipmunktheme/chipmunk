<div class="section section_theme-white section_separated section_compact">
  <div class="container">
    <div class="toolbox">
      <div class="toolbox__share">
        <nav class="nav-socials">
          <h4 class="nav-socials__title"><?php _e('Follow us', 'chipmunk'); ?></h4>
          <ul>
            <?php if (ChipmunkHelpers::theme_option('twitter')) : ?>
              <li class="nav-socials__item"><a href="<?php echo ChipmunkHelpers::theme_option('twitter'); ?>" title="Twitter" target="_blank"><i class="icon icon_twitter" aria-hidden="true"></i><span class="sr-only">Twitter</span></a></li>
            <?php endif; ?>
            <?php if (ChipmunkHelpers::theme_option('facebook')) : ?>
              <li class="nav-socials__item"><a href="<?php echo ChipmunkHelpers::theme_option('facebook'); ?>" title="Facebook" target="_blank"><i class="icon icon_facebook" aria-hidden="true"></i><span class="sr-only">Facebook</span></a></li>
            <?php endif; ?>
            <?php if (ChipmunkHelpers::theme_option('google')) : ?>
              <li class="nav-socials__item"><a href="<?php echo ChipmunkHelpers::theme_option('google'); ?>" title="Google" target="_blank"><i class="icon icon_google" aria-hidden="true"></i><span class="sr-only">Google</span></a></li>
            <?php endif; ?>
            <?php if (ChipmunkHelpers::theme_option('instagram')) : ?>
              <li class="nav-socials__item"><a href="<?php echo ChipmunkHelpers::theme_option('instagram'); ?>" title="Instagram" target="_blank"><i class="icon icon_instagram" aria-hidden="true"></i><span class="sr-only">Instagram</span></a></li>
            <?php endif; ?>
            <?php if (ChipmunkHelpers::theme_option('pinterest')) : ?>
              <li class="nav-socials__item"><a href="<?php echo ChipmunkHelpers::theme_option('pinterest'); ?>" title="Pinterest" target="_blank"><i class="icon icon_pinterest" aria-hidden="true"></i><span class="sr-only">Pinterest</span></a></li>
            <?php endif; ?>
            <?php if (ChipmunkHelpers::theme_option('flickr')) : ?>
              <li class="nav-socials__item"><a href="<?php echo ChipmunkHelpers::theme_option('flickr'); ?>" title="Flickr" target="_blank"><i class="icon icon_flickr" aria-hidden="true"></i><span class="sr-only">Flickr</span></a></li>
            <?php endif; ?>
            <?php if (ChipmunkHelpers::theme_option('vimeo')) : ?>
              <li class="nav-socials__item"><a href="<?php echo ChipmunkHelpers::theme_option('vimeo'); ?>" title="Vimeo" target="_blank"><i class="icon icon_vimeo" aria-hidden="true"></i><span class="sr-only">Vimeo</span></a></li>
            <?php endif; ?>
            <?php if (ChipmunkHelpers::theme_option('youtube')) : ?>
              <li class="nav-socials__item"><a href="<?php echo ChipmunkHelpers::theme_option('youtube'); ?>" title="YouTube" target="_blank"><i class="icon icon_youtube" aria-hidden="true"></i><span class="sr-only">YouTube</span></a></li>
            <?php endif; ?>
            <?php if (ChipmunkHelpers::theme_option('reddit')) : ?>
              <li class="nav-socials__item"><a href="<?php echo ChipmunkHelpers::theme_option('reddit'); ?>" title="Reddit" target="_blank"><i class="icon icon_reddit" aria-hidden="true"></i><span class="sr-only">Reddit</span></a></li>
            <?php endif; ?>
            <?php if (ChipmunkHelpers::theme_option('producthunt')) : ?>
              <li class="nav-socials__item"><a href="<?php echo ChipmunkHelpers::theme_option('producthunt'); ?>" title="ProductHunt" target="_blank"><i class="icon icon_producthunt" aria-hidden="true"></i><span class="sr-only">ProductHunt</span></a></li>
            <?php endif; ?>
          </ul>
        </nav>
        <!-- /.nav-socials -->
      </div>

      <?php if (!ChipmunkHelpers::theme_option('disable_submissions')) : ?>
        <div class="toolbox__cta visible-md-flex">
          <p class="visible-lg-block"><?php echo ChipmunkHelpers::theme_option('submit_tagline', 'Internet is huge! Help us find great content'); ?></p>
          <button type="button" class="toolbox__button button button_primary" data-popup-toggle><?php _e('Submit', 'chipmunk'); ?></a>
        </div>
      <?php endif; ?>
    </div>
    <!-- /.toolbox -->
  </div>
</div>
<!-- /.section -->
