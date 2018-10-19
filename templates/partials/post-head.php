<?php if ( is_single() ) : ?>
    <h1 class="entry__title heading heading_xl">
        <?php the_title(); ?>
    </h1>
<?php else : ?>
    <h2 class="entry__title heading heading_lg">
        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
    </h2>
<?php endif; ?>

<div class="entry__meta">
    <?php if ( is_single() ) : ?>
        <div class="entry__author">
            <?php echo get_avatar( get_the_author_meta( 'ID' ), 32 ); ?>
            <?php the_author(); ?>
        </div>
    <?php endif; ?>

    <ul class="entry__stats stats">
        <?php chipmunk_get_template( 'partials/post-stats', array( 'args' => $collections ) ); ?>
    </ul>
</div>
