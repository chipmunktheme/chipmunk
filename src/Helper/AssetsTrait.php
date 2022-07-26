<?php

namespace Chipmunk\Helper;

use Timber\URLHelper;
use Chipmunk\Helper\FileTrait;
use Chipmunk\Helper\ConfigTrait;

/**
 * Provides methods to manipulate static asset files
 */
trait AssetsTrait {

	use FileTrait;
	use ConfigTrait;

	/**
	 * Stored manifest JSON file
	 *
	 * @var ?array
	 */
	public $manifest;

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

		return $this->buildPath( $this->getDistFullPath(), $manifest[ $asset ] );
	}

	/**
	 * Returns the real path of the asset file.
	 *
	 * @param $asset
	 *
	 * @return string
	 */
	protected function assetPath( $asset ) {
		return $this->revisionedPath( $this->buildPath( $this->getAssetsPath(), $asset ) );
	}

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
	 * Returns the real path of the dist directory.
	 *
	 * @return string
	 */
	protected function getDistFullPath() {
		return $this->buildPath( get_template_directory(), $this->getDistPath() );
	}

	/**
	 * Enqueues style file after making sure it exists
	 *
	 * @param string $name
	 * @param string $path
	 *
	 * @return void
	 */
	protected function enqueueStyle( string $name, string $path ): void {
		$this->enqueue( 'style', $name, $path );
	}

	/**
	 * Enqueues script file after making sure it exists
	 *
	 * @param string $name
	 * @param string $path
	 *
	 * @return void
	 */
	protected function enqueueScript( string $name, string $path ): void {
		$this->enqueue( 'script', $name, $path );
	}

	/**
	 * Dequeues style file
	 *
	 * @param string $name
	 *
	 * @return void
	 */
	protected function dequeueStyle( string $name ): void {
		wp_dequeue_style( $name );
	}

	/**
	 * Dequeues script file
	 *
	 * @param string $name
	 *
	 * @return void
	 */
	protected function dequeueScript( string $name ): void {
		wp_dequeue_script( $name );
	}

	/**
	 * Determines whether a file path is absolute or not and enqueues it
	 *
	 * @param string $type
	 * @param string $name
	 * @param string $path
	 *
	 * @return void
	 */
	private function enqueue( $type, $name, $path ) {
		$function = ${"wp_enqueue_$type"};

		if ( URLHelper::is_url( $path ) ) {
			$function( $name, $path );
		} elseif ( $this->hasFile( $path ) ) {
			$function( $name, $this->revisionedPath( $path ) );
		}
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
			? $this->getManifestDevPath()
			: $this->getManifestPath();

		$manifestPath = $this->buildPath( get_template_directory(), $manifestPath );

		if ( file_exists( $manifestPath ) ) {
			$this->manifest = json_decode( file_get_contents( $manifestPath ), true );
		}
	}
}
