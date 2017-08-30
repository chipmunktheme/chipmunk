'use strict';

var $ = require('jquery');
var queryString = require('query-string');

var Filter = function () {
  $('[data-filter]').on('change', function () {
    var params = queryString.parse(location.search);

    $('[data-filter]').each(function () {
      var name = $(this).data('filter');
      var value = $(this).val();

      if (value !== '') {
        params[name] = value;
      }
    });

    location.search = queryString.stringify(params);
  });
};

module.exports = Filter;
