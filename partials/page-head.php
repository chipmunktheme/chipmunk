<header class="page-head">
  <div class="container">
    <div class="page-head__inner">
      <h1 class="page-head__logo">
        <a href="<?php echo home_url(); ?>" rel="index">
          <?php if ($logo = ChipmunkCustomizer::theme_option('logo')) : ?>
            <span class="sr-only"><?php bloginfo('name'); ?></span>
            <img src="<?php echo $logo; ?>" alt="" />
          <?php else : ?>
            <?php bloginfo('name'); ?>
          <?php endif; ?>
        </a>
      </h1>

      <nav class="nav-primary">
        <div class="nav-primary__inner">
          <ul>
            <?php $menu_items = wp_get_nav_menu_items('Header nav'); ?>

            <?php if (!empty($menu_items)) : ?>
              <?php foreach ($menu_items as $menu_item) : ?>
                <li class="nav-primary__item<?php echo (is_page($menu_item->object_id) ? ' nav-primary__item_active' : ''); ?>"><a href="<?php echo $menu_item->url; ?>"><?php echo $menu_item->title; ?></a></li>
              <?php endforeach; ?>
            <?php endif; ?>

            <?php if (!ChipmunkCustomizer::theme_option('disable_submissions')) : ?>
              <li class="nav-primary__item hidden-lg">
                <button type="button" class="button button_secondary" data-popup-toggle>
                  <?php _e('Submit', 'chipmunk'); ?>
                </button>
              </li>
            <?php endif; ?>
          </ul>
          
          <button type="button" class="nav-primary__close hidden-lg" data-nav-toggle>
            <i class="icon icon_close" aria-hidden="true"></i>
            <span class="sr-only"><?php _e('Close', 'chipmunk'); ?></span>
          </button>
        </div>
        <!-- /.nav-primary__inner -->
      </nav>
      <!-- /.nav-primary -->

      <div class="page-head__cta">
        <?php if (!ChipmunkCustomizer::theme_option('disable_search')) : ?>
          <button type="button" class="page-head__search" data-search-toggle>
            <i class="icon icon_search" aria-hidden="true"></i>
            <span class="sr-only"><?php _e('Search', 'chipmunk'); ?></span>
          </button>
        <?php endif; ?>

        <?php if (!ChipmunkCustomizer::theme_option('disable_submissions')) : ?>
          <button type="button" class="button button_secondary visible-lg-block" data-popup-toggle>
            <?php _e('Submit', 'chipmunk'); ?>
          </button>
        <?php endif; ?>

        <button type="button" class="page-head__trigger button button_secondary hidden-lg" data-nav-toggle>
          <?php _e('Menu', 'chipmunk'); ?>
        </button>
      </div>
      <!-- /.page-head__cta -->
    </div>
    <!-- /.page-head__inner -->
  </div>
  <!-- /.container -->
</header>
<!-- /.page-head -->
