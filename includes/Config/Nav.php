<?php

namespace Chipmunk\Config;

use Chipmunk\Helpers;

/**
 * Nav config hooks
 *
 * @package WordPress
 * @subpackage Chipmunk
 */
class Nav {

	/**
 	 * Used to register custom hooks
	 *
	 * @return void
	 */
	function __construct() {
		add_filter( 'nav_menu_css_class', array( $this, 'menu_item_classes' ), 1, 3 );
		add_filter( 'nav_menu_link_attributes', array( $this, 'menu_link_classes' ), 1, 3 );
		add_filter( 'walker_nav_menu_start_el', array( $this, 'menu_item_toggle' ), 10, 4 );
		add_action( 'nav_menu_submenu_css_class', array( $this, 'extra_submenu_classes' ) );
	}

	/**
	 * Add menu item classes
	 *
	 * @return array
	 */
	public static function menu_item_classes( $classes, $item, $args ) {
		if ( property_exists( $args, 'menu_item_class' ) ) {
			$classes[] = $args->menu_item_class;
		}

		return $classes;
	}

	/**
	 * Add menu link classes
	 *
	 * @return array
	 */
	public static function menu_link_classes( $atts, $item, $args ) {
		if ( property_exists( $args, 'menu_link_class' ) ) {
			$atts['class'] = $args->menu_link_class;
		}

		return $atts;
	}

	/**
	 * Add menu toggle items
	 *
	 * @param  string  $item_output The menu item output.
	 * @param  WP_Post $item        Menu item object.
	 * @param  int     $depth       Depth of the menu.
	 * @param  array   $args        wp_nav_menu() arguments.
	 * @return string  $item_output The menu item output with social icon.
	 */
	public static function menu_item_toggle( $item_output, $item, $depth, $args ) {
		if ( $args->theme_location == 'nav-primary' && property_exists( $args, 'show_toggles' ) && in_array( 'menu-item-has-children', $item->classes ) ) {
			$icon = Helpers::get_template_part( 'partials/icon', array( 'icon' => 'chevron-down', 'size' => 'lg' ), false );
			$classes = implode( '.', explode( ' ', $args->menu_class ) );

			$button = "<button class='menu-toggle' data-expand='.{$classes} .menu-item-{$item->ID}'>{$icon}</button>";
			$item_output = str_replace( '</a>', '</a>' . $button, $item_output );
		}

		return $item_output;
	}

	/**
	 * Adds extra sub-menu subclasses
	 *
	 * @return array
	 */
	public static function extra_submenu_classes( $classes ) {
		$classes[] = 'theme-' . Helpers::get_theme_option( 'dropdown_theme' );

		return $classes;
	}
}
