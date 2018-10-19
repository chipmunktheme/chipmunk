<?php if ( has_post_thumbnail() ) : ?>
    <div class="entry__hero">
        <?php if ( has_post_thumbnail() ) : ?>
            <div class="entry__background" style="background-image: url(<?php the_post_thumbnail_url( 'xl' ); ?>)" data-rellax data-rellax-speed="-5"></div>
        <?php endif; ?>

        <div class="entry__details section">
            <div class="container">
                <div class="row">
                    <div class="column column_lg-8 column_lg-offset-2">
                        <?php chipmunk_get_template( 'partials/post-head', array( 'show_author' => true, 'collections' => array(
                            'display'  => true,
                            'type'     => 'link',
                            'quantity' => -1,
                        ) ) ); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.entry__head -->
<?php endif; ?>

<div class="section">
    <div class="container">
        <div class="row">
            <div class="column column_lg-8 column_lg-offset-2">
                <?php if ( ! has_post_thumbnail() ) : ?>
                    <div class="entry__head">
                        <?php chipmunk_get_template( 'partials/post-head', array( 'show_author' => true, 'collections' => array(
                            'display'  => true,
                            'type'     => 'link',
                            'quantity' => -1,
                        ) ) ); ?>
                    </div>
                <?php endif; ?>

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
        </div>
    </div>
</div>
<!-- /.section -->
