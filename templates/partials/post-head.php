<h1 class="entry__title"><?php the_title(); ?></h1>

<div class="entry__meta">
    <?php if ( isset( $show_author ) ) : ?>
        <div class="entry__author">
            <?php echo get_avatar( get_the_author_meta( 'ID' ), 32 ); ?>
            <?php the_author(); ?>
        </div>
    <?php endif; ?>

    <ul class="entry__stats stats">
        <?php chipmunk_get_template( 'partials/post-stats', array( 'args' => $collections ) ); ?>
    </ul>
</div>
