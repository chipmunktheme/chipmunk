'use strict';

var $ = require('jquery');

var Helpers = {
  request: function (action, data) {
    var requestData = $.extend(data, { 'action': action });
    
    if (!ajaxurl) {
      return false;
    }

    return $.get(ajaxurl, requestData);
  },

  convertToObject: function (params) {
    var object = {};

    for (var param in params) {
      object[params[param].name] = params[param].value;
    }

    return object;
  }
};

module.exports = Helpers;
