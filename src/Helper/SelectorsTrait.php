<?php

namespace Chipmunk\Helper;

use Piotrkulpinski\Framework\Exception\TypeException;

/**
 * Provides methods for selectors and HTML elements
 */
trait SelectorsTrait {

	/**
	 * Builds class string based on name and modifiers
	 *
	 * @param string           $name          Base class name
	 * @param ?string[]|string $modifiers,... Class name modifiers
	 *
	 * @return string
	 */
	protected static function className( $name, $modifiers = null ): string {
		if ( ! is_string( $name ) ) {
			return '';
		}

		$modifiers = array_slice( func_get_args(), 1 );
		$classes   = [ $name ];

		foreach ( $modifiers as $modifier ) {
			if ( ! empty( $modifier ) ) {
				if ( is_array( $modifier ) ) {
					foreach ( $modifier as $modifier ) {
						if ( ! empty( $modifier ) ) {
							$classes[] = $name . '--' . $modifier;
						}
					}
				} elseif ( is_string( $modifier ) ) {
					$classes[] = $name . '--' . $modifier;
				}
			}
		}

		return implode( ' ', $classes );
	}

	/**
	 * Makes sure the output is string. Useful for converting an array of components into a string.
	 * If you pass an associative array it will output strings with keys, used for generating data-attributes from array.
	 *
	 * @param array<string, mixed>|string[]|string $variable Variable we need to convert into a string.
	 *
	 * @throws TypeException When $variable is not a string or array.
	 *
	 * @return string
	 */
	protected static function ensureString( $variable ): string {
		$output = '';

		if ( is_array( $variable ) ) {
			$isAssociative = array_values( $variable ) === $variable;

			if ( $isAssociative ) {
				$output = implode( '', $variable );
			} else {
				foreach ( $variable as $key => $value ) {
					$output .= $key . '="' . htmlspecialchars( $value ) . '" ';
				}
			}
		} elseif ( is_string( $variable ) ) {
			$output = $variable;
		} else {
			throw new TypeException(
				'Not a string nor array: ' . $variable,
				TypeException::NOT_STRING_OR_ARRAY
			);
		}

		return $output;
	}
}
