<?php

namespace Chipmunk\Settings;

use Timber\Timber;
use MadeByLess\Lessi\Helper\HelperTrait;
use MadeByLess\Lessi\Helper\TransientTrait;
use Chipmunk\Theme;
use Chipmunk\Core\Settings;

/**
 * A License settings class
 */
class Licenser extends Theme {
	use HelperTrait;
	use TransientTrait;

	/**
	 * Setting class
	 *
	 * @var Settings
	 */
	protected Settings $settings;

	/**
	 * License key
	 *
	 * @var string
	 */
	private $key;

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
	private string $slug;

	/**
	 * Initialize the class
	 */
	public function __construct( Settings $settings, array $strings = [], array $errors = [] ) {
		$this->settings = $settings;
		$this->slug = sanitize_title( $this->name );

		// Set license option names
		$this->optionKey  = $this->buildThemeSlug( [ $this->slug, 'key' ] );
		$this->optionData = $this->buildThemeSlug( [ $this->slug, 'data' ] );

		// Set license key
		$this->key = get_option( $this->optionKey );

		// Set default strings
		$this->strings = wp_parse_args(
			$strings,
			[
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
			]
		);

		// Set default errors
		$this->errors = wp_parse_args(
			$errors,
			[
				'license-expired'       => __( 'Your license key expired on %s.', 'chipmunk' ),
				'license-disabled'      => __( 'Your license key has been disabled.', 'chipmunk' ),
				'license-missing'       => __( 'Your license key is invalid.', 'chipmunk' ),
				'license-invalid'       => __( 'Your license key is invalid.', 'chipmunk' ),
				'license-name-mismatch' => __( 'This appears to be an invalid license key for %s.', 'chipmunk' ),
				'license-exceeded'      => __( 'Your license key has reached its activation limit.', 'chipmunk' ),
				'license-unknown'       => __( 'An error occurred, please try again.', 'chipmunk' ),
			]
		);
	}

	/**
	 * Hooks methods of this object into the WordPress ecosystem.
	 */
	public function initialize() {
		$this->addAction( 'admin_init', [ $this, 'registerOption' ] );
		$this->addAction( 'admin_init', [ $this, 'activateLicense' ] );
		$this->addAction( 'admin_init', [ $this, 'deactivateLicense' ] );
		$this->addAction( 'admin_init', [ $this, 'checkLicense' ] );

		// Output settings content
		$this->addAction( $this->buildThemeSlug( 'settings_tabs' ), [ $this, 'addSettingsTab' ] );
	}

	/**
	 * Registers the option used to store the license key in the options table.
	 */
	public function registerOption() {
		register_setting( $this->optionKey, $this->optionKey );
	}

