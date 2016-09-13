'use strict';

var $ = require('jquery');

var Helpers = {
  pageData: document.body.dataset,

  request: function (action, data) {
    var requestData = $.extend(data, { 'action': action });

    return $.get(this.pageData.ajaxSource, requestData);
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
