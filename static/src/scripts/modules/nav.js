'use strict';

var $ = require('jquery');

var Nav = function () {
  var trigger = '[data-nav-toggle]';

  $(document.body).on('click', trigger, function (ev) {
    ev.preventDefault();
    $(document.body).toggleClass('has-nav-open');
  });
};

module.exports = Nav;
