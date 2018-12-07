const $ = require('jquery');

require('select2')();

const Extras = {
  init() {
    // Custom select
    $('select').each(function () {
      $(this).select2({
        minimumResultsForSearch: Infinity,
        dropdownParent: $(this).parent(),
      });
    });

    // Make images full-width
    $(window).on('load resize', function () {
      $('[class*="offset"] .alignfull').each(function () {
        $(this).css({
          width: '100vw',
          maxWidth: 'none',
          marginLeft: () => {
            return 0 - parseInt(($(document).width() - $(this).parent().width()) / 2);
          },
        });
      });
    });
  },
};

export default Extras;
