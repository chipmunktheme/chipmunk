<?php $paged = Chipmunk\Helpers::get_current_page(); ?>

<?php if ( is_singular( 'resource' ) ) : ?>
	<?php $query = Chipmunk\Query::get_related( get_the_ID(), apply_filters( 'chipmunk_related_resources_count', 3 ) ); ?>
<?php elseif ( is_author() && get_query_var( 'author_name' ) ) : ?>
	<?php $query = Chipmunk\Query::get_resources( Chipmunk\Customizer::get_theme_option( 'posts_per_page' ), $paged, null, get_query_var( 'author_name' ) ); ?>
<?php else : ?>
	<?php $query = Chipmunk\Query::get_resources( Chipmunk\Customizer::get_theme_option( 'posts_per_page' ), $paged ); ?>
<?php endif; ?>

<?php if ( is_singular( 'page' ) ) : ?>
	<?php $resources_title = get_the_title(); ?>
<?php else : ?>
	<?php $resources_title = __( 'Resources', 'chipmunk' ); ?>
<?php endif; ?>

<?php if ( $query->have_posts() || ! is_singular( 'resource' ) ) : ?>
	<div class="l-section">
		<div class="l-container">
			<div class="l-component l-header">
				<?php if ( is_singular( 'resource' ) ) : ?>
					<h2 class="l-section__title c-heading c-heading--h4"><?php esc_html_e( 'Related', 'chipmunk' ); ?></h2>
				<?php else : ?>
					<h1 class="l-section__title c-heading c-heading--h4"><?php echo esc_html( $resources_title ); ?></h1>

					<?php if ( $query->have_posts() ) : ?>
						<?php Chipmunk\Helpers::get_template_part( 'partials/filters' ); ?>
					<?php endif; ?>
				<?php endif; ?>

				<?php if ( ! $query->have_posts() ) : ?>
					<p class="l-header__copy">
						<?php esc_html_e( 'Sorry, there are no resources to display yet.', 'chipmunk' ); ?>
					</p>
				<?php endif; ?>
			</div>

			<?php if ( $query->have_posts() ) : ?>
				<div class="l-component">
					<div class="c-tile__list" data-action-element="load_posts">
						<?php while ( $query->have_posts() ) : $query->the_post(); ?>

							<?php Chipmunk\Helpers::get_template_part( 'sections/resource-tile' ); ?>

						<?php endwhile; ?>
					</div>
				</div>
			<?php endif; ?>

			<?php Chipmunk\Helpers::get_template_part( 'sections/pagination', array( 'query' => $query ) ); ?>
		</div>
	</div>
<?php endif; ?>
