<?php

namespace Chipmunk\Settings;

use Timber\Timber;
use MadeByLess\Lessi\Helper\HelperTrait;
use Chipmunk\Theme;
use Chipmunk\Core\Settings;

/**
 * A Faker settings class
 */
class Faker extends Theme {
	use HelperTrait;

	/**
	 * Setting class
	 *
	 * @var Settings
	 */
	protected Settings $settings;

	/**
	 * Setting name
	 *
	 * @var string
	 */
	private string $name = 'Faker';

	/**
	 * Setting slug
	 *
	 * @var string
	 */
	private string $slug;

	/**
	 * Allowed types to be generated
	 *
	 * @var array
	 */
	private array $types = [];

	/**
	 * Class constructor.
	 *
	 * @param Settings $settings
	 */
	public function __construct( Settings $settings ) {
		$this->settings = $settings;
		$this->slug     = sanitize_title( $this->name );

		$this->types = [
			[
				'name'  => __( 'Upvotes', 'chipmunk' ),
				'slug'  => 'upvote',
				'types' => [ 'resource' ],
			],
			[
				'name'  => __( 'Post views', 'chipmunk' ),
				'slug'  => 'post_view',
				'types' => [ 'post', 'resource' ],
			],
		];
	}

	/**
	 * Hooks methods of this object into the WordPress ecosystem.
	 */
	public function initialize() {
		$this->addAction( 'admin_init', [ $this, 'maybeGenerate' ] );

		// Output settings content
		$this->addFilter( $this->buildThemeSlug( 'settings_tabs' ), [ $this, 'addSettingsTab' ] );
	}

	/**
	 * Checks if a generator action was submitted.
	 */
	public function maybeGenerate() {
		foreach ( $this->types as $type ) {
			if ( $this->getParam( $this->buildThemeSlug( [ 'generator', $type['slug'] ] ) ) ) {
				$this->generate(
					$type['slug'],
					(int) $this->getParam( $this->buildThemeSlug( [ 'generator', $type['slug'], 'start' ] ) ),
					(int) $this->getParam( $this->buildThemeSlug( [ 'generator', $type['slug'], 'end' ] ) ),
					$type['types']
				);
			}
		}
	}

	/**
	 * Generate fake values for upvote and view counters
	 *
	 * @param string  $type
	 * @param integer $start
	 * @param integer $end
	 * @param array   $postTypes
	 *
	 * @return void
	 */
	private function generate( string $type, int $start, int $end, array $postTypes ) {
		check_admin_referer( $this->buildThemeSlug( [ 'generator', $type, 'nonce' ] ) );

		if ( empty( $start ) || empty( $end ) ) {
			$this->settings->addMessage( $this->slug, __( 'You need to provide both values for the range!', 'chipmunk' ) );
			return null;
		}

		$dbKey = $this->buildPrefixedThemeSlug( [ $type, 'count' ] );

		$posts = Timber::get_posts(
			[
				'post_type'      => $postTypes,
				'post_status'    => 'any',
				'perm'           => 'readable',
				'posts_per_page' => -1,
			]
		);

		foreach ( $posts as $post ) {
			$count    = (int) $post->meta( $dbKey ) ?? 0;
			$newCount = $count + rand( $start, ( $start > $end ? $start : $end ) );

			update_post_meta( $post->ID, $dbKey, $newCount );
		}

		$this->settings->addMessage( $this->slug, __( 'Fake counters successfully generated!', 'chipmunk' ), 'success' );
	}

	/**
	 * Adds settings tab to the list
	 *
	 * @param array $tabs
	 */
	public function addSettingsTab( array $tabs ): array {
		$tabs[] = [
			'name'    => $this->name,
			'slug'    => $this->slug,
			'content' => $this->getSettingsContent(),
		];

		return $tabs;
	}

	/**
	 * Returns the settings markup for counter fakers
	 *
	 * @return string
	 */
	private function getSettingsContent(): string {
		$args = [
			'types' => $this->types,
		];

		return Timber::compile( 'admin/settings/faker.twig', array_merge( Timber::context(), $args ) );
	}
}
