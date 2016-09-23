'use strict';

var $ = require('jquery');

var Popup = function () {
  var $trigger = $('[data-popup-toggle]');

  $trigger.on('click', function (ev) {
    ev.preventDefault();
    $(document.body).removeClass('has-nav-open');
    $(document.body).toggleClass('has-popup-open');
    $('html, body').animate({ scrollTop: 0 }, 500);
  });
};

module.exports = Popup;
