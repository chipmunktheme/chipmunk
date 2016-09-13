    <?php get_template_part('partials/newsletter'); ?>
    <?php get_template_part('partials/page-bottom'); ?>
    <?php get_template_part('partials/page-foot'); ?>
  </div>
  <!-- /.body-bag -->

  <?php if (!ChipmunkHelpers::theme_option('disable_search')) : ?>
    <?php get_template_part('partials/search-bar'); ?>
  <?php endif; ?>

  <?php if (!ChipmunkHelpers::theme_option('disable_submissions')) : ?>
    <?php get_template_part('partials/popup'); ?>
  <?php endif; ?>

  <?php if ($tracking_code = ChipmunkHelpers::theme_option('tracking_code')) : ?>
    <?php echo $tracking_code; ?>
  <?php endif ?>

  <?php wp_footer(); ?>
  <script src='https://www.google.com/recaptcha/api.js'></script>
</body>
</html>
