<?php

namespace Chipmunk;

use Chipmunk\Assets;
use Chipmunk\Errors;
use Chipmunk\Helpers;

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
	 */
	function __construct() {
		add_action( 'admin_menu', [ $this, 'addMenuPage' ], 1 );
		add_action( 'chipmunk_settings_nav', [ $this, 'addMenuPage' ], 1 );
		add_action( 'admin_init', [ $this, 'displayErrors' ], 99 );

		// Initialize theme licenser
		$licenser = new Settings\Licenser( [
			'remote_api_url' => THEME_SHOP_URL,
			'item_id'        => THEME_ITEM_ID,
			'item_name'      => THEME_TITLE,
			'item_slug'      => THEME_SLUG,
		] );

		// Store license data
		self::$license = $licenser->get_license_data();

		// Initialize other settings
		new Settings\Faker();
		new Settings\Addons();
	}

	/**
	 * Register settings page to the admin_menu action hook
	 */
	public function addMenuPage() {
		add_menu_page(
			THEME_TITLE,
			THEME_TITLE,
			'edit_theme_options',
			THEME_SLUG,
			[ $this, 'admin_settings' ],
			Helpers::svgToBase64( Assets::assetPath( 'images/logo.svg' ) ),
		);
	}

	/**
	 * Outputs the markup used on the theme settings page.
	 */
	public function adminSettings() {
		$tabs = apply_filters( 'chipmunk_settings_tabs', [] );
		?>

		<div class="chipmunk">
			<div class="chipmunk__head chipmunk__wrap">
				<h2 style="display: none;"></h2>

				<h1 class="chipmunk__title">
					<?php echo Helpers::getSvgContent( Assets::assetPath( 'images/logo.svg' ) ); ?>
					<?php echo THEME_TITLE; ?>
				</h1>

				<?php if ( ! empty( self::$license ) && 'valid' == self::$license->license ) : ?>
					<a href="<?php echo THEME_SHOP_URL; ?>/account" target="_blank" class="chipmunk__status">
						<div class="chipmunk__status-icon chipmunk__status-icon--success">✓</div>

						<div class="chipmunk__status-content">
							<?php if ( ! empty( self::$license->price_id ) ) : ?>
								<strong><?php printf( esc_html__( '%s License', 'chipmunk' ), THEME_PLANS[ self::$license->price_id ] ); ?></strong>
							<?php endif; ?>
							<?php echo esc_html( self::$license->customer_email ); ?>
						</div>
					</a>
				<?php else : ?>
					<a href="?page=chipmunk&tab=license" class="chipmunk__status">
						<div class="chipmunk__status-icon chipmunk__status-icon--error">⤫</div>

						<div class="chipmunk__status-content">
							<strong><?php esc_html_e( 'License is invalid', 'chipmunk' ); ?></strong>
							<?php esc_html_e( 'Please activate your license', 'chipmunk' ); ?>
						</div>
					</a>
				<?php endif; ?>
			</div>

			<div class="chipmunk__nav chipmunk__wrap">
				<ul>
					<?php foreach ( $tabs as $tab ) : ?>
						<li>
							<a href="?page=chipmunk&tab=<?php echo esc_attr( $tab['slug'] ); ?>" <?php echo $this->isActiveTab( $tabs, $tab ) ? 'class="active"' : ''; ?>>
								<?php echo esc_html( $tab['name'] ); ?>
							</a>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>

			<div class="chipmunk__main chipmunk__wrap">
				<?php settings_errors(); ?>

				<?php foreach ( $tabs as $index => $tab ) : ?>
					<?php if ( $this->isActiveTab( $tabs, $tab ) && ! empty( $tab['content'] ) ) : ?>
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
	private function isActiveTab( $tabs, $tab ) {
		return ( ! empty( $_GET['tab'] ) && $_GET['tab'] == $tab['slug'] ) || ( empty( $_GET['tab'] ) && $tabs[0] == $tab );
	}

	/**
	 * Is valid license activated
	 *
	 * @return bool
	 */
	public static function isValidLicense() {
		return ! empty( self::$license ) && 'valid' == self::$license->license;
	}

	/**
	 * Get the price ID if the license is valid and activated
	 *
	 * @return int
	 */
	public static function getLicensePrice() {
		return self::isValidLicense() ? (int) self::$license->price_id : 0;
	}

	/**
	 * Adds setting error using Settings API
	 *
	 * @param string $message Error message
	 * @param string $type Error type
	 */
	public static function addSettingsError( $setting, $message, $type = 'error' ) {
		$setting = THEME_SLUG . '_' . $setting;
		$errors = get_settings_errors( $setting );

		if ( ! empty( $message ) && ! Helpers::findKeyValue( $errors, 'code', $setting ) ) {
			add_settings_error( $setting, $setting, $message, $type );
		}
	}

	/**
	 * Checks if a import action was submitted.
	 */
	public function displayErrors() {
		$errors = Errors::getInstance();

		foreach ( $errors->get_error_messages() as $error ) {
			self::addSettingsError( '', $error );
		}
	}
}
