<?php
global $wp_query;
$query = isset($custom_query) ? $custom_query : $wp_query;
$paged = ChipmunkHelpers::get_current_page();
?>

<?php if ($query and $query->max_num_pages > 1 and (!isset($query->query['orderby']) or $query->query['orderby'] != 'rand')) : ?>
  <nav class="pagination">
    <div class="container">
      <div class="pagination__inner">
        <span class="pagination__title"><?php printf(__('Page %d of %d', 'chipmunk'), $paged, $query->max_num_pages); ?></span>

        <ul class="pagination__nav">
          <li class="pagination__item<?php echo get_previous_posts_link(null, $query->max_num_pages) ? '' : ' pagination__item_disabled'; ?>">
            <?php $previous_link = '<i class="icon icon_arrow-left" aria-hidden="true"></i><span class="sr-only">'.__('Previous', 'chipmunk').'</span>'; ?>

            <?php if (get_previous_posts_link(null, $query->max_num_pages)) : ?>
              <?php previous_posts_link($previous_link, $query->max_num_pages); ?>
            <?php else : ?>
              <?php echo $previous_link; ?>
            <?php endif; ?>
          </li>

          <li class="pagination__item<?php echo get_next_posts_link(null, $query->max_num_pages) ? '' : ' pagination__item_disabled'; ?>">
            <?php $next_link = '<i class="icon icon_arrow-right" aria-hidden="true"></i><span class="sr-only">'.__('Next', 'chipmunk').'</span>'; ?>

            <?php if (get_next_posts_link(null, $query->max_num_pages)) : ?>
              <?php next_posts_link($next_link, $query->max_num_pages); ?>
            <?php else : ?>
              <?php echo $next_link; ?>
            <?php endif; ?>
          </li>
        </ul>
      </div>
    </div>
    <!-- /.container -->
  </nav>
  <!-- /.pagination -->
<?php endif; ?>

<?php
  wp_reset_postdata();
  wp_reset_query();
?>
