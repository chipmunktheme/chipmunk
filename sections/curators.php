<?php $query = ChipmunkHelpers::get_curators(); ?>

<?php if ($query->have_posts()) : ?>
  <div class="separator"></div>

  <h3 class="heading heading_md"><?php _e('Curators', 'chipmunk'); ?></h3>

  <div class="row">
    <?php while ($query->have_posts()) : $query->the_post(); ?>
      <?php $twitter = get_post_meta(get_the_ID(), '_'.ChipmunkMetaBoxes::$field_name.'_curator_twitter', true); ?>

      <div class="card column column_md-3 column_lg-4">
        <?php if (has_post_thumbnail()) : ?>
          <div class="card__image">
            <?php the_post_thumbnail('sm'); ?>
          </div>
        <?php endif; ?>

        <h4 class="card__title"><?php the_title(); ?></h4>

        <?php if (!empty($twitter)) : ?>
          <a href="<?php echo esc_url('https://twitter.com/'.$twitter); ?>" target="_blank" class="card__handle"><?php echo $twitter; ?></a>
        <?php endif; ?>
      </div>
    <?php endwhile; wp_reset_postdata(); ?>
  </div>
<?php endif; ?>
