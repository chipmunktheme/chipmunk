<?php if (!ChipmunkCustomizer::theme_option('disable_sorting')) : ?>
  <div class="sort text_right column column_sm-3 column_lg-6">
    <h4 class="sort__title"><?php _e('Sort by', 'chipmunk'); ?>:</h4>

    <select class="sort__select custom-select" data-sort>
      <option value="date-desc" <?php if (isset($_GET['sort']) and $_GET['sort'] == 'date-desc') echo 'selected'; ?>><?php _e('Date', 'chipmunk'); ?> &darr;</option>
      <option value="date-asc" <?php if (isset($_GET['sort']) and $_GET['sort'] == 'date-asc') echo 'selected'; ?>><?php _e('Date', 'chipmunk'); ?> &uarr;</option>
      <option value="name-desc" <?php if (isset($_GET['sort']) and $_GET['sort'] == 'name-desc') echo 'selected'; ?>><?php _e('Name', 'chipmunk'); ?> &darr;</option>
      <option value="name-asc" <?php if (isset($_GET['sort']) and $_GET['sort'] == 'name-asc') echo 'selected'; ?>><?php _e('Name', 'chipmunk'); ?> &uarr;</option>

      <?php if (!ChipmunkCustomizer::theme_option('disable_views')) : ?>
        <option value="popularity-desc" <?php if (isset($_GET['sort']) and $_GET['sort'] == 'popularity-desc') echo 'selected'; ?>><?php _e('Popularity', 'chipmunk'); ?> &darr;</option>
        <option value="popularity-asc" <?php if (isset($_GET['sort']) and $_GET['sort'] == 'popularity-asc') echo 'selected'; ?>><?php _e('Popularity', 'chipmunk'); ?> &uarr;</option>
      <?php endif; ?>
    </select>
  </div>
<?php endif; ?>
