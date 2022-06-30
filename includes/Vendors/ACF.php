<?php

namespace Chipmunk\Vendors;

/**
 * Configure ACF plugin
 *
 * @package WordPress
 * @subpackage Chipmunk
 */
class ACF {

	/**
	 * ACF directory paths
	 *
	 * @var string
	 */
	const ACF_PATH = THEME_TEMPLATE_DIR . '/vendor/advanced-custom-fields/advanced-custom-fields-pro/';
	const ACF_URL = THEME_TEMPLATE_URI . '/vendor/advanced-custom-fields/advanced-custom-fields-pro/';

	/**
	 * Create a new ACF Config object
	 *
	 * @return void
	 */
	function __construct() {
		// Include the ACF plugin.
		include_once( self::ACF_PATH . 'acf.php' );

		add_filter( 'acf/init', [ $this, 'acf_register_fields' ] );
		add_filter( 'acf/settings/url', [ $this, 'acf_settings_url' ] );
		add_filter( 'acf/settings/show_admin', [ $this, 'acf_settings_show_admin' ] );
	}

	/**
	 * Register the proper custom fields via ACF
	 */
	public static function acf_register_fields() {
		$groups = [

			// Resource
			[
				'key'      => 'resource',
				'title'     => __( 'Resource', 'chipmunk' ),

				'location' => [ [ [
					'param'     => 'post_type',
					'operator'  => '==',
					'value'     => 'resource',
				] ] ],

				'fields'   => [
					[
						'key' => 'is_featured',
						'label' => __( 'Featured on homepage', 'chipmunk' ),
						'type' => 'true_false',
						'ui' => 1,
						'width' => '50',
					],
					[
						'key' => 'links',
						'label' => __( 'Links', 'chipmunk' ),
						'type' => 'repeater',
						'width' => '50',
						'layout' => 'table',
						'button_label' => __( 'Add link', 'chipmunk' ),
						'sub_fields' => [
							[
								'key' => 'link',
								'label' => __( 'Link', 'chipmunk' ),
								'type' => 'link',
								'required' => 1,
							],
						],
					],
					[
						'key' => 'website',
						'label' => __( 'Website', 'chipmunk' ),
						'type' => 'text',
						'width' => '50',
						'instructions' => __( 'Deprecated. Please use "Links" functionality above.', 'chipmunk' ),
						'readonly' => 1,
					],
					[
						'key' => 'submitter',
						'label' => __( 'Submitter', 'chipmunk' ),
						'type' => 'text',
						'width' => '50',
						'instructions' => __( 'Read only, will contain the email of resource submitter.', 'chipmunk' ),
						'readonly' => 1,
					],
				],
			],

			// Collection
			[
				'key'      => 'collection',
				'title'     => __( 'Collection', 'chipmunk' ),

				'location' => [ [ [
					'param'     => 'taxonomy',
					'operator'  => '==',
					'value'     => 'resource-collection',
				] ] ],

				'fields'   => [
					[
						'key' => 'image',
						'label' => __( 'Image', 'chipmunk' ),
						'type' => 'image',
						'return_format' => 'id',
					],
				],
			],
		];

		foreach ( $groups as $key => $group ) {
			// Normalize group fields
			array_walk( $group['fields'], [ self::class, 'acf_normalize_fields' ], [ 'group' => $group, 'prefix_key' => true ] );

			// Register ACF Group
			acf_add_local_field_group( $group );
		}
	}

	/**
	 * Register the proper custom fields via ACF
	 *
	 * @return void
	 */
	private static function acf_normalize_fields( &$field, $key, $params ) {
		// Generate proper field key
		$key = ( isset( $params['prefix_key'] ) && isset( $params['group'] ) ? '_' . THEME_SLUG . '_' . $params['group']['key'] . '_' : '' ) . $field['key'];

		// Normalized field
		$norm_field = [
			'key' => $key,
			'name' => $key,
			'label' => $field['label'],
			'type' => $field['type'],
		];

		$optional_values = [
			'required',
			'readonly',
			'instructions',
			'ui',
			'layout',
			'button_label',
			'return_format',
			'preview_size',
		];

		foreach ( $optional_values as $value ) {
			if ( isset( $field[ $value ] ) ) {
				$norm_field[ $value ] = $field[ $value ];
			}
		}

		if ( isset( $field['width'] ) ) {
			$norm_field['wrapper'] = [ 'width' => $field['width'] ];
		}

		if ( isset( $field['sub_fields'] ) ) {
			// Normalize sub-fields
			array_walk( $field['sub_fields'], [ self::class, 'acf_normalize_fields' ], [ 'group' => $params['group'] ] );

			$norm_field['sub_fields'] = $field['sub_fields'];
		}

		// Alter the original field
		$field = $norm_field;
	}

	/**
	 * Hide the ACF admin menu item.
	 *
	 * @return bool
	 */
	function acf_settings_show_admin( $show_admin ) {
		return false;
	}

	/**
	 * Customize the url setting to fix incorrect asset URLs.
	 *
	 * @return string
	 */
	function acf_settings_url( $url ) {
		return self::ACF_URL;
	}
}
