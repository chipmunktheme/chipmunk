<?php

namespace Chipmunk\Settings;

use \Chipmunk\Settings;

/**
 * A Addons settings class
 *
 * @package WordPress
 * @subpackage Chipmunk
 */
class Addons {

	/**
	 * Option name
	 *
	 * @var string
	 */
	private static $option;

	/**
	 * Setting name
	 *
	 * @var string
	 */
	private static $name = 'Addons';

	/**
	 * Setting slug
	 *
	 * @var string
	 */
	private static $slug = 'addons';

	/**
	 * Initialize the class
	 */
	function __construct( ) {
		self::$option = THEME_SLUG . '_' . self::$slug;

		add_action( 'admin_init', [ $this, 'register_option' ] );

		// Output settings content
		add_filter( 'chipmunk_settings_tabs', [ $this, 'add_settings_tab' ] );
	}

	/**
	 * Registers the option used to store the license key in the options table.
	 */
	public function register_option() {
		register_setting(
			self::$option,
			self::$option
		);
	}

	/**
	 * Adds settings tab to the list
	 */
	public function add_settings_tab( $tabs ) {
		$tabs[] = [
			'name'      => self::$name,
			'slug'      => self::$slug,
			'content'   => $this->get_settings_content(),
		];

		return $tabs;
	}

	/**
	 * Returns the settings markup for upvote faker
	 */
	private function get_settings_content() {
		$addons = apply_filters( 'chipmunk_settings_addons', [] );
		$options = get_option( self::$option );

		ob_start();

		?>

		<form action="options.php" method="post">
			<?php settings_fields( self::$option ); ?>

			<div class="chipmunk__grid">
				<?php foreach ( $addons as $addon ) : ?>
					<?php $setting_name = self::$option . "[{$addon['slug']}]"; ?>

					<div class="chipmunk__addon chipmunk__box">
						<h3 class="chipmunk__addon-title">
							<?php echo esc_html( $addon['icon'] ); ?>
							<?php echo esc_html( $addon['name'] ); ?>
						</h3>

						<p class="chipmunk__addon-excerpt">
							<?php echo esc_html( $addon['excerpt'] ); ?>
							<a href="<?php echo esc_attr( $addon['url'] ); ?>" target="_blank" class="link"><?php esc_html_e( 'Read more', 'chipmunk' ); ?> &rarr;</a>
						</p>

						<?php if ( ! Settings::isValidLicense() ) : ?>
							<p class="chipmunk__addon-error">
								<?php esc_html_e( 'Please use a valid license to enable.', 'chipmunk' ); ?>
							</p>
						<?php elseif ( ! self::isAddonAllowed( $addon['slug'] ) ) : ?>
							<p class="chipmunk__addon-error">
								<a href="<?php echo esc_url( THEME_SHOP_URL ); ?>/account/licenses" target="_blank" class="button-secondary"><?php esc_html_e( 'Upgrade now', 'chipmunk' ); ?></a>
								<?php printf( esc_html__( 'Available in the %s plan.', 'chipmunk' ), THEME_PLANS[ THEME_ADDONS[ $addon['slug'] ] ] ); ?>
							</p>
						<?php else : ?>
							<label for="<?php echo esc_attr( $addon['slug'] ); ?>">
								<input type="checkbox" name="<?php echo esc_attr( $setting_name ); ?>" id="<?php echo esc_attr( $addon['slug'] ); ?>" value="1" <?php checked( 1, $options[ $addon['slug'] ] ?? '0' ); ?> />
								<?php esc_html_e( 'Enable Addon', 'chipmunk' ); ?>
							</label>
						<?php endif; ?>
					</div>
				<?php endforeach; ?>
			</div>

			<?php submit_button(); ?>
		</form>

		<?php
		return ob_get_clean();
	}

	/**
	 * Check if Chipmunk plugin is allowed
	 */
	public static function isAddonAllowed( $addon ) {
		if ( ! Settings::isValidLicense() ) {
			return false;
		}

		return Settings::getLicensePrice() >= THEME_ADDONS[ $addon ];
	}

	/**
	 * Check if Chipmunk plugin is enabled
	 */
	public static function isAddonEnabled( $addon ) {
		$option = get_option( self::$option );

		return self::isAddonAllowed( $addon ) && ! empty( $option[ $addon ] );
	}
}
