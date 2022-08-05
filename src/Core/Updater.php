<?php

namespace Chipmunk\Core;

use MadeByLess\Lessi\Helper\HelperTrait;
use MadeByLess\Lessi\Helper\ThemeTrait;
use MadeByLess\Lessi\Helper\TransientTrait;
use Chipmunk\Theme;

/**
 * Easy Digital Downloads Theme Updater
 */
class Updater extends Theme {
	use HelperTrait;
	use ThemeTrait;
	use TransientTrait;

	/**
	 * Update transient name
	 *
	 * @var string
	 */
	private string $transientName = 'update_response';

	/**
	 * License key
	 *
	 * @var string
	 */
	private string $licenseKey;

	/**
	 * Shop remote API Url
	 *
	 * @var string
	 */
	private string $shopUrl;

	/**
	 * Shop remote item ID
	 *
	 * @var string
	 */
	private string $shopItemId;

	/**
	 * Slug of the theme
	 *
	 * @var string
	 */
	private string $itemSlug;

	/**
	 * Class constructor.
	 */
	public function __construct() {
		$this->licenseKey = get_option( $this->buildThemeSlug( 'license_key' ) );
		$this->shopUrl    = config()->getShopUrl();
		$this->shopItemId = $this->getThemeProperty( 'name' );
		$this->itemSlug   = $this->getThemeProperty( 'text-domain' );
	}

	/**
	 * Hooks methods of this object into the WordPress ecosystem.
	 */
	public function initialize() {
		$this->addAction( 'load-update-core.php', [ $this, 'deleteThemeUpdateTransient' ] );
		$this->addAction( 'load-themes.php', [ $this, 'deleteThemeUpdateTransient' ] );
		$this->addFilter( 'delete_site_transient_update_themes', [ $this, 'deleteThemeUpdateTransient' ] );
		$this->addFilter( 'pre_set_site_transient_update_themes', [ $this, 'addThemeUpdateTransient' ], 10, 2 );
		$this->addFilter( 'http_request_args', [ $this, 'disableOfficialRequest' ], 5, 2 );
	}

	/**
	 * Returns the theme updater transient name.
	 *
	 * @return string
	 */
	public function getTransientName(): string {
		return $this->transientName;
	}

	/**
	 * Updates the transient with the response from the version check
	 *
	 * @param  object $value   The default update values.
	 *
	 * @return array|bool  If an update is available, returns the update parameters,
	 *                        if no update is needed or the request fails, returns false.
	 */
	public function addThemeUpdateTransient( object $value ) {
		if ( ! current_user_can( 'update_themes' ) ) {
			return false;
		}

		/* If there is no valid license key status, don't allow updates. */
		if ( get_option( $this->buildThemeSlug( 'license_key_status' ), false ) !== 'valid' ) {
			return false;
		}

		if ( isset( $value->response ) && empty( $value->checked[ $this->itemSlug ] ) ) {
			return $value;
		}

		if ( $data = $this->checkForUpdate() ) {
			$value->response[ $this->itemSlug ] = [
				'theme'       => $this->itemSlug,
				'new_version' => $data['new_version'],
				'url'         => $data['url'],
				'package'     => $data['package'],
			];
		}

		return $value;
	}

	/**
	 * Removes the update data for the theme
	 */
	public function delete_theme_update_transient() {
		$this->deleteTransient( $this->transientName );
	}

	/**
	 * Disable requests to wp.org repository for this theme.
	 *
	 * @see https://developer.wordpress.org/reference/hooks/http_request_args
	 *
	 * @param array $args
	 * @param string $url
	 */
	public function disableOfficialRequest( array $args, string $url ) {
		// If it's not a theme update request, bail.
		if ( 0 !== strpos( $url, 'https://api.wordpress.org/themes/update-check/1.1/' ) ) {
			return $args;
		}

		// Decode the JSON response
		$themes = json_decode( $args['body']['themes'] );

		// Remove the active parent and child themes from the check
		$parent = get_option( 'template' );
		$child  = get_option( 'stylesheet' );
		unset( $themes->themes->$parent );
		unset( $themes->themes->$child );

		// Encode the updated JSON response
		$args['body']['themes'] = json_encode( $themes );

		return $args;
	}

	/**
	 * Call the EDD SL API (using the URL in the construct) to get the latest version information
	 *
	 * @return array|bool  If an update is available, returns the update parameters,
	 *                        if no update is needed or the request fails, returns false.
	 */
	private function checkForUpdate() {
		$updateData = $this->getTransient( $this->transientName );

		if ( $updateData === false ) {
			$failed = false;

			$response = wp_remote_post(
				$this->shopUrl,
				[
					'timeout' => 15,
					'body'    => [
						'edd_action' => 'get_version',
						'item_id'    => $this->shopItemId,
					],
				]
			);

			// Make sure the response was successful
			if ( is_wp_error( $response ) || 200 !== wp_remote_retrieve_response_code( $response ) ) {
				$failed = true;
			}

			$updateData = json_decode( wp_remote_retrieve_body( $response ) );

			if ( ! is_object( $updateData ) ) {
				$failed = true;
			}

			// If the response failed, try again in 30 minutes
			if ( $failed ) {
				$this->setTransient( $this->transientName, '', strtotime( '+30 minutes', time() ) );
				return false;
			} else {
				$updateData->sections = maybe_unserialize( $updateData->sections );
				$this->setTransient( $this->transientName, $updateData, strtotime( '+12 hours', time() ) );
			}
		}

		if ( version_compare( $this->version, $updateData->new_version, '<' ) ) {
			return (array) $updateData;
		}
	}
}
