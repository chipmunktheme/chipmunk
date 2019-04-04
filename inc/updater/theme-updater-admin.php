<?php
/**
 * Theme updater admin page and functions.
 *
 * @package WordPress
 * @subpackage Chipmunk
 */

class Chipmunk_Theme_Updater_Admin {
	/**
	 * Initialize the class.
	 *
	 * @since 1.0.0
	 */
	function __construct( $config = array(), $strings = array() ) {
		$config = wp_parse_args( $config, array(
			'menu_url'          => '',
			'remote_api_url'    => '',
			'item_slug'         => '',
			'item_name'         => '',
			'version'           => '',
			'author'            => '',
			'download_id'       => '',
			'renew_url'         => '',
			'beta'              => false,
		) );

		// Set config arguments
		foreach ( $config as $key => $value ) {
			$this->$key = $value;
		}

		// Strings passed in from the updater config
		$this->strings = $strings;

		// Initialize theme licenser
		$this->licenser = new Chipmunk_Licenser( $config, $strings );

		// Updater
		add_action( 'init', array( $this, 'updater' ) );
		add_filter( 'http_request_args', array( $this, 'disable_wporg_request' ), 5, 2 );

		// Licenser
		add_action( 'admin_menu', array( $this, 'license_menu' ) );
	}

	/**
	 * Creates the updater class.
	 */
	function updater() {
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		/* If there is no valid license key status, don't allow updates. */
		if ( get_option( $this->item_slug . '_license_key_status', false ) != 'valid' ) {
			return;
		}

		if ( ! class_exists( 'Chipmunk_Theme_Updater' ) ) {
			// Load our custom theme updater
			include( dirname( __FILE__ ) . '/theme-updater-class.php' );
		}

		new Chipmunk_Theme_Updater(
			array(
				'remote_api_url'    => $this->remote_api_url,
				'version'           => $this->version,
				'license'           => get_option( $this->item_slug . '_license_key' ),
				'item_name'         => $this->item_name,
				'item_slug'         => $this->item_slug,
				'author'            => $this->author,
				'beta'              => $this->beta,
			),

			$this->strings
		);
	}

	/**
	 * Adds a menu item for the theme license under the appearance menu.
	 */
	function license_menu() {
		add_submenu_page(
			THEME_SLUG,
			$this->strings['licenses'],
			$this->strings['licenses'],
			'manage_options',
			THEME_SLUG . '_licenses',
			array( $this, 'license_settings' )
		);
	}

	/**
	 * Outputs the markup used on the theme license page.
	 */
	function license_settings() {
		?>
		<div class="wrap">
			<h1><?php echo $this->strings['licenses']; ?></h1>
			<hr>

			<?php settings_errors(); ?>

			<form method="post" action="options.php">
				<table class="form-table">
					<tbody>
						<?php do_action( 'chipmunk_licenses_content' ); ?>
					</tbody>
				</table>

				<?php submit_button(); ?>
			</form>
		<?php
	}

	/**
	 * Disable requests to wp.org repository for this theme.
	 *
	 * @since 1.0.0
	 */
	function disable_wporg_request( $r, $url ) {
		// If it's not a theme update request, bail.
		if ( 0 !== strpos( $url, 'https://api.wordpress.org/themes/update-check/1.1/' ) ) {
 			return $r;
 		}

 		// Decode the JSON response
 		$themes = json_decode( $r['body']['themes'] );

 		// Remove the active parent and child themes from the check
 		$parent = get_option( 'template' );
 		$child = get_option( 'stylesheet' );
 		unset( $themes->themes->$parent );
 		unset( $themes->themes->$child );

 		// Encode the updated JSON response
 		$r['body']['themes'] = json_encode( $themes );

 		return $r;
	}

}
