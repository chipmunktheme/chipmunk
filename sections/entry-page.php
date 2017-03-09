<?php $wide_content = get_post_meta( get_the_ID(), '_' . CHIPMUNK_THEME_SLUG . '_about_wide_content', true ); ?>
<?php $curators_enabled = get_post_meta( get_the_ID(), '_' . CHIPMUNK_THEME_SLUG . '_about_curators_enabled', true ); ?>
<?php $columns = $wide_content ? 10 : 8; ?>

<div class="row">
	<div class="column column_lg-<?php echo $columns; ?> column_lg-offset-<?php echo (12 - $columns) / 2; ?>">
		<h1 class="entry__subtitle heading heading_md"><?php the_title(); ?></h1>

		<div class="entry__content">
			<?php the_content(); ?>
		</div>
		<!-- /.entry -->
	</div>
</div>

<?php if ( $curators_enabled ) : ?>
	<div class="separator"></div>

	<?php get_template_part( 'sections/curators' ); ?>
<?php endif; ?>
