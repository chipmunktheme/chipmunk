<?php $columns = get_page_template_slug() == 'page-full-width.php' ? 12 : 8; ?>

<div class="row">
	<div class="column column_lg-<?php echo $columns; ?> column_lg-offset-<?php echo (12 - $columns) / 2; ?>">
		<h1 class="entry__subtitle heading heading_md"><?php the_title(); ?></h1>

		<div class="entry__content content">
			<?php the_content(); ?>
		</div>
		<!-- /.entry -->
	</div>
</div>
