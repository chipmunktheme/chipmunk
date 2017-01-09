<?php $wide_content = get_post_meta( get_the_ID(), '_' . CHIPMUNK_THEME_SLUG . '_about_wide_content', true ); ?>
<?php $curators_enabled = get_post_meta( get_the_ID(), '_' . CHIPMUNK_THEME_SLUG . '_about_curators_enabled', true ); ?>

<?php if ( $wide_content ) : ?>
	<?php
	$dom = new DOMDocument( '1.0', 'UTF-8' );
	$content = mb_convert_encoding( '<div>' . wpautop( get_the_content() ) . '</div>', 'HTML-ENTITIES', 'UTF-8' );

	if ( defined( 'LIBXML_HTML_NOIMPLIED' ) ) {
		$dom->loadHTML( $content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD );
	}
	else {
		$dom->loadHTML( $content );
	}

	$content = $dom->getElementsByTagName( 'div' )->item( 0 );
	$heading = $content->childNodes->item( 0 );
	$content->removeChild( $heading );
	$content = preg_replace( '/\<[\/]{0,1}div[^\>]*\>/i', '', $dom->saveHTML() );
	?>

	<h1 class="entry__title heading heading_md"><?php the_title(); ?></h1>

	<div class="entry row">
		<div class="entry__column column column_lg-5">
			<<?php echo $heading->nodeName;?>><?php echo $heading->nodeValue; ?></<?php echo $heading->nodeName;?>>
		</div>

		<div class="entry__column column column_lg-6 column_lg-offset-1">
			<?php echo $content; ?>
		</div>
	</div>
	<!-- /.entry -->

<?php else : ?>

	<div class="row">
		<div class="column column_lg-8 column_lg-offset-2">
			<h1 class="entry__title heading heading_md"><?php the_title(); ?></h1>

			<div class="entry">
				<?php the_content(); ?>
			</div>
			<!-- /.entry -->
		</div>
	</div>
<?php endif; ?>

<?php if ( $curators_enabled ) : ?>
	<div class="separator"></div>

	<?php get_template_part( 'sections/curators' ); ?>
<?php endif; ?>
