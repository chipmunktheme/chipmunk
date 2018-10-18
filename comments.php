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
	<?php esc_html_e( 'This post is password protected. Enter the password to view any comments.', 'chipmunk' ); ?>
	<?php
	/**
	 * Stop the rest of comments.php from being processed,
	 * but don't kill the script entirely -- we still have
	 * to fully load the template.
	 */
	return;
endif;
?>

<?php if ( post_type_supports( get_post_type(), 'comments' ) ) : ?>
	<?php
	/**
	 * List comments acording to custom_comment function specified
	 * in commentstemplate.php file
	 */
	?>
	<?php if ( have_comments() ) : ?>
		<h3 class="heading heading_md"><?php esc_html( printf( _n( '%s Comment', '%s Comments', get_comments_number() ), number_format_i18n( get_comments_number() ) ) ); ?></h3>

		<ul>
			<?php
			/**
			 * List comments acording to custom_comment function specified
			 * in commentstemplate.php file
			 */
			wp_list_comments( array(
				'avatar_size' => 40,
				'type'        => 'comment',
				'callback'    => 'chipmunk_comment'
			 ) );
			 ?>
		 </ul>
	<?php endif; ?>

	<?php if ( comments_open() ) : ?>
		<?php
		/*
		 * Alter default values of form field
		 * Name, Author and URL are edited in functions.php via
		 * comment_form_default_fields filter hook
		 */
		$commenter = wp_get_current_commenter();
		$req = get_option( 'require_name_email' ) ? " required" : '';

		$fields = array(
			'author' => '<div class="form__field"><div class="form__child">' .
				'<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
				'" size="30" placeholder="' . esc_attr__( 'Name', 'chipmunk' ) . ( ! empty( $req ) ? ' *' : '' ) . '"' . $req . ' /></div>',

			'email' => '<div class="form__child">' .
				'<input id="email" name="email" type="email" value="' . esc_attr(  $commenter['comment_author_email'] ) .
				'" size="30" placeholder="' . esc_attr__( 'Email', 'chipmunk' ) . ( ! empty( $req ) ? ' *' : '' ) . '"' . $req . ' /></div></div>',

			'url' => '',
		);

		comment_form( array(
			'class_form'           => 'form',
			'class_submit'         => 'button button_secondary',
			'comment_notes_before' => '',
			'comment_notes_after'  => '',
			'title_reply_before'   => '<h3 class="heading heading_md">',
			'title_reply_after'    => '</h3>',
			'submit_button'        => '<span class="form__field"><button name="%1$s" type="submit" id="%2$s" class="%3$s">%4$s</button></span>',
			'fields'               => apply_filters( 'comment_form_fields', $fields ),
			'comment_field'        => '<div class="form__field"><textarea id="comment" name="comment" cols="45" rows="1" placeholder="' . esc_attr__( 'Comment', 'chipmunk' ) . ( ! empty( $req ) ? ' *' : '' ) . '"' . $req . ' data-dynamic-rows></textarea></div>',
		) );

		?>
	<?php endif; ?>
<?php endif;
