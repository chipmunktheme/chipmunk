<?php

namespace Chipmunk\Core;

use Chipmunk\Theme;
use Chipmunk\Helper\HelpersTrait;

/**
 * Theme shortcodes
 */
class Shortcodes extends Theme {

	use HelpersTrait;

	/**
	 * Class constructor
	 */
	public function __construct() {}

	/**
	 * Hooks methods of this object into the WordPress ecosystem
	 *
	 * @return void
	 */
	public function initialize(): void {
		$this->addShortcode( $this->getThemeSlug( 'counter', '-' ), [ $this, 'renderCounter' ] );
		$this->addShortcode( $this->getThemeSlug( 'submit', '-' ), [ $this, 'renderSubmit' ] );
	}

	/**
	 * Render the total count of resources
	 *
	 * @param ?string|array $atts
	 * @param string        $content
	 * @param string        $shortcode
	 *
	 * @return string
	 */
	public function renderCounter( $atts, string $content, string $shortcode ): string {
		return $this->getShortcodeTemplate( 'shortcodes/counter.twig', shortcode_atts(
			[
				'type'   => 'resource',
				'status' => 'publish',
			],
			$atts
		) );
	}

	/**
	 * Render the submit template
	 *
	 * @param ?string|array $atts
	 * @param string        $content
	 * @param string        $shortcode
	 *
	 * @return string
	 */
	public function renderSubmit( $atts, string $content, string $shortcode ): string {
		return $this->getShortcodeTemplate( 'shortcodes/counter.twig', shortcode_atts(
			[
				'title' => '',
			],
			$atts
		) );
	}
}
