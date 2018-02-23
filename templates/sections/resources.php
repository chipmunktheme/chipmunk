<?php $paged = chipmunk_get_current_page(); ?>

<?php if ( is_single() ) : ?>
	<?php $custom_query = chipmunk_get_related( get_the_ID() ); ?>
<?php else : ?>
	<?php $custom_query = chipmunk_get_resources( chipmunk_theme_option( 'posts_per_page' ), $paged ); ?>
<?php endif; ?>

<?php if ( $custom_query->have_posts() || ! is_single() ) : ?>
	<div class="section">
		<div class="container">
			<?php if ( is_single() ) : ?>
				<h2 class="heading heading_md"><?php esc_html_e( 'Related', 'chipmunk' ); ?></h2>
			<?php else : ?>
				<?php if ( $custom_query->have_posts() ) : ?>
					<div class="row">
						<div class="column column_md-4 column_lg-4">
							<h1 class="heading heading_md"><?php esc_html_e( 'Resources', 'chipmunk' ); ?></h1>
						</div>

						<?php get_template_part( 'templates/partials/filters' ); ?>
					</div>
				<?php else : ?>
					<h1 class="heading heading_md"><?php esc_html_e( 'Resources', 'chipmunk' ); ?></h1>
				<?php endif; ?>
			<?php endif; ?>

			<?php if ( $custom_query->have_posts() ) : ?>
				<div class="row">
					<?php while ( $custom_query->have_posts() ) : $custom_query->the_post(); ?>

						<?php get_template_part( 'templates/sections/resource-tile' ); ?>

					<?php endwhile; ?>
				</div>
			<?php else : ?>
				<p class="text_content text_separated">
					<?php if ( current_user_can( 'publish_posts' ) ) : ?>
						<?php esc_html_e( 'Ready to publish your first resource?', 'chipmunk' ); ?>

						<a href="<?php echo esc_url( admin_url( 'post-new.php?post_type=resource' ) ); ?>"><?php esc_html_e( 'Get started here', 'chipmunk' ); ?></a>.
					<?php else : ?>
						<?php esc_html_e( 'Sorry, there are no resources to display yet.', 'chipmunk' ); ?>
					<?php endif; ?>
				</p>
			<?php endif; ?>
		</div>

		<?php require_once locate_template( 'templates/sections/pagination.php' ); ?>
	</div>
	<!-- /.section -->
<?php endif; ?>
