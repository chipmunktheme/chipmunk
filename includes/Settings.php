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
	 * License data object
	 *
	 * @var object
	 */
	public static $license;

	/**
 	 * Used to register custom hooks
	 *
	 * @return void
	 */
	function __construct() {
		add_action( 'admin_menu', array( $this, 'add_menu_page' ), 1 );
		add_action( 'chipmunk_settings_nav', array( $this, 'add_menu_page' ), 1 );

		// Initialize theme licenser
		$licenser = new Settings\Licenser( array(
			'remote_api_url' => THEME_SHOP_URL,
			'item_id'        => THEME_ITEM_ID,
			'item_name'      => THEME_TITLE,
			'item_slug'      => THEME_SLUG,
		) );

		// Store license data
		self::$license = $licenser->get_license_data();

		// Initialize other settings
		new Settings\Faker();
		new Settings\Addons();
	}

	/**
	 * Register settings page to the admin_menu action hook
	 */
	public function add_menu_page() {
		add_menu_page(
			THEME_TITLE,
			THEME_TITLE,
			'edit_theme_options',
			THEME_SLUG,
			array( $this, 'admin_settings' ),
			Helpers::svg_to_base64( Assets::asset_path( 'images/logo.svg' ) ),
		);
	}

	/**
	 * Outputs the markup used on the theme settings page.
	 */
	public function admin_settings() {
		$tabs = apply_filters( 'chipmunk_settings_tabs', array() );
		?>

		<div class="chipmunk">
			<div class="chipmunk__head chipmunk__wrap">
				<h1 class="chipmunk__title">
					<?php echo Helpers::get_svg_content( Assets::asset_path( 'images/logo.svg' ) ); ?>
					<?php echo THEME_TITLE; ?>
				</h1>

				<?php if ( ! empty( self::$license ) && 'valid' == self::$license->license ) : ?>
					<a href="<?php echo THEME_SHOP_URL; ?>/account" target="_blank" class="chipmunk__status">
						<div class="chipmunk__status-icon">
							✓
						</div>

						<div class="chipmunk__status-content">
							<?php if ( ! empty( self::$license->price_id ) ) : ?>
								<strong><?php printf( esc_html__( '%s License', 'chipmunk' ), THEME_PLANS[ self::$license->price_id ] ); ?></strong><br>
							<?php endif; ?>
							<?php echo esc_html( self::$license->customer_email ); ?>
						</div>
					</a>
				<?php endif; ?>
			</div>

			<div class="chipmunk__nav chipmunk__wrap">
				<ul>
					<?php foreach ( $tabs as $tab ) : ?>
						<li><a href="?page=chipmunk&tab=<?php echo esc_attr( $tab['slug'] ); ?>" <?php echo $this->is_active_tab( $tabs, $tab ) ? 'class="active"' : ''; ?>><?php echo esc_html( $tab['name'] ); ?></a></li>
					<?php endforeach; ?>
				</ul>
			</div>

			<div class="chipmunk__main chipmunk__wrap">
				<?php settings_errors(); ?>

				<?php foreach ( $tabs as $index => $tab ) : ?>
					<?php if ( $this->is_active_tab( $tabs, $tab ) && ! empty( $tab['content'] ) ) : ?>
						<?php echo $tab['content']; ?>
					<?php endif; ?>
				<?php endforeach; ?>
			</div>

			<script>
				var HW_config = {
					selector: ".chipmunk__head h1",
					account:  "yZMVmJ"
				}
			</script>
			<script async src="https://cdn.headwayapp.co/widget.js"></script>
		</div>

		<?php
	}

	/**
	 * Checks if the tab is active
	 *
	 * @param array $tabs Tabs array list
	 * @param array $tab Single tab instance
	 */
	private function is_active_tab( $tabs, $tab ) {
		return ( ! empty( $_GET['tab'] ) && $_GET['tab'] == $tab['slug'] ) || ( empty( $_GET['tab'] ) && $tabs[0] == $tab );
	}

	/**
	 * Is valid license activated
	 *
	 * @return bool
	 */
	protected static function is_valid_license() {
		return ! empty( self::$license ) && 'valid' == self::$license->license;
	}

	/**
	 * Get the price ID if the license is valid and activated
	 *
	 * @return int
	 */
	protected static function get_license_price() {
		return self::is_valid_license() ? (int) self::$license->price_id : 0;
	}

	/**
	 * Adds setting error using Settings API
	 *
	 * @param string $message Error message
	 * @param string $type Error type
	 */
	protected function add_settings_error( $setting, $message, $type = 'error' ) {
		$setting = THEME_SLUG . '_' . $setting;
		$errors = get_settings_errors( $setting );

		if ( ! empty( $message ) && ! Helpers::find_key_value( $errors, 'code', $setting ) ) {
			add_settings_error( $setting, $setting, $message, $type );
		}
	}
}
