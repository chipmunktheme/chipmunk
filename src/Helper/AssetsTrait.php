<?php

namespace Chipmunk\Helper;

use Chipmunk\Helper\FileTrait;
use function Chipmunk\config;

/**
 * Provides methods to manipulate static asset files
 */
trait AssetsTrait {

	use FileTrait;

	/**
	 * Stored manifest JSON file
	 *
	 * @var ?array
	 */
	public $manifest;

	/**
	 * Verifies existence of the given file in manifest
	 *
	 * @return bool
	 */
	protected function hasFile( $asset ) {
		$manifest = $this->getManifest();

		return array_key_exists( $asset, $manifest );
	}

	/**
	 * Returns the real path of the revisioned file.
	 * based on the manifest file content.
	 *
	 * @param $asset
	 *
	 * @return string
	 */
	protected function revisionedPath( $asset ) {
		$manifest = $this->getManifest();

		if ( ! array_key_exists( $asset, $manifest ) ) {
			return 'FILE-NOT-REVISIONED';
		}

		return $this->buildPath( config()->getDistPath(), $manifest[ $asset ] );
	}

	/**
	 * Returns the real path of the asset file.
	 *
	 * @param $asset
	 *
	 * @return string
	 */
	protected function assetPath( $asset ) {
		return $this->revisionedPath( $this->buildPath( config()->getAssetsPath(), $asset ) );
	}

	/**
	 * Checks if request is in development environment
	 *
	 * @return boolean
	 */
	private function isDev() {
		return defined( 'THEME_DEV_ENV' );
	}

	/**
	 * Get parsed manifest file content
	 *
	 * @return array
	 */
	private function getManifest() {
		if ( empty( $this->manifest ) ) {
			$this->initManifest();
		}

		return $this->manifest;
	}

	/**
	 * Loads data from manifest file.
	 */
	private function initManifest() {
		$manifestPath = defined( 'THEME_DEV_ENV' )
			? config()->getManifestDevPath()
			: config()->getManifestPath();

		if ( file_exists( $manifestPath ) ) {
			$this->manifest = json_decode( file_get_contents( $manifestPath ), true );
		}
	}
}
