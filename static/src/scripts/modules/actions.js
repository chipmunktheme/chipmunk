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

        this.events[$(ev.currentTarget).data('action')].call(this, $(ev.currentTarget));
      }.bind(this));
    }
  },

  events: {
    submit_upvote: function ($target) {
      var data = $target.data();

      // Enable loading indicator
      $target.addClass('is-loading');

      helpers.request(data.action, data)
        .fail(function (xhr, ajaxOptions, thrownError) {
          console.log(xhr.status);
          console.log(xhr.responseText);
          console.log(thrownError);
        })
        .done(function (response) {
          console.log('Upvote: ', response);
          
          setTimeout(function () {
            var $targets = $('[data-post-id="' + response.post + '"]');

            if ($target.length > 0) {
              $targets.html(response.counter);
              $targets.toggleClass('is-active', response.status === 'upvoted');
            }
          }, 250);
        })
        .always(function () {
          // Disable loading indicator
          setTimeout(function () {
            $target.removeClass('is-loading');
          }, 250);
        });
    }
  }
};

module.exports = Actions;
