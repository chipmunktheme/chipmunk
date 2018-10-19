<?php
/**
 * Comments
 *
 * @package WordPress
 * @subpackage Chipmunk
 */

if ( current_theme_supports( 'comments' ) ) {
    /**
     * Alter comments form default fields via filter function
     */
    function chipmunk_comment_fields($fields) {
        $fields['author'] = '<li><label for="name-txt">Name *</label><input type="text" id="name-txt" name="author" value="" /></li>';
        $fields['email'] = '<li><label for="email-txt">Email *</label><input type="text" id="email-txt" name="email" value="" /></li>';
        return $fields;
    }

    add_filter( 'comment_form_default_fields', 'chipmunk_comment_fields' );

    if ( ! function_exists( 'chipmunk_comment' ) ) :
        /**
         * Template for comments, without pingbacks or trackbacks
         * Based on Twenty Eleven Theme
         */
        function chipmunk_comment( $comment, $args, $depth ) {
            if ( $comment->comment_type == 'pingback' || $comment->comment_type == 'trackback' ) {
                return;
            }
            ?>

            <li>
                <article <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
                    <?php if ( $args['avatar_size'] != 0 ) : ?>
                        <figure class="comment__image">
                            <?php echo get_avatar( $comment, $args['avatar_size'] ); ?>
                        </figure>
                        <!-- /.comment__image -->
                    <?php endif; ?>

                    <div class="comment__info">
                        <h4 class="comment__title"><?php echo get_comment_author_link(); ?></h4>
                        <a href="<?php echo get_comment_link(); ?>"><time class="comment__date" datetime="<?php comment_time( 'Y-m-d H:i' ); ?>"><?php echo get_comment_time( get_option( 'date_format' ) . ' ' . get_option( 'time_format' ), false, true ); ?></time></a>

                        <div class="comment__content">
                            <?php comment_text(); ?>
                        </div>

                        <div class="comment__reply">
                            <?php comment_reply_link( array_merge( $args, array( 'reply_text' => esc_html__( 'Reply', 'chipmunk' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
                        </div>

                        <?php if ( ! $comment->comment_approved ) : ?>
                            <p class="comment__note"><?php esc_html_e( 'Your comment is awaiting moderation.', 'chipmunk' ); ?></p>
                        <?php endif; ?>
                    </div>
                </article>
            <?php
        }
    endif;
}
