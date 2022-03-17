<?php

namespace Chipmunk;

/**
 * Custom settings pages for the theme
 *
 * @package WordPress
 * @subpackage Chipmunk
 */
class Settings {

	/**
 	 * Used to register custom hooks
	 *
	 * @return void
	 */
	function __construct() {
		add_action( 'admin_menu', array( $this, 'add_menu_page' ), 1 );
		add_action( 'admin_menu', array( $this, 'add_licenses_menu_page' ) );
		add_action( 'admin_init', array( $this, 'faker_action' ) );
		add_action( 'chipmunk_settings_content', array( $this, 'faker_settings' ) );
	}

	/**
	 * Register settings page to the admin_menu action hook
	 */
	public static function add_menu_page() {
		global $chipmunk_menu_page;

		if ( empty( $GLOBALS['admin_page_hooks'][THEME_SLUG] ) ) {
			$title      = THEME_TITLE;
			$slug       = THEME_SLUG;
			$capability = 'edit_theme_options';
			$function   = array( self::class, 'admin_settings' );
			$icon       = 'data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiPz4KPHN2ZyB3aWR0aD0iMTI4cHgiIGhlaWdodD0iMTI2cHgiIHZpZXdCb3g9IjAgMCAxMjggMTI2IiB2ZXJzaW9uPSIxLjEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiPgogICAgPHRpdGxlPmNoaXBtdW5rPC90aXRsZT4KICAgIDxnIGlkPSJQYWdlLTEiIHN0cm9rZT0ibm9uZSIgc3Ryb2tlLXdpZHRoPSIxIiBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPgogICAgICAgIDxnIGlkPSJjaGlwbXVuayIgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoMTAuMDAwMDAwLCAxMC4wMDAwMDApIiBmaWxsPSIjQTdBQUFEIiBmaWxsLXJ1bGU9Im5vbnplcm8iPgogICAgICAgICAgICA8cGF0aCBkPSJNODQuNDM5MTI1LDEwNi4yMjgxMjUgTDg1LjE1MDQwNjMsMTA1LjY0NDI1IEM4Ni4yODM1NjI1LDEwNC43NjY3NSA4Ni43MzE1OTM4LDEwMy40Mzk1MzEgODYuNzU4NTkzOCwxMDAuODg5NzE5IEw4Ni43NTQzNzUsMTAwLjM1OTg0NCBDODYuNzMyNDM3NSw5OC44NzQ4NDM3IDg2LjU5NzQzNzUsOTguMjcwNzE4OCA4Ni4wOTk2MjUsOTcuMTcwNDY4OCBDODUuMDk4MDkzOCw5NS4wNDU5MDYzIDgzLjMwNTk2ODgsOTMuMTYwMTI1IDgxLjExODEyNSw5Mi4wMTg1MzEzIEw3OS4yNzM2ODc1LDkxLjAzNTU2MjUgTDgwLjMwMTM3NSw4OS4xMjM2MjUgQzgzLjQ2Mzc1LDgzLjI3OTgxMjUgODQuODA3ODQzOCw3Ni44NzkxMjUgODQuMDE3MjUsNzEuMjc0OTM3NSBMODMuNjc0Njg3NSw2OC44ODM3NSBMODQuNDM5MTI1LDY4LjM1MjE4NzUgQzg1Ljc4MzIxODgsNjcuMzk3MDYyNSA4Ny45OTcyMTg4LDY1LjIxODUgODguOTQ1NTkzOCw2My45MTc0Mzc1IEw4OS44Njc4MTI1LDYyLjY0MjUzMTMgTDkyLjM3MjA2MjUsNjIuNjQyNTMxMyBDOTMuNzQ5MDYyNSw2Mi42NDI1MzEzIDk1LjU5MDk2ODgsNjIuODIwNTYyNSA5Ny4xMjY1OTM4LDYzLjExNjcxODggTDk3LjUzNzUsNjMuMjAwMjUgQzEwMC43NTIxODgsNjMuODY0MjgxMyAxMDIuMTIzMjgxLDYzLjc1Nzk2ODggMTAzLjQxNDIxOSw2Mi43NzUgQzEwNS4zOTExMjUsNjEuMjYxMzEyNSAxMDUuOTcwNzgxLDU3Ljg4OCAxMDQuNzA1MTU2LDU1LjMxMjAzMTMgQzEwMi42NjU4MTMsNTEuMjAwNDM3NSA5OC4yNDk2MjUsNDguMzEzMTI1IDkzLjMzODE1NjMsNDcuODcyNjg3NSBMOTIuMjg1MTU2Myw0Ny43OTA4NDM4IEM5MC44MjU0Njg4LDQ3LjY2ODUgOTAuNzQ5NTMxMyw0Ny41NTYyODEzIDkwLjQ3NDQ2ODgsNDYuODM5MDkzOCBDOTAuMjc3MDMxMyw0Ni40MTcyMTg4IDkwLjAzNDg3NSw0NS4zNzA5Njg4IDg5Ljg5NjUsNDQuNDM0NDA2MyBMODkuNjMwNzE4OCw0Mi40NTY2NTYzIEw5MC45NzQ4MTI1LDQyLjQ1NjY1NjMgQzkzLjQ1MjA2MjUsNDIuNDU2NjU2MyA5OC4zNTQyNSw0MS44OTg5Mzc1IDEwMC41OTM1NjMsNDEuMzY4MjE4OCBDMTA1LjU3NTA2Myw0MC4xOTg3ODEzIDEwOCwzOC4yODY4NDM4IDEwOCwzNS41NTA1NjI1IEMxMDgsMzMuNzk4MDkzOCAxMDcuMTMwOTM4LDI5Ljg0MDA2MjUgMTA2LjI4NzE4OCwyNy43MTU1IEMxMDQuNjI2Njg4LDIzLjU0NTY4NzUgMTAyLjIyODc1LDIwLjU0MzYyNSA5OC41MTIwMzEzLDE4LjA0Njk2ODggQzk1LjAwNzA5MzgsMTUuNjgzNjI1IDkxLjM0MzUzMTMsMTQuNDA4NzE4NyA4Ni4wNDY0Njg4LDEzLjY5MTUzMTIgTDgzLjcwMDg0MzgsMTMuMzcyNTkzOCBMODIuNzMwNTMxMywxMC40ODEwNjI1IEM4Mi4xNjY5MDYzLDguODQ5MjUgODEuODU3MjUsOC4yMzU4NDM3NSA4MC43ODQ4NDM4LDYuNjUyOTY4NzUgTDgwLjI3NTIxODgsNS45MDk2MjUgQzc4Ljc0NjM0MzgsMy42MjQ3NSA3NS40MjUzNDM4LDAuMzMxNTkzNzUgNzQuNDUwODEyNSwwLjA5MjgxMjUgQzcyLjg2MzcxODgsLTAuMzIwNjI1IDcxLjMyNTU2MjUsMC44MjA5Njg3NSA2OS41MjMzMTI1LDMuNzM1MjgxMjUgTDY5LjM2Mzg0MzgsMy45OTY4NDM3NSBDNjcuMTk2MjUsNy41NTMyNSA2Ni4yMzM1MzEzLDExLjQ5OTQ2ODggNjUuODUzODQzOCwxOC4zNDM5Njg3IEw2NS43NTA5MDYzLDIwLjQyNDY1NjMgQzY1LjQ4NzY1NjMsMjUuMzk3NzE4NyA2NS4wNDM4NDM4LDI4Ljk3MDE1NjMgNjQuMjg0NDY4OCwzMi4yNjQxNTYzIEw2NC4xOTg0MDYzLDMyLjYyODY1NjMgQzYzLjY0NDkwNjMsMzQuOTQwNTMxMyA2Mi42OTY1MzEzLDM3Ljc4MTQzNzUgNjIuNTM4NzUsMzcuNjIyODEyNSBDNjIuNDg1NTkzOCwzNy41Njk2NTYzIDYyLjYxNzIxODgsMzYuNDUzMzc1IDYyLjg1NDMxMjUsMzUuMTUyMzEyNSBDNjMuNzUwMzc1LDI5LjkyMDIxODggNjIuNTkxMDYyNSwyMy4xNDY1OTM4IDU5Ljg3NTg3NSwxNy42NzU3MTg4IEM1NS41NTUwMzEzLDkuMDQ0MTU2MjUgNDcuNzI3NTYyNSwyLjg4MTQwNjI1IDM4LjQyNDM3NSwwLjcyOTg0Mzc1IEMzNi40MTYyNSwwLjI2MzI1IDI5LjgzMjQ2ODgsLTAuMTc4ODc1IDI4LjQ5NTk2ODgsMC4wNzM0MDYyNSBMMjguMzAwMjE4OCwwLjExNjQzNzUgQzI3LjU0ODU2MjQsMC4yNTY4NTkzIDI2Ljc5NDA4OTQsMC4zODE3NjA4NjkgMjYuMDM3MjgxMywwLjQ5MTA2MjUgQzE2LjY1NDc4MTMsMi4wMzE3NSA3Ljc3MzQ2ODc1LDguNjcxMjE4NzUgMy4zNzI0Njg3NSwxNy40ODkyNSBDMS4zMTM3MTg3NSwyMS41ODczNDM4IDAuMzMzMjgxMjUsMjUuMzE1MDMxMyAwLjA3NTkzNzUsMzAuMTAwNzgxMyBMMC4wNTA2MjUsMzAuNjM3NDA2MyBDLTAuMTI5OTM3NSwzNC44MTgxODc1IDAuMTE4MTI1LDM1LjkyNjg3NSAxLjUwOTQ2ODc1LDM2LjY0NDkwNjIgTDEuNjA1NjU2MjUsMzYuNjkzIEMyLjg2Mjg0Mzc1LDM3LjMxNCAzLjcyODUzMTI1LDM3LjA3NTIxODggNS4zMDEyODEyNSwzNS40OTgyNSBMNS42Mzc5Mzc1LDM1LjE1MjMxMjUgQzYuNTQ2MTI3MDEsMzQuMTgxMzA1MiA3LjYyNzgzMDQyLDMzLjM4ODYyODQgOC44MjczMTI1LDMyLjgxNTEyNSBMOS4xOTY4NzUsMzIuNjQzIEMxMC40MjAzMTI1LDMyLjA4NjEyNSAxMC45NDM0Mzc1LDMxLjk4MDY1NjMgMTIuNjEzMjE4OCwzMS45NjcxNTYzIEwxMy42MzI0Njg4LDMxLjk2NzE1NjMgQzE1LjQ2MDAzMTMsMzEuOTgyMzQzOCAxNS45MTMxMjUsMzIuMTA2Mzc1IDE3LjM5MjIxODgsMzIuODE1MTI1IEMxOS43OTAxNTYzLDMzLjk1NjcxODggMjEuMzcxMzQzOCwzNS40OTgyNSAyMi41MDUzNDM4LDM3LjgwODQzNzUgQzI0LjA1OTUzMTMsNDAuOTk1MjgxMyAyNC4wMzMzNzUsNDUuMDU5NjI1IDIyLjQ1MjE4NzUsNDcuMTg0MTg3NSBMMjIuMzYyNzUsNDcuMjgwMzc1IEMyMS44MTAwOTM4LDQ3LjgzMzAzMTMgMTkuNjc0NTYyNSw0OS40MTE2ODc1IDE3LjM2MDE1NjMsNTAuOTYwODEyNSBMMTcuMTI4MTI1LDUxLjExNTIxODggQzE0LjA4MzAzMTMsNTMuMTM2IDEyLjAxNSw1NC43MTI5Njg4IDEwLjc2MDM0MzgsNTUuOTY1MDkzOCBMMTAuNjE4NTkzOCw1Ni4xMDg1MzEzIEM3LjE5Mjk2ODc1LDU5LjU4ODE1NjMgNC43MTU3MTg3NSw2NC4wNDk5MDYzIDMuMzE4NDY4NzUsNjkuMjAzNTMxMyBDMi41Mjc4NzUsNzIuMTc3NzUgMi41MDE3MTg3NSw3OS4xMDkxNTYzIDMuMjkzMTU2MjUsODIuMDMxOTA2MyBDNC43NjgwMzEyNSw4Ny40NDk2MjUgNy4xNjU5Njg3NSw5MS43NTE5MDYzIDEwLjcyNDA2MjUsOTUuMzM3ODQzOCBDMTcuOTE5NTYyNSwxMDIuNTg5MDMxIDI4Ljc1MDc4MTMsMTA1LjM1MTQ2OSAzNy43MTE0MDYzLDEwMi4yNDM5MzggTDM5LjE4Nzk2ODgsMTAxLjczOTM3NSBMNDIuNDI4ODEyNSwxMDMuMzU5Mzc1IEw0NC4xOTE0MDYzLDEwNC4yNTk2NTYgQzQ3LjIyODkwNjMsMTA1Ljc4MTc4MSA0OC41NTUyODEzLDEwNi4wMzMyMTkgNTcuOTIzNDM3NSwxMDYuMTA3NDY5IEw4NC40MzgyODEzLDEwNi4yMjgxMjUgTDg0LjQzOTEyNSwxMDYuMjI4MTI1IFogTTgwLjYyMzY4NzUsMTAwLjE4MjY1NiBMNzkuODQ0OTA2MiwxMDAuMjUwMTU2IEM3OC4zNDM4NzUsMTAwLjM1OSA3NS42NjY2NTYyLDEwMC4zNjQwNjMgNzEuMDY4MjE4NywxMDAuMzYxOTY3IEw1OS4zODIyODEyLDEwMC4zNTQ3ODEgQzQ5LjU0MTYyNSwxMDAuMzIxMDMxIDQ4LjI0OSwxMDAuMDM5MjE5IDQ0LjIxMzM0MzcsOTcuODAwNzUgTDQyLjA3Njk2ODcsOTYuNjAyNjI1IEM0MC4zNDY0Mzc1LDk1LjY0NzUgMzkuOTI1NDA2Miw5NS42ODEyNSAzNi4yOTcyODEyLDk2Ljc2OCBDMzEuNDQ2NTYyNSw5OC4yMzM1OTM3IDI2LjM3OSw5Ny44NjMxODc1IDIxLjkwOTY1NjIsOTYuMDAwMTg3NSBDMTcuMzA0MzQ4OCw5NC4wODE3NTAxIDEzLjQ5MzExNjMsOTAuNjQ2ODE4IDExLjEwNzk2ODcsODYuMjY1IEM5LjExMzY5MTcxLDgyLjU4OTg1ODQgOC4xOTgyMjQyLDc4LjQyNjA4OTkgOC40NjcwMzEyNSw3NC4yNTMzNzUgQzguNzI3NzUsNzAuMTU2MTI1IDEwLjExNTcxODcsNjYuMTQyNDA2MyAxMi41OTg4NzUsNjIuNzQ0NjI1IEwxMi44OTA4MTI1LDYyLjM1MTQzNzUgQzE0LjYyNDcxODcsNjAuMDUyMjE4OCAxNi4xNTE5MDYyLDU4Ljc4ODI4MTMgMjAuMzQ3MDMxMiw1Ni4wMTkwOTM4IEwyMS4wNDk4NzUsNTUuNTQxNTMxMyBDMjMuMTYzNDY4Nyw1NC4wOTAyODEzIDI1LjI2MjcxODcsNTIuNTExNjI1IDI1Ljg4OTYyNSw1MS44NTUxODc1IEMyNy44OTE4NDM3LDQ5Ljc4MjA5MzggMjkuMDY2MzQzNyw0Ni45NDg3ODEzIDI5LjM0OSw0My44OTM1NjI1IEMyOS42MjgyODEyLDQwLjg2MzY1NjMgMjkuMDMwOTA2MiwzNy42MTYwNjI1IDI3LjUwNTQwNjIsMzQuNjkyNDY4OCBDMjYuMjIyOTA2MiwzMi4yNDY0Mzc1IDIzLjAwNzM3NSwyOS4wODc0Mzc1IDIwLjU1Mzc1LDI3Ljg1MTM0MzggQzE2LjA3MjU5MzcsMjUuNTc5MTI1IDExLjc5NjQ2ODcsMjUuNDM2NTMxMyA2LjYxMTYyNSwyNy4zNzA0MDYzIEw2LjY1OTcxODc1LDI3LjExMjIxODggQzYuOTk1NTMxMjUsMjUuMDgyMTU2MyA4LjEwNzU5Mzc1LDIxLjg1NjUgOS4yNjk0Mzc1LDE5LjU5MjcxODggQzEyLjgzMzQzNzUsMTIuNTkxMjgxMyAxOS40MTgwNjI1LDcuNjc1NTkzNzUgMjcuMjY2NjI1LDYuMTY2MTI1IEMzMC4wNTUyMTg3LDUuNjQ1NTMxMjUgMzQuOTU4MjUsNS44NTY0Njg3NSAzOC4wNTQ4MTI1LDYuNjYyMjUgQzQ1LjE0NDg0MzcsOC41MTAwNjI1IDUwLjc2ODQzNzUsMTMuMTcwOTM3NSA1NC4wNzQyNSwxOS4xMTE3ODEzIEM1Ny4zNzgzNzUsMjUuMDUwMDkzOCA1OC4zNjY0MDYyLDMyLjI3MDA2MjUgNTYuMTg1MzEyNSwzOS4yNDE5Njg4IEM1NS43Njk0ODk2LDQwLjUyNzAxNzIgNTUuMjY0ODM1Niw0MS43ODE2MDM5IDU0LjY3NSw0Mi45OTY2NTYzIEM1NC40MTAwNjI1LDQzLjU0MDAzMTMgNTQuMTU2OTM3NSw0NC4wMDI0MDYzIDUzLjk0NDMxMjUsNDQuMzIxMzQzOCBDNTMuOTIyMzc1LDQ0LjM1MzQwNjMgNTMuOTMyNSw0NC41ODEyMTg4IDUzLjg5MzY4NzUsNDQuNTgxMjE4OCBMNTMuNzYyMDYyNSw0NC41OTEzNDM4IEM1My42MTI3MTg3LDQ0LjYwNjUzMTMgNTMuMzU3MDYyNSw0NC42Mzg1OTM4IDUzLjAzMjIxODcsNDQuNjgxNjI1IEw1MC45OTU0MDYyLDQ0Ljk1OTIxODggQzQ0Ljg3ODIxODcsNDUuODkxNTYyNSAzOS40MjU5MDYyLDQ4LjYyMzYyNSAzNS4xNTMxNTYyLDUyLjY2MTgxMjUgQzMwLjg4MTI1LDU2LjY5OTE1NjMgMjcuNzg3MjE4Nyw2Mi4wNDQzMTI1IDI2LjM5MzM0MzcsNjguMjA3OTA2MyBDMjUuODU1MDMxMiw3MC42MjEwMzEzIDI1Ljc3NTcxODcsNzcuNTUzMjgxMyAyNi4yNjAwMzEyLDc5Ljg4NzA5MzggQzI2LjcxNTY1NjIsODEuOTg1NSAyNy4xNTYwOTM3LDgzLjMzMjk2ODggMjcuNzAwMzEyNSw4NC4xNjE1MzEzIEMyOC4zMzMxMjUsODUuMTI1OTM3NSAyOS4xMDA5Mzc1LDg1LjQ4NDUzMTMgMzAuMTc1MDMxMiw4NS40ODQ1MzEzIEMzMC45MjkzNDM3LDg1LjQ4NDUzMTMgMzEuNDg5NTkzNyw4NS4zNDEwOTM3IDMxLjkzMjU2MjUsODUuMDU1OTA2MyBDMzIuMzQwOTM3NSw4NC43OTI2NTYzIDMyLjY1OTAzMTIsODQuNDAzNjg3NSAzMi45MTk3NSw4My44NDUxMjUgTDMzLjA4MTc1LDgzLjQ2NjI4MTMgQzMzLjQxMDgxMjUsODIuNjY0NzE4OCAzMy4zOTM5Mzc1LDgyLjI2OSAzMi44MjAxODc1LDgwLjA5NDY1NjMgQzMyLjAyMiw3Ni45Mjg5MDYzIDMyLjAyMDMxMjUsNzEuNTMzMTI1IDMyLjgxNzY1NjIsNjguNDkzOTM3NSBDMzQuNjIxNTkzNyw2MS44NzA1IDM5LjE1NDIxODcsNTYuMjg0ODc1IDQ1LjEwNzcxODcsNTMuMzczOTM3NSBDNDcuNzg0MDkzNyw1Mi4wODcyMTg4IDUwLjQxMzIxODcsNTEuMzY2NjU2MyA1My42MzgwMzEyLDUxLjAzIEw1NC4xNTE4NzUsNTAuOTgwMjE4OCBDNjAuNTg3MTU2Miw1MC4zNzUyNSA2My44NTc1MzEyLDQ4LjE3NjQzNzUgNjYuODAxMzc1LDQyLjQzNDcxODggQzY5LjY0NjUsMzYuODg0NTMxMyA3MS4wOTUyMTg3LDMwLjI3ODgxMjUgNzEuNTc3LDIwLjIzMjI4MTMgTDcxLjY3MTUsMTguMjE3NDA2MyBDNzEuODMxODEyNSwxNS4xMDkwMzEzIDcyLjAyNDE4NzUsMTMuMzk5NTkzOCA3Mi4zNjg0Mzc1LDEyLjA3NDkwNjMgTDcyLjQwNTU2MjUsMTEuOTM0ODQzOCBDNzIuNjgyMzQzMiwxMC44MzU1ODQ5IDczLjAzNzYzMDEsOS43NTc1OTkxNiA3My40Njg2ODc1LDguNzA5MTg3NSBMNzMuNzc1ODEyNSw3Ljk4NjkzNzUgQzczLjgzODQzODksNy44Mzc0NjIyNiA3My44OTY0MDQzLDcuNjg2MDc2NjggNzMuOTQ5NjI1LDcuNTMzIEw3My45NDQ1NjI1LDcuNDg0OTA2MjUgQzczLjk0MTE4NzUsNy40NDYwOTM3NSA3My45Mzg2NTYyLDcuMzk2MzEyNSA3My45NDk2MjUsNy4zOTYzMTI1IEM3NC4wOTQ3NSw3LjM5NjMxMjUgNzQuNDQ0MDYyNSw4LjAzNTAzMTI1IDc0Ljg2Njc4MTMsOC42NCBMNzQuOTUyODQzNyw4Ljc2MDY1NjI1IEM3NS42MjM2MjUsOS42ODg3ODEyNSA3Ni4zNzg3ODEzLDEwLjg2NjY1NjMgNzYuODgwODEyNSwxMS44MDk5Njg4IEM3Ny4zMzk4MTI1LDEyLjcwODU2MjUgNzcuOTAwOTA2MywxNC4xMjAxNTYzIDc4LjEzMjA5MzgsMTQuOTIwODc1IEw3OC4zMzEyMTg3LDE1LjYzMjE1NjMgQzc4Ljc1ODE1NjIsMTcuMTA2MTg3NSA3OS4xMTMzNzUsMTcuODg3NSA3OS43NjIyMTg4LDE4LjM2MzM3NSBDODAuNDkzNzUsMTguODk4MzEyNSA4MS42NDEyNSwxOS4wNDUxMjUgODMuOTA4NDA2MywxOS4xODg1NjI1IEM4OS43ODQyODEzLDE5LjUyNDM3NSA5NC4xMzM4MTI1LDIxLjE4NTcxODggOTcuMjQyMTg3NSwyNC4zNDM4NzUgQzk5Ljc3ODUsMjYuOTAwNDM3NSAxMDEuMzQzNjU2LDI5LjkzMzcxODggMTAxLjg2MzQwNiwzMy4zMDc4NzUgTDEwMi4wNzA5NjksMzQuNzUzMjE4OCBMMTAxLjMyOTMxMywzNS4wOTE1NjI1IEwxMDEuMjUzMzc1LDM1LjEyMzYyNSBDOTkuNTUxNTMxMiwzNS44NDA4MTI1IDk2LjI1NzUzMTIsMzYuMzE5MjE4OCA5MS44NTE0Njg3LDM2LjUwMjMxMjUgTDkwLjM1MTI4MTIsMzYuNTU3MTU2MyBDODcuNDgwODQzNywzNi42NzEwNjI1IDg1Ljc4OTEyNSwzNi44NjQyODEzIDg1LjMzNjg3NSwzNy4wOTM3ODEzIEM4NC42MTg4NDM3LDM3LjQ1NjU5MzggODQuMTgzNDY4NywzNy45NDE3NSA4My45NTk4NzUsMzguOTI4OTM3NSBDODMuNzg0Mzc1LDM5LjcwODU2MjUgODMuNzU0LDQwLjg1Nzc1IDgzLjgyMDY1NjIsNDIuNjM2Mzc1IEw4My44MzMzMTI1LDQyLjk1NyBDODMuOTkzNjI1LDQ2Ljk2NDgxMjUgODQuNTk4NTkzNyw0OS4xMDM3MTg4IDg2LjAzNDY1NjIsNTAuODQ1MjE4OCBMODYuMTcxMzQzNyw1MS4wMDcyMTg4IEM4Ny41MjcyNSw1Mi42MTg3ODEzIDg4Ljc5MTE4NzUsNTMuMjI3MTI1IDkxLjYyMjgxMjUsNTMuNTczOTA2MyBMOTEuOTIxNSw1My42MDkzNDM4IEM5NC42ODksNTMuODk5NTkzOCA5Ni42NTQ5Mzc1LDU0LjczOTk2ODggOTguMjk1MTg3NSw1Ni4zOTU0MDYzIEw5OC40OTAwOTM3LDU2LjU5NzkwNjMgTDk4LjU2NjAzMTIsNTYuNjgyMjgxMyBDOTguODAzOTY4Nyw1Ni45NTE0Mzc1IDk5LjAwNTYyNSw1Ny4xOTk1IDk5LjE2ODQ2ODcsNTcuNDI0NzgxMyBMOTkuMjgyMzc1LDU3LjU5MSBMOTkuMzExOTA2Miw1Ny42MzU3MTg4IEw5OC4xMjcyODEyLDU3LjI5NjUzMTMgQzk2LjI3MTAzMTIsNTYuNzczNDA2MyA4OC4xNTkyMTg3LDU2LjgzOTIxODggODcuMDc1ODQzNyw1Ny4zODU5Njg4IEM4Ni42NDMsNTcuNjA1MzQzOCA4NS43MjgzNzUsNTguNTc1NjU2MyA4NC45OTY4NDM3LDU5LjYzNjI1IEw4NC41MTY3NSw2MC4zNTAwNjI1IEM4My4yNTExMjUsNjIuMTg1MjE4OCA4Mi4yNzc0Mzc1LDYzLjA2MTAzMTMgODAuMzIxNjI1LDY0LjI1NzQ2ODggTDc5Ljg4Mjg3NSw2NC41MjY2MjUgQzc4Ljc4MDA5MzcsNjUuMjE2ODEyNSA3OC4yMTU2MjUsNjUuNzEyMDkzOCA3Ny45NTA2ODc1LDY2LjM4ODc4MTMgQzc3LjY3NDc4MTIsNjcuMDkzMzEyNSA3Ny43MzMsNjguMDI1NjU2MyA3Ny45OTc5Mzc1LDY5LjcwNzI1IEw3OC4wNDE4MTI1LDY5Ljk3OTc4MTMgQzc4LjU4MzUsNzMuMzYxNTMxMiA3OC41ODYwMzEyLDc1LjY3ODQ2ODggNzguMDk1ODEyNSw3OC42MTk3ODEzIEM3Ny40NTExODc1LDgyLjMxNjI1IDc2LjMwNzA2MjUsODUuMzE5MTU2MiA3NC4yMzIyODEyLDg4LjYxMzE1NjIgTDczLjk1NzIxODcsODkuMDQ1MTU2MyBDNzIuODQwOTM3NSw5MC43NzgyMTg3IDcyLjQ4MDY1NjMsOTEuOTE5ODEyNSA3Mi43NzU5Njg3LDkyLjg1NzIxODggQzczLjA1NDQwNjIsOTMuNzQyMzEyNSA3My45NTMsOTQuNTA0MjE4NyA3NS43MTcyODEyLDk1LjM3OTE4NzUgTDc1Ljk2MjgxMjUsOTUuNDk5IEM3OC4yNTEwNjI1LDk2LjYwNDMxMjUgNzkuODM1NjI1LDk3LjgyNzc1IDgwLjU2MTI1LDk5LjEzMTM0MzcgTDgwLjcyOTE1NjIsOTkuNDQ5NDM3NSBMODAuOTk2NjI1LDk5LjkyMTkzNzUgQzgxLjAzMjA2MjUsOTkuOTg0Mzc1IDgxLjA2MjQzNzUsMTAwLjA0MjU5NCA4MS4wODQzNzUsMTAwLjA5NjU5NCBDODAuOTg3MzQzNywxMDAuMTQyMTU2IDgwLjgzMjkzNzUsMTAwLjE2MzI1IDgwLjYyMzY4NzUsMTAwLjE4MjY1NiBaIiBpZD0iU2hhcGUiPjwvcGF0aD4KICAgICAgICA8L2c+CiAgICA8L2c+Cjwvc3ZnPg==';
			$position   = 2;

			$chipmunk_menu_page = add_menu_page( $title, $title, $capability, $slug, $function, $icon, $position );
		}
	}

