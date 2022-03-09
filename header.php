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

	<?php wp_head(); ?>
</head>

<body <?php body_class( 'l-body' ); ?>
	data-ajax-source="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>"
    data-login-url="<?php echo wp_login_url( home_url( add_query_arg( array(), $wp->request ) ) ); ?>">

	<?php wp_body_open(); ?>

	<?php Chipmunk\Helpers::get_template_part( 'partials/page-head' ); ?>
	<?php Chipmunk\Helpers::get_template_part( 'partials/page-overlay' ); ?>
