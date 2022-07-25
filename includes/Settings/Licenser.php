<?php

namespace Chipmunk\Settings;

use \Chipmunk\Settings;

/**
 * A License settings class
 *
 * @package WordPress
 * @subpackage Chipmunk
 */
class Licenser {

	/**
	 * License key
	 *
	 * @var string
	 */
	private $licenseKey;

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
		$config = wp_parse_args(
			$config,
			array(
				'remoteApiUrl' => '',
				'itemId'       => '',
				'itemName'     => '',
				'itemSlug'     => '',
				'renewUrl'     => '',
			)
		);

		// Set default strings
		$this->strings = wp_parse_args(
			$strings,
			array(
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
			)
		);

		// Set default errors
		$this->errors = wp_parse_args(
			$errors,
			array(
				'license-expired'       => __( 'Your license key expired on %s.', 'chipmunk' ),
				'license-disabled'      => __( 'Your license key has been disabled.', 'chipmunk' ),
				'license-missing'       => __( 'Your license key is invalid.', 'chipmunk' ),
				'license-invalid'       => __( 'Your license key is invalid.', 'chipmunk' ),
				'license-name-mismatch' => __( 'This appears to be an invalid license key for %s.', 'chipmunk' ),
				'license-exceeded'      => __( 'Your license key has reached its activation limit.', 'chipmunk' ),
				'license-unknown'       => __( 'An error occurred, please try again.', 'chipmunk' ),
			)
		);

		// Set config arguments
		foreach ( $config as $key => $value ) {
			$this->$key = $value;
		}

		// Set license option names
		$this->licenseKeyOption  = "{$this->itemSlug}_license_key";
		$this->licenseDataOption = "{$this->itemSlug}_license_data";

		// Set license key
		$this->licenseKey = get_option( $this->licenseKeyOption );

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
		add_action( 'admin_init', array( $this, 'registerOption' ) );
		add_action( 'admin_init', array( $this, 'activateLicense' ) );
		add_action( 'admin_init', array( $this, 'deactivateLicense' ) );
		add_action( 'admin_init', array( $this, 'checkLicense' ) );

