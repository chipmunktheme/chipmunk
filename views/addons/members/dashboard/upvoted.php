<?php $resources = Chipmunk\Query::get_resources( [
	'post_status'       => 'any, trash',
	'perm' 				=> 'readable',
	'meta_query'        => [
		'relation'          => 'OR',

		[
			'key'           => Chipmunk\Extensions\Upvotes::$db_key,
			'value'         => get_current_user_id(),
			'compare'       => '=',
		],
	],
] ); ?>

<?php if ( $resources->have_posts() ) : ?>
	<div class="c-tile__list" data-action-element="load_posts">
		<?php while ( $resources->have_posts() ) : $resources->the_post(); ?>

			<?php Chipmunk\Helpers::get_template_part( 'sections/tile-resource' ); ?>

		<?php endwhile; wp_reset_postdata(); ?>
	</div>
<?php else : ?>
	<p class="l-header__copy">
		<?php esc_html_e( 'Sorry, there are no resources to display yet.', 'chipmunk' ); ?>
	</p>
<?php endif; ?>

<?php Chipmunk\Helpers::get_template_part( 'sections/pagination', [ 'query' => $resources ] ); ?>
