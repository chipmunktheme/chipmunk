<?php
/**
 * Custom config actions
 *
 * @package WordPress
 * @subpackage Chipmunk
 */

if ( ! function_exists( 'chipmunk_acf_settings_url' ) ) :
	/**
	 * Customize the url setting to fix incorrect asset URLs.
	 */
	function chipmunk_acf_settings_url( $url ) {
		return CHIPMUNK_ACF_URL;
	}
endif;
add_filter( 'acf/settings/url', 'chipmunk_acf_settings_url' );


if ( ! function_exists( 'chipmunk_acf_settings_show_admin' ) ) :
	/**
	 * Hide the ACF admin menu item.
	 */
	function chipmunk_acf_settings_show_admin( $show_admin ) {
		return true;
	}
endif;
add_filter( 'acf/settings/show_admin', 'chipmunk_acf_settings_show_admin' );


if ( ! function_exists( 'chipmunk_acf_register_fields' ) ) :
	/**
	 * Register the proper custom fields via ACF
	 */
	function chipmunk_acf_register_fields() {
		$groups = array(
			array(
				'key'      => 'resource',
				'title'     => __( 'Resource', 'chipmunk' ),

				'location' => array( array( array(
					'param'     => 'post_type',
					'operator'  => '==',
					'value'     => 'resource',
				) ) ),

				'fields'   => array (
					array(
						'key' => 'is_featured',
						'label' => __( 'Featured on homepage', 'chipmunk' ),
						'type' => 'true_false',
						'ui' => 1,
						'width' => '50',
					),
					array(
						'key' => 'links',
						'label' => __( 'Links', 'chipmunk' ),
						'type' => 'repeater',
						'width' => '50',
						'layout' => 'table',
						'button_label' => __( 'Add link', 'chipmunk' ),
						'sub_fields' => array(
							array(
								'key' => 'link',
								'label' => __( 'Link', 'chipmunk' ),
								'type' => 'link',
								'required' => 1,
							),
						),
					),
					array(
						'key' => 'website',
						'label' => __( 'Website', 'chipmunk' ),
						'type' => 'text',
						'width' => '50',
						'readonly' => 1,
					),
					array(
						'key' => 'submitter',
						'label' => __( 'Submitter', 'chipmunk' ),
						'type' => 'text',
						'width' => '50',
						'readonly' => 1,
					),
				),
			),
		);

		foreach ( $groups as $key => $group ) {
			// Normalize group fields
			array_walk( $group['fields'], 'chipmunk_acf_normalize_fields', $group );

			// Register ACF Group
			acf_add_local_field_group( $group );
		}
	}

	function chipmunk_acf_normalize_fields( &$field, $key, $group ) {
		// Generate proper field key
		$key = '_' . THEME_SLUG . '_' . $group['key'] . '_' . $field['key'];

		// Normalized field
		$norm_field = array(
			'key' => $key,
			'name' => $key,
			'label' => $field['label'],
			'type' => $field['type'],
		);

		if ( isset( $field['required'] ) ) {
			$norm_field['required'] = $field['required'];
		}

		if ( isset( $field['readonly'] ) ) {
			$norm_field['readonly'] = $field['readonly'];
		}

		if ( isset( $field['ui'] ) ) {
			$norm_field['ui'] = $field['ui'];
		}

		if ( isset( $field['width'] ) ) {
			$norm_field['wrapper'] = array( 'width' => $field['width'] );
		}

		if ( isset( $field['layout'] ) ) {
			$norm_field['layout'] = $field['layout'];
		}

		if ( isset( $field['button_label'] ) ) {
			$norm_field['button_label'] = $field['button_label'];
		}

		if ( isset( $field['sub_fields'] ) ) {
			// Normalize sub-fields
			array_walk( $field['sub_fields'], 'chipmunk_acf_normalize_fields', $group );

			$norm_field['sub_fields'] = $field['sub_fields'];
		}

		// Alter the original field
		$field = $norm_field;
	}
endif;
add_filter( 'acf/init', 'chipmunk_acf_register_fields' );
