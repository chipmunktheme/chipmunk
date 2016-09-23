'use strict';

var $ = require('jquery');

var Search = function () {
  var $trigger = $('[data-search-toggle]');

  $trigger.on('click', function (ev) {
    ev.preventDefault();
    $(document.body).toggleClass('has-search-open');

    // Focus or blur search field depending on current state of search
    $('input[type="search"]').trigger($(document.body).hasClass('has-search-open') ? 'focus' : 'blur');
  });
};

module.exports = Search;
