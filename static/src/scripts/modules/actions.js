const $ = require('jquery');

import helpers from '../utils/helpers';

const Actions = {
  trigger: $('[data-action]'),

  init() {
    if (this.trigger.length) {
      this.trigger.on('click', ev => {
        ev.preventDefault();
        ev.stopPropagation();

        this.events[$(ev.currentTarget).data('action')].call(this, $(ev.currentTarget));
      });
    }
  },

  events: {
    submit_upvote($target) {
      var data = $target.data();

      // Enable loading indicator
      $target.addClass('is-loading');

      helpers.request(data.action, data)
        .fail((xhr, ajaxOptions, thrownError) => {
          console.log(xhr.status);
          console.log(xhr.responseText);
          console.log(thrownError);
        })
        .done((response) => {
          console.log('Upvote: ', response);

          setTimeout(() => {
            var $targets = $('[data-post-id="' + response.post + '"]');

            if ($target.length > 0) {
              $targets.html(response.counter);
              $targets.toggleClass('is-active', response.status === 'upvoted');
            }
          }, 250);
        })
        .always(() => {
          // Disable loading indicator
          setTimeout(() => $target.removeClass('is-loading'), 250);
        });
    }
  }
};

export default Actions;
