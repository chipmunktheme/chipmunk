<?php

namespace Chipmunk\Addons\Importer;

/**
 * Initializes the plugin settings.
 *
 * @package WordPress
 * @subpackage Chipmunk
 */
class Settings {

	/**
 	 * Class constructor
	 */
	public function __construct( $config ) {
		$this->config = $config;

		add_action( 'admin_init', [ $this, 'register_settings_init' ], 20 );

		// Output settings content
		add_filter( 'chipmunk_settings_tabs', [ $this, 'add_settings_tab' ] );
	}

	/**
	 * Register a settings for Importer tab
	 */
	public function register_settings_init() {
		$setting_name = THEME_SLUG . '_members_pages';
		$pages = get_pages();

		$fields = [
			'chipmunk_login_page_id'            => __( 'Login Page', 'chipmunk' ),
			'chipmunk_register_page_id'         => __( 'Register Page', 'chipmunk' ),
			'chipmunk_lost_password_page_id'    => __( 'Forgot Password Page', 'chipmunk' ),
			'chipmunk_reset_password_page_id'   => __( 'Reset Password Page', 'chipmunk' ),
			'chipmunk_profile_page_id'          => __( 'Profile Page', 'chipmunk' ),
			'chipmunk_dashboard_page_id'        => __( 'Dashboard Page', 'chipmunk' ),
		];

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
				[ $this, 'page_settings_cb' ],
				$setting_name,
				$setting_name . '_section',
				[
					'option' => $setting_name,
					'pages' => $pages,
					'field' => $field,
				]
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
				<option value="<?php echo $page->ID; ?>" <?php echo ( isset( $options[ $args['field'] ] ) ? selected( $options[ $args['field'] ], $page->ID, false ) : '' ); ?>>
					<?php echo esc_html( $page->post_title ); ?>
				</option>
			<?php endforeach; ?>
		</select>

		<?php
	}

	/**
	 * Adds settings tab to the list
	 */
	public function add_settings_tab( $tabs ) {
		$tabs[] = [
			'name'      => $this->config['name'],
			'slug'      => $this->config['slug'],
			'content'   => $this->get_settings_content(),
		];

		return $tabs;
	}

	/**
	 * Returns the settings markup for upvote faker
	 */
	private function get_settings_content() {
		ob_start();

		?>
		<form method="post" action="">
			<h2><?php esc_html_e( 'Bulk resource importer', 'chipmunk' ); ?></h2>

			<p class="description">
				<?php echo esc_html( $this->config['excerpt'] ); ?>
			</p>

			<table class="form-table">
				<tbody>
					<tr>
						<th><?php esc_html_e( 'CSV File', 'chipmunk' ); ?></th>

						<td>
							<input type="file" name="<?php echo esc_attr( THEME_SLUG . '_import_csv' ); ?>" />
							<p class="description">
								<?php esc_html_e( '', 'chipmunk' ); ?>
							</p>
						</td>
					</tr>
					<tr>
						<th><?php esc_html_e( 'Thumbnails', 'chipmunk' ); ?></th>

						<td>
							<input type="file" name="<?php echo esc_attr( THEME_SLUG . '_import_thumbnails' ); ?>" />
							<p class="description">
								<?php esc_html_e( '', 'chipmunk' ); ?>
							</p>
						</td>
					</tr>
				</tbody>
			</table>

			<?php submit_button( esc_html__( 'Import', 'chipmunk' ), 'primary', THEME_SLUG . '_import' ); ?>
			<?php wp_nonce_field( THEME_SLUG . '_import_nonce' ); ?>
		</form>

		<?php
		return ob_get_clean();
	}
}
