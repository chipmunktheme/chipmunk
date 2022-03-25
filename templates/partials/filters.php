<div class="c-filter__group">
	<?php if ( ! Chipmunk\Customizer::get_theme_option( 'disable_resource_filters' ) && ! is_tax() ) : ?>
		<?php
			$tags = get_terms( array(
				'taxonomy'    => 'resource-tag',
				'orderby'     => 'name',
				'hide_empty'  => true,
			) );
		?>

		<?php if ( ! empty( $tags ) ) : ?>
			<?php Chipmunk\Helpers::get_template_part( 'partials/filter', array(
				'filter' => 'tag',
				'title' => __( 'Filter by', 'chipmunk' ),
				'placeholder' => __( 'Choose topic', 'chipmunk' ),
				'options' => array_map( function( $tag ) {
					return array(
						'value' => $tag->slug,
						'title' => ucfirst( $tag->name ),
						'selected' => isset( $_GET['tag'] ) && $_GET['tag'] == $tag->slug,
					);
				}, $tags ),
			) ); ?>
		<?php endif; ?>
	<?php endif; ?>

	<?php if ( ! Chipmunk\Customizer::get_theme_option( 'disable_resource_sorting' ) ) : ?>
		<?php
			$default_orderby = Chipmunk\Customizer::get_theme_option( 'default_sort_by' );
			$default_order = Chipmunk\Customizer::get_theme_option( 'default_sort_order' );

			$options = array(
				array(
					'value' => 'date-desc',
					'title' => __( 'Date', 'chipmunk' ) . ' &uarr;',
					'selected' => ( isset( $_GET['sort'] ) && $_GET['sort'] == 'date-desc' ) || ( ! isset( $_GET['sort'] ) && $default_orderby == 'date' && $default_order == 'desc' ),
				),
				array(
					'value' => 'date-asc',
					'title' => __( 'Date', 'chipmunk' ) . ' &darr;',
					'selected' => ( isset( $_GET['sort'] ) && $_GET['sort'] == 'date-asc' ) || ( ! isset( $_GET['sort'] ) && $default_orderby == 'date' && $default_order == 'asc' ),
				),
				array(
					'value' => 'name-desc',
					'title' => __( 'Name', 'chipmunk' ) . ' &uarr;',
					'selected' => ( isset( $_GET['sort'] ) && $_GET['sort'] == 'name-desc' ) || ( ! isset( $_GET['sort'] ) && $default_orderby == 'name' && $default_order == 'desc' ),
				),
				array(
					'value' => 'name-asc',
					'title' => __( 'Name', 'chipmunk' ) . ' &darr;',
					'selected' => ( isset( $_GET['sort'] ) && $_GET['sort'] == 'name-asc' ) || ( ! isset( $_GET['sort'] ) && $default_orderby == 'name' && $default_order == 'asc' ),
				),
			);

			if ( ! Chipmunk\Customizer::get_theme_option( 'disable_resource_views' ) ) {
				$options[] = array(
					'value' => 'views-desc',
					'title' => __( 'Views', 'chipmunk' ),
					'selected' => ( isset( $_GET['sort'] ) && $_GET['sort'] == 'views-desc' ) || ( ! isset( $_GET['sort'] ) && $default_orderby == 'views' ),
				);
			}

			if ( ! Chipmunk\Customizer::get_theme_option( 'disable_resource_upvotes' ) ) {
				$options[] = array(
					'value' => 'upvotes-desc',
					'title' => __( 'Upvotes', 'chipmunk' ),
					'selected' => ( isset( $_GET['sort'] ) && $_GET['sort'] == 'upvotes-desc' ) || ( ! isset( $_GET['sort'] ) && $default_orderby == 'upvotes' ),
				);
			}

			if ( Chipmunk\Helpers::has_addon( 'ratings' ) ) {
				$options[] = array(
					'value' => 'ratings-desc',
					'title' => __( 'Ratings', 'chipmunk' ),
					'selected' => ( isset( $_GET['sort'] ) && $_GET['sort'] == 'ratings-desc' ) || ( ! isset( $_GET['sort'] ) && $default_orderby == 'ratings' ),
				);
			}
		?>

		<?php Chipmunk\Helpers::get_template_part( 'partials/filter', array(
			'filter' => 'sort',
			'title' => __( 'Sort by', 'chipmunk' ),
			'options' => $options,
		) ); ?>
	<?php endif; ?>
</div>
