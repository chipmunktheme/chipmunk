<div class="c-ratings">
	<h4 class="c-ratings__title heading heading--h5"><?php echo esc_html_e(' Rate', 'chipmunk'); ?></h4>

	<div class="c-ratings__form <?php echo esc_attr( ! empty( $ratings['rating'] ) ? 'is-active' : '' ); ?>">
		<?php for ( $i = $max_rating; $i >= 1; $i-- ) : ?>
			<button
				class="c-ratings__button <?php echo esc_attr( $i == round( $ratings['average'] ) ? 'is-selected' : '' ); ?> <?php echo esc_attr( ! empty( $ratings['rating'] ) && $i == $ratings['rating']['rating'] ? 'is-active' : '' ); ?>"
				title="<?php printf( esc_attr( _n( '%d star', '%d stars', $i, 'chipmunk'  ) ), $i ); ?>"
				data-rating
				data-action="submit_rating"
				data-action-rating="<?php echo esc_attr( $i ); ?>"
				data-action-post-id="<?php echo esc_attr( get_the_ID() ); ?>">

				<div class="c-ratings__icon">
					<?php Chipmunk\Helpers::get_template_part( 'partials/icon', [ 'icon' => 'star' ] ); ?>
				</div>
			</button>
		<?php endfor; ?>
	</div>

	<div class="c-ratings__result" data-action-rating="<?php echo esc_attr( get_the_ID() ); ?>">
		<?php echo $summary; ?>
	</div>
</div>
