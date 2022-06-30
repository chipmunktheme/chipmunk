<?php

namespace Chipmunk\Settings;

use \Chipmunk\Settings;

/**
 * A Faker settings class
 *
 * @package WordPress
 * @subpackage Chipmunk
 */
class Faker {

	/**
	 * Setting name
	 *
	 * @var string
	 */
	private $name = 'Faker';

	/**
	 * Setting slug
	 *
	 * @var string
	 */
	private $slug = 'faker';

	/**
	 * Allowed types to be generated
	 *
	 * @var array
	 */
	private $types = [];

	/**
	 * Initialize the class.
	 *
	 * @since 1.0.0
	 */
	function __construct( ) {
		$this->types = [
			[
				'name' => __( 'Upvotes', 'chipmunk' ),
				'slug' => 'upvote',
				'types' => [ 'resource' ],
			],
			[
				'name' => __( 'Post views', 'chipmunk' ),
				'slug' => 'post_view',
				'types' => [ 'post', 'resource' ],
			],
		];

		// Handle form action
		add_action( 'admin_init', [ $this, 'maybe_generate' ] );

		// Output settings content
		add_filter( 'chipmunk_settings_tabs', [ $this, 'add_settings_tab' ] );
	}

	/**
	 * Checks if a generator action was submitted.
	 */
	public function maybe_generate() {
		foreach ( $this->types as $type ) {
			if ( isset( $_POST[THEME_SLUG . '_generator_' . $type['slug']] ) ) {
				self::generate( $type['slug'], (int) $_POST[THEME_SLUG . '_generator_' . $type['slug'] . '_start'], (int) $_POST[THEME_SLUG . '_generator_' . $type['slug'] . '_end'], $type['types'] );
			}
		}
	}

	/**
	 * Generate fake values for upvote and view counters
	 */
	private function generate( $type, $start, $end, $post_types ) {
		check_admin_referer( THEME_SLUG . '_generator_' . $type . '_nonce' );

		if ( empty( $start ) && empty( $end ) ) {
			Settings::add_settings_error( $this->slug, __( 'You need to provide both values for the range!', 'chipmunk' ) );
			return null;
		}

		$db_key = '_' . THEME_SLUG . '_' . $type . '_count';

		$posts = get_posts( [
			'post_type'         => $post_types,
			'post_status'       => 'any',
			'posts_per_page'    => -1,
		] );

		foreach ( $posts as $post ) {
			$count = (int) get_post_meta( $post->ID, $db_key, true );

			if ( isset( $count ) && is_numeric( $count ) ) {
				update_post_meta( $post->ID, $db_key, $count + rand( $start, ( $start > $end ? $start : $end ) ) );
			}
		}

		Settings::add_settings_error( $this->slug, __( 'Fake counters successfully generated!', 'chipmunk' ), 'success' );
	}

	/**
	 * Adds settings tab to the list
	 */
	public function add_settings_tab( $tabs ) {
		$tabs[] = [
			'name'      => $this->name,
			'slug'      => $this->slug,
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
		<h2><?php esc_html_e( 'Fake counter generators', 'chipmunk' ); ?></h2>

		<p class="description">
			<?php esc_html_e( 'Adds fake values for your upvote or view counters.', 'chipmunk' ); ?>
		</p>

		<table class="form-table">
			<tbody>
				<?php foreach ( $this->types as $type ) : ?>
					<tr>
						<th><?php echo esc_html( $type['name'] ); ?></th>

						<td>
							<form method="post" action="">
								<input type="number" class="small-text" name="<?php echo esc_attr( THEME_SLUG . '_generator_' . $type['slug'] . '_start' ); ?>" value="" min="0" placeholder="<?php esc_attr_e( 'Start', 'chipmunk' ); ?>" />
								<input type="number" class="small-text" name="<?php echo esc_attr( THEME_SLUG . '_generator_' . $type['slug'] . '_end' ); ?>" value="" min="0" placeholder="<?php esc_attr_e( 'End', 'chipmunk' ); ?>" />
								<?php submit_button( esc_html__( 'Generate', 'chipmunk' ), 'primary', THEME_SLUG . '_generator_' . $type['slug'], false ); ?>
								<?php wp_nonce_field( THEME_SLUG . '_generator_' . $type['slug'] . '_nonce' ); ?>
							</form>

							<p class="description">
								<?php printf( esc_html__( 'Pick a range to generate %1$s from.', 'chipmunk' ), esc_html( strtolower( $type['name'] ) ) ); ?>
							</p>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>

		<?php
		return ob_get_clean();
	}
}
