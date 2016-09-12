<?php get_header(); ?>

  <div class="section section_theme-gray">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
      <?php $wide_content = get_post_meta(get_the_ID(), '_'.ChipmunkMetaBoxes::$field_name.'_about_wide_content', true); ?>
      <?php $curators_enabled = get_post_meta(get_the_ID(), '_'.ChipmunkMetaBoxes::$field_name.'_about_curators_enabled', true); ?>

      <div class="container">
        <?php if ($wide_content) : ?>
          <?php
            $dom = new DOMDocument('1.0', 'UTF-8');
            $content = '<div>'.wpautop(get_the_content()).'</div>';
            $dom->loadHTML(mb_convert_encoding($content, 'HTML-ENTITIES', 'UTF-8'), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

            $content = $dom->firstChild;
            $heading = $content->firstChild;
            $content->removeChild($heading);
            $content = preg_replace('/\<[\/]{0,1}div[^\>]*\>/i', '', $dom->saveHTML());
          ?>

          <h3 class="entry__title heading heading_md"><?php the_title(); ?></h3>

          <div class="entry row">
            <div class="entry__column column column_lg-5">
              <<?php echo $heading->nodeName;?>><?php echo $heading->nodeValue; ?></<?php echo $heading->nodeName;?>>
            </div>

            <div class="entry__column column column_lg-6 column_lg-offset-1">
              <?php echo $content; ?>
            </div>
          </div>
          <!-- /.entry -->
        <?php else : ?>
          <div class="row">
            <div class="column column_lg-8 column_lg-offset-2">
              <h1 class="entry__title heading heading_md"><?php the_title(); ?></h1>

              <div class="entry">
                <?php the_content(); ?>
              </div>
              <!-- /.entry -->
            </div>
          </div>
        <?php endif; ?>

        <?php if ($curators_enabled) : ?>
          <div class="separator"></div>

          <?php get_template_part('sections/curators'); ?>
        <?php endif; ?>
      </div>
    <?php endwhile; endif; ?>

    <?php get_template_part('sections/promo'); ?>
  </div>
  <!-- /.section -->

  <?php get_template_part('sections/toolbox'); ?>

<?php get_footer(); ?>
