<div class="popup">
  <div class="container">
    <div class="popup__content">
      <button class="popup__close" data-popup-toggle>
        <i class="icon icon_close"></i>
        <span class="sr-only"><?php _e('Close', 'chipmunk'); ?></span>
      </button>

      <h2 class="headline headline_xl text-center"><?php _e('Submit', 'chipmunk'); ?></h2>

      <div class="form__message" style="display: none;">
        <p class="headline headline_thin"><?php echo Chipmunk::theme_option('submission_thanks', __('Thank you for your contribution. The submission was sent to the website owners for review.', 'chipmunk')); ?></p>
      </div>

      <form action="#" method="post" class="form">
        <div class="form__field">
          <div class="form__child">
            <input type="text" name="name" placeholder="<?php _e('Resource name', 'chipmunk'); ?>" required>
          </div>
          <div class="form__child">
            <input type="text" name="description" placeholder="<?php _e('Description', 'chipmunk'); ?>">
          </div>
        </div>

        <div class="form__field">
          <div class="form__child">
            <select name="category" data-placeholder="<?php _e('Category', 'chipmunk'); ?>" class="custom-select" required>
              <option value=""></option>
              <?php
                $collections = get_terms('resource-collection', array(
                  'orderby'    => 'name',
                  'hide_empty' => 0,
                ));
              ?>

              <?php if (!empty($collections)) : ?>
                <?php foreach ($collections as $collection) : ?>
                  <option value="<?php echo $collection->slug; ?>"><?php echo $collection->name; ?></option>
                <?php endforeach; ?>
              <?php endif; ?>
            </select>
          </div>
          <div class="form__child">
            <input type="url" name="url" placeholder="<?php _e('Website URL', 'chipmunk'); ?>" required>
          </div>
        </div>

        <div class="form__field form__field_separated">
          <div class="form__child">
            <input type="text" name="submitter_name" placeholder="<?php _e('Your name', 'chipmunk'); ?>" required>
          </div>
          <div class="form__child">
            <input type="email" name="submitter_email" placeholder="<?php _e('Your email', 'chipmunk'); ?>" required>
          </div>
        </div>
        
        <div class="form__field">
          <button type="submit" class="button button_secondary"><?php _e('Submit', 'chipmunk'); ?></button>
        </div>
      </form>
    </div>
    <div class="popup__loader"></div>
  </div>
</div>
<!-- /.popup -->
