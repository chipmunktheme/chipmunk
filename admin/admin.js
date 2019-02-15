(function($) {
  var taxonomyTermImage = {
    // modal frame
    file_frame: null,

    // modal settings
    settings: {
      title: ChipmunkTaxonomyMeta.modalTitle,
      button: { text: ChipmunkTaxonomyMeta.modalButton },
      multiple: false,
      library: {
        type: 'image'
      }
    },

    /**
     * Initialize script
     */
    init: function(){
      var _this = this;

      // delegate our click handler so that the image itself is clickable.  because that's cool
      $('body').on('click', '.chipmunk-taxonomy-meta-attach', function ( event ) {
        event.preventDefault();

        _this.openModal();
      });

      // remove button
      $('.chipmunk-taxonomy-meta-remove').click( _this.removeImage );
    },

    /**
     * Remove the current image by emptying the container and field
     */
    removeImage: function(){
      $('#chipmunk-taxonomy-meta-container').html('');
      $('#chipmunk-taxonomy-meta-id').val('');
    },

    /**
     * Open the media modal window
     * - http://mikejolley.com/2012/12/using-the-new-wordpress-3-5-media-uploader-in-plugins/
     * - https://gist.github.com/pippinsplugins/29bebb740e09e395dc06
     */
    openModal: function(){
      var _this = this;

      // If the media frame already exists, reopen it.
      if ( _this.file_frame ) {
        _this.file_frame.open();
        return;
      }

      // Create the media frame.
      _this.file_frame = wp.media.frames.file_frame = wp.media( _this.settings );

      // When an image is selected, run a callback.
      _this.file_frame.on( 'select', function() {

        _this.file_frame.state()
          .get('selection')

          // handle each attachment
          .map( _this.updateImage);
      });

      // Finally, open the modal
      _this.file_frame.open();
    },

    /**
     * Handle a single selected image attachment
     *
     * @param attachment
     */
    updateImage: function( attachment ){
      // the selected image
      var image = attachment.toJSON();

      // get image sizes data
      var sizes = attachment.get('sizes');
      var size = ( typeof sizes.thumbnail === 'undefined' ) ? sizes.full : sizes.thumbnail;

      //image.id
      $('#chipmunk-taxonomy-meta-id').val( image.id );

      //sizes.thumbnail.url
      $('#chipmunk-taxonomy-meta-container').html("<img class='chipmunk-taxonomy-meta-attach' src='" + size.url + "' />");
    }
  };

  $(document).ready(function(){
    taxonomyTermImage.init();
  });

})(jQuery);