	/**
	 * Adds a menu item for the theme license under the appearance menu.
	 */
	public static function add_licenses_menu_page() {
		add_submenu_page(
			THEME_SLUG,
			__( 'Licenses', 'chipmunk' ),
			__( 'Licenses', 'chipmunk' ),
			'manage_options',
			THEME_SLUG . '_licenses',
			array( self::class, 'admin_licenses' ),
		);
	}

	/**
	 * Outputs the markup used on the theme settings page.
	 */
	public static function admin_settings() {
		?>
		<div class="wrap">
			<h1><?php echo THEME_TITLE; ?></h1>
			<hr>

			<?php do_action( 'chipmunk_settings_content' ); ?>
		</div>
		<?php
	}

	/**
	 * Outputs the markup used on the theme license page.
	 */
	public static function admin_licenses() {
		?>
		<div class="wrap chipmunk-wrap-licenses">
			<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
			<hr>

			<?php settings_errors(); ?>

			<form method="post" action="options.php">
				<table class="form-table">
					<tbody>
						<?php do_action( 'chipmunk_licenses_content' ); ?>
					</tbody>
				</table>

				<?php submit_button(); ?>
			</form>
		<?php
	}

	/**
	 * Outputs the settings markup for upvote faker
	 */
	public static function faker_settings() {
		?>
		<h2><?php esc_html_e( 'Fake counter generators', 'chipmunk' ); ?></h2>

		<p class="description">
			<?php esc_html_e( 'Adds fake values for your upvote or view counters.', 'chipmunk' ); ?>
		</p>

		<table class="form-table">
			<tbody>
				<tr>
					<th><?php esc_html_e( 'Upvotes', 'chipmunk' ); ?></th>

					<td>
						<form method="post" action="">
							<input type="number" class="small-text" name="<?php echo esc_attr( THEME_SLUG . '_generator_upvote_start' ); ?>" value="" min="0" placeholder="<?php esc_attr_e( 'Start', 'chipmunk' ); ?>" />
							<input type="number" class="small-text" name="<?php echo esc_attr( THEME_SLUG . '_generator_upvote_end' ); ?>" value="" min="0" placeholder="<?php esc_attr_e( 'End', 'chipmunk' ); ?>" />
							<button type="submit" class="button-primary" name="<?php echo esc_attr( THEME_SLUG . '_generator_upvote' ); ?>"><?php esc_html_e( 'Generate', 'chipmunk' ); ?></button>
						</form>

						<p class="description">
							<?php printf( esc_html__( 'Pick a range to generate %1$s from.', 'chipmunk' ), esc_html__( 'upvotes', 'chipmunk' ) ); ?>
						</p>
					</td>
				</tr>

				<tr>
					<th><?php esc_html_e( 'Views', 'chipmunk' ); ?></th>

					<td>
						<form method="post" action="">
							<input type="number" class="small-text" name="<?php echo esc_attr( THEME_SLUG . '_generator_view_start' ); ?>" value="" min="0" placeholder="<?php esc_attr_e( 'Start', 'chipmunk' ); ?>" />
							<input type="number" class="small-text" name="<?php echo esc_attr( THEME_SLUG . '_generator_view_end' ); ?>" value="" min="0" placeholder="<?php esc_attr_e( 'End', 'chipmunk' ); ?>" />
							<button type="submit" class="button-primary" name="<?php echo esc_attr( THEME_SLUG . '_generator_view' ); ?>"><?php esc_html_e( 'Generate', 'chipmunk' ); ?></button>
						</form>

						<p class="description">
							<?php printf( esc_html__( 'Pick a range to generate %1$s from.', 'chipmunk' ), esc_html__( 'views', 'chipmunk' ) ); ?>
						</p>
					</td>
				</tr>
			</tbody>
		</table>
		<?php
	}

