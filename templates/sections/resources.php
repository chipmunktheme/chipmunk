<?php $paged = chipmunk_get_current_page(); ?>

<?php if ( is_singular( 'resource' ) ) : ?>
	<?php $query = chipmunk_get_related( get_the_ID(), apply_filters( 'chipmunk_related_resources_count', 3 ) ); ?>
<?php elseif ( is_author() && get_query_var( 'author_name' ) ) : ?>
	<?php if ( chipmunk_has_plugin( 'members' ) ) : ?>
		<?php $author = ( get_query_var( 'author_name' ) ) ? get_user_by( 'slug', get_query_var( 'author_name' ) ) : get_userdata( get_query_var( 'author' ) ); ?>
        <?php $query = ChipmunkMembers\Helpers::get_bookmarked_resources( chipmunk_theme_option( 'posts_per_page' ), $author ); ?>
    <?php else : ?>
        <?php $query = chipmunk_get_resources( chipmunk_theme_option( 'posts_per_page' ), $paged, null, get_query_var( 'author_name' ) ); ?>
    <?php endif; ?>
<?php else : ?>
	<?php $query = chipmunk_get_resources( chipmunk_theme_option( 'posts_per_page' ), $paged ); ?>
<?php endif; ?>

<?php if ( is_singular( 'page' ) ) : ?>
	<?php $resources_title = get_the_title(); ?>
<?php else : ?>
	<?php $resources_title = __( 'Resources', 'chipmunk' ); ?>
<?php endif; ?>

<?php if ( $query->have_posts() or ! is_singular( 'resource' ) ) : ?>
	<div class="section">
		<div class="container">
			<?php if ( is_singular( 'resource' ) ) : ?>
				<h2 class="heading heading--h4"><?php esc_html_e( 'Related', 'chipmunk' ); ?></h2>
			<?php else : ?>
				<?php if ( $query->have_posts() ) : ?>
					<div class="row">
						<div class="column column--md-4 column--lg-4">
							<h1 class="heading heading--h4"><?php echo esc_html( $resources_title ); ?></h1>
						</div>

						<?php get_template_part( 'templates/partials/filters' ); ?>
					</div>
				<?php else : ?>
					<h1 class="heading heading--h4"><?php echo esc_html( $resources_title ); ?></h1>
				<?php endif; ?>
			<?php endif; ?>

			<?php if ( $query->have_posts() ) : ?>
				<div class="row" data-action-element="load_posts">
					<?php while ( $query->have_posts() ) : $query->the_post(); ?>

						<?php get_template_part( 'templates/sections/resource-tile' ); ?>

					<?php endwhile; ?>
				</div>
			<?php else : ?>
				<p class="text--content text--separated">
					<?php if ( current_user_can( 'publish_posts' ) ) : ?>
						<?php esc_html_e( 'Ready to publish your first resource?', 'chipmunk' ); ?>

						<a href="<?php echo esc_url( admin_url( 'post-new.php?post_type=resource' ) ); ?>"><?php esc_html_e( 'Get started here', 'chipmunk' ); ?></a>.
					<?php else : ?>
						<?php esc_html_e( 'Sorry, there are no resources to display yet.', 'chipmunk' ); ?>
					<?php endif; ?>
				</p>
			<?php endif; ?>
		</div>

		<?php chipmunk_get_template( 'sections/pagination', array( 'query' => $query ) ); ?>
	</div>
	<!-- /.section -->
<?php endif; ?>
