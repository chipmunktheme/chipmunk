<div class="sort column column_md-3 column_lg-6">
  <h4 class="sort__title visible-md-inline-block"><?php _e('Sort by', 'chipmunk'); ?>:</h4>

  <select class="sort__select custom-select" data-sort>
    <?php
      $default_orderby = ChipmunkCustomizer::theme_option('default_sort_by');
      $default_order = ChipmunkCustomizer::theme_option('default_sort_order');
    ?>
    <option value="date-desc" <?php if ((isset($_GET['sort']) and $_GET['sort'] == 'date-desc') || (!isset($_GET['sort']) && $default_orderby == 'date' && $default_order == 'desc')) echo 'selected'; ?>><?php _e('Date', 'chipmunk'); ?> &darr;</option>
    <option value="date-asc" <?php if ((isset($_GET['sort']) and $_GET['sort'] == 'date-asc') || (!isset($_GET['sort']) && $default_orderby == 'date' && $default_order == 'asc')) echo 'selected'; ?>><?php _e('Date', 'chipmunk'); ?> &uarr;</option>
    <option value="name-desc" <?php if ((isset($_GET['sort']) and $_GET['sort'] == 'name-desc') || (!isset($_GET['sort']) && $default_orderby == 'name' && $default_order == 'desc')) echo 'selected'; ?>><?php _e('Name', 'chipmunk'); ?> &darr;</option>
    <option value="name-asc" <?php if ((isset($_GET['sort']) and $_GET['sort'] == 'name-asc') || (!isset($_GET['sort']) && $default_orderby == 'name' && $default_order == 'asc')) echo 'selected'; ?>><?php _e('Name', 'chipmunk'); ?> &uarr;</option>

    <?php if (!ChipmunkCustomizer::theme_option('disable_views')) : ?>
      <option value="popularity-desc" <?php if ((isset($_GET['sort']) and $_GET['sort'] == 'popularity-desc') || (!isset($_GET['sort']) && $default_orderby == 'popularity' && $default_order == 'desc')) echo 'selected'; ?>><?php _e('Popularity', 'chipmunk'); ?> &darr;</option>
      <option value="popularity-asc" <?php if ((isset($_GET['sort']) and $_GET['sort'] == 'popularity-asc') || (!isset($_GET['sort']) && $default_orderby == 'popularity' && $default_order == 'asc')) echo 'selected'; ?>><?php _e('Popularity', 'chipmunk'); ?> &uarr;</option>
    <?php endif; ?>
  </select>
</div>
