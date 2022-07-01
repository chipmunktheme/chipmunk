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

		// Output settings content
		add_filter( 'chipmunk_settings_tabs', [ $this, 'add_settings_tab' ] );
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
		<form method="post" enctype="multipart/form-data">
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
