<?php

namespace Chipmunk\Settings;

/**
 * A License settings class
 *
 * @package WordPress
 * @subpackage Chipmunk
 */
class OldLicenser extends \Chipmunk\Settings {

	/**
	 * Setting name
	 *
	 * @var string
	 */
	private $setting_name = 'licenses';

	/**
	 * Settings tab name
	 *
	 * @var string
	 */
	private $tab_name = 'License';

	/**
	 * Settings tab slug
	 *
	 * @var string
	 */
	private $tab_slug = 'license';

	/**
	 * Initialize the class.
	 *
	 * @since 1.0.0
	 */
	function __construct( $config = array(), $strings = array(), $errors = array() ) {
		// Set config defaults
		$config = wp_parse_args( $config, array(
			'theme_slug'		=> '',
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
			'license-missing'           => __( 'Your license is invalid.', 'chipmunk' ),
			'license-invalid'           => __( 'Your license is not active for this URL.', 'chipmunk' ),
			'license-name-mismatch'     => __( 'This appears to be an invalid license key for %s.', 'chipmunk' ),
			'license-exceeded'          => __( 'Your license key has reached its activation limit.', 'chipmunk' ),
			'license-unknown'           => __( 'An error occurred, please try again.', 'chipmunk' ),
		) );

		// Set config arguments
		foreach ( $config as $key => $value ) {
			$this->$key = $value;
		}

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

		// License updating hooks
		// add_action( 'pre_update_option_' . $this->item_slug . '_license_key', 'trim' );
		// add_action( 'update_option_' . $this->item_slug . '_license_key', array( $this, 'activate_license' ) );

		// Output settings content
		add_filter( 'chipmunk_settings_tabs', array( $this, 'add_settings_tab' ) );
	}

