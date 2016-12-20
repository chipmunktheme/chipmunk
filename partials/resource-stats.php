<?php $show_collections = $wp_query->current_post == 0 || is_search(); ?>
<?php $collections = get_the_terms(get_the_ID(), 'resource-collection'); ?>
<?php $collections_count = count($collections); ?>

<?php if ($show_collections and $collections) : ?>
  <li class="stats__item" title="<?php _e('Collections', 'chipmunk'); ?>">
    <i class="icon icon_tag"></i>

    <a href="<?php echo get_term_link($collections[0]->term_id); ?>"><?php echo $collections[0]->name; ?></a>

    <?php if ($collections_count > 1) : ?>
      <span class="stats__note">, <?php printf(__('+%d more', 'chipmunk'), $collections_count - 1); ?></span>
    <?php endif; ?>
  </li>
<?php endif; ?>

<?php if (!ChipmunkCustomizer::theme_option('disable_resource_date')) : ?>
  <li class="stats__item" title="<?php _e('Published', 'chipmunk'); ?>: <?php echo get_post_time('j. F Y', true, get_the_ID(), true); ?>">
    <i class="icon icon_clock"></i>

    <?php echo get_post_time('j. M', true, get_the_ID(), true); ?>
  </li>
<?php endif; ?>

<?php if (!ChipmunkCustomizer::theme_option('disable_views')) : ?>
  <li class="stats__item" title="<?php _e('Views', 'chipmunk'); ?>">
    <i class="icon icon_view"></i>

    <?php echo ChipmunkHelpers::format_number(ChipmunkViewCounter::get_post_views(get_the_ID())); ?>
  </li>
<?php endif; ?>

<?php if (!ChipmunkCustomizer::theme_option('disable_upvotes')) : ?>
  <?php $upvote_button = ChipmunkUpvotes::get_button(get_the_ID(), 'stats__button'); ?>
  <?php $upvote_counter = ChipmunkUpvotes::get_counter(get_the_ID()); ?>

  <?php if ($show_collections) : ?>
    <li class="stats__item"><?php echo $upvote_button; ?></li>
  <?php else : ?>
    <?php if (ChipmunkCustomizer::theme_option('display_resource_cards')) : ?>
     <li class="stats__item stats__item_sided"><?php echo $upvote_button; ?></li>
   <?php else : ?>
    <li class="stats__item" title="<?php _e('Upvotes', 'chipmunk'); ?>"><?php echo $upvote_counter; ?></li>
   <?php endif; ?>
  <?php endif; ?>
<?php endif; ?>
