<div class="c-filter__group">
	<?php if ( Chipmunk\Helpers::isOptionEnabled( 'filters', 'resource', false ) && ! is_tax() ) : ?>
		<?php
			$tags = get_terms( [
				'taxonomy'    => 'resource-tag',
				'orderby'     => 'name',
				'hide_empty'  => true,
			] );
		?>

		<?php if ( ! empty( $tags ) ) : ?>
			<?php Chipmunk\Helpers::get_template_part( 'partials/filter', [
				'filter' => 'tag',
				'title' => __( 'Filter by', 'chipmunk' ),
				'placeholder' => __( 'Choose topic', 'chipmunk' ),
				'options' => array_map( function( $tag ) {
					return [
						'value' => $tag->slug,
						'title' => ucfirst( $tag->name ),
						'selected' => isset( $_GET['tag'] ) && $_GET['tag'] == $tag->slug,
					];
				}, $tags ),
			] ); ?>
		<?php endif; ?>
	<?php endif; ?>

	<?php if ( Chipmunk\Helpers::isOptionEnabled( 'sorting', 'resource', false ) ) : ?>
		<?php
			$default_orderby = Chipmunk\Helpers::getOption( 'default_sort_by' );
			$default_order = Chipmunk\Helpers::getOption( 'default_sort_order' );

			$options = [
				[
					'value' => 'date-desc',
					'title' => __( 'Date', 'chipmunk' ) . ' &uarr;',
					'selected' => ( isset( $_GET['sort'] ) && $_GET['sort'] == 'date-desc' ) || ( ! isset( $_GET['sort'] ) && $default_orderby == 'date' && $default_order == 'desc' ),
				],
				[
					'value' => 'date-asc',
					'title' => __( 'Date', 'chipmunk' ) . ' &darr;',
					'selected' => ( isset( $_GET['sort'] ) && $_GET['sort'] == 'date-asc' ) || ( ! isset( $_GET['sort'] ) && $default_orderby == 'date' && $default_order == 'asc' ),
				],
				[
					'value' => 'name-desc',
					'title' => __( 'Name', 'chipmunk' ) . ' &uarr;',
					'selected' => ( isset( $_GET['sort'] ) && $_GET['sort'] == 'name-desc' ) || ( ! isset( $_GET['sort'] ) && $default_orderby == 'name' && $default_order == 'desc' ),
				],
				[
					'value' => 'name-asc',
					'title' => __( 'Name', 'chipmunk' ) . ' &darr;',
					'selected' => ( isset( $_GET['sort'] ) && $_GET['sort'] == 'name-asc' ) || ( ! isset( $_GET['sort'] ) && $default_orderby == 'name' && $default_order == 'asc' ),
				],
			];

			if ( Chipmunk\Helpers::isOptionEnabled( 'views', 'resource', false ) ) {
				$options[] = [
					'value' => 'views-desc',
					'title' => __( 'Views', 'chipmunk' ),
					'selected' => ( isset( $_GET['sort'] ) && $_GET['sort'] == 'views-desc' ) || ( ! isset( $_GET['sort'] ) && $default_orderby == 'views' ),
				];
			}

			if ( Chipmunk\Helpers::isOptionEnabled( 'upvotes', 'resource', false ) ) {
				$options[] = [
					'value' => 'upvotes-desc',
					'title' => __( 'Upvotes', 'chipmunk' ),
					'selected' => ( isset( $_GET['sort'] ) && $_GET['sort'] == 'upvotes-desc' ) || ( ! isset( $_GET['sort'] ) && $default_orderby == 'upvotes' ),
				];
			}

			if ( Chipmunk\Helpers::is_addon_enabled( 'ratings' ) ) {
				$options[] = [
					'value' => 'ratings-desc',
					'title' => __( 'Ratings', 'chipmunk' ),
					'selected' => ( isset( $_GET['sort'] ) && $_GET['sort'] == 'ratings-desc' ) || ( ! isset( $_GET['sort'] ) && $default_orderby == 'ratings' ),
				];
			}
		?>

		<?php Chipmunk\Helpers::get_template_part( 'partials/filter', [
			'filter' => 'sort',
			'title' => __( 'Sort by', 'chipmunk' ),
			'options' => $options,
		] ); ?>
	<?php endif; ?>
</div>
