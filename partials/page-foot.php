<footer class="page-foot section section_compact">
  <div class="container">
    <div class="page-foot__inner">
      <p class="page-foot__copy">&copy; <?php bloginfo( 'name' ); ?> <?php echo date( 'Y' ); ?></p>

      <?php if ( ! ChipmunkCustomizer::theme_option( 'disable_credits' ) ) : ?>
        <p class="page-foot__credits">
          <a href="http://chipmunktheme.com" target="_blank" title="<?php _e( 'Chipmunk WordPress Theme', 'chipmunk' ); ?>">
            <?php _e( 'Chipmunk WordPress Theme', 'chipmunk' ); ?>
            <img src="<?php echo get_template_directory_uri(); ?>/static/dist/images/chipmunk.png" alt="" />
          </a>
        </p>
      <?php endif; ?>
    </div>
    <!-- /.page-foot__inner -->
  </div>
  <!-- /.container -->
</footer>
<!-- /.page-foot -->
