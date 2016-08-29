'use strict';

var $ = require('jquery');

var Search = function () {
  var $trigger = $('[data-search-toggle]');

  $trigger.on('click', function (ev) {
    ev.preventDefault();
    $(document.body).toggleClass('has-search-open');
  });
};

module.exports = Search;
