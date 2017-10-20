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
      } else {
        delete params[name];
      }
    });

    var search = queryString.stringify(params);
    var pageRegex = /\/page\/[0-9]+\//g;

    if (params['tag']) {
      location.href = location.origin + location.pathname.replace(pageRegex, '/') + '?' + search;
    } else {
      location.search = search;
    }
  });
};

module.exports = Filter;
