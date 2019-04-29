<?php
/**
 * Easy Digital Downloads License class
 *
 * @package WordPress
 * @subpackage Chipmunk
 */

class Chipmunk_Licenser {
	/**
	 * Initialize the class.
	 *
	 * @since 1.0.0
	 */
	function __construct( $config = array(), $strings = array(), $errors = array() ) {
		// Set config defaults
		$config = wp_parse_args( $config, array(
			'menu_url'          => '',
			'remote_api_url'    => '',
			'item_id'           => '',
			'item_name'         => '',
			'item_slug'         => '',
			'download_id'       => '',
			'renew_url'         => '',
		) );

		// Set string defaults
		$this->strings = $strings;

		// Set error defaults
		$this->errors = $errors;

		// Set config arguments
		foreach ( $config as $key => $value ) {
			$this->$key = $value;
		}

		// Licensing hooks
		add_action( 'admin_init', array( $this, 'register_option' ) );
		add_action( 'admin_init', array( $this, 'license_action' ) );

		// License updating hooks
		add_action( 'pre_update_option_' . $this->item_slug . '_license_key', array( $this, 'trim_value' ), 10, 1 );
		add_action( 'update_option_' . $this->item_slug . '_license_key', array( $this, 'activate_license' ), 10, 0 );

		// Output license settings
		add_action( 'chipmunk_licenses_content', array( $this, 'license_settings' ) );
	}

	/**
	 * Activates the license key.
	 */
	public function activate_license( $license = null ) {
		$license = isset( $license ) ? $license : get_option( $this->item_slug . '_license_key' );
		$api_params = $this->get_api_params( 'activate_license', $license );
		$response = $this->get_api_response( $api_params );

		// Make sure the response came back okay
		if ( ! $this->is_valid_response( $response ) ) {
			$this->redirect_with_error( $this->errors['license-unknown'] );
		}

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
				$redirect = add_query_arg( array( 'sl_activation' => 'false', 'message' => urlencode( $message ) ), $this->menu_url );

				// Redirect to the menu_url
				wp_safe_redirect( $redirect );
				exit();
			}
		}

		// $response->license will be either "active" or "inactive"
		if ( $license_data && isset( $license_data->license ) ) {
			update_option( $this->item_slug . '_license_key_status', $license_data->license );
			delete_transient( $this->item_slug . '_license_status' );
		}
	}

	/**
	 * Deactivates the license key.
	 */
	private function deactivate_license( $license = null ) {
		$license = isset( $license ) ? $license : get_option( $this->item_slug . '_license_key' );
		$api_params = $this->get_api_params( 'deactivate_license', $license );
		$response = $this->get_api_response( $api_params );

		// Make sure the response came back okay
		if ( ! $this->is_valid_response( $response ) ) {
			$this->redirect_with_error( $this->errors['license-unknown'] );
		}

		$license_data = json_decode( wp_remote_retrieve_body( $response ) );

		// $license_data->license will be either "deactivated" or "failed"
		if ( $license_data && ( $license_data->license == 'deactivated' ) ) {
			delete_option( $this->item_slug . '_license_key_status' );
			delete_transient( $this->item_slug . '_license_status' );
		}
	}

	/**
	 * Checks if license is valid and gets expire date.
	 *
	 * @return string $message License status message.
	 */
	private function check_license( $license = null ) {
		$license = isset( $license ) ? $license : get_option( $this->item_slug . '_license_key' );
		$api_params = $this->get_api_params( 'check_license', $license );
		$response = $this->get_api_response( $api_params );

		// Make sure the response came back okay
		if ( ! $this->is_valid_response( $response ) ) {
			$this->redirect_with_error( $this->strings['license-status-unknown'] );
		}

		$license_data = json_decode( wp_remote_retrieve_body( $response ) );

		// If response doesn't include license data, return
		if ( ! isset( $license_data->license ) ) {
			$message = $this->strings['license-status-unknown'];
			return $message;
		}

		// We need to update the license status at the same time the message is updated
		if ( $license_data && isset( $license_data->license ) ) {
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
					$message .= ' ' . $renew_link;
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
	 * @param array $api_params to be used for wp_remote_get.
	 * @return array $response decoded JSON response.
	 */
	private function get_api_response( $api_params ) {
		$verify_ssl = (bool) apply_filters( 'chipmunk_api_request_verify_ssl', true );

		// Call the custom API.
		$response = wp_remote_post( $this->remote_api_url, array(
			'timeout'   => 15,
			'sslverify' => $verify_ssl,
			'body'      => $api_params,
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
	 * Redirects to the current page with error message
	 *
	 * @param object $response Remote API response object
	 * @param string $error Fallback error message
	 */
	private function redirect_with_error( $response, $error = '' ) {
		$message = is_wp_error( $response ) ? $response->get_error_message() : $error;

		$redirect = add_query_arg( array(
			'sl_activation'     => 'false',
			'message'           => urlencode( $message ),
		), $this->menu_url );

		wp_safe_redirect( $redirect );
		exit();
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

		if ( ! get_transient( $this->item_slug . '_license_status', false ) ) {
			set_transient( $this->item_slug . '_license_status', $this->check_license( $license ), DAY_IN_SECONDS );
		}

		return get_transient( $this->item_slug . '_license_status' );
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
		if ( isset( $_POST[$this->item_slug . '_license_activate'] ) ) {
			$this->activate_license( $_POST[$this->item_slug . '_license_key'] );
		}

		if ( isset( $_POST[$this->item_slug . '_license_deactivate'] ) ) {
			$this->deactivate_license( $_POST[$this->item_slug . '_license_key'] );
		}
	}

	/**
	 * Registers the option used to store the license key in the options table.
	 */
	public function register_option() {
		register_setting(
			$this->item_slug . '_license',
			$this->item_slug . '_license_key',
			array( 'sanitize_callback' => array( $this, 'sanitize_license' ) )
		);
	}

	/**
	 * Outputs the markup used on the theme license page.
	 */
	public function license_settings() {
		$license    = get_option( $this->item_slug . '_license_key' );
		$key_status = get_option( $this->item_slug . '_license_key_status', false );
		$status     = $this->get_license_status( $license );

		?>
		<tr valign="top">
			<th scope="row" valign="top">
				<?php echo $this->item_name; ?>
			</th>

			<td>
				<div class="chipmunk-license">
					<?php settings_fields( $this->item_slug . '_license' ); ?>

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

/**
 * Catches errors from the activation method above and displyaing it to the customer
 */
function chipmunk_license_admin_notices( $errors ) {
	if ( isset( $_GET['sl_activation'] ) && ! empty( $_GET['message'] ) ) {
		if ( $_GET['sl_activation'] == 'false') {
			$errors[] = urldecode( $_GET['message'] );
		}
	}

	return $errors;
}
add_filter( 'chipmunk_admin_notices', 'chipmunk_license_admin_notices' );
