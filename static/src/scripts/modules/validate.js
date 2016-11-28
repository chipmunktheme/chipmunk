'use strict';

var $ = require('jquery');
// require('parsleyjs/src/i18n/pl.js')
require('parsleyjs');

var Validate = function () {
  $('[data-parsley-validate]').parsley();

  $('[data-parsley-validate] .custom-select').on('change', function() {
    $(this).parsley().validate();
  });
};

module.exports = Validate;
