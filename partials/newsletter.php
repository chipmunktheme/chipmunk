<?php if (!ChipmunkCustomizer::theme_option('disable_newsletter') and $action = ChipmunkCustomizer::theme_option('newsletter_action')) : ?>
  <div class="section section_theme-primary text-center">
    <div class="container">
      <h2 class="heading heading_xl"><?php _e('Newsletter', 'chipmunk'); ?></h2>
      <p class="heading heading_thin"><?php echo ChipmunkCustomizer::theme_option('newsletter_tagline'); ?></p>

      <div class="row">
        <form action="<?php echo $action; ?>" method="post" class="form form_compact column column_sm-4 column_sm-offset-1 column_md-4 column_md-offset-1 column_lg-6 column_lg-offset-3" target="_blank">
          <div class="form__field">
            <input type="email" name="<?php echo strpos($action, 'list-manage.com') != false ? 'MERGE0' : 'email'; ?>" placeholder="<?php _e('Email address', 'chipmunk'); ?>" required>
          </div>
          <div class="form__field">
            <button type="submit" class="button button_secondary"><?php _e('Join now', 'chipmunk'); ?></button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- /.section -->
<?php endif; ?>
