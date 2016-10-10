'use strict';

var $ = require('jquery');

var Sort = function () {
  $('[data-sort]').on('change', function () {
    var URIParams = window.location.search;
    var sortSlug = 'sort';

    // Update URI params
    if (URIParams === '') {
      URIParams = '?' + sortSlug + '=' + $(this).val();
    } else if (URIParams.indexOf(sortSlug) >= 0) {
      URIParams = URIParams.replace(new RegExp(sortSlug + '=[a-z,-]+', 'g'), sortSlug + '=' + $(this).val());
    } else {
      URIParams = URIParams + '&' + sortSlug + '=' + $(this).val();
    }

    if (!window.location.origin) {
      window.location.origin = window.location.protocol + '//' + window.location.hostname + (window.location.port ? (':' + window.location.port) : '');
    }

    window.location = window.location.origin + window.location.pathname + URIParams;
    return false;
  });
};

module.exports = Sort;
