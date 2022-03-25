<?php

namespace Chipmunk\Vendors\ThemeUpdater;

/**
 * Easy Digital Downloads License class
 *
 * @package WordPress
 * @subpackage Chipmunk
 */
class Licenser {

	/**
	 * Initialize the class.
	 *
	 * @since 1.0.0
	 */
	function __construct( $config = array(), $strings = array(), $errors = array() ) {
		// Set config defaults
		$config = wp_parse_args( $config, array(
			'theme_slug'		=> THEME_SLUG,
			'menu_url'          => '',
			'remote_api_url'    => '',
			'item_id'           => '',
			'item_name'         => '',
			'item_slug'         => '',
			'download_id'       => '',
			'renew_url'         => '',
			'item_priority'     => 10,
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
			'expires-never'             => __( 'Lifetime License.', 'chipmunk' ),
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

		// Licensing hooks
		add_action( 'admin_init', array( $this, 'register_option' ), $this->item_priority );
		add_action( 'admin_init', array( $this, 'license_action' ), $this->item_priority );

		// License updating hooks
		add_action( 'pre_update_option_' . $this->item_slug . '_license_key', array( $this, 'trim_value' ), $this->item_priority, 1 );
		// add_action( 'update_option_' . $this->item_slug . '_license_key', array( $this, 'activate_license' ), $this->item_priority, 2 );

		// Output license settings
		add_action( 'chipmunk_licenses_content', array( $this, 'license_settings' ), $this->item_priority );
	}

	/**
	 * Activates the license key.
	 */
	public function activate_license( $license = null ) {
		$license = isset( $license ) ? $license : get_option( $this->item_slug . '_license_key' );
		$params = $this->get_api_params( 'activate_license', $license );
		$response = $this->get_api_response( $params );

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
	 */
	private function deactivate_license( $license = null ) {
		$license = isset( $license ) ? $license : get_option( $this->item_slug . '_license_key' );
		$params = $this->get_api_params( 'deactivate_license', $license );
		$response = $this->get_api_response( $params );

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
	 * @return string $message License status message.
	 */
	private function get_license_response( $license = null ) {
		$license = isset( $license ) ? $license : get_option( $this->item_slug . '_license_key' );
		$params = $this->get_api_params( 'check_license', $license );
		$response = $this->get_api_response( $params );

		// Make sure the response came back okay
		if ( ! $this->is_valid_response( $response ) ) {
			$this->display_settings_error( $this->strings['license-status-unknown'] );
		}

		// Decode the API response
		$license_data = json_decode( wp_remote_retrieve_body( $response ) );

		return $license_data;
	}

	/**
	 * Prints API params to be used for wp_remote_get
	 *
	 * @param string $action Name of the API action
	 * @param string $license License key
	 *
	 * @return array API params array
	 */
	private function get_api_params( $action, $license ) {
		return array(
			'edd_action' => $action,
			'license'    => $license,
			'item_id'    => $this->item_id,
			'url'        => home_url(),
		);
	}

	/**
	 * Makes a call to the API.
	 *
	 * @param array $params to be used for wp_remote_get.
	 * @return array $response decoded JSON response.
	 */
	private function get_api_response( $params ) {
		$verify_ssl = (bool) apply_filters( 'chipmunk_api_request_verify_ssl', true );

		// Call the custom API.
		$response = wp_remote_post( $this->remote_api_url, array(
			'timeout'   => 15,
			'sslverify' => $verify_ssl,
			'body'      => $params,
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
			$this->add_settings_error( $message );
		}
	}

	/**
	 * Constructs a renewal link
	 *
	 * @param string $license License key
	 *
	 * @return string Renewal link.
	 */
	private function get_renewal_link( $license ) {
		// If a renewal link was passed in the config, use that
		if ( ! empty( $this->renew_url ) ) {
			return esc_url( $this->renew_url );
		}

		if ( ! empty( $this->download_id ) && $license ) {
			$renew_url = add_query_arg( array(
				'edd_license_key'   => $license,
				'download_id'       => $this->download_id,
			), $this->remote_api_url . '/checkout/' );

			return esc_url( $renew_url );
		}

		// Otherwise return the remote_api_url
		return esc_url( $this->remote_api_url );
	}

	/**
	 * Adds setting error using Settings API
	 *
	 * @param string $message Error message
	 * @param string $type Error type
	 */
	private function add_settings_error( $message, $type = 'error' ) {
		$old_errors = get_settings_errors( $this->theme_slug . '_licenses' );

		if ( ! \Chipmunk\Helpers::find_key_value( $old_errors, 'code', 'license_error' ) ) {
			add_settings_error( $this->theme_slug . '_licenses', 'license_error', $message, $type );
		}
	}

	// /**
	//  * Returns a license status
	//  *
	//  * @param string $license License key
	//  *
	//  * @return object License status.
	//  */
	// public function get_license_status( $license = null ) {
	// 	return $this->get_license_response();
	// }

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
				$message = $this->strings['license-key-is-active'] . ' ';

				if ( isset( $expires ) && 'lifetime' != $expires ) {
					$message .= sprintf( $this->strings['expires%s'], $expires ) . ' ';
				}

				if ( isset( $expires ) && 'lifetime' == $expires ) {
					$message .= $this->strings['expires-never'];
				}

				if ( $site_count && $license_limit ) {
					$message .= sprintf( $this->strings['%1$s/%2$-sites'], $site_count, $license_limit );
				}

				break;

			case 'expired':
				if ( $expires ) {
					$message = sprintf( $this->strings['license-key-expired-%s'], $expires );
				}
				else {
					$message = $this->strings['license-key-expired'];
				}

				if ( $renew_link ) {
					$message .= " $renew_link";
				}

				break;

			case 'invalid':
				$message = $this->strings['license-is-invalid'];
				break;

			case 'inactive':
				$message = $this->strings['license-is-inactive'];
				break;

			case 'disabled':
				$message = $this->strings['license-key-is-disabled'];
				break;

			case 'site_inactive':
				$message = $this->strings['site-is-inactive'];
				break;

			default:
				$message = $this->strings['license-status-unknown'];
				break;
		}

		return $message;
	}

	/**
	 * Sanitizes the license key.
	 *
	 * @param string $new License key that was submitted.
	 * @return string $new Sanitized license key.
	 */
	public function sanitize_license( $new ) {
		$old = get_option( $this->item_slug . '_license_key' );

		if ( $old && $old != $new ) {
			// New license has been entered, so must reactivate
			delete_option( $this->item_slug . '_license_key_status' );
			delete_transient( $this->item_slug . '_license_status' );
		}

		return $new;
	}

	/**
	 * Trims the value of the key.
	 *
	 * @param string $value Value to be trimmed
	 */
	public function trim_value( $value ) {
		return trim( $value );
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
			$this->theme_slug . '_licenses',
			$this->item_slug . '_license_key',
			array( 'sanitize_callback' => array( $this, 'sanitize_license' ) )
		);
	}

	/**
	 * Outputs the markup used on the theme license page.
	 */
	public function license_settings() {
		$license    = get_option( $this->item_slug . '_license_key' );
		$status    = $this->get_license_status( $license );
		$key_status = get_option( $this->item_slug . '_license_key_status', false );

		?>
		<tr valign="top">
			<th scope="row" valign="top">
				<?php echo $this->item_name; ?>
			</th>

			<td>
				<div class="chipmunk-license">
					<?php settings_fields( $this->theme_slug . '_licenses' ); ?>

					<input id="<?php echo $this->item_slug; ?>_license_key" name="<?php echo $this->item_slug; ?>_license_key" type="text" class="regular-text" value="<?php echo esc_attr( $license ); ?>" placeholder="<?php echo esc_attr( $this->strings['license-key'] ); ?>" />

					<?php if ( ! empty( $license ) ) : ?>
						<?php if ( 'valid' == $key_status ) : ?>
							<button type="submit" class="button-secondary" name="<?php echo $this->item_slug; ?>_license_deactivate"><?php echo esc_attr( $this->strings['deactivate-license'] ); ?></button>
						<?php else : ?>
							<button type="submit" class="button-secondary" name="<?php echo $this->item_slug; ?>_license_activate"><?php echo esc_attr( $this->strings['activate-license'] ); ?></button>
						<?php endif; ?>
					<?php endif; ?>
				</div>

				<div class="chipmunk-license-data license-<?php echo $key_status; ?>-notice">
					<p class="description"><?php echo $status; ?></p>
				</div>
			</td>
		</tr>
		<?php
	}
}
