<?php

namespace Chipmunk\Settings;

use \Chipmunk\Settings;

/**
 * A License settings class
 *
 * @package WordPress
 * @subpackage Chipmunk
 */
class Licenser extends Settings {

	/**
	 * License key
	 *
	 * @var string
	 */
	private $license_key;

	/**
	 * Setting name
	 *
	 * @var string
	 */
	private $name = 'License';

	/**
	 * Setting slug
	 *
	 * @var string
	 */
	private $slug = 'license';

	/**
	 * Initialize the class
	 */
	function __construct( $config = array(), $strings = array(), $errors = array() ) {
		// Set config defaults
		$config = wp_parse_args( $config, array(
			'remote_api_url'    => '',
			'item_id'           => '',
			'item_name'         => '',
			'item_slug'         => '',
			'renew_url'         => '',
		) );

		// Set default strings
		$this->strings = wp_parse_args( $strings, array(
			'enter-key'                 => __( 'To receive updates, please enter your valid license key.', 'chipmunk' ),
			'license-key'               => __( 'License Key', 'chipmunk' ),
			'license-action'            => __( 'License Action', 'chipmunk' ),
			'deactivate-license'        => __( 'Deactivate License', 'chipmunk' ),
			'activate-license'          => __( 'Activate License', 'chipmunk' ),
			'status-unknown'            => __( 'License status is unknown.', 'chipmunk' ),
			'renew'                     => __( 'Renew?', 'chipmunk' ),
			'unlimited'                 => __( 'unlimited', 'chipmunk' ),
			'license-key-is-active'     => __( 'License key is active.', 'chipmunk' ),
			'expires%s'                 => __( 'Expires %s.', 'chipmunk' ),
			'%1$s/%2$-sites'            => __( 'You have %1$s / %2$s sites activated.', 'chipmunk' ),
			'license-key-expired-%s'    => __( 'License key expired %s.', 'chipmunk' ),
			'license-key-expired'       => __( 'License key has expired.', 'chipmunk' ),
			'license-keys-do-not-match' => __( 'License keys do not match.', 'chipmunk' ),
			'license-is-invalid'        => __( 'License is invalid.', 'chipmunk' ),
			'license-is-inactive'       => __( 'License is inactive.', 'chipmunk' ),
			'license-key-is-disabled'   => __( 'License key is disabled.', 'chipmunk' ),
			'site-is-inactive'          => __( 'Site is inactive.', 'chipmunk' ),
			'license-status-unknown'    => __( 'License status is unknown.', 'chipmunk' ),
		) );

		// Set default errors
		$this->errors = wp_parse_args( $errors, array(
			'license-expired'           => __( 'Your license key expired on %s.', 'chipmunk' ),
			'license-disabled'          => __( 'Your license key has been disabled.', 'chipmunk' ),
			'license-missing'           => __( 'Your license key is invalid.', 'chipmunk' ),
			'license-invalid'           => __( 'Your license key is invalid.', 'chipmunk' ),
			'license-name-mismatch'     => __( 'This appears to be an invalid license key for %s.', 'chipmunk' ),
			'license-exceeded'          => __( 'Your license key has reached its activation limit.', 'chipmunk' ),
			'license-unknown'           => __( 'An error occurred, please try again.', 'chipmunk' ),
		) );

		// Set config arguments
		foreach ( $config as $key => $value ) {
			$this->$key = $value;
		}

		// Set license option names
		$this->license_key_option = "{$this->item_slug}_license_key";
		$this->license_data_option = "{$this->item_slug}_license_data";

		// Set license key
		$this->license_key = get_option( $this->license_key_option );

		// Set hooks
		$this->hooks();
	}

	/**
	 * Setup hooks
	 *
	 * @return  void
	 */
	private function hooks() {
		// Licensing hooks
		add_action( 'admin_init', array( $this, 'register_option' ) );
		add_action( 'admin_init', array( $this, 'activate_license' ) );
		add_action( 'admin_init', array( $this, 'deactivate_license' ) );
		add_action( 'admin_init', array( $this, 'check_license' ) );

		// Output settings content
		add_filter( 'chipmunk_settings_tabs', array( $this, 'add_settings_tab' ) );
	}

