    <?php get_template_part('partials/newsletter'); ?>
    <?php get_template_part('partials/page-bottom'); ?>
    <?php get_template_part('partials/page-foot'); ?>

    <?php if (!ChipmunkCustomizer::theme_option('disable_search')) : ?>
      <?php get_template_part('partials/search-bar'); ?>
    <?php endif; ?>
  </div>
  <!-- /.body-bag -->

  <?php if (!ChipmunkCustomizer::theme_option('disable_submissions')) : ?>
    <?php get_template_part('partials/popup'); ?>
  <?php endif; ?>

  <?php if ($tracking_code = ChipmunkCustomizer::theme_option('tracking_code')) : ?>
    <?php echo $tracking_code; ?>
  <?php endif ?>

  <?php wp_footer(); ?>
  <script src='https://www.google.com/recaptcha/api.js'></script>
</body>
</html>
