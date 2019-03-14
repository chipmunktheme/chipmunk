<?php
/**
 * Custom config actions
 *
 * @package WordPress
 * @subpackage Chipmunk
 */

if ( ! function_exists( 'chipmunk_add_menu_page' ) ) :
	/**
	 * Register settings page to the admin_menu action hook
	 */
	function chipmunk_add_menu_page() {
		if ( empty( $GLOBALS['admin_page_hooks'][THEME_SLUG] ) ) {
			$icon = 'data:image/svg+xml;base64,PHN2ZyBpZD0iTGF5ZXJfMSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB2aWV3Qm94PSIwIDAgNzIuNCA3NS4xIj48c3R5bGU+LnN0MHtmaWxsOiMzMzMzMzM7fSAuc3Qxe2ZpbGw6I0ZGRkZGRjt9PC9zdHlsZT48cGF0aCBjbGFzcz0ic3QwIiBkPSJNMzYuMyA3NS4xYy00LjUgMC04LjctMi4xLTExLjQtNS44LS43LS45LS41LTIuMS40LTIuOHMyLjEtLjUgMi44LjRjMS45IDIuNyA0LjkgNC4yIDguMiA0LjIgMy4yIDAgNi4zLTEuNiA4LjItNC4yLjctLjkgMS45LTEuMSAyLjgtLjQuOS43IDEuMSAxLjkuNCAyLjgtMi43IDMuNi02LjkgNS44LTExLjQgNS44ek01MiA2OS43Yy0xLjEgMC0yLS45LTItMnMuOS0yIDItMmM5IDAgMTYuNC03LjQgMTYuNC0xNi40UzYxIDMyLjkgNTIgMzIuOWMtMS41IDAtMyAuMi00LjYuNy0xLjEuMy0yLjItLjMtMi41LTEuNC0uMy0xLjEuMy0yLjIgMS40LTIuNSAyLS42IDMuOS0uOSA1LjgtLjkgMTEuMiAwIDIwLjQgOS4yIDIwLjQgMjAuNC0uMSAxMS40LTkuMyAyMC41LTIwLjUgMjAuNXptLTMzLjMtLjFoLS4yQzguMSA2OC43IDAgNTkuOCAwIDQ5LjNjMC0xMS4yIDkuMi0yMC40IDIwLjQtMjAuNCAxLjkgMCAzLjcuMyA1LjguOSAxLjEuMyAxLjcgMS40IDEuNCAyLjUtLjMgMS4xLTEuNCAxLjctMi41IDEuNC0xLjctLjUtMy4xLS43LTQuNi0uNy05IDAtMTYuNCA3LjQtMTYuNCAxNi40IDAgOC40IDYuNSAxNS42IDE0LjkgMTYuMyAxLjEuMSAxLjkgMS4xIDEuOCAyLjItLjIuOS0xLjEgMS43LTIuMSAxLjd6TTU3IDI3LjVjLTEuMSAwLTItLjktMi0yIDAtMTAuMy04LjQtMTguNy0xOC43LTE4LjctMTAuNCAwLTE4LjggOC40LTE4LjggMTguNyAwIDEuMS0uOSAyLTIgMnMtMi0uOS0yLTJDMTMuNSAxMyAyMy43IDIuOCAzNi4zIDIuOCA0OC44IDIuOCA1OSAxMyA1OSAyNS41YzAgMS4xLS45IDItMiAyeiIvPjxwYXRoIGNsYXNzPSJzdDAiIGQ9Ik0zMy42IDI3LjVjLTEuMSAwLTItLjktMi0yQzMxLjggOC45IDIzIDUuMSAxOS4zIDQuM2MtLjMgMS42LS4yIDQuNCAxLjYgNy43LjUgMSAuMiAyLjItLjggMi43cy0yLjIuMi0yLjctLjhDMTMuNSA3IDE1LjkgMS40IDE2IDEuMiAxNi4zLjQgMTcuMSAwIDE3LjkgMGMuMiAwIDE4IDEuMSAxNy43IDI1LjUgMCAxLjEtLjkgMi0yIDJ6bTUuMiAwYy0xLjEgMC0yLS45LTItMkMzNi42IDEuMSA1NC4zIDAgNTQuNSAwYy45LS4xIDEuNi40IDEuOSAxLjIuMS4yIDIuNSA1LjctMS41IDEyLjgtLjUgMS0xLjggMS4zLTIuNy44LTEtLjUtMS4zLTEuOC0uOC0yLjcgMS45LTMuNCAxLjktNi4yIDEuNy03LjgtMy43LjktMTIuNSA0LjctMTIuMyAyMS4yIDAgMS4xLS45IDItMiAyek0zNi4yIDQ4LjljLTQuNCAwLTgtMy42LTgtOHMzLjYtOCA4LTggOCAzLjYgOCA4LTMuNiA4LTggOHptMC0xMmMtMi4yIDAtNCAxLjgtNCA0czEuOCA0IDQgNCA0LTEuOCA0LTQtMS44LTQtNC00ek0zNi4yIDU4LjRjLTQuMiAwLTguMS0xLjMtMTAuNi0zLjYtLjgtLjctLjktMi0uMS0yLjguNy0uOCAyLS45IDIuOC0uMSAxLjggMS42IDQuOCAyLjYgOCAyLjZzNi4yLTEgOC0yLjZjLjgtLjcgMi4xLS43IDIuOC4xLjcuOC43IDIuMS0uMSAyLjgtMi43IDIuMy02LjYgMy42LTEwLjggMy42eiIvPjxwYXRoIGNsYXNzPSJzdDEiIGQ9Ik00MC40IDU2LjRsLS44IDQuNmgtNi43bC0uOC00LjZoOC4zeiIvPjxwYXRoIGNsYXNzPSJzdDAiIGQ9Ik0zOS42IDYzaC02LjdjLTEgMC0xLjgtLjctMi0xLjdsLS44LTQuNmMtLjEtLjYuMS0xLjIuNC0xLjYuNC0uNS45LS43IDEuNS0uN2g4LjNjLjYgMCAxLjIuMyAxLjUuNy40LjUuNSAxIC40IDEuNmwtLjggNC42YzAgMS0uOCAxLjctMS44IDEuN3ptLTUtNGgzLjNsLjEtLjZoLTMuNWwuMS42eiIvPjxjaXJjbGUgY2xhc3M9InN0MCIgY3g9IjI3LjQiIGN5PSIyNS4zIiByPSIyIi8+PGNpcmNsZSBjbGFzcz0ic3QwIiBjeD0iNDUuMSIgY3k9IjI1LjMiIHI9IjIiLz48Zz48cGF0aCBjbGFzcz0ic3QwIiBkPSJNNTkuMyA1OWMtLjUgMC0xLjEtLjItMS40LS42LS44LS44LS43LTIuMS4xLTIuOCAxLjctMS42IDIuNy0zLjkgMi43LTYuMyAwLTEuMS45LTIgMi0yczIgLjkgMiAyYzAgMy41LTEuNCA2LjctMy45IDkuMS0uNS40LTEgLjYtMS41LjZ6bS00Ni4yIDBjLS41IDAtMS0uMi0xLjQtLjYtMi41LTIuNC0zLjktNS43LTMuOS05LjEgMC0zLjUgMS4zLTYuNyAzLjctOS4xLjgtLjggMi0uOCAyLjggMCAuOC44LjggMiAwIDIuOC0xLjYgMS42LTIuNSAzLjktMi41IDYuM3MxIDQuNiAyLjcgNi4zYy44LjguOCAyIC4xIDIuOC0uNC40LTEgLjYtMS41LjZ6Ii8+PC9nPjwvc3ZnPg==';

			add_menu_page( THEME_TITLE, THEME_TITLE, 'manage_options', THEME_SLUG, null, $icon, 99 );
		}
	}
endif;
add_action( 'admin_menu', 'chipmunk_add_menu_page' );


if ( ! function_exists( 'chipmunk_check_admin_notices' ) ) :
	/**
	 * Checks if there are any admin notices to show
	 */
	function chipmunk_check_admin_notices() {
		$errors = apply_filters( 'chipmunk_admin_notices', chipmunk_check_requirements() );

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


if ( ! function_exists( 'chipmunk_remove_type_attr' ) ) :
	/**
	 * Remove type attribute for Javascript and style
	 */
	function chipmunk_remove_type_attr($tag, $handle) {
		return preg_replace( "/type=['\"]text\/(javascript|css)['\"]/", '', $tag );
	}
endif;
add_filter( 'style_loader_tag', 'chipmunk_remove_type_attr', 10, 2 );
add_filter( 'script_loader_tag', 'chipmunk_remove_type_attr', 10, 2 );