	/**
	 * Activates the license key.
	 *
	 * @param string $license_key License key
	 *
	 * @return void
	 */
	public function activate_license( $license_key = null ) {
		$response = $this->get_api_response( 'activate_license', $license_key );

		// Make sure the response came back okay
		if ( ! $this->is_valid_response( $response ) ) {
			$this->display_settings_error( $this->errors['license-unknown'] );
		}

		// Decode the API response
		$license_data = json_decode( wp_remote_retrieve_body( $response ) );

		if ( ! $license_data->success ) {
			switch ( $license_data->error ) {
				case 'expired':
					$message = sprintf( $this->errors['license-expired'], date_i18n( get_option( 'date_format' ), strtotime( $license_data->expires, current_time( 'timestamp' ) ) ) );
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

			if ( ! empty( $message ) ) {
				$this->display_settings_error( null, $message );
			}
		}

		// $license_data->license will be either "active" or "inactive"
		if ( ! empty( $license_data->license ) ) {
			update_option( $this->item_slug . '_license_key_status', $license_data->license );
			delete_transient( $this->item_slug . '_license_status' );
		}
	}

	/**
	 * Deactivates the license key.
	 *
	 * @param string $license_key License key
	 *
	 * @return void
	 */
	private function deactivate_license( $license_key = null ) {
		$response = $this->get_api_response( 'deactivate_license', $license_key );

		// Make sure the response came back okay
		if ( ! $this->is_valid_response( $response ) ) {
			$this->display_settings_error( $this->errors['license-unknown'] );
		}

		// Decode the API response
		$license_data = json_decode( wp_remote_retrieve_body( $response ) );

		// $license_data->license will be either "deactivated" or "failed"
		if ( ! empty( $license_data ) && ( $license_data->license == 'deactivated' ) ) {
			delete_option( $this->item_slug . '_license_key_status' );
			delete_transient( $this->item_slug . '_license_status' );
		}
	}

	/**
	 * Checks if license is valid and gets expire date.
	 *
	 * @param string $license_key License key
	 *
	 * @return string License status message.
	 */
	private function get_license_response( $license_key = null ) {
		$response = $this->get_api_response( 'check_license', $license_key );

		// Make sure the response came back okay
		if ( ! $this->is_valid_response( $response ) ) {
			$this->display_settings_error( $this->strings['license-status-unknown'] );
		}

		// Decode the API response
		return json_decode( wp_remote_retrieve_body( $response ) );
	}

	/**
	 * Makes a call to the API and returns the response.
	 *
	 * @param string $action Name of the API action
	 * @param string $license_key License key
	 *
	 * @return array Encoded JSON response.
	 */
	private function get_api_response( $action, $license_key = null ) {
		$verify_ssl = (bool) apply_filters( 'chipmunk_api_request_verify_ssl', true );

		// Call the custom API.
		$response = wp_remote_post( $this->remote_api_url, array(
			'timeout'   => 15,
			'sslverify' => $verify_ssl,
			'body'      => array(
				'edd_action' => $action,
				'license'    => $license_key ?? get_option( $this->item_slug . '_license_key' ),
				'item_id'    => $this->item_id,
				'url'        => home_url(),
			),
		) );

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
		if ( ! isset( $_POST['submit'] ) ) {
			$this->add_settings_error( $this->setting_name, $message );
		}
	}

	/**
	 * Constructs a renewal link
	 *
	 * @param string $license_key License key
	 *
	 * @return string Renewal link.
	 */
	private function get_renewal_link( $license_key ) {
		// If a renewal link was passed in the config, use that
		if ( ! empty( $this->renew_url ) ) {
			return esc_url( $this->renew_url );
		}

		if ( ! empty( $this->item_id ) && $license_key ) {
			$renew_url = add_query_arg( array(
				'edd_license_key'   => $license_key,
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
	 * @param string $license License key
	 *
	 * @return object License status.
	 */
	public function get_license( $license = null ) {
		return $this->get_license_response();
	}

	/**
	 * Returns a license status
	 *
	 * @param string $license License key
	 *
	 * @return string/object License status.
	 */
	public function get_license_status( $license ) {
		if ( empty( $license ) ) {
			return $this->strings['enter-key'];
		}

		$license_data = $this->get_license_response( $license );
		$messages = array();

		// If response doesn't include license data, return
		if ( ! isset( $license_data->license ) ) {
			return $this->strings['license-status-unknown'];
		}

		// We need to update the license status at the same time the message is updated
		if ( ! empty( $license_data ) && isset( $license_data->license ) ) {
			update_option( $this->item_slug . '_license_key_status', $license_data->license );
		}

		// Get expire date
		$expires = false;

		if ( isset( $license_data->expires ) && 'lifetime' != $license_data->expires ) {
			$expires = date_i18n( get_option( 'date_format' ), strtotime( $license_data->expires, current_time( 'timestamp' ) ) );
			$renew_link = '<a href="' . esc_url( $this->get_renewal_link( $license ) ) . '" target="_blank">' . $this->strings['renew'] . '</a>';
		}
		elseif ( isset( $license_data->expires ) && 'lifetime' == $license_data->expires ) {
			$expires = 'lifetime';
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

				if ( ! empty( $expires ) && 'lifetime' != $expires ) {
					$messages[] = sprintf( $this->strings['expires%s'], $expires );
				}

				if ( $site_count && $license_limit ) {
					$messages[] = sprintf( $this->strings['%1$s/%2$-sites'], $site_count, $license_limit );
				}

				break;

			case 'expired':
				if ( $expires ) {
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
	 * Sanitizes the license key.
	 *
	 * @param string $license_key License key that was submitted.
	 *
	 * @return string Sanitized license key.
	 */
	public function sanitize_license( $license_key ) {
		$old_key = get_option( $this->item_slug . '_license_key' );

		if ( ! empty( $old_key ) && $old_key != $license_key ) {
			// New license has been entered, so must reactivate
			delete_option( $this->item_slug . '_license_key_status' );
			delete_transient( $this->item_slug . '_license_status' );
		}

		return $license_key;
	}

	/**
	 * Checks if a license action was submitted.
	 */
	public function license_action() {
		$license_key = $_POST[$this->item_slug . '_license_key'] ?? null;
		$license_activate = $_POST[$this->item_slug . '_license_activate'] ?? null;
		$license_deactivate = $_POST[$this->item_slug . '_license_deactivate'] ?? null;

		if ( isset ( $_POST['submit'] )) {
			if ( ! empty( $license_key ) ) {
				$this->activate_license( $license_key );
			}
			elseif ( isset( $license_key ) ) {
				$this->deactivate_license( $license_key );
			}
		}

		if ( isset( $license_activate ) ) {
			$this->activate_license( $license_key );
		}

		if ( isset( $license_deactivate ) ) {
			$this->deactivate_license( $license_key );
		}
	}

	/**
	 * Registers the option used to store the license key in the options table.
	 */
	public function register_option() {
		register_setting(
			"{$this->theme_slug}_{$this->setting_name}",
			"{$this->item_slug}_license_key",
			array( $this, 'sanitize_license' )
		);
	}

	/**
	 * Adds settings tab to the list
	 */
	public function add_settings_tab( $tabs ) {
		$tabs[] = array(
			'name'      => $this->tab_name,
			'slug'      => $this->tab_slug,
			'content'   => $this->get_settings_content(),
		);

		return $tabs;
	}

	/**
	 * Returns the markup used on the theme license page.
	 */
	private function get_settings_content() {
		ob_start();

		$license    = get_option( $this->item_slug . '_license_key' );
		$status    = $this->get_license_status( $license );
		$key_status = get_option( $this->item_slug . '_license_key_status', false );
		?>

		<form action="options.php" method="post">
			<div class="chipmunk__license">
				<h3 class="chipmunk__license-head">
					<?php echo $this->item_name; ?>
				</h3>

				<div class="chipmunk__license-body">
					<?php settings_fields( $this->theme_slug . '_licenses' ); ?>

					<input id="<?php echo $this->item_slug; ?>_license_key" name="<?php echo $this->item_slug; ?>_license_key" type="password" class="regular-text" value="<?php echo esc_attr( $license ); ?>" placeholder="<?php echo esc_attr( $this->strings['license-key'] ); ?>" />

					<?php if ( ! empty( $license ) ) : ?>
						<?php if ( 'valid' == $key_status ) : ?>
							<button type="submit" class="button-secondary" name="<?php echo $this->item_slug; ?>_license_deactivate"><?php echo esc_attr( $this->strings['deactivate-license'] ); ?></button>
						<?php else : ?>
							<button type="submit" class="button-secondary" name="<?php echo $this->item_slug; ?>_license_activate"><?php echo esc_attr( $this->strings['activate-license'] ); ?></button>
						<?php endif; ?>
					<?php endif; ?>
				</div>

				<div class="chipmunk__license-data is-<?php echo $key_status; ?>">
					<p class="description"><?php echo $status; ?></p>
				</div>

				<?php do_action( 'chipmunk_licenses_content' ); ?>
			</div>

			<?php submit_button(); ?>
		</form>

		<?php
		return ob_get_clean();
	}
}