		// Output settings content
		add_filter( 'chipmunk_settings_tabs', array( $this, 'addSettingsTab' ) );
	}

	/**
	 * Activates the license key.
	 */
	public function activateLicense() {
		if ( ! isset( $_POST[ $this->licenseKeyOption ] ) ) {
			return null;
		}

		if ( ! isset( $_POST[ "{$this->licenseKeyOption}_activate" ] ) ) {
			return null;
		}

		$this->licenseKey = sanitize_text_field( $_POST[ $this->licenseKeyOption ] );

		if ( $this->getApiResponse( 'activate_license' ) ) {
			$licenseData = $this->checkLicense( true );

			if ( 'valid' != $licenseData->license ) {
				switch ( $licenseData->license ) {
					case 'expired':
						$message = sprintf( $this->errors['license-expired'], date_i18n( 'F j, Y', strtotime( $licenseData->expires, current_time( 'timestamp' ) ) ) );
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
						$message = sprintf( $this->errors['license-item-mismatch'], $this->itemName );
						break;

					case 'no_activations_left':
						$message = $this->errors['license-exceeded'];
						break;

					default:
						$message = $this->errors['license-unknown'];
						break;
				}

				$this->displaySettingsError( null, $message );
			}
		}
	}

	/**
	 * Deactivates the license key.
	 */
	public function deactivateLicense() {
		if ( ! isset( $_POST[ $this->licenseKeyOption ] ) ) {
			return null;
		}

		if ( ! isset( $_POST[ "{$this->licenseKeyOption}_deactivate" ] ) ) {
			return null;
		}

		if ( $this->getApiResponse( 'deactivate_license' ) ) {
			$this->checkLicense( true );
		}
	}

	/**
	 * Checks the license key and stores the license data in db.
	 *
	 * @param bool $forceRefresh Force connecting to the API and retrieving new license data
	 *
	 * @return object
	 */
	public function checkLicense( $forceRefresh = false ) {
		if ( ! $forceRefresh && $licenseData = $this->getLicenseData() ) {
			return $licenseData;
		}

		if ( $response = $this->getApiResponse( 'check_license' ) ) {
			$licenseData = json_decode( wp_remote_retrieve_body( $response ) );

			set_transient( $this->licenseDataOption, $licenseData, WEEK_IN_SECONDS );

			return $licenseData;
		}
	}

	/**
	 * Returns the license data (either from db or API call)
	 *
	 * @return object
	 */
	public function getLicenseData() {
		$licenseData = get_transient( $this->licenseDataOption );

		if ( ! empty( $licenseData ) ) {
			return maybe_unserialize( $licenseData );
		}
	}

	/**
	 * Makes a call to the API and returns the response.
	 *
	 * @param string $action Name of the API action
	 *
	 * @return array Encoded JSON response.
	 */
	private function getApiResponse( $action ) {
		$response = wp_remote_post(
			$this->remoteApiUrl,
			array(
				'timeout'   => 15,
				'sslverify' => false,
				'body'      => array(
					'edd_action' => $action,
					'license'    => trim( $this->licenseKey ),
					'item_id'    => $this->itemId,
					'url'        => home_url(),
				),
			)
		);

		if ( ! $this->isValidResponse( $response ) ) {
			$this->displaySettingsError( $response, $this->errors['license-unknown'] );
			return null;
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
	private function isValidResponse( $response ) {
		return ! is_wp_error( $response ) && 200 == wp_remote_retrieve_response_code( $response );
	}

	/**
	 * Displays the error on the page
	 *
	 * @param object $response Remote API response object
	 * @param string $error Fallback error message
	 */
	private function displaySettingsError( $response, $error = '' ) {
		$message = is_wp_error( $response ) ? $response->get_error_message() : $error;

		// Add proper error message
		Settings::addSettingsError( $this->slug, $message );
	}

	/**
	 * Constructs a renewal link
	 *
	 * @return string Renewal link.
	 */
	private function getRenewalLink() {
		// If a renewal link was passed in the config, use that
		if ( ! empty( $this->renewUrl ) ) {
			return esc_url( $this->renewUrl );
		}

		if ( ! empty( $this->itemId ) && ! empty( $this->licenseKey ) ) {
			$renewUrl = add_query_arg(
				array(
					'edd_license_key' => $this->licenseKey,
					'download_id'     => $this->itemId,
				),
				$this->remoteApiUrl . '/checkout/'
			);

			return esc_url( $renewUrl );
		}

		// Otherwise return the remoteApiUrl
		return esc_url( $this->remoteApiUrl );
	}

	/**
	 * Returns a license status
	 *
	 * @param object $licenseData License data object
	 *
	 * @return string/object License status.
	 */
	public function getLicenseStatus( $licenseData ) {
		$messages = array();

		// If response doesn't include license data, return
		if ( ! isset( $licenseData->license ) ) {
			return $this->strings['license-status-unknown'];
		}

		if ( isset( $licenseData->expires ) && 'lifetime' != $licenseData->expires ) {
			$expires   = date_i18n( 'F j, Y', strtotime( $licenseData->expires, current_time( 'timestamp' ) ) );
			$renewLink = '<a href="' . esc_url( $this->getRenewalLink() ) . '" target="_blank">' . $this->strings['renew'] . '</a>';
		}

		// Get site counts
		$siteCount    = isset( $licenseData->site_count ) ? $licenseData->site_count : null;
		$licenseLimit = isset( $licenseData->license_limit ) ? $licenseData->license_limit : null;

		// If unlimited
		if ( 0 == $licenseLimit ) {
			$licenseLimit = $this->strings['unlimited'];
		}

		switch ( $licenseData->license ) {
			case 'valid':
				$messages[] = $this->strings['license-key-is-active'];

				if ( ! empty( $expires ) ) {
					$messages[] = sprintf( $this->strings['expires%s'], $expires );
				}

				if ( $siteCount && $licenseLimit ) {
					$messages[] = sprintf( $this->strings['%1$s/%2$-sites'], $siteCount, $licenseLimit );
				}

				break;

			case 'expired':
				if ( ! empty( $expires ) ) {
					$messages[] = sprintf( $this->strings['license-key-expired-%s'], $expires );
				} else {
					$messages[] = $this->strings['license-key-expired'];
				}

				if ( ! empty( $renewLink ) ) {
					$messages[] = $renewLink;
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
	public function registerOption() {
		register_setting(
			$this->licenseKeyOption,
			$this->licenseKeyOption
		);
	}

	/**
	 * Adds settings tab to the list
	 */
	public function addSettingsTab( $tabs ) {
		$tabs[] = array(
			'name'    => $this->name,
			'slug'    => $this->slug,
			'content' => $this->getSettingsContent(),
		);

		return $tabs;
	}

	/**
	 * Returns the markup used on the theme license page.
	 */
	private function getSettingsContent() {
		ob_start();

		$licenseData   = $this->getLicenseData();
		$licenseStatus = $this->getLicenseStatus( $licenseData );
		?>

		<form action="options.php" method="post">
			<div class="chipmunk__grid">
				<div class="chipmunk__license chipmunk__box">
					<h3 class="chipmunk__license-head">
						<?php echo $this->itemName; ?>
					</h3>

					<div class="chipmunk__license-body">
						<?php settings_fields( $this->licenseKeyOption ); ?>

						<input id="<?php echo $this->licenseKeyOption; ?>" name="<?php echo $this->licenseKeyOption; ?>" type="text" class="regular-text" value="<?php echo esc_attr( $this->licenseKey ); ?>" placeholder="<?php echo esc_attr( $this->strings['license-key'] ); ?>" />

						<?php if ( ! empty( $licenseData ) && 'valid' == $licenseData->license ) : ?>
							<button type="submit" class="button-secondary" name="<?php echo $this->licenseKeyOption; ?>_deactivate"><?php echo esc_attr( $this->strings['deactivate-license'] ); ?></button>
						<?php else : ?>
							<button type="submit" class="button-primary" name="<?php echo $this->licenseKeyOption; ?>_activate"><?php echo esc_attr( $this->strings['activate-license'] ); ?></button>
						<?php endif; ?>
					</div>

					<div class="chipmunk__license-data is-<?php echo $licenseData->license ?? ''; ?>">
						<p class="description"><?php echo $licenseStatus; ?></p>
					</div>

					<?php do_action( 'chipmunk_license_content' ); ?>
				</div>
			</div>
		</form>

		<?php
		return ob_get_clean();
	}
}
