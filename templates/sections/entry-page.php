<?php
$template = get_page_template_slug();

switch ( $template ) {
	case 'page-full-width.php':
		$columns = 12;
		break;
	case 'page-narrow-width.php':
		$columns = 6;
		break;
	default:
		$columns = 8;
}
?>

<div class="row">
	<div class="column<?php echo $template == 'page-narrow-width.php' ? ' column--md-4 column--md-offset-1' : ''; ?> column--lg-<?php echo $columns; ?> column--lg-offset-<?php echo ( 12 - $columns ) / 2; ?>">
		<h1 class="heading heading--lg"><?php the_title(); ?></h1>

		<div class="entry__content content">
			<?php the_content(); ?>
		</div>
		<!-- /.entry -->
	</div>
</div>
