<?php
/**
 * Custom config actions
 *
 * @package WordPress
 * @subpackage Chipmunk
 */

if ( ! function_exists( 'chipmunk_check_admin_notices' ) ) :
	/**
	 * Checks if there are any admin notices to show
	 */
	function chipmunk_check_admin_notices() {
		$errors = chipmunk_check_requirements();

		if ( ! empty( $errors ) ) {
			foreach ( $errors as $error ) { ?>
				<div class="notice notice-error">
					<p><?php echo $error; ?></p>
				</div>
			<?php }
		}
	}
endif;
add_action( 'admin_notices', 'chipmunk_check_admin_notices' );


if ( ! function_exists( 'chipmunk_update_search_query' ) ) :
	/**
	 * Update search query
	 */
	function chipmunk_update_search_query( $query ) {
		if ( $query->is_search ) {
			// Use custom value for posts per page
			$query->set( 'posts_per_page', chipmunk_theme_option( 'results_per_page' ) );

			// Include resources
			$query->set( 'post_type', array( 'post', 'resource' ) );

			// Include only published posts
			$query->set( 'post_status', array( 'publish' ) );
		}

		return $query;
	}
endif;
add_filter( 'pre_get_posts', 'chipmunk_update_search_query' );


if ( ! function_exists( 'chipmunk_update_main_query' ) ) :
	/**
	 * Update main query
	 */
	function chipmunk_update_main_query( $query ) {
		if ( $query->is_tax and is_tax() ) {
			$query->set( 'posts_per_page', chipmunk_theme_option( 'posts_per_page' ) );
		}

		return $query;
	}
endif;
add_filter( 'pre_get_posts', 'chipmunk_update_main_query' );


if ( ! function_exists( 'chipmunk_exclude_tax_children' ) ) :
	/**
	 * Exclude children from taxonomy listing
	 */
	function chipmunk_exclude_tax_children( $query ) {
		if ( isset( $query->query_vars['resource-collection'] ) ) {
			$query->set( 'tax_query', array( array(
				'taxonomy'          => 'resource-collection',
				'field'             => 'slug',
				'terms'             => $query->query_vars['resource-collection'],
				'include_children'  => false,
			) ) );
		}
	}
endif;
add_filter( 'pre_get_posts', 'chipmunk_exclude_tax_children' );


if ( ! function_exists( 'chipmunk_resource_field' ) ) :
	/**
	* Add extra option to Permalinks settings page
	*/
	function chipmunk_resource_field() {
		if ( isset( $_POST['chipmunk_resource_cpt_base'] ) ) {
			update_option( 'chipmunk_resource_cpt_base', sanitize_title_with_dashes( $_POST['chipmunk_resource_cpt_base'] ) );
		}

		add_settings_field(
			'chipmunk_resource_cpt_base',
			__('Resource base', 'chipmunk'),
			'chipmunk_resource_field_callback',
			'permalink',
			'optional'
		);
	}

	function chipmunk_resource_field_callback() {
		$value = get_option( 'chipmunk_resource_cpt_base' );
		echo '<input type="text" value="' . esc_attr( $value ) . '" name="chipmunk_resource_cpt_base" id="chipmunk_resource_cpt_base" class="regular-text code" />';
	}
endif;
add_action( 'admin_init', 'chipmunk_resource_field' );


if ( ! function_exists( 'chipmunk_collection_field' ) ) :
	/**
	* Add extra option to Permalinks settings page
	*/
	function chipmunk_collection_field() {
		if ( isset( $_POST['chipmunk_collection_cpt_base'] ) ) {
			update_option( 'chipmunk_collection_cpt_base', sanitize_title_with_dashes( $_POST['chipmunk_collection_cpt_base'] ) );
		}

		add_settings_field(
			'chipmunk_collection_cpt_base',
			__('Collection base', 'chipmunk'),
			'chipmunk_collection_field_callback',
			'permalink',
			'optional'
		);
	}

	function chipmunk_collection_field_callback() {
		$value = get_option( 'chipmunk_collection_cpt_base' );
		echo '<input type="text" value="' . esc_attr( $value ) . '" name="chipmunk_collection_cpt_base" id="chipmunk_collection_cpt_base" class="regular-text code" />';
	}
endif;
add_action( 'admin_init', 'chipmunk_collection_field' );


