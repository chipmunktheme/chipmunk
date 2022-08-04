<?php

namespace Chipmunk\Core;

use MadeByLess\Lessi\Helper\HelperTrait;
use Chipmunk\Theme;

/**
 * Theme shortcodes
 */
class Shortcodes extends Theme {
	use HelperTrait;

	/**
	 * Class constructor
	 */
	public function __construct() {}

	/**
	 * Hooks methods of this object into the WordPress ecosystem
	 */
	public function initialize(): void {
		$this->addShortcode( $this->buildThemeSlug( 'counter', '-' ), [ $this, 'renderCounter' ] );
		$this->addShortcode( $this->buildThemeSlug( 'submit', '-' ), [ $this, 'renderSubmit' ] );
	}

	/**
	 * Render the total count of resources
	 *
	 * @param string|array|null $atts
	 * @param string            $content
	 * @param string            $shortcode
	 *
	 * @return string
	 */
	public function renderCounter( $atts, string $content, string $shortcode ): string {
		$atts = shortcode_atts(
			[
				'type'   => 'resource',
				'status' => 'publish',
			],
			$atts
		);

		return $this->getShortcodeTemplate( 'shortcodes/counter.twig', $atts );
	}

	/**
	 * Render the submit template
	 *
	 * @param string|array|null $atts
	 * @param string            $content
	 * @param string            $shortcode
	 *
	 * @return string
	 */
	public function renderSubmit( $atts, string $content, string $shortcode ): string {
		$atts = shortcode_atts(
			[
				'title' => '',
			],
			$atts
		);

		return $this->getShortcodeTemplate( 'shortcodes/counter.twig', $atts );
	}
}