	/**
	 * Activates the license key.
	 *
	 * @return void
	 */
	public function activate_license() {
		if ( ! isset( $_POST[ $this->license_key_option ] ) ) {
			return;
		}

		if ( ! isset( $_POST["{$this->license_key_option}_activate"] ) ) {
			return;
		}

		$this->license_key = sanitize_text_field( $_POST[ $this->license_key_option ] );

		if ( $response = $this->get_api_response( 'activate_license' ) ) {
			$license_data = $this->check_license( true );

			if ( 'valid' != $license_data->license ) {
				switch ( $license_data->license ) {
					case 'expired':
						$message = sprintf( $this->errors['license-expired'], date_i18n( 'F j, Y', strtotime( $license_data->expires, current_time( 'timestamp' ) ) ) );
						break;

					case 'disabled':
					case 'revoked':
						$message = $this->errors['license-disabled'];
						break;

					case 'missing':
						$message = $this->errors['license-missing'];
						break;

					case 'invalid':
					case 'site_inactive':
					case 'invalid_item_id':
						$message = $this->errors['license-invalid'];
						break;

					case 'item_name_mismatch':
						$message = sprintf( $this->errors['license-item-mismatch'], $this->item_name );
						break;

					case 'no_activations_left':
						$message = $this->errors['license-exceeded'];
						break;

					default:
						$message = $this->errors['license-unknown'];
						break;
				}

				$this->display_settings_error( null, $message );
			}
		}
	}

	/**
	 * Deactivates the license key.
	 *
	 * @return void
	 */
	public function deactivate_license() {
		if ( ! isset( $_POST[ $this->license_key_option ] ) ) {
			return;
		}

		if ( ! isset( $_POST["{$this->license_key_option}_deactivate"] ) ) {
			return;
		}

		if ( $this->get_api_response( 'deactivate_license' ) ) {
			$this->check_license( true );
		}
	}

	/**
	 * Checks the license key and stores the license data in db.
	 *
	 * @param bool $force_refresh Force connecting to the API and retrieving new license data
	 *
	 * @return object
	 */
	public function check_license( $force_refresh = false ) {
		if ( ! $force_refresh && $license_data = $this->get_license_data() ) {
			return $license_data;
		}

		if ( $response = $this->get_api_response( 'check_license' ) ) {
			$license_data = json_decode( wp_remote_retrieve_body( $response ) );

			set_transient( $this->license_data_option, $license_data, WEEK_IN_SECONDS );

			return $license_data;
		}
	}

	/**
	 * Returns the license data (either from db or API call)
	 *
	 * @return object
	 */
	public function get_license_data() {
		$license_data = get_transient( $this->license_data_option );

		if ( ! empty( $license_data ) ) {
			return maybe_unserialize( $license_data );
		}
	}

	/**
	 * Makes a call to the API and returns the response.
	 *
	 * @param string $action Name of the API action
	 *
	 * @return array Encoded JSON response.
	 */
	private function get_api_response( $action ) {
		$response = wp_remote_post( $this->remote_api_url, array(
			'timeout'   => 15,
			'sslverify' => false,
			'body'      => array(
				'edd_action' => $action,
				'license'    => trim( $this->license_key ),
				'item_id'    => $this->item_id,
				'url'        => home_url(),
			),
		) );

		if ( ! $this->is_valid_response( $response ) ) {
			$this->display_settings_error( $response, $this->errors['license-unknown'] );
			return;
		}

		return $response;
	}

	/**
	 * Check if the API response is valid
	 *
	 * @param object $response Remote API response object
	 *
	 * @return boolean
	 */
	private function is_valid_response( $response ) {
		return ! is_wp_error( $response ) && 200 == wp_remote_retrieve_response_code( $response );
	}

	/**
	 * Displays the error on the page
	 *
	 * @param object $response Remote API response object
	 * @param string $error Fallback error message
	 */
	private function display_settings_error( $response, $error = '' ) {
		$message = is_wp_error( $response ) ? $response->get_error_message() : $error;

		// Add proper error message
		$this->add_settings_error( $this->slug, $message );
	}

	/**
	 * Constructs a renewal link
	 *
	 * @return string Renewal link.
	 */
	private function get_renewal_link() {
		// If a renewal link was passed in the config, use that
		if ( ! empty( $this->renew_url ) ) {
			return esc_url( $this->renew_url );
		}

		if ( ! empty( $this->item_id ) && ! empty( $this->license_key ) ) {
			$renew_url = add_query_arg( array(
				'edd_license_key'   => $this->license_key,
				'download_id'       => $this->item_id,
			), $this->remote_api_url . '/checkout/' );

			return esc_url( $renew_url );
		}

		// Otherwise return the remote_api_url
		return esc_url( $this->remote_api_url );
	}

