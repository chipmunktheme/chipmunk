<?php $term = get_queried_object(); ?>
<?php $paged = chipmunk_get_current_page(); ?>
<?php $layout = ( is_single() or is_front_page() ) ? 'tiles' : chipmunk_theme_option( 'blog_layout' ); ?>

<?php if ( is_single() ) : ?>
    <?php $query = chipmunk_get_related( get_the_ID() ); ?>
<?php elseif ( is_front_page() ) : ?>
    <?php $query = chipmunk_get_posts( 3 ); ?>
<?php else : ?>
    <?php $query = chipmunk_get_posts( chipmunk_theme_option( 'blog_posts_per_page' ), $paged, isset( $term->term_id ) ? $term : null ); ?>
<?php endif; ?>

<?php if ( ( ! is_front_page() and ! is_single() ) or $query->have_posts() ) : ?>
    <div class="section">
        <div class="container">
            <?php if ( is_single() ) : ?>
                <h2 class="heading heading_md"><?php esc_html_e( 'Related', 'chipmunk' ); ?></h2>
            <?php elseif ( is_front_page() ) : ?>
                <h2 class="heading heading_md"><?php esc_html_e( 'Latest Posts', 'chipmunk' ); ?></h2>
            <?php else : ?>
                <?php if ( $term and $layout == 'tiles' ) : ?>
                    <h1 class="heading heading_md"><?php echo $term->taxonomy == 'category' ? sprintf( esc_html__( '%s Category', 'chipmunk' ), single_term_title( null, false ) ) : get_the_title(); ?></h1>
                <?php endif; ?>
            <?php endif; ?>

            <?php if ( $query->have_posts() ) : ?>
                <div class="row" data-action-element="load_posts">
                    <?php $i = 0; ?>
                    <?php while ( $query->have_posts() ) : $query->the_post(); ?>
                        <?php if ( $layout == 'mixed' ) : ?>
                            <?php if ( $i % 4 == 0 and $paged == 1 ) : ?>
                                <?php get_template_part( 'templates/sections/post-excerpt' ); ?>
                            <?php else : ?>
                                <?php get_template_part( 'templates/sections/post-tile' ); ?>
                            <?php endif; ?>

                            <?php $i++; ?>
                        <?php endif; ?>

                        <?php if ( $layout == 'tiles' ) : ?>
                            <?php get_template_part( 'templates/sections/post-tile' ); ?>
                        <?php endif; ?>

                        <?php if ( $layout == 'excerpts' ) : ?>
                            <?php get_template_part( 'templates/sections/post-excerpt' ); ?>
                        <?php endif; ?>
                    <?php endwhile; ?>
                </div>
            <?php else : ?>
                <p class="text_content text_separated">
                    <?php if ( current_user_can( 'publish_posts' ) ) : ?>
                        <?php esc_html_e( 'Ready to publish your first post?', 'chipmunk' ); ?>

                        <a href="<?php echo esc_url( admin_url( 'post-new.php?post_type=post' ) ); ?>"><?php esc_html_e( 'Get started here', 'chipmunk' ); ?></a>.
                    <?php else : ?>
                        <?php esc_html_e( 'Sorry, there are no posts to display yet.', 'chipmunk' ); ?>
                    <?php endif; ?>
                </p>
            <?php endif; ?>
        </div>

        <?php if ( ! is_single() and ! is_front_page() ) : ?>
            <?php chipmunk_get_template( 'sections/pagination', array( 'query' => $query, 'type' => 'post' ) ); ?>
        <?php endif; ?>
    </div>
    <!-- /.section -->
<?php endif; ?>
