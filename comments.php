<?php
/**
 * Chipmunk: Comments Handler
 *
 * Cover the comments logic here
 * Taken directly from Twenty Eleven
 *
 * @package WordPress
 * @subpackage Chipmunk
 */
?>

<?php if ( post_password_required() ) : ?>
	<?php _e( 'This post is password protected. Enter the password to view any comments.', 'chipmunk' ); ?>
	<?php
	/**
	 * Stop the rest of comments.php from being processed,
	 * but don't kill the script entirely -- we still have
	 * to fully load the template.
	 */
	return;
endif;
?>

<?php if ( comments_open() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
	<?php
	/**
	 * List comments acording to custom_comment function specified
	 * in commentstemplate.php file
	 */
	?>
	<?php if ( have_comments() ) : ?>
		<?php $comments_number = get_comments_number(); ?>
		<h3 class="heading heading_md"><?php printf( _n( '%s Comment', '%s Comments', $comments_number ), number_format_i18n( $comments_number ) ); ?></h3>

		<?php
		/**
		 * List comments acording to custom_comment function specified
		 * in commentstemplate.php file
		 */
		?>
		<?php wp_list_comments( array( 'callback' => 'chipmunk_comment' ) ); ?>
	<?php endif; ?>

	<?php if ( comments_open() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
		<?php
		/*
		 * Alter default values of form field
		 * Name, Author and URL are edited in functions.php via
		 * comment_form_default_fields filter hook
		 */
		comment_form( array(
			'comment_field'        => '<li><label for="message-txt">' . __( 'Message', 'chipmunk' ) . '</label><textarea cols="87" rows="7" id="comment" name="comment"></textarea></li>',
			'must_log_in'          => '<p class="must-log-in">' . __( 'You must log in to post a comment.', 'chipmunk' ) . '</p>',
			'logged_in_as'         => '<p class="logged-in-as">' . __( 'Logged in.', 'chipmunk' ) . '</p>',
			'comment_notes_before' => '',
			'comment_notes_after'  => '',
			'id_form'              => 'commentform',
			'id_submit'            => 'button-add-comment',
			'title_reply'          => __( 'Leave a reply', 'chipmunk' ),
			'title_reply_to'       => __( 'Leave a Reply to %s', 'chipmunk' ),
			'cancel_reply_link'    => __( 'Cancel comment', 'chipmunk' ),
			'label_submit'         => __( 'Comment', 'chipmunk' ),
		) );
		?>
	<?php endif; ?>
<?php endif;
