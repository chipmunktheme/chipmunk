'use strict';

var $ = require('jquery');
var helpers = require('../utils/helpers');

var RemoteForm = {
  $form: $('[data-remote-form]'),
  $message: $('[data-remote-message]'),

  init: function () {
    if (this.$form.length) {
      this.$form.on('submit', this.events.onFormSubmit.bind(this));
    }
  },

  events: {
    onFormSubmit: function (ev) {
      ev.preventDefault();

      var $form = $(ev.target);
      var formAction = $form.data('remote-form');
      var formData = $form.serializeArray();
      var formObject = helpers.convertToObject(formData);

      helpers.request(formAction, formObject)
        .always(function (response) {
          console.log('Remote form: ', response);

          if (this.$message.length) {
            if (response.success) {
              $form.hide();
            }

            this.$message.text(response.data).show();
          }
        }.bind(this));
    }
  }
};

module.exports = RemoteForm;
