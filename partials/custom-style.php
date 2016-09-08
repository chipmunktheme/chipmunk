<style type="text/css">
  body {
    <?php if ($primary_font = ChipmunkHelpers::theme_option('primary_font')) : ?>
      font-family: "<?php echo str_replace('+', ' ', $primary_font); ?>", "Helvetica Neue", Helvetica, Arial, sans-serif;
    <?php else : ?>
      font-family: -apple-system, ".SFNSText-Regular", "San Francisco", "Roboto", "Segoe UI", "Helvetica Neue", "Lucida Grande", sans-serif;
    <?php endif; ?>
  }

  <?php if ($primary_color = ChipmunkHelpers::theme_option('primary_color') and $primary_color != '#F38181') : ?>
    .button_primary:hover,
    .button_secondary,
    .entry a:hover,
    .nav-primary__close:hover,
    .nav-socials__item a:hover,
    .page-head__logo,
    .popup__close:hover,
    .popup__close:hover,
    .popup__close:hover,
    .section_theme-primary .button_secondary:hover {
      color: <?php echo $primary_color; ?>;
    }

    .select2-container .select2-results__option[aria-selected=true],
    .button_primary,
    .button_secondary:hover,
    .section_theme-primary,
    .tile__image {
      background-color: <?php echo $primary_color; ?>;
    }
  <?php endif; ?>

  <?php if ($custom_css = ChipmunkHelpers::theme_option('custom_css')) : ?>
    <?php echo esc_textarea($custom_css); ?>
  <?php endif; ?>
</style>
