<?php

namespace Piotrkulpinski\Framework\Helper;

use function Chipmunk\config;

/**
 * Provides helper methods
 */
trait HelperTrait {

	/**
	 * Retrieves the server param if not empty
	 *
	 * @param string $key Key of the param
	 *
	 * @return ?string
	 */
	public static function getParam( string $key ): ?string {
		return $_REQUEST[ $key ] ?? null;
	}

	/**
	 * Geneterates random string
	 *
	 * @param int $length Optional. Lenght of the generated string
	 *
	 * @return string
	 */
	public function getSalt( int $length = 5 ): string {
		return bin2hex( random_bytes( $length ) );
	}

	/**
	 * Truncates long strings
	 *
	 * @param string $str       String to be truncated
	 * @param int    $chars     Character limit
	 * @param bool   $toSpace   Optional. Whether to cut the the closest space or not
	 * @param string $suffix    Optional. String to add to the end of truncated text
	 *
	 * @return string
	 */
	public function truncateString( string $str, int $chars, bool $toSpace = true, string $suffix = '...' ): string {
		$str = strip_tags( $str );

		if ( $chars == 0 || $chars > strlen( $str ) ) {
			return $str;
		}

		$str      = substr( $str, 0, $chars );
		$spacePos = strrpos( $str, ' ' );

		if ( $toSpace && $spacePos >= 0 ) {
			$str = substr( $str, 0, strrpos( $str, ' ' ) );
		}

		return $str . $suffix;
	}

	/**
	 * Builds a slug based on the theme slug config
	 *
	 * @param string|array $slug      A slug to generate.
	 * @param string       $separator Separator used to generate the final slug.
	 * @param string|null  $prefix    String to add to the beginning of slug.
	 *
	 * @return string
	 */
	protected function getThemeSlug( $slug, string $separator = '_', int $slugPosition = 0 ): string {
		$segments     = is_array( $slug ) ? $slug : [ $slug ];
		$segmentsHead = array_slice( $segments, 0, $slugPosition );
		$segmentsTail = array_slice( $segments, $slugPosition );
		$segments     = array_merge( $segmentsHead, [ config()->getSlug() ], $segmentsTail );

		return join( $separator, $segments );
	}

	/**
	 * Utility to find if key/value pair exists in array
	 *
	 * @param array $array Haystack
	 * @param string $key  Needle key
	 * @param mixed $value Needle value
	 *
	 * @return ?mixed
	 */
	protected function findKeyValue( array $array, string $key, $val ) {
		foreach ( $array as $item ) {
			if ( is_array( $item ) && $this->findKeyValue( $item, $key, $val ) ) {
				return $item;
			}

			if ( isset( $item[ $key ] ) && $item[ $key ] == $val ) {
				return $item;
			}
		}

		return null;
	}

	/**
	 * Find element in an array by property name
	 *
	 * @param array $haystack
	 * @param string $segments
	 * @param mixed $needle
	 *
	 * @return ?mixed
	 */
	protected function findByProperty( array $haystack, string $segments, $needle ) {
		$segments = explode( '.', $segments );

		$i = 0;

		while ( $i < count( $segments ) ) {
			$segment = $segments[ $i ];

			if ( $segment !== end( $segments ) ) {
				if ( $segment === '*' ) {
					$haystack = array_merge( ...array_column( $haystack, $segments[ $i + 1 ] ) );
					$i++; // Skip one iteration
				} else {
					$haystack = array_column( $haystack, $segment );
				}
			} else {
				foreach ( $haystack as $value ) {
					if ( isset( $value[ $segment ] ) && $value[ $segment ] === $needle ) {
						return $value;
					}
				}
			}

			$i++;
		}

		return null;
	}
}
