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
			$icon       = 'data:image/svg+xml;base64,PHN2ZyBpZD0iTGF5ZXJfMSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB2aWV3Qm94PSIwIDAgNzIuNCA3NS4xIj48c3R5bGU+LnN0MHtmaWxsOiMzMzMzMzM7fSAuc3Qxe2ZpbGw6I0ZGRkZGRjt9PC9zdHlsZT48cGF0aCBjbGFzcz0ic3QwIiBkPSJNMzYuMyA3NS4xYy00LjUgMC04LjctMi4xLTExLjQtNS44LS43LS45LS41LTIuMS40LTIuOHMyLjEtLjUgMi44LjRjMS45IDIuNyA0LjkgNC4yIDguMiA0LjIgMy4yIDAgNi4zLTEuNiA4LjItNC4yLjctLjkgMS45LTEuMSAyLjgtLjQuOS43IDEuMSAxLjkuNCAyLjgtMi43IDMuNi02LjkgNS44LTExLjQgNS44ek01MiA2OS43Yy0xLjEgMC0yLS45LTItMnMuOS0yIDItMmM5IDAgMTYuNC03LjQgMTYuNC0xNi40UzYxIDMyLjkgNTIgMzIuOWMtMS41IDAtMyAuMi00LjYuNy0xLjEuMy0yLjItLjMtMi41LTEuNC0uMy0xLjEuMy0yLjIgMS40LTIuNSAyLS42IDMuOS0uOSA1LjgtLjkgMTEuMiAwIDIwLjQgOS4yIDIwLjQgMjAuNC0uMSAxMS40LTkuMyAyMC41LTIwLjUgMjAuNXptLTMzLjMtLjFoLS4yQzguMSA2OC43IDAgNTkuOCAwIDQ5LjNjMC0xMS4yIDkuMi0yMC40IDIwLjQtMjAuNCAxLjkgMCAzLjcuMyA1LjguOSAxLjEuMyAxLjcgMS40IDEuNCAyLjUtLjMgMS4xLTEuNCAxLjctMi41IDEuNC0xLjctLjUtMy4xLS43LTQuNi0uNy05IDAtMTYuNCA3LjQtMTYuNCAxNi40IDAgOC40IDYuNSAxNS42IDE0LjkgMTYuMyAxLjEuMSAxLjkgMS4xIDEuOCAyLjItLjIuOS0xLjEgMS43LTIuMSAxLjd6TTU3IDI3LjVjLTEuMSAwLTItLjktMi0yIDAtMTAuMy04LjQtMTguNy0xOC43LTE4LjctMTAuNCAwLTE4LjggOC40LTE4LjggMTguNyAwIDEuMS0uOSAyLTIgMnMtMi0uOS0yLTJDMTMuNSAxMyAyMy43IDIuOCAzNi4zIDIuOCA0OC44IDIuOCA1OSAxMyA1OSAyNS41YzAgMS4xLS45IDItMiAyeiIvPjxwYXRoIGNsYXNzPSJzdDAiIGQ9Ik0zMy42IDI3LjVjLTEuMSAwLTItLjktMi0yQzMxLjggOC45IDIzIDUuMSAxOS4zIDQuM2MtLjMgMS42LS4yIDQuNCAxLjYgNy43LjUgMSAuMiAyLjItLjggMi43cy0yLjIuMi0yLjctLjhDMTMuNSA3IDE1LjkgMS40IDE2IDEuMiAxNi4zLjQgMTcuMSAwIDE3LjkgMGMuMiAwIDE4IDEuMSAxNy43IDI1LjUgMCAxLjEtLjkgMi0yIDJ6bTUuMiAwYy0xLjEgMC0yLS45LTItMkMzNi42IDEuMSA1NC4zIDAgNTQuNSAwYy45LS4xIDEuNi40IDEuOSAxLjIuMS4yIDIuNSA1LjctMS41IDEyLjgtLjUgMS0xLjggMS4zLTIuNy44LTEtLjUtMS4zLTEuOC0uOC0yLjcgMS45LTMuNCAxLjktNi4yIDEuNy03LjgtMy43LjktMTIuNSA0LjctMTIuMyAyMS4yIDAgMS4xLS45IDItMiAyek0zNi4yIDQ4LjljLTQuNCAwLTgtMy42LTgtOHMzLjYtOCA4LTggOCAzLjYgOCA4LTMuNiA4LTggOHptMC0xMmMtMi4yIDAtNCAxLjgtNCA0czEuOCA0IDQgNCA0LTEuOCA0LTQtMS44LTQtNC00ek0zNi4yIDU4LjRjLTQuMiAwLTguMS0xLjMtMTAuNi0zLjYtLjgtLjctLjktMi0uMS0yLjguNy0uOCAyLS45IDIuOC0uMSAxLjggMS42IDQuOCAyLjYgOCAyLjZzNi4yLTEgOC0yLjZjLjgtLjcgMi4xLS43IDIuOC4xLjcuOC43IDIuMS0uMSAyLjgtMi43IDIuMy02LjYgMy42LTEwLjggMy42eiIvPjxwYXRoIGNsYXNzPSJzdDEiIGQ9Ik00MC40IDU2LjRsLS44IDQuNmgtNi43bC0uOC00LjZoOC4zeiIvPjxwYXRoIGNsYXNzPSJzdDAiIGQ9Ik0zOS42IDYzaC02LjdjLTEgMC0xLjgtLjctMi0xLjdsLS44LTQuNmMtLjEtLjYuMS0xLjIuNC0xLjYuNC0uNS45LS43IDEuNS0uN2g4LjNjLjYgMCAxLjIuMyAxLjUuNy40LjUuNSAxIC40IDEuNmwtLjggNC42YzAgMS0uOCAxLjctMS44IDEuN3ptLTUtNGgzLjNsLjEtLjZoLTMuNWwuMS42eiIvPjxjaXJjbGUgY2xhc3M9InN0MCIgY3g9IjI3LjQiIGN5PSIyNS4zIiByPSIyIi8+PGNpcmNsZSBjbGFzcz0ic3QwIiBjeD0iNDUuMSIgY3k9IjI1LjMiIHI9IjIiLz48Zz48cGF0aCBjbGFzcz0ic3QwIiBkPSJNNTkuMyA1OWMtLjUgMC0xLjEtLjItMS40LS42LS44LS44LS43LTIuMS4xLTIuOCAxLjctMS42IDIuNy0zLjkgMi43LTYuMyAwLTEuMS45LTIgMi0yczIgLjkgMiAyYzAgMy41LTEuNCA2LjctMy45IDkuMS0uNS40LTEgLjYtMS41LjZ6bS00Ni4yIDBjLS41IDAtMS0uMi0xLjQtLjYtMi41LTIuNC0zLjktNS43LTMuOS05LjEgMC0zLjUgMS4zLTYuNyAzLjctOS4xLjgtLjggMi0uOCAyLjggMCAuOC44LjggMiAwIDIuOC0xLjYgMS42LTIuNSAzLjktMi41IDYuM3MxIDQuNiAyLjcgNi4zYy44LjguOCAyIC4xIDIuOC0uNC40LTEgLjYtMS41LjZ6Ii8+PC9nPjwvc3ZnPg==';
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
