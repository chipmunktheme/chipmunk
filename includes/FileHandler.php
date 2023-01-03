<?php

namespace Chipmunk;

use Chipmunk\Errors;

/**
 * Used to handle file upload and archive unzipping.
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
	public function handleFile( ?array $file, ?array $allowedMimes = null ): ?array {
		if ( ! $this->validateUploadedFile( $file, $allowedMimes ) ) {
			return null;
		}

		$this->file = $file;

		// Upload file
		if ( ! $this->uploadFile() ) {
			Errors::getInstance()->add( 'F400', 'Could not upload file.' );

			return null;
		}

		if ( 'zip' == $this->file['type'] ) {
			$this->unzipFile();
		}

		return $this->file;
	}

	/**
	 * Returns uploaded file path
	 */
	public function getUploadedFilePath() {
		return $this->uploadedFilePath;
	}

	/**
	 * Validates uploaded file.
	 */
	private function validateUploadedFile( ?array $file, ?array $allowedMimes = null ): ?array {
		if ( empty( $file ) ) {
			Errors::getInstance()->add( 'F400', 'You forgot to upload the file.' );

			return null;
		}

		if ( ! is_array( $file ) ) {
			Errors::getInstance()->add( 'F400', 'Something went wrong and file cannot be processed.' );

			return null;
		}

		if ( ! empty( $allowedMimes ) && ! in_array( $file['type'], $allowedMimes ) ) {
			Errors::getInstance()->add( 'F400', 'Uploaded file has incorrect format.' );

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
		$this->uploadedFilePath = THEME_UPLOADS_DIR . $this->file['name'];

		return @ move_uploaded_file( $this->file['tmp_name'], $this->uploadedFilePath );
	}

	/**
	 * Unzips uploaded file and removes the archive.
	 */
	private function unzipFile(): ?bool {
		$result = unzip_file( $this->uploadedFilePath, THEME_UPLOADS_DIR );

		if ( is_wp_error( $result ) ) {
			Errors::getInstance()->add( 'F400', 'Could not unzip file.' );

			return null;
		}

		unlink( $this->uploadedFilePath );

		return true;
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
	public static function cleanUpArchiveFiles() {
		$files   = glob( CHISEL_IMPORTER_THUMBNAILS_DIR . '*', GLOB_BRACE );
		$files[] = CHISEL_IMPORTER_THUMBNAILS_DIR;
		$files[] = THEME_UPLOADS_DIR . CHISEL_IMPORTER_CSV_FILENAME;

		foreach ( $files as $file ) {
			if ( is_file( $file ) || is_dir( $file ) ) {
				unlink( $file );
			}
		}
	}
}
