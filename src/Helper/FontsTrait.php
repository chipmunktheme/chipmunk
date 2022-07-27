<?php

namespace Chipmunk\Helper;

use Chipmunk\Helper\TransientsTrait;
use function Chipmunk\config;

/**
 * Provides methods for getting and manipulating fonts
 */
trait FontsTrait {

	use TransientsTrait;

	/**
	 * Get Google fonts list
	 */
	private function getGoogleFonts() {
		if ( ! is_customize_preview() ) {
			return [];
		}

		if ( false === ( $googleFonts = $this->getTransient( 'google_fonts' ) ) ) {
			$googleFonts = $this->fetchGoogleFonts() ?? [];
			$googleFonts = array_column( $googleFonts, 'family' );

			$this->setTransient( 'google_fonts', $googleFonts, WEEK_IN_SECONDS );
		}

		return array_combine( $googleFonts, $googleFonts );
	}

	/**
	 * Fetches fonts from Google Fonts API
	 *
	 * @param array $sort Optional. Sort option to pass to the Google Fonts API
	 *
	 * @return ?array
	 */
	public function fetchGoogleFonts( $sort = 'popularity' ) {
		$apiKey = config()->getGoogleApiKey();

		$ch = curl_init( "https://www.googleapis.com/webfonts/v1/webfonts?key=$apiKey&sort=$sort" );
		curl_setopt( $ch, CURLOPT_HTTPHEADER, [ 'Content-Type: application/json' ] );
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );

		$response = curl_exec( $ch );
		$httpCode = curl_getinfo( $ch, CURLINFO_HTTP_CODE );
		curl_close( $ch );

		$fonts = json_decode( $response, true );

		if ( $httpCode === 200 && ! empty( $fonts ) ) {
			return $fonts['items'];
		}

		return null;
	}
}
