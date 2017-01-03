<?php
/**
 * Custom meta boxes
 *
 * @package WordPress
 * @subpackage Chipmunk
 */

if ( ! function_exists( 'chipmunk_add_meta_boxes' ) ) :
/*
 * Adds a meta box to theme screens.
 */
function chipmunk_add_meta_boxes() {
	global $post;

	chipmunk_add_meta_box( 'resource', 'resource' );
	chipmunk_add_meta_box( 'curator', 'curator' );

	if ( ! empty( $post ) ) {
		$template = get_post_meta( $post->ID, '_wp_page_template', true );

		if ( ! $template or in_array( $template, array( 'default' ) ) ) {
			chipmunk_add_meta_box( 'about', 'page' );
		}
		else {
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
		update_post_meta( $post_id, '_' . CHIPMUNK_THEME_SLUG . '_website', sanitize_text_field( $_POST['website'] ) );
	}

	if ( ! ChipmunkCustomizer::theme_option( 'disable_featured' ) ) {
		if ( isset( $_REQUEST['is_featured'] ) ) {
			update_post_meta( $post_id, '_' . CHIPMUNK_THEME_SLUG . '_resource_is_featured', sanitize_text_field( $_POST['is_featured'] ) );
		}
		else {
			delete_post_meta( $post_id, '_' . CHIPMUNK_THEME_SLUG . '_resource_is_featured' );
		}
	}
}
endif;
add_action( 'save_post_resource', 'chipmunk_save_meta_boxes_resource' );


if ( ! function_exists( 'chipmunk_save_meta_boxes_curator' ) ) :
/**
 * Store custom field meta box data
 *
 * @param int $post_id The post ID.
 */
function chipmunk_save_meta_boxes_curator( $post_id ) {
	// Verify permissions
	if ( ! chipmunk_verify_permissions( $post_id ) ) {
		return false;
	}

	// store custom fields values
	if ( isset( $_REQUEST['twitter'] ) ) {
		update_post_meta( $post_id, '_' . CHIPMUNK_THEME_SLUG . '_curator_twitter', sanitize_text_field( $_POST['twitter'] ) );
	}
}
endif;
add_action( 'save_post_curator', 'chipmunk_save_meta_boxes_curator' );


if ( ! function_exists( 'chipmunk_save_meta_boxes_about' ) ) :
/**
 * Store custom field meta box data
 *
 * @param int $post_id The post ID.
 */
function chipmunk_save_meta_boxes_about( $post_id ) {
	// Verify permissions
	if ( ! chipmunk_verify_permissions( $post_id ) ) {
		return false;
	}

	// store custom fields values
	if ( isset( $_REQUEST['wide_content'] ) ) {
		update_post_meta( $post_id, '_' . CHIPMUNK_THEME_SLUG . '_about_wide_content', sanitize_text_field( $_POST['wide_content'] ) );
	}
	else {
		delete_post_meta( $post_id, '_' . CHIPMUNK_THEME_SLUG . '_about_wide_content' );
	}

	if ( isset( $_REQUEST['curators_enabled'] ) ) {
		update_post_meta( $post_id, '_' . CHIPMUNK_THEME_SLUG . '_about_curators_enabled', sanitize_text_field( $_POST['curators_enabled'] ) );
	}
	else {
		delete_post_meta( $post_id, '_' . CHIPMUNK_THEME_SLUG . '_about_curators_enabled' );
	}
}
endif;
add_action( 'save_post_page', 'chipmunk_save_meta_boxes_about' );


if ( ! function_exists( 'chipmunk_build_meta_boxes_resource' ) ) :
/**
 * Build custom field meta box
 *
 * @param post $post The post object
 */
function chipmunk_build_meta_boxes_resource( $post ) {
	wp_nonce_field( basename( __FILE__ ), CHIPMUNK_THEME_SLUG . '_nonce' );
	$website = get_post_meta( $post->ID, '_' . CHIPMUNK_THEME_SLUG . '_resource_website', true );

	if ( ! ChipmunkCustomizer::theme_option( 'disable_featured' ) ) {
		$is_featured = get_post_meta( $post->ID, '_' . CHIPMUNK_THEME_SLUG . '_resource_is_featured', true );
	}

	?>
	<div class="chipmunk-fields">
		<div class="chipmunk-field">
			<label class="chipmunk-label" for="website"><?php _e( 'Website URL', 'chipmunk' ); ?></label>
			<input type="url" name="website" id="website" value="<?php echo $website; ?>" class="widefat" />
		</div>

		<?php if ( ! ChipmunkCustomizer::theme_option( 'disable_featured' ) ) : ?>
			<div class="chipmunk-field">
				<p class="chipmunk-label"><?php _e( 'Featured?', 'chipmunk' ); ?></p>

				<label for="is_featured">
					<input type="checkbox" name="is_featured" id="is_featured" <?php echo $is_featured ? ' checked' : ''; ?> />
					<?php _e( 'Featured on homepage', 'chipmunk' ); ?>
				</label>
			</div>
		<?php endif; ?>
	</div>
	<?php
}
endif;


if ( ! function_exists( 'chipmunk_build_meta_boxes_curator' ) ) :
/**
 * Build custom field meta box
 *
 * @param post $post The post object
 */
function chipmunk_build_meta_boxes_curator( $post ) {
	wp_nonce_field( basename( __FILE__ ), CHIPMUNK_THEME_SLUG . '_nonce' );
	$twitter = get_post_meta($post->ID, '_' . CHIPMUNK_THEME_SLUG . '_curator_twitter', true);

	?>
	<div class="chipmunk-fields">
		<div class="chipmunk-field">
			<label class="chipmunk-label" for="twitter"><?php _e( 'Twitter Handle', 'chipmunk' ); ?></label>
			<p>Add twitter username here (in the @username format).</p>
			<input type="text" name="twitter" id="twitter" value="<?php echo $twitter; ?>" class="widefat" />
		</div>
	</div>
	<?php
}
endif;


if ( ! function_exists( 'chipmunk_build_meta_boxes_about' ) ) :
/**
 * Build custom field meta box
 *
 * @param post $post The post object
 */
function chipmunk_build_meta_boxes_about( $post ) {
	wp_nonce_field( basename( __FILE__ ), CHIPMUNK_THEME_SLUG . '_nonce' );
	$wide_content = get_post_meta( $post->ID, '_' . CHIPMUNK_THEME_SLUG . '_about_wide_content', true );
	$curators_enabled = get_post_meta( $post->ID, '_' . CHIPMUNK_THEME_SLUG . '_about_curators_enabled', true );

	?>
	<div class="chipmunk-fields">
		<div class="chipmunk-field">
			<p class="chipmunk-label"><?php _e( 'Wide content', 'chipmunk' ); ?></p>

			<label for="wide_content">
				<input type="checkbox" name="wide_content" id="wide_content" <?php echo $wide_content ? ' checked' : ''; ?> />
				<?php _e( 'Enable wide content for this page (it will make first heading of this page a left-floated title)', 'chipmunk' ); ?>
			</label>
		</div>

		<div class="chipmunk-field">
			<p class="chipmunk-label"><?php _e( 'Enable curators', 'chipmunk' ); ?></p>

			<label for="curators_enabled">
				<input type="checkbox" name="curators_enabled" id="curators_enabled" <?php echo $curators_enabled ? ' checked' : ''; ?> />
				<?php _e( 'Enable curators listing on this page', 'chipmunk' ); ?>
			</label>
		</div>
	</div>
	<?php
}
endif;


if ( ! function_exists( 'chipmunk_add_meta_box' ) ) :
/*
 * Custom wrapper for add_meta_box function.
 */
function chipmunk_add_meta_box( $name, $post_type ) {
	add_meta_box(
		// ID
		CHIPMUNK_THEME_SLUG . '_' . $name,
		// Title
		__( 'Custom fields', 'chipmunk' ),
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
/*
 * Custom wrapper for add_meta_box function.
 */
function chipmunk_verify_permissions( $post_id ) {
	// verify taxonomies meta box nonce
	if ( ! isset( $_POST[CHIPMUNK_THEME_SLUG . '_nonce'] ) || ! wp_verify_nonce( $_POST[CHIPMUNK_THEME_SLUG . '_nonce'], basename( __FILE__ ) ) ) {
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
