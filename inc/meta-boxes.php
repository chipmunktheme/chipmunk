<?php
/**
 * Custom meta boxes
 *
 * @package WordPress
 * @subpackage Chipmunk
 */

if ( ! function_exists( 'chipmunk_add_meta_boxes' ) ) :
/**
 * Adds a meta box to theme screens.
 */
function chipmunk_add_meta_boxes() {
	global $post;

	chipmunk_add_meta_box( 'resource', 'resource' );

	if ( ! empty( $post ) ) {
		$template = get_page_template_slug( $post->ID );
		$template = str_replace( array( 'page-', '.php' ),  array( '', '' ),  $template );

		if ( in_array( $template, array( 'blog', 'collections', 'resources' ) ) ) {
			remove_post_type_support( 'page', 'editor' );
		}
	}
}
endif;
add_action( 'add_meta_boxes', 'chipmunk_add_meta_boxes' );


if ( ! function_exists( 'chipmunk_save_meta_boxes_resource' ) ) :
/**
 * Store custom field meta box data
 *
 * @param int $post_id The post ID.
 */
function chipmunk_save_meta_boxes_resource( $post_id ) {
	// Verify permissions
	if ( ! chipmunk_verify_permissions( $post_id ) ) {
		return false;
	}

	// store custom fields values
	if ( isset( $_REQUEST['website'] ) ) {
		update_post_meta( $post_id, '_' . THEME_SLUG . '_resource_website', sanitize_text_field( $_POST['website'] ) );
	}

	if ( ! chipmunk_theme_option( 'disable_featured' ) ) {
		if ( isset( $_REQUEST['is_featured'] ) ) {
			update_post_meta( $post_id, '_' . THEME_SLUG . '_resource_is_featured', sanitize_text_field( $_POST['is_featured'] ) );
		}
		else {
			delete_post_meta( $post_id, '_' . THEME_SLUG . '_resource_is_featured' );
		}
	}
}
endif;
add_action( 'save_post_resource', 'chipmunk_save_meta_boxes_resource' );


if ( ! function_exists( 'chipmunk_build_meta_boxes_resource' ) ) :
/**
 * Build custom field meta box
 *
 * @param post $post The post object
 */
function chipmunk_build_meta_boxes_resource( $post ) {
	wp_nonce_field( basename( __FILE__ ), THEME_SLUG . '_nonce' );
	$website = get_post_meta( $post->ID, '_' . THEME_SLUG . '_resource_website', true );
	$submitter = get_post_meta( $post->ID, '_' . THEME_SLUG . '_resource_submitter', true );

	if ( ! chipmunk_theme_option( 'disable_featured' ) ) {
		$is_featured = get_post_meta( $post->ID, '_' . THEME_SLUG . '_resource_is_featured', true );
	}

	?>
	<div class="chipmunk-fields">
		<div class="chipmunk-field">
			<label class="chipmunk-label" for="website"><?php esc_html_e( 'Website URL', 'chipmunk' ); ?></label>
			<input type="url" name="website" id="website" value="<?php echo esc_attr( $website ); ?>" class="widefat" />
		</div>

		<?php if ( ! chipmunk_theme_option( 'disable_featured' ) ) : ?>
			<div class="chipmunk-field">
				<p class="chipmunk-label"><?php esc_html_e( 'Featured?', 'chipmunk' ); ?></p>

				<label for="is_featured">
					<input type="checkbox" name="is_featured" id="is_featured" <?php echo $is_featured ? ' checked' : ''; ?> />
					<?php esc_html_e( 'Featured on homepage', 'chipmunk' ); ?>
				</label>
			</div>
		<?php endif; ?>

		<?php if ( ! empty( $submitter ) ) : ?>
			<div class="chipmunk-field">
				<label class="chipmunk-label" for="submitter"><?php esc_html_e( 'Submitter', 'chipmunk' ); ?></label>
				<input type="url" name="submitter" id="submitter" value="<?php echo esc_attr( $submitter ); ?>" readonly class="widefat" />
			</div>
		<?php endif; ?>
	</div>
	<?php
}
endif;


if ( ! function_exists( 'chipmunk_add_meta_box' ) ) :
/**
 * Custom wrapper for add_meta_box function.
 */
function chipmunk_add_meta_box( $name, $post_type ) {
	add_meta_box(
		// ID
		THEME_SLUG . '_' . $name,
		// Title
		esc_html__( 'Custom fields', 'chipmunk' ),
		// Callback
		'chipmunk_build_meta_boxes_' . $name,
		// Screen
		$post_type,
		// Context
		'normal',
		// Priority
		'high'
	);
}
endif;


if ( ! function_exists( 'chipmunk_verify_permissions' ) ) :
/**
 * Custom wrapper for add_meta_box function.
 */
function chipmunk_verify_permissions( $post_id ) {
	// verify taxonomies meta box nonce
	if ( ! isset( $_POST[THEME_SLUG . '_nonce'] ) || ! wp_verify_nonce( $_POST[THEME_SLUG . '_nonce'], basename( __FILE__ ) ) ) {
		return false;
	}

	// return if autosave
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return false;
	}

	// Check the user's permissions.
	if ( !current_user_can( 'edit_post', $post_id ) ) {
		return false;
	}

	return true;
}
endif;
