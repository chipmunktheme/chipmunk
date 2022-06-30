<?php if ( ! empty( $term_id ) && $count = wp_count_terms( 'resource-collection', [ 'parent' => $term_id, 'hide_empty' => true ] ) ) : ?>
	<li class="c-stats__item c-stats__item--count-collections" title="<?php esc_attr_e( 'Sub collections', 'chipmunk' ); ?>">
		<?php Chipmunk\Helpers::get_template_part( 'partials/icon', [ 'icon' => 'collection' ] ); ?>
		<?php echo $count; ?>
	</li>
<?php endif; ?>
