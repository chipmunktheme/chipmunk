<?php if (!ChipmunkCustomizer::theme_option('disable_newsletter') and $action = ChipmunkCustomizer::theme_option('newsletter_action')) : ?>
  <div class="section section_theme-primary text_center">
    <div class="container">
      <h4 class="heading heading_xl"><?php _e('Newsletter', CHIPMUNK_THEME_SLUG); ?></h4>
      <p class="heading heading_thin"><?php echo ChipmunkCustomizer::theme_option('newsletter_tagline'); ?></p>

      <div class="row">
        <form action="<?php echo stripslashes(trim($action, '" ')); ?>" method="post" class="form form_compact column column_sm-4 column_sm-offset-1 column_md-4 column_md-offset-1 column_lg-6 column_lg-offset-3" target="_blank" novalidate data-parsley-validate>
          <div class="form__field">
            <input type="email" name="<?php echo strpos($action, 'list-manage.com') != false ? 'MERGE0' : 'email'; ?>" placeholder="<?php _e('Email address', CHIPMUNK_THEME_SLUG); ?>" required>
          </div>
          <div class="form__field">
            <button type="submit" class="button button_secondary"><?php _e('Join now', CHIPMUNK_THEME_SLUG); ?></button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- /.section -->
<?php endif; ?>
