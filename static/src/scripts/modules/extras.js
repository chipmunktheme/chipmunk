'use strict';

var $ = require('jquery');
window.$ = $;
window.jQuery = $;

require('select2');
require('slick-carousel');

var Extras = function () {
  // Custom select
  $('.custom-select').select2({
    minimumResultsForSearch: Infinity
  });
};

module.exports = Extras;
