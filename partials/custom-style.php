<?php
  $primary_color  = ChipmunkCustomizer::theme_option('primary_color');
  $primary_font   = ChipmunkCustomizer::theme_option('primary_font');
  $custom_css     = ChipmunkCustomizer::theme_option('custom_css');
?>

<style type="text/css">
  body {
    <?php if ($primary_font) : ?>
      font-family: "<?php echo str_replace('+', ' ', $primary_font); ?>", "Helvetica Neue", Helvetica, Arial, sans-serif;
    <?php else : ?>
      font-family: -apple-system, ".SFNSText-Regular", "San Francisco", "Roboto", "Segoe UI", "Helvetica Neue", "Lucida Grande", sans-serif;
    <?php endif; ?>
  }

  <?php if ($primary_color and $primary_color != '#F38181') : ?>
    .button_primary:hover,
    .button_secondary,
    .entry a:hover,
    .nav-primary__close:hover,
    .nav-socials__item a:hover,
    .page-head__logo,
    .pagination__item a:hover,
    .popup__close:hover,
    .popup__close:hover,
    .popup__close:hover,
    .section_theme-primary .button_secondary:hover {
      color: <?php echo $primary_color; ?>;
    }

    .select2-container .select2-results__option[aria-selected=true],
    .button_primary,
    .button_secondary:hover,
    .section_theme-primary {
      background-color: <?php echo $primary_color; ?>;
    }
  <?php endif; ?>

  <?php if ($custom_css) : ?>
    <?php echo esc_textarea($custom_css); ?>
  <?php endif; ?>
</style>
