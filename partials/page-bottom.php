<div class="page-foot section section_theme-white">
  <div class="container">
    <div class="row">
      <div class="column column_md-3 column_lg-5">
        <h4 class="headline headline_sm"><?php _e('About', 'chipmunk'); ?></h4>

        <div class="page-foot__description">
          <p>Internet Curated is a collection of all the best curated resources on the internet.</p>
          <p>Created by <a href="#">@piotrkulpinski</a> and <a href="#">@janwennesland</a></p>
        </div>
      </div>

      <div class="column column_md-2 column_md-offset-1 column_lg-2 column_lg-offset-3">
        <h4 class="headline headline_sm"><?php _e('Navigation', 'chipmunk'); ?></h4>

        <ul class="nav-secondary">
          <?php $menu_items = wp_get_nav_menu_items('Footer nav'); ?>

          <?php foreach ($menu_items as $menu_item) : ?>
            <li class="nav-secondary__item"><a href="<?php echo $menu_item->url; ?>"><?php echo $menu_item->title; ?></a></li>
          <?php endforeach; ?>

          <li class="nav-secondary__item"><button type="button" data-popup-toggle><?php _e('Submit', 'chipmunk'); ?></button></li>
        </ul>
      </div>

      <div class="column column_lg-2 visible-lg-block">
        <h4 class="headline headline_sm"><?php _e('Follow', 'chipmunk'); ?></h4>

        <ul class="nav-secondary">
          <?php if (Chipmunk::theme_option('twitter')) : ?>
            <li class="nav-secondary__item"><a href="<?php echo Chipmunk::theme_option('twitter'); ?>" target="_blank">Twitter</a></li>
          <?php endif; ?>
          <?php if (Chipmunk::theme_option('facebook')) : ?>
            <li class="nav-secondary__item"><a href="<?php echo Chipmunk::theme_option('facebook'); ?>" target="_blank">Facebook</a></li>
          <?php endif; ?>
          <?php if (Chipmunk::theme_option('google')) : ?>
            <li class="nav-secondary__item"><a href="<?php echo Chipmunk::theme_option('google'); ?>" target="_blank">Google</a></li>
          <?php endif; ?>
          <?php if (Chipmunk::theme_option('instagram')) : ?>
            <li class="nav-secondary__item"><a href="<?php echo Chipmunk::theme_option('instagram'); ?>" target="_blank">Instagram</a></li>
          <?php endif; ?>
          <?php if (Chipmunk::theme_option('pinterest')) : ?>
            <li class="nav-secondary__item"><a href="<?php echo Chipmunk::theme_option('pinterest'); ?>" target="_blank">Pinterest</a></li>
          <?php endif; ?>
          <?php if (Chipmunk::theme_option('flickr')) : ?>
            <li class="nav-secondary__item"><a href="<?php echo Chipmunk::theme_option('flickr'); ?>" target="_blank">Flickr</a></li>
          <?php endif; ?>
          <?php if (Chipmunk::theme_option('vimeo')) : ?>
            <li class="nav-secondary__item"><a href="<?php echo Chipmunk::theme_option('vimeo'); ?>" target="_blank">Vimeo</a></li>
          <?php endif; ?>
          <?php if (Chipmunk::theme_option('youtube')) : ?>
            <li class="nav-secondary__item"><a href="<?php echo Chipmunk::theme_option('youtube'); ?>" target="_blank">YouTube</a></li>
          <?php endif; ?>
          <?php if (Chipmunk::theme_option('reddit')) : ?>
            <li class="nav-secondary__item"><a href="<?php echo Chipmunk::theme_option('reddit'); ?>" target="_blank">Reddit</a></li>
          <?php endif; ?>
          <?php if (Chipmunk::theme_option('producthunt')) : ?>
            <li class="nav-secondary__item"><a href="<?php echo Chipmunk::theme_option('producthunt'); ?>" target="_blank">ProductHunt</a></li>
          <?php endif; ?>
        </ul>
      </div>
    </div>
  </div>
</div>
<!-- /.section -->