	/**
	 * Returns a license status
	 *
	 * @param object $license_data License data object
	 *
	 * @return string/object License status.
	 */
	public function get_license_status( $license_data ) {
		$messages = array();

		// If response doesn't include license data, return
		if ( ! isset( $license_data->license ) ) {
			return $this->strings['license-status-unknown'];
		}

		if ( isset( $license_data->expires ) && 'lifetime' != $license_data->expires ) {
			$expires = date_i18n( 'F j, Y', strtotime( $license_data->expires, current_time( 'timestamp' ) ) );
			$renew_link = '<a href="' . esc_url( $this->get_renewal_link() ) . '" target="_blank">' . $this->strings['renew'] . '</a>';
		}

		// Get site counts
		$site_count = isset( $license_data->site_count ) ? $license_data->site_count : null;
		$license_limit = isset( $license_data->license_limit ) ? $license_data->license_limit : null;

		// If unlimited
		if ( 0 == $license_limit ) {
			$license_limit = $this->strings['unlimited'];
		}

		switch ( $license_data->license ) {
			case 'valid':
				$messages[] = $this->strings['license-key-is-active'];

				if ( ! empty( $expires ) ) {
					$messages[] = sprintf( $this->strings['expires%s'], $expires );
				}

				if ( $site_count && $license_limit ) {
					$messages[] = sprintf( $this->strings['%1$s/%2$-sites'], $site_count, $license_limit );
				}

				break;

			case 'expired':
				if ( ! empty( $expires ) ) {
					$messages[] = sprintf( $this->strings['license-key-expired-%s'], $expires );
				}
				else {
					$messages[] = $this->strings['license-key-expired'];
				}

				if ( ! empty( $renew_link ) ) {
					$messages[] = $renew_link;
				}

				break;

			case 'invalid':
			case 'invalid_item_id':
				$messages[] = $this->strings['license-is-invalid'];
				break;

			case 'inactive':
				$messages[] = $this->strings['license-is-inactive'];
				break;

			case 'disabled':
				$messages[] = $this->strings['license-key-is-disabled'];
				break;

			case 'site_inactive':
				$messages[] = $this->strings['site-is-inactive'];
				break;

			default:
				$messages[] = $this->strings['license-status-unknown'];
				break;
		}

		return implode( ' ', $messages );
	}

	/**
	 * Registers the option used to store the license key in the options table.
	 */
	public function register_option() {
		register_setting(
			$this->license_key_option,
			$this->license_key_option
		);
	}

	/**
	 * Adds settings tab to the list
	 */
	public function add_settings_tab( $tabs ) {
		$tabs[] = array(
			'name'      => $this->name,
			'slug'      => $this->slug,
			'content'   => $this->get_settings_content(),
		);

		return $tabs;
	}

	/**
	 * Returns the markup used on the theme license page.
	 */
	private function get_settings_content() {
		ob_start();

		$license_data   = $this->get_license_data();
		$license_status = $this->get_license_status( $license_data );
		?>

		<form action="options.php" method="post">
			<div class="chipmunk__grid">
				<div class="chipmunk__license chipmunk__box">
					<h3 class="chipmunk__license-head">
						<?php echo $this->item_name; ?>
					</h3>

					<div class="chipmunk__license-body">
						<?php settings_fields( $this->license_key_option ); ?>

						<input id="<?php echo $this->license_key_option; ?>" name="<?php echo $this->license_key_option; ?>" type="text" class="regular-text" value="<?php echo esc_attr( $this->license_key ); ?>" placeholder="<?php echo esc_attr( $this->strings['license-key'] ); ?>" />

						<?php if ( ! empty( $license_data ) && 'valid' == $license_data->license ) : ?>
							<button type="submit" class="button-secondary" name="<?php echo $this->license_key_option; ?>_deactivate"><?php echo esc_attr( $this->strings['deactivate-license'] ); ?></button>
						<?php else : ?>
							<button type="submit" class="button-primary" name="<?php echo $this->license_key_option; ?>_activate"><?php echo esc_attr( $this->strings['activate-license'] ); ?></button>
						<?php endif; ?>
					</div>

					<div class="chipmunk__license-data is-<?php echo $license_data->license ?? ''; ?>">
						<p class="description"><?php echo $license_status; ?></p>
					</div>

					<?php do_action( 'chipmunk_license_content' ); ?>
				</div>
			</div>
		</form>

		<?php
		return ob_get_clean();
	}
}