if ( ! function_exists( 'chipmunk_tag_field' ) ) :
	/**
	* Add extra option to Permalinks settings page
	*/
	function chipmunk_tag_field() {
		if ( isset( $_POST['chipmunk_tag_cpt_base'] ) ) {
			update_option( 'chipmunk_tag_cpt_base', sanitize_title_with_dashes( $_POST['chipmunk_tag_cpt_base'] ) );
		}

		add_settings_field(
			'chipmunk_tag_cpt_base',
			__('Resource tag base', 'chipmunk'),
			'chipmunk_tag_field_callback',
			'permalink',
			'optional'
		);
	}

	function chipmunk_tag_field_callback() {
		$value = get_option( 'chipmunk_tag_cpt_base' );
		echo '<input type="text" value="' . esc_attr( $value ) . '" name="chipmunk_tag_cpt_base" id="chipmunk_tag_cpt_base" class="regular-text code" />';
	}
endif;
add_action( 'admin_init', 'chipmunk_tag_field' );


if ( ! function_exists( 'chipmunk_set_default_meta' ) ) :
	/**
	 * Set default meta values for likes and upvotes
	 */
	function chipmunk_set_default_meta( $post_ID ) {
		$defaut_values = array(
			'_' . THEME_SLUG . '_post_view_count'   => 0,
			'_' . THEME_SLUG . '_upvote_count'      => 0,
		);

		foreach ( $defaut_values as $meta => $value ) {
			$current_value = get_post_meta( $post_ID, $meta );

			if ( empty( $current_value ) && ! wp_is_post_revision( $post_ID ) ) {
				add_post_meta( $post_ID, $meta, $value );
			}
		}

		return $post_ID;
	}
endif;
add_action( 'wp_insert_post', 'chipmunk_set_default_meta' );


if ( ! function_exists( 'chipmunk_activation_hook' ) ) :
	/**
	 * Theme activation hook
	 */
	function chipmunk_activation_hook( $old_name, $old_theme ) {
		// chipmunk_ping( 'https://chipmunktheme.com/activations', array(
		// 	'active'    => true,
		// 	'website'   => get_site_url(),
		// 	'version'   => THEME_VERSION,
		// ) );
	}
endif;
add_action( 'after_switch_theme', 'chipmunk_activation_hook' );


if ( ! function_exists( 'chipmunk_deactivation_hook' ) ) :
	/**
	 * Theme deactivation hook
	 */
	function chipmunk_deactivation_hook( $new_name, $new_theme, $old_theme ) {
		// chipmunk_ping( 'https://chipmunktheme.com/activations', array(
		// 	'active'    => false,
		// 	'website'   => get_site_url(),
		// ) );
	}
endif;
add_action( 'switch_theme', 'chipmunk_deactivation_hook' );


if ( ! function_exists( 'chipmunk_add_og_tags' ) ) :
	/**
	 * Add facebook's Open Graph tags
	 */
	function chipmunk_add_og_tags() {
		if ( chipmunk_theme_option( 'disable_og' ) ) {
			return;
		}

		$site_image = chipmunk_theme_option( 'og_image' );

		if ( is_front_page() ) {
			?>

			<!-- / Twitter Card -->
			<meta name="twitter:card" content="summary">

			<!-- / FB Open Graph -->
			<meta property="og:type" content="website">
			<meta property="og:url" content="<?php echo esc_url( home_url( '/' ) ); ?>">
			<meta property="og:title" content="<?php bloginfo( 'name' ); ?>">
			<meta property="og:description" content="<?php bloginfo( 'description' ); ?>">
			<meta property="og:image" content="<?php echo $site_image; ?>">
			<meta property="og:image:width" content="1200">
			<meta property="og:image:height" content="630">
			<meta property="og:site_name" content="<?php bloginfo( 'name' ); ?>">

			<?php
		}
		elseif ( is_single() or is_page() ) {
			global $post;

			if ( get_the_post_thumbnail( $post->ID, 'xl' ) ) {
				$thumbnail_id     = get_post_thumbnail_id( $post->ID );
				$thumbnail_object = wp_get_attachment_image_src( $thumbnail_id, 'xl' );
				$image            = $thumbnail_object[0];
			}
			?>

			<!-- / Twitter Card -->
			<meta name="twitter:card" content="<?php echo isset( $image ) ? 'summary_large_image' : 'summary'; ?>">

			<!-- / FB Open Graph -->
			<meta property="og:type" content="article">
			<meta property="og:url" content="<?php the_permalink(); ?>">
			<meta property="og:title" content="<?php echo chipmunk_og_title(); ?>">
			<meta property="og:description" content="<?php echo chipmunk_meta_description(); ?>">
			<meta property="og:image" content="<?php echo isset( $image ) ? $image : $site_image; ?>">
			<meta property="og:image:width" content="1200">
			<meta property="og:image:height" content="630">
			<meta property="og:site_name" content="<?php bloginfo( 'name' ); ?>">

			<?php
		}
	}
endif;
add_action( 'wp_head', 'chipmunk_add_og_tags' );
