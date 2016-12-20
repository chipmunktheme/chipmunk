'use strict';

var $ = require('jquery');
var helpers = require('../utils/helpers');

var Actions = {
  $trigger: $('[data-action]'),

  init: function () {
    if (this.$trigger.length) {
      this.$trigger.on('click', function (ev) {
        ev.preventDefault();
        ev.stopPropagation();

        this.events[$(ev.currentTarget).data('action')].call(this, $(ev.currentTarget))
      }.bind(this));
    }
  },

  events: {
    process_upvote: function($target) {
      var data = $target.data();

      helpers.request(data.action, data)
        .fail(function (xhr, ajaxOptions, thrownError) {
           console.log(xhr.status);
           console.log(xhr.responseText);
           console.log(thrownError);
         })
        .done(function (response) {
          console.log('Upvote: ', response);

          $target.html(response.counter);
          $target.toggleClass('is-active', response.status === 'liked');
        }.bind(this));
    }
  }
};

module.exports = Actions;
