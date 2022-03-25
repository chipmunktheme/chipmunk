<?php

namespace Chipmunk\Addons\Members;

/**
 * Initializes the plugin settings.
 *
 * @package WordPress
 * @subpackage Chipmunk
 */
class Settings {

	/**
 	 * Class constructor
	 *
	 * @return void
	 */
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'register_settings_page' ), 20 );
		add_action( 'admin_init', array( $this, 'register_settings_init' ), 20 );
	}

	/**
	 * Register settings page to the admin_menu action hook
	 */
	public function register_settings_page() {
		add_submenu_page(
			THEME_SLUG,
			__( 'Members', 'chipmunk' ),
			__( 'Members', 'chipmunk' ),
			'manage_options',
			THEME_SLUG . '_members',
			array( $this, 'render_settings_page' )
		);
	}

	/**
	 * Register a settings for Members page
	 */
	public function register_settings_init() {
		$this->init_page_settings();
	}

	/**
	 * Init page settings
	 */
	public function init_page_settings() {
		$setting_name = THEME_SLUG . '_members_pages';
		$pages = get_pages();

		$fields = array(
			'chipmunk_login_page_id'            => __( 'Login Page', 'chipmunk' ),
			'chipmunk_register_page_id'         => __( 'Register Page', 'chipmunk' ),
			'chipmunk_lost_password_page_id'    => __( 'Forgot Password Page', 'chipmunk' ),
			'chipmunk_reset_password_page_id'   => __( 'Reset Password Page', 'chipmunk' ),
			'chipmunk_profile_page_id'          => __( 'Profile Page', 'chipmunk' ),
			'chipmunk_dashboard_page_id'        => __( 'Dashboard Page', 'chipmunk' ),
		);

		// If the option don't exist, create it.
		if ( false == get_option( $setting_name ) ) {
			add_option( $setting_name );
		}

		// Register section
		add_settings_section(
			$setting_name . '_section',
			__( 'Page Options', 'chipmunk' ),
			null,
			$setting_name
		);

		foreach ( $fields as $field => $title ) {
			add_settings_field(
				$field,
				$title,
				array( $this, 'page_settings_cb' ),
				$setting_name,
				$setting_name . '_section',
				array(
					'option' => $setting_name,
					'pages' => $pages,
					'field' => $field,
				)
			);
		}

		register_setting( $setting_name, $setting_name );
	}

	public function page_settings_cb( $args ) {
		$options = get_option( $args['option'] );
		?>

		<select name="<?php echo esc_attr( $args['option'] ); ?>[<?php echo esc_attr( $args['field'] ); ?>]">
			<option value="">
				<?php esc_html_e( 'Choose page', 'chipmunk' ); ?>
			</option>

			<?php foreach ( $args['pages'] as $page ) : ?>
				<option value="<?php echo $page->ID; ?>" <?php echo ( isset( $options[$args['field']] ) ? selected( $options[$args['field']], $page->ID, false ) : '' ); ?>>
					<?php echo esc_html( $page->post_title ); ?>
				</option>
			<?php endforeach; ?>
		</select>

		<?php
	}

	/**
	 * Render settings page
	 */
	public function render_settings_page() {
		if ( ! current_user_can( 'manage_options' ) ) {
			wp_die( esc_html__( 'Unauthorized user.', 'chipmunk' ) );
		}

		\Chipmunk\Helpers::get_template_part( 'addons/members/admin/settings' );
	}
}
