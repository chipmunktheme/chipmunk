<div class="sort column column_md-2 column_lg-4">
  <h4 class="sort__title visible-lg-inline-block"><?php _e( 'Sort by', CHIPMUNK_THEME_SLUG ); ?>:</h4>

  <select class="sort__select custom-select" data-sort>
    <?php
      $default_orderby = ChipmunkCustomizer::theme_option( 'default_sort_by' );
      $default_order = ChipmunkCustomizer::theme_option( 'default_sort_order' );
    ?>
    <option value="date-desc" <?php if ( ( isset( $_GET['sort'] ) and $_GET['sort'] == 'date-desc' ) || ( ! isset( $_GET['sort'] ) && $default_orderby == 'date' && $default_order == 'desc' ) ) echo 'selected'; ?>><?php _e( 'Date', CHIPMUNK_THEME_SLUG ); ?> &darr;</option>
    <option value="date-asc" <?php if ( ( isset( $_GET['sort'] ) and $_GET['sort'] == 'date-asc' ) || ( ! isset( $_GET['sort'] ) && $default_orderby == 'date' && $default_order == 'asc' ) ) echo 'selected'; ?>><?php _e( 'Date', CHIPMUNK_THEME_SLUG ); ?> &uarr;</option>
    <option value="name-desc" <?php if ( ( isset( $_GET['sort'] ) and $_GET['sort'] == 'name-desc' ) || ( ! isset( $_GET['sort'] ) && $default_orderby == 'name' && $default_order == 'desc' ) ) echo 'selected'; ?>><?php _e( 'Name', CHIPMUNK_THEME_SLUG ); ?> &darr;</option>
    <option value="name-asc" <?php if ( ( isset( $_GET['sort'] ) and $_GET['sort'] == 'name-asc' ) || ( ! isset( $_GET['sort'] ) && $default_orderby == 'name' && $default_order == 'asc' ) ) echo 'selected'; ?>><?php _e( 'Name', CHIPMUNK_THEME_SLUG ); ?> &uarr;</option>

    <?php if ( !ChipmunkCustomizer::theme_option( 'disable_views' ) ) : ?>
      <option value="views-desc" <?php if ( ( isset( $_GET['sort'] ) and $_GET['sort'] == 'views-desc' ) || ( ! isset( $_GET['sort'] ) && $default_orderby == 'views' && $default_order == 'desc' ) ) echo 'selected'; ?>><?php _e( 'Views', CHIPMUNK_THEME_SLUG, 'sort dropdown value' ); ?> &darr;</option>
      <option value="views-asc" <?php if ( ( isset( $_GET['sort'] ) and $_GET['sort'] == 'views-asc' ) || ( ! isset( $_GET['sort'] ) && $default_orderby == 'views' && $default_order == 'asc' ) ) echo 'selected'; ?>><?php _e( 'Views', CHIPMUNK_THEME_SLUG, 'sort dropdown value' ); ?> &uarr;</option>
    <?php endif; ?>

    <?php if ( !ChipmunkCustomizer::theme_option( 'disable_upvotes' ) ) : ?>
      <option value="upvotes-desc" <?php if ( ( isset( $_GET['sort'] ) and $_GET['sort'] == 'upvotes-desc' ) || ( ! isset( $_GET['sort'] ) && $default_orderby == 'upvotes' && $default_order == 'desc' ) ) echo 'selected'; ?>><?php _e( 'Upvotes', CHIPMUNK_THEME_SLUG, 'sort dropdown value' ); ?> &darr;</option>
      <option value="upvotes-asc" <?php if ( ( isset( $_GET['sort'] ) and $_GET['sort'] == 'upvotes-asc' ) || ( ! isset( $_GET['sort'] ) && $default_orderby == 'upvotes' && $default_order == 'asc' ) ) echo 'selected'; ?>><?php _e( 'Upvotes', CHIPMUNK_THEME_SLUG, 'sort dropdown value' ); ?> &uarr;</option>
    <?php endif; ?>
  </select>
</div>
