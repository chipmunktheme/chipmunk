<div class="section section_theme-white section_separated section_compact">
  <div class="container">
    <div class="toolbox">
      <div class="toolbox__share">
        <nav class="nav-socials">
          <h5 class="nav-socials__title"><?php _e( 'Follow us', 'chipmunk' ); ?></h5>
          <ul>
            <?php foreach ( ChipmunkCustomizer::$socials as $social ) : ?>
              <?php $social_slug = strtolower( $social ); ?>

              <?php if ( ChipmunkCustomizer::theme_option( $social_slug ) ) : ?>
                <li class="nav-socials__item"><a href="<?php echo ChipmunkCustomizer::theme_option( $social_slug ); ?>" title="<?php echo $social; ?>" target="_blank"><i class="icon icon_<?php echo $social_slug; ?>" aria-hidden="true"></i><span class="sr-only"><?php echo $social; ?></span></a></li>
              <?php endif; ?>
            <?php endforeach; ?>
          </ul>
        </nav>
        <!-- /.nav-socials -->
      </div>

      <?php if ( !ChipmunkCustomizer::theme_option( 'disable_submissions' ) ) : ?>
        <div class="toolbox__cta visible-md-flex">
          <p class="visible-lg-block"><?php echo ChipmunkCustomizer::theme_option( 'submit_tagline' ); ?></p>
          <button type="button" class="toolbox__button button button_primary" data-popup-toggle><?php _e( 'Submit', 'chipmunk' ); ?></button>
        </div>
      <?php endif; ?>
    </div>
    <!-- /.toolbox -->
  </div>
</div>
<!-- /.section -->
