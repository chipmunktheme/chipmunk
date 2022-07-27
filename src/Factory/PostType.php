<?php

namespace Chipmunk\Factory;

use Chipmunk\Helper\HelpersTrait;
use Chipmunk\Helper\HooksTrait;

/**
 * Post Type Factory
 */
class PostType {

	use HelpersTrait;
	use HooksTrait;

	private string $singularName;
	private string $pluralName;
	private array $args;

	public function __construct( string $singularName, string $pluralName, array $args = [] ) {
		$this->singularName = $singularName;
		$this->pluralName   = $pluralName;
		$this->args         = $args;
	}

	public function getSingularName() {
		return $this->singularName;
	}

	public function getPluralName() {
		return $this->pluralName;
	}

	public function getSlug() {
		return sanitize_title( $this->singularName );
	}

	public function register() {
		if ( ! post_type_exists( $this->getSlug() ) ) {
			$this->addAction( 'init', [ $this, 'registerType' ] );
		}
	}

	public function registerType() {
		$args = wp_parse_args( $this->getArguments(), $this->args );

		register_post_type( $this->getSlug(), $args );
	}

	private function getArguments(): array {
		$nouns = [
			$this->getSingularName(),
			strtolower( $this->getSingularName() ),
			$this->getPluralName(),
			strtolower( $this->getPluralName() ),
		];

		$labels     = $this->getGeneratedLabels( $nouns );
		$slugOption = get_option( $this->getThemeSlug( $this->getSlug(), '_', null, 'cpt_base' ) );

		return [
			'label'              => $nouns[0],
			'labels'             => $labels,
			'rest_base'          => $this->getSlug(),
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'show_in_rest'       => true,
			'query_var'          => true,
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'supports'           => [ 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'publicize', 'revisions' ],
			'rewrite'            => [
				'slug'       => $slugOption ?: $this->getSlug(),
				'with_front' => false,
			],
		];
	}

	private function getGeneratedLabels( array $nouns ): array {
		$labelTemplates = [
			/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
			'name'                  => esc_html_x( '%3$s', 'Post Type General Name', 'chipmunk' ),
			/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
			'singular_name'         => esc_html_x( '%1$s', 'Post Type Singular Name', 'chipmunk' ),
			/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
			'menu_name'             => esc_html__( '%3$s', 'chipmunk' ),
			/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
			'name_admin_bar'        => esc_html__( '%1$s', 'chipmunk' ),
			/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
			'archives'              => esc_html__( '%1$s Archives', 'chipmunk' ),
			/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
			'attributes'            => esc_html__( '%1$s Attributes', 'chipmunk' ),
			/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
			'parent_item_colon'     => esc_html__( 'Parent %1$s:', 'chipmunk' ),
			/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
			'all_items'             => esc_html__( 'All %3$s', 'chipmunk' ),
			/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
			'add_new_item'          => esc_html__( 'Add New %1$s', 'chipmunk' ),
			/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
			'add_new'               => esc_html__( 'Add New', 'chipmunk' ),
			/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
			'new_item'              => esc_html__( 'New %1$s', 'chipmunk' ),
			/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
			'edit_item'             => esc_html__( 'Edit %1$s', 'chipmunk' ),
			/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
			'update_item'           => esc_html__( 'Update %1$s', 'chipmunk' ),
			/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
			'view_item'             => esc_html__( 'View %1$s', 'chipmunk' ),
			/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
			'view_items'            => esc_html__( 'View %3$s', 'chipmunk' ),
			/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
			'search_items'          => esc_html__( 'Search %3$s', 'chipmunk' ),
			/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
			'not_found'             => esc_html__( 'Not found', 'chipmunk' ),
			/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
			'not_found_in_trash'    => esc_html__( 'Not found in Trash', 'chipmunk' ),
			/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
			'featured_image'        => esc_html__( 'Featured Image', 'chipmunk' ),
			/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
			'set_featured_image'    => esc_html__( 'Set featured image', 'chipmunk' ),
			/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
			'remove_featured_image' => esc_html__( 'Remove featured image', 'chipmunk' ),
			/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
			'use_featured_image'    => esc_html__( 'Use as featured image', 'chipmunk' ),
			/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
			'insert_into_item'      => esc_html__( 'Insert into %2$s', 'chipmunk' ),
			/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
			'uploaded_to_this_item' => esc_html__( 'Uploaded to this %2$s', 'chipmunk' ),
			/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
			'items_list'            => esc_html__( '%3$s list', 'chipmunk' ),
			/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
			'items_list_navigation' => esc_html__( '%3$s list navigation', 'chipmunk' ),
			/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
			'filter_items_list'     => esc_html__( 'Filter %4$s list', 'chipmunk' ),
			/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
			'item_link'             => esc_html__( '%1$s Link', 'chipmunk' ),
			/* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
			'item_link_description' => esc_html__( 'A link to a %2$s', 'chipmunk' ),
			'filter_by_date'        => esc_html__( 'Filter by date', 'chipmunk' ),
		];

		return array_map( fn( $label ) => sprintf( $label, ...$nouns ), $labelTemplates );
	}
}
