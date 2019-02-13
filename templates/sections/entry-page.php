<?php
switch ( get_page_template_slug() ) {
	case 'page-full-width.php':
		$columns = 12;
		break;
	case 'page-wide-width.php':
		$columns = 10;
		break;
	case 'page-narrow-width.php':
		$columns = 6;
		break;
	default:
		$columns = chipmunk_theme_option( 'content_width' );
}
?>

<div class="row">
	<div class="column <?php echo esc_attr( chipmunk_get_columns( $columns ) ); ?>">
		<h1 class="heading heading--lg"><?php the_title(); ?></h1>

		<div class="entry__content content">
			<?php the_content(); ?>
		</div>
		<!-- /.entry -->
	</div>
</div>
