<div class="popup">
  <div class="container">
    <div class="popup__content">
      <button class="popup__close" data-popup-toggle>
        <i class="icon icon_close"></i>
        <span class="sr-only"><?php _e('Close', 'chipmunk'); ?></span>
      </button>

      <h2 class="heading heading_xl text_center"><?php _e('Submit', 'chipmunk'); ?></h2>

      <p class="form__message heading heading_thin" style="display: none;" data-remote-message></p>

      <form action="#" method="post" class="form" novalidate data-remote-form="submit_resource" data-parsley-validate>
        <div class="form__field">
          <div class="form__child">
            <input type="text" name="name" placeholder="<?php _e('Resource name', 'chipmunk'); ?>" required>
          </div>
          <div class="form__child">
            <select name="collection" data-placeholder="<?php _e('Collection', 'chipmunk'); ?>" data-parsley-errors-container=".collection-errors" class="custom-select" required>
              <option value=""><?php _e('Collection', 'chipmunk'); ?></option>
              <?php
                $collections = get_terms('resource-collection', array(
                  'orderby'    => 'name',
                  'hide_empty' => 0,
                  'parent'     => 0,
                ));
              ?>

              <?php if (!empty($collections)) : ?>
                <?php foreach ($collections as $collection) : ?>
                  <option value="<?php echo $collection->term_id; ?>"><?php echo $collection->name; ?></option>
                <?php endforeach; ?>
              <?php endif; ?>
            </select>

            <div class="collection-errors"></div>
          </div>
        </div>

        <div class="form__field">
          <div class="form__child">
            <input type="url" name="website" placeholder="<?php _e('Website URL', 'chipmunk'); ?>" required>
          </div>
          <div class="form__child">
            <input type="text" name="content" placeholder="<?php _e('Description', 'chipmunk'); ?>">
          </div>
        </div>

        <?php if (!ChipmunkCustomizer::theme_option('disable_submitter_info', true)) : ?>
          <div class="form__field form__field_separated">
            <div class="form__child">
              <input type="text" name="submitter_name" placeholder="<?php _e('Your name', 'chipmunk'); ?>" required>
            </div>
            <div class="form__child">
              <input type="email" name="submitter_email" placeholder="<?php _e('Your email', 'chipmunk'); ?>" required>
            </div>
          </div>
        <?php endif; ?>

        <div class="form__field form__field_center">
          <?php if (ChipmunkCustomizer::theme_option('recaptcha_site_key')) : ?>
            <div class="g-recaptcha" data-sitekey="<?php echo ChipmunkCustomizer::theme_option('recaptcha_site_key'); ?>"></div>
          <?php endif; ?>

          <?php wp_nonce_field('submit_resource', 'chipmunk_nonce'); ?>
          <button type="submit" class="button button_secondary"><?php _e('Submit', 'chipmunk'); ?></button>
        </div>
      </form>
    </div>
    <div class="popup__loader"></div>
  </div>
</div>
<!-- /.popup -->
