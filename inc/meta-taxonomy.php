<?php
/**
 * Taxonomy Meta class
 *
 * @package WordPress
 * @subpackage Chipmunk
 */

if ( ! class_exists( 'ChipmunkTaxonomyImageMeta' ) ) :
	class ChipmunkTaxonomyImageMeta {
		// Defined during __construct() for i18n reasons
		private $labels = array();

		// Array of slugs for the taxonomies we are targeting
		private $taxonomies = array( 'resource-collection' );

		// Our term meta key
		private $term_meta_key = 'image';

		/**
		 * Simple singleton to enforce one instance
		 *
		 * @return ChipmunkTaxonomyImageMeta object
		 */
		static function instance() {
			static $object = null;

			if ( is_null( $object ) ) {
				$object = new ChipmunkTaxonomyImageMeta();
			}

			return $object;
		}

		// prevent cloning
		private function __clone() {}

		// prevent unserialization
		private function __wakeup() {}

		/**
		 * Init the plugin and hook into WordPress
		 */
		private function __construct() {
			// default labels
			$this->labels = array(
				'fieldTitle'       => __( 'Image', 'chipmunk' ),
				'fieldDescription' => __( 'Select which image should represent this collection.', 'chipmunk' ),

				'imageButton'      => __( 'Media Library' ),
				'removeButton'     => __( 'Remove' ),
				'modalTitle'       => __( 'Select or Upload Media' ),
				'modalButton'      => __( 'Select' ),
			);

			// hook into WordPress
			$this->hook_up();
		}

		/**
		 * Hook into WordPress
		 */
		private function hook_up() {
			// register our term meta and sanitize as an integer
			register_meta( 'term', $this->term_meta_key, 'absint' );

			// add our data when term is retrieved
			add_filter( 'get_term', array( $this, 'get_term' ) );
			add_filter( 'get_terms', array( $this, 'get_terms' ) );
			add_filter( 'get_object_terms', array( $this, 'get_terms' ) );

			// we only need to add most hooks on the admin side
			if ( is_admin() ) {
				add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );

				foreach ( $this->taxonomies as $taxonomy ) {
					// add our image field to the taxonomy term forms
					add_action( $taxonomy . '_add_form_fields', array( $this, 'add_form' ) );
					add_action( $taxonomy . '_edit_form_fields', array( $this, 'edit_form' ) );

					// hook into term administration actions
					add_action( 'create_' . $taxonomy, array( $this, 'term_form_save' ) );
					add_action( 'edit_' . $taxonomy, array( $this, 'term_form_save' ) );
				}
			}
		}

		/**
		 * The HTML form for our taxonomy image field
		 *
		 * @param  int    $image_ID  the image ID
		 * @return string the html output for the image form
		 */
		function term_image_field( $image_ID = null ) {
			$image_src = ( $image_ID ) ? wp_get_attachment_image_src( $image_ID, 'thumbnail' ) : array();

			wp_nonce_field( 'chipmunk-taxonomy-meta-form-save', 'chipmunk-taxonomy-meta-nonce' );
			?>
			<input type="button" class="chipmunk-taxonomy-meta-attach button" value="<?php echo esc_attr( $this->labels['imageButton'] ); ?>" />
			<input type="button" class="chipmunk-taxonomy-meta-remove button" value="<?php echo esc_attr( $this->labels['removeButton'] ); ?>" />
			<input type="hidden" id="chipmunk-taxonomy-meta-id" name="chipmunk_image" value="<?php echo esc_attr( $image_ID ); ?>" />
			<p class="description"><?php echo esc_html( $this->labels['fieldDescription'] ); ?></p>

			<p id="chipmunk-taxonomy-meta-container">
				<?php if ( isset( $image_src[0] ) ) : ?>
					<img class="chipmunk-taxonomy-meta-attach" src="<?php print esc_attr( $image_src[0] ); ?>" />
				<?php endif; ?>
			</p>
			<?php
		}

		/**
		 * Add a new form field for the add taxonomy term form
		 */
		function add_form() {
			?>
			<div class="form-field term-image-wrap">
				<label><?php echo esc_html( $this->labels['fieldTitle'] ); ?></label>
				<?php $this->term_image_field(); ?>
			</div>
			<?php
		}

		/**
		 * Add a new form field for the edit taxonomy term form
		 *
		 * @param $term | object | the term object
		 */
		function edit_form( $term ) {
			// ensure we have our term_image data
			if ( ! isset( $term->term_image ) ) {
				$term = $this->get_term( $term, $term->taxonomy );
			}
			?>
			<tr class="form-field">
				<th scope="row" valign="top"><label><?php echo esc_html( $this->labels['fieldTitle'] ); ?></label></th>
				<td class="chipmunk-taxonomy-meta-row">
					<?php $this->term_image_field( $term->term_image ); ?>
				</td>
			</tr>
			<?php
		}

		/**
		 * Handle saving our custom taxonomy term meta
		 *
		 * @param $term_id
		 */
		function term_form_save( $term_id ) {
			// our requirements for saving:
			if (
				// nonce was submitted and is verified
				isset( $_POST['chipmunk-taxonomy-meta-nonce'] ) &&
				wp_verify_nonce( $_POST['chipmunk-taxonomy-meta-nonce'], 'chipmunk-taxonomy-meta-form-save' ) &&

				// taxonomy data and chipmunk_image data was submitted
				isset( $_POST['taxonomy'] ) &&
				isset( $_POST['chipmunk_image'] ) &&

				// the taxonomy submitted is one of the taxonomies we are dealing with
				in_array( $_POST['taxonomy'], $this->taxonomies )
			)
			{
				// get the term_meta and assign it the old_image
				$old_image = get_term_meta( $term_id, $this->term_meta_key, true );

				// sanitize the data and save it as the new_image
				$new_image = absint( $_POST['chipmunk_image'] );

				// if an image was removed, delete the meta data
				if ( $old_image && '' === $new_image ) {
					delete_term_meta( $term_id, $this->term_meta_key );
				}

				// if the new image is not the same as the old update the term_meta
				else if ( $old_image !== $new_image ) {
					update_term_meta( $term_id, $this->term_meta_key, $new_image );
				}
			}
		}

		/**
		 * Add the image data to any relevant get_term() call.  Double duty as a
		 * helper function for this->get_terms().
		 *
		 * @param $_term
		 * @return object
		 */
		function get_term( $_term ) {
			// only modify term when dealing with our taxonomies
			if ( is_object( $_term ) && in_array( $_term->taxonomy, $this->taxonomies ) ) {

				// default to null if not found
				$image_id = get_term_meta( $_term->term_id, $this->term_meta_key, true );
				$_term->term_image = ! empty( $image_id ) ? $image_id : null;
			}
			return $_term;
		}

		/**
		 * Add term_image data to objects when get_terms() or wp_get_object_terms()
		 * is called.
		 *
		 * @param $terms
		 * @return array
		 */
		function get_terms( $terms ) {
			foreach( $terms as $i => $term ) {
				if ( is_object( $term ) && ! empty( $term->taxonomy ) ) {
					$terms[ $i ] = $this->get_term( $term );
				}
			}
			return $terms;
		}

		/**
		 * WordPress action "admin_enqueue_scripts"
		 */
		function admin_enqueue_scripts() {
			// get the screen object to decide if we want to inject our scripts
			$screen = get_current_screen();

			// check if we are on any edit-{taxonomy} screen
			foreach( $this->taxonomies as $taxonomy ) {
				if ( $screen->id == 'edit-' . $taxonomy ) {
					// WP core stuff we need
					wp_enqueue_media();
					wp_enqueue_style( 'thickbox' );

					// register our custom script
					wp_register_script( 'chipmunk-admin-js', THEME_TEMPLATE_URI . '/admin/admin.js', array( 'jquery', 'thickbox', 'media-upload' ), THEME_VERSION );

					// Localize the modal window text so it can be translated
					wp_localize_script( 'chipmunk-admin-js', 'ChipmunkTaxonomyMeta', $this->labels );

					// enqueue the registered and localized script
					wp_enqueue_script( 'chipmunk-admin-js' );
					break;
				}
			}
		}
	}
endif;

/**
 * Initialize the class by calling for its instance
 */
function chipmunk_taxonomy_meta_init() {
	ChipmunkTaxonomyImageMeta::instance();
}
add_action( 'init', 'chipmunk_taxonomy_meta_init' );