	/**
	 * Checks if a generator action was submitted.
	 */
	public static function faker_action() {
		if ( isset( $_POST[THEME_SLUG . '_generator_upvote'] ) ) {
			self::faker_generate( 'upvote', (int) $_POST[THEME_SLUG . '_generator_upvote_start'], (int) $_POST[THEME_SLUG . '_generator_upvote_end'], array( 'resource' ) );
		}

		if ( isset( $_POST[THEME_SLUG . '_generator_view'] ) ) {
			self::faker_generate( 'post_view', (int) $_POST[THEME_SLUG . '_generator_view_start'], (int) $_POST[THEME_SLUG . '_generator_view_end'], array( 'post', 'resource' ) );
		}
	}

	/**
	 * Generate fake values for upvote and view counters
	 */
	public static function faker_generate( $type, $start, $end, $post_types ) {
		if ( empty( $start ) && empty( $end ) ) {
			return;
		}

		$db_key = '_' . THEME_SLUG . '_' . $type . '_count';

		$posts = get_posts( array(
			'post_type'         => $post_types,
			'post_status'       => 'any',
			'posts_per_page'    => -1,
		) );

		foreach ( $posts as $post ) {
			$count = (int) get_post_meta( $post->ID, $db_key, true );

			if ( isset( $count ) && is_numeric( $count ) ) {
				update_post_meta( $post->ID, $db_key, $count + rand( $start, ( $start > $end ? $start : $end ) ) );
			}
		}

		add_action( 'admin_notices', function() {
			?>
				<div class="notice notice-success">
					<p><?php echo esc_html( 'Fake counters successfully generated!', 'chipmunk' ); ?></p>
				</div>
			<?php
		} );
	}
}
