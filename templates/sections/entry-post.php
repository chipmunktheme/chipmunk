<?php if ( has_post_thumbnail() ) : ?>
    <div class="entry__hero">
        <?php if ( has_post_thumbnail() ) : ?>
            <div class="entry__background" style="background-image: url(<?php the_post_thumbnail_url( 'xl' ); ?>)" data-rellax data-rellax-speed="-5"></div>
        <?php endif; ?>

        <div class="entry__details section">
            <div class="container">
                <div class="row">
                    <div class="column <?php echo ! is_active_sidebar( 'blog-sidebar' ) ? 'column_lg-8 column_lg-offset-2' : ''; ?>">
                        <?php chipmunk_get_template( 'partials/post-head', array( 'collections' => array(
                            'display'  => true,
                            'type'     => 'link',
                            'quantity' => -1,
                        ) ) ); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.entry__hero -->
<?php endif; ?>

<div class="section">
    <div class="container">
        <?php if ( ! has_post_thumbnail() ) : ?>
            <div class="row">
                <div class="column <?php echo ! is_active_sidebar( 'blog-sidebar' ) ? 'column_lg-8 column_lg-offset-2' : ''; ?>">
                    <div class="entry__head">
                        <?php chipmunk_get_template( 'partials/post-head', array( 'collections' => array(
                            'display'  => true,
                            'type'     => 'link',
                            'quantity' => -1,
                        ) ) ); ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <div class="row row_separated">
            <div class="column column_lg-8 <?php echo ! is_active_sidebar( 'blog-sidebar' ) ? 'column_lg-offset-2' : ''; ?>">
                <div class="entry__content content">
                    <?php the_content(); ?>
                </div>
                <!-- /.entry -->

                <?php if ( ! chipmunk_theme_option( 'blog_disable_sharing' ) ) : ?>
                    <div class="entry__footer">
                        <?php get_template_part( 'templates/partials/share-box' ); ?>
                    </div>
                <?php endif; ?>
            </div>

            <?php if ( is_active_sidebar( 'blog-sidebar' ) ) : ?>
                <div class="column column_lg-4">
                    <?php dynamic_sidebar( 'blog-sidebar' ); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<!-- /.section -->
