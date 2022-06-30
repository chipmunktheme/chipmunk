<?php

namespace Chipmunk;

use Chipmunk\Errors;

/**
 * Used to handle file upload and archive unzipping.
 *
 * @package WordPress
 * @subpackage Chipmunk
 */
class FileHandler {

	/**
	 * Holds uploaded file array.
	 */
	private array $file;

	/**
	 * Holds uploaded file path.
	 */
	private string $uploadedFilePath;

	/**
	 * Class constructor.
	 */
	public function __construct() {
		WP_Filesystem();
	}

	/**
	 * Handles validation, uploading and unzipping of the file.
	 */
	public function handleFile( array $file ): ?FileHandler {
		if ( ! ( $this->file = $this->validateUploadedFile( $file ) ) ) {
			return null;
		}

		if ( ! $this->uploadFile() ) {
			Errors::getInstance()->add( 'F400', 'Could not upload file.' );

			return null;
		}

		if ( $this->checkFiletype( [ 'zip' => 'application/zip' ] ) ) {
			$this->unzipFile();
		}

		return $this;
	}

	/**
	 * Validates uploaded file.
	 */
	private function validateUploadedFile( array $file ): ?array {
		if ( ! is_array( $file ) ) {
			Errors::getInstance()->add( 'F400', 'Something went wrong and file cannot be processed.' );

			return null;
		}

		if ( ! isset( $file['size'] ) || $file['size'] < 1 ) {
			Errors::getInstance()->add( 'F400', 'Uploaded file is empty.' );

			return null;
		}

		return $file;
	}

	/**
	 * Handles file upload to defined directory.
	 */
	private function uploadFile(): bool {
		$this->uploadedFilePath = CHISEL_IMPORTER_UPLOADS_DIR . $this->file['name'];

		return @ move_uploaded_file( $this->file['tmp_name'], $this->uploadedFilePath );
	}

	/**
	 * Unzips uploaded file and removes the archive.
	 */
	private function unzipFile(): ?bool {
		$result = unzip_file( $this->uploadedFilePath, CHISEL_IMPORTER_UPLOADS_DIR );

		if ( is_wp_error( $result ) ) {
			Errors::getInstance()->add( 'F400', 'Could not unzip file.' );

			return null;
		}

		unlink( $this->uploadedFilePath );

		return true;
	}

	/**
	 * Checks if the filetype matches the provided value
	 */
	private function checkFiletype( ?array $mimes ): ?bool {
		$filetype = wp_check_filetype( $this->uploadedFilePath, $mimes );

		return !! $filetype['type'];
	}

	/**
	 * Returns path to file from extracted archive.
	 */
	private function getArchiveFilepath( string $filename ): string {
		return CHISEL_IMPORTER_THUMBNAILS_DIR . basename( $filename );
	}

	/**
	 * Moves file to uploads directory.
	 */
	public function moveToUploads( string $filename ): ?string {
		$filepath = $this->getArchiveFilepath( $filename );
		if ( ! file_exists( $filepath ) ) {
			return null;
		}

		$newPath     = wp_upload_dir();
		$newFilename = wp_unique_filename( $newPath['path'], $filename );
		$newFilepath = sprintf( '%s/%s', $newPath['path'], $newFilename );
		rename( $filepath, $newFilepath );

		return $newFilepath;
	}

	/**
	 * Cleans up archive uploads directory.
	 */
	public function cleanUpArchiveFiles() {
		$files   = glob( CHISEL_IMPORTER_THUMBNAILS_DIR . '*', GLOB_BRACE );
		$files[] = CHISEL_IMPORTER_THUMBNAILS_DIR;
		$files[] = CHISEL_IMPORTER_UPLOADS_DIR . CHISEL_IMPORTER_CSV_FILENAME;

		foreach ( $files as $file ) {
			if ( is_file( $file ) || is_dir( $file ) ) {
				unlink( $file );
			}
		}
	}
}
