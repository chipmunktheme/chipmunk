<?php global $wp_query; ?>
<?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; ?>

<?php if ($wp_query->max_num_pages > 1) : ?>
  <nav class="pagination">
    <div class="container">
      <div class="pagination__inner">
        <span class="pagination__title">Page <?php echo $paged; ?> of <?php echo $wp_query->max_num_pages; ?></span>

        <ul class="pagination__nav">
          <li class="pagination__item<?php echo get_previous_posts_link() ? '' : ' pagination__item_disabled'; ?>">
            <?php $previous_link = '<i class="icon icon_arrow-left" aria-hidden="true"></i><span class="sr-only">'.__('Previous', 'chipmunk').'</span>'; ?>

            <?php if (get_previous_posts_link()) : ?>
              <?php previous_posts_link($previous_link); ?>
            <?php else : ?>
              <?php echo $previous_link; ?>
            <?php endif; ?>
          </li>

          <li class="pagination__item<?php echo get_next_posts_link() ? '' : ' pagination__item_disabled'; ?>">
            <?php $next_link = '<i class="icon icon_arrow-right" aria-hidden="true"></i><span class="sr-only">'.__('Next', 'chipmunk').'</span>'; ?>

            <?php if (get_next_posts_link()) : ?>
              <?php next_posts_link($next_link); ?>
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
