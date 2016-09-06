'use strict';

var $ = require('jquery');

var Popup = function () {
  var $trigger = $('[data-popup-toggle]');

  $trigger.on('click', function (ev) {
    ev.preventDefault();
    $(document.body).toggleClass('has-popup-open');
  });
};

module.exports = Popup;
