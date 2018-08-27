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
  },
};

export default Extras;