	/**
	 * Activates the license key.
	 *
	 * @return void
	 */
	public function activateLicense(): void {
		if ( ! isset( $_POST[ $this->optionKey ] ) ) {
			return;
		}

		if ( ! isset( $_POST[ "{$this->optionKey}_activate" ] ) ) {
			return;
		}

		$this->key = sanitize_text_field( $_POST[ $this->optionKey ] );

		if ( $this->getApiResponse( 'activate_license' ) ) {
			$data = $this->checkLicense( true );

			if ( 'valid' != $data->license ) {
				switch ( $data->license ) {
					case 'expired':
						$message = sprintf( $this->errors['license-expired'], date_i18n( 'F j, Y', strtotime( $data->expires, current_time( 'timestamp' ) ) ) );
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
						$message = sprintf( $this->errors['license-item-mismatch'], $this->getThemeProperty( 'name' ) );
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
	 *
	 * @return void
	 */
	public function deactivateLicense(): void {
		if ( ! isset( $_POST[ $this->optionKey ] ) ) {
			return;
		}

		if ( ! isset( $_POST[ "{$this->optionKey}_deactivate" ] ) ) {
			return;
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
	 * @return object|null
	 */
	public function checkLicense( bool $forceRefresh = false ): ?object {
		if ( ! $forceRefresh && $data = $this->getData() ) {
			return $data;
		}

		if ( $response = $this->getApiResponse( 'check_license' ) ) {
			$data = json_decode( wp_remote_retrieve_body( $response ) );

			set_transient( $this->optionData, $data, WEEK_IN_SECONDS );

			return $data;
		}

		return null;
	}

	/**
	 * Makes a call to the API and returns the response.
	 *
	 * @param string $action Name of the API action
	 *
	 * @return ?array Encoded JSON response.
	 */
	private function getApiResponse( string $action ): ?array {
		$response = wp_remote_post(
			config()->getShopUrl(),
			[
				'timeout'   => 15,
				'sslverify' => false,
				'body'      => [
					'edd_action' => $action,
					'license'    => trim( $this->key ),
					'item_id'    => config()->getShopItemId(),
					'url'        => home_url(),
				],
			]
		);

		if ( ! $this->isValidResponse( $response ) ) {
			$this->displaySettingsError( $response, $this->errors['license-unknown'] );
			return null;
		}

		return $response;
	}

	/**
	 * Displays the error on the page
	 *
	 * @param object|null $response Remote API response object
	 * @param string      $error Fallback error message
	 */
	private function displaySettingsError( ?object $response, string $error = '' ) {
		$message = is_wp_error( $response ) ? $response->get_error_message() : $error;

		// Add proper error message
		$this->settings->addMessage( $this->slug, $message );
	}

	/**
	 * Returns the license data (either from db or API call)
	 *
	 * @return ?object
	 */
	public function getData(): ?object {
		$data = get_transient( $this->optionData );

		if ( ! empty( $data ) ) {
			return maybe_unserialize( $data );
		}

		return null;
	}

	/**
	 * Returns a license status
	 *
	 * @param object $data License data object
	 *
	 * @return string|object License status.
	 */
	public function getStatus( object $data ) {
		$messages = [];

		// If response doesn't include license data, return
		if ( ! isset( $data->license ) ) {
			return $this->strings['license-status-unknown'];
		}

		if ( isset( $data->expires ) && 'lifetime' != $data->expires ) {
			$expires   = date_i18n( 'F j, Y', strtotime( $data->expires, current_time( 'timestamp' ) ) );
			$renewLink = '<a href="' . esc_url( $this->getRenewalLink() ) . '" target="_blank">' . $this->strings['renew'] . '</a>';
		}

		// Get site counts
		$siteCount    = isset( $data->site_count ) ? $data->site_count : null;
		$licenseLimit = isset( $data->license_limit ) ? $data->license_limit : null;

		// If unlimited
		if ( 0 == $licenseLimit ) {
			$licenseLimit = $this->strings['unlimited'];
		}

		switch ( $data->license ) {
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
	 * Constructs a renewal link
	 *
	 * @return string Renewal link.
	 */
	private function getRenewalLink(): string {
		// If a renewal link was passed in the config, use that
		if ( ! empty( $this->renewUrl ) ) {
			return esc_url( $this->renewUrl );
		}

		if ( ! empty( config()->getShopItemId() ) && ! empty( $this->key ) ) {
			$renewUrl = add_query_arg(
				[
					'edd_license_key' => $this->key,
					'download_id'     => config()->getShopItemId(),
				],
				config()->getShopUrl() . '/checkout/'
			);

			return esc_url( $renewUrl );
		}

		// Otherwise return the remoteApiUrl
		return esc_url( config()->getShopUrl() );
	}

	/**
	 * Adds settings tab to the list
	 *
	 * @param array $tabs
	 */
	public function addSettingsTab( array $tabs ): array {
		$tabs[] = [
			'name'    => $this->name,
			'slug'    => $this->slug,
			'content' => $this->getSettingsContent(),
		];

		return $tabs;
	}

	/**
	 * Returns the markup used on the theme license page.
	 *
	 * @return string
	 */
	private function getSettingsContent(): string {
		$data   = $this->getData();
		$status = $this->getStatus( $data );

		$args    = [
			'strings' => $this->strings,
			'option'   => $this->optionKey,
			'key' => $this->key,
			'data' => $data,
			'status' => $status,
		];

		return Timber::compile( 'admin/settings/licenser.twig', array_merge( Timber::context(), $args ) );
	}
}
