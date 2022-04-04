<?php

namespace Chipmunk\Settings;

/**
 * A Addons settings class
 *
 * @package WordPress
 * @subpackage Chipmunk
 */
class Addons extends \Chipmunk\Settings {

	/**
	 * Setting name
	 *
	 * @var string
	 */
	private $name = 'Addons';

	/**
	 * Setting slug
	 *
	 * @var string
	 */
	private $slug = 'addons';

	/**
	 * Initialize the class
	 */
	function __construct( ) {
		add_action( 'admin_init', array( $this, 'register_option' ) );

		// Output settings content
		add_filter( 'chipmunk_settings_tabs', array( $this, 'add_settings_tab' ) );
	}

	/**
	 * Registers the option used to store the license key in the options table.
	 */
	public function register_option() {
		register_setting(
			THEME_SLUG,
			THEME_SLUG . "_{$this->slug}"
		);
	}

	/**
	 * Adds settings tab to the list
	 */
	public function add_settings_tab( $tabs ) {
		$tabs[] = array(
			'name'      => $this->name,
			'slug'      => $this->slug,
			'content'   => $this->get_settings_content(),
		);

		return $tabs;
	}

	/**
	 * Returns the settings markup for upvote faker
	 */
	private function get_settings_content() {
		$addons = apply_filters( 'chipmunk_settings_addons', array() );
		$options = get_option( THEME_SLUG . "_{$this->slug}" );

		ob_start();

		?>

		<form action="options.php" method="post">
			<?php settings_fields( THEME_SLUG ); ?>

			<div class="chipmunk__addons">
				<?php foreach ( $addons as $addon ) : ?>
					<?php $setting_name = THEME_SLUG . "_{$this->slug}[{$addon['slug']}]"; ?>

					<div class="chipmunk__addons-item chipmunk__box">
						<h3 class="chipmunk__addons-title"><?php echo esc_html( $addon['name'] ); ?></h3>
						<p class="chipmunk__addons-excerpt"><?php echo esc_html( $addon['excerpt'] ); ?></p>

						<label for="<?php echo esc_attr( $addon['slug'] ); ?>">
							<input type="checkbox" name="<?php echo esc_attr( $setting_name ); ?>" id="<?php echo esc_attr( $addon['slug'] ); ?>" value="1" <?php checked( 1, $options[ $addon['slug'] ] ?? '0' ); ?> />
							Enable <?php echo esc_html( $addon['name'] ); ?> Addon
						</label>
					</div>
				<?php endforeach; ?>
			</div>

			<?php submit_button(); ?>
		</form>

		<?php
		return ob_get_clean();
	}
}
