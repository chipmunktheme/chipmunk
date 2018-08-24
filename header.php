<?php
/**
 * Chipmunk: Header
 *
 * @package WordPress
 * @subpackage Chipmunk
 */
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="robots" content="noodp">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="<?php echo chipmunk_meta_description(); ?>">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> data-ajax-source="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>">
	<div class="body-bag">
		<?php get_template_part( 'templates/partials/page-head' ); ?>
