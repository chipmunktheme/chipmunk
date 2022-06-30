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
	return null;
endif;
?>

<?php if ( post_type_supports( get_post_type(), 'comments' ) ) : ?>
	<div class="l-wrapper">
		<?php
		/**
		 * List comments acording to custom_comment function specified
		 * in commentstemplate.php file
		 */
		?>
		<?php if ( have_comments() ) : ?>
			<div class="l-component">
				<h3 class="c-heading c-heading--h4"><?php esc_html( printf( _n( '%s Comment', '%s Comments', get_comments_number(), 'chipmunk' ), number_format_i18n( get_comments_number() ) ) ); ?></h3>
			</div>

			<div class="l-component l-component--md">
				<ul class="c-comment__list">
					<?php
					/**
					 * List comments acording to custom_comment function specified
					 * in commentstemplate.php file
					 */
					wp_list_comments( [
						'avatar_size' => 40,
						'type'        => 'comment',
						'callback'    => [ Chipmunk\Helpers::class, 'comment_template' ],
					] );
					?>
				</ul>
			</div>

			<?php
			/*
			* Displays a paginated navigation to next/previous set of comments
			*/
			Chipmunk\Helpers::get_template_part( 'sections/comment-pagination' );
			?>
		<?php endif; ?>

		<?php if ( comments_open() ) : ?>
			<div class="l-component l-component--md">
				<?php
				/*
				* Alter default values of c-form field
				* Name, Author and URL are edited in functions.php via
				* comment_form_default_fields filter hook
				*/
				$commenter = wp_get_current_commenter();
				$req = get_option( 'require_name_email' ) ? " required" : '';

				$fields = [
					'author' => '<div class="c-form__field">' .
						'<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
						'" size="30" placeholder="' . esc_attr__( 'Name', 'chipmunk' ) . ( ! empty( $req ) ? '*' : '' ) . '" class="c-form__input"' . $req . ' /></div>',

					'email' => '<div class="c-form__field">' .
						'<input id="email" name="email" type="email" value="' . esc_attr(  $commenter['comment_author_email'] ) .
						'" size="30" placeholder="' . esc_attr__( 'Email', 'chipmunk' ) . ( ! empty( $req ) ? '*' : '' ) . '" class="c-form__input"' . $req . ' /></div>',

					'url' => '',
				];

				comment_form( [
					'class_form'           => 'l-component c-form',
					'class_submit'         => 'c-button c-button--primary-outline',
					'comment_notes_before' => '',
					'comment_notes_after'  => '',
					'title_reply_before'   => '<h3 class="l-component c-heading c-heading--h4">',
					'title_reply_after'    => '</h3>',
					'submit_field'         => '%1$s %2$s',
					'submit_button'        => '<div class="c-form__field c-form__field--wide c-form__field--cta"><button name="%1$s" type="submit" id="%2$s" class="%3$s">%4$s</button></div>',
					'fields'               => apply_filters( 'comment_form_fields', $fields ),
					'comment_field'        => '<div class="c-form__field c-form__field--wide"><textarea id="comment" name="comment" cols="45" rows="1" placeholder="' . esc_attr__( 'Comment', 'chipmunk' ) . ( ! empty( $req ) ? '*' : '' ) . '" class="c-form__input"' . $req . ' data-dynamic-rows></textarea></div>',
					'must_log_in'          => '<div class="l-component"><p class="l-header__copy">' . sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.' ), wp_login_url( apply_filters( 'the_permalink', get_permalink() ) ) ) . '</p></div>',
				] );

				?>
			</div>
		<?php endif; ?>
	</div>
<?php endif;
