import $http from '../utils/http';

const Actions = {
  init(selector = document) {
    this.triggers = selector.querySelectorAll('[data-action]');

    [].forEach.call(this.triggers, ($trigger) => {
      if ($trigger.hasAttribute('action')) {
        $trigger.addEventListener('submit', this.handleEvent.bind(this));
      } else {
        $trigger.addEventListener('click', this.handleEvent.bind(this));
      }
    });
  },

  handleEvent(ev) {
    ev.preventDefault();
    ev.stopPropagation();

    const trigger = ev.currentTarget;
    const data = trigger.dataset;

    this.runAction(trigger, data);
  },

  runAction(trigger, data) {
    const formData = new FormData(trigger.hasAttribute('action') ? trigger : document.createElement('form'));

    // Enable loading indicator
    trigger.classList.add('is-loading');
    trigger.setAttribute('disabled', true);

    // Extend formData with trigger data attributes
    Object.keys(data).forEach((key) => {
      formData.append(key, data[key]);
    });

    setTimeout(() => {
      $http.post(document.body.dataset.ajaxSource, formData)
      // Run action callback
      .then((response) => {
        if (this.callbacks[data.action]) {
          this.callbacks[data.action](trigger, response, data.action, 'success');
        }
      })

      // Log errors
      .catch((response) => {
        console.error(response);

        if (this.callbacks[data.action]) {
          this.callbacks[data.action](trigger, response, data.action, 'error')
        }
      })

      // Disable loading indicator
      .then(() => {
        trigger.classList.remove('is-loading');
        trigger.removeAttribute('disabled');
      });
    }, 500);
  },

  callbacks: {
    submit_resource: (trigger, response, action, status) => {
      const element = trigger.querySelector(`[data-action-element=${action}]`);
      const message = trigger.querySelector(`[data-action-message=${action}]`);

      if (message) {
        message.style.display = 'block';
        message.dataset.status = status;
        message.innerHTML = response;

        if (status === 'success') {
          element.style.display = 'none';
        }
      }
    },

    submit_upvote: (trigger, response, action, status) => {
      var targets = document.querySelectorAll(`[data-post-id="${response.post}"]`);

      [].forEach.call(targets, (target) => {
        target.innerHTML = response.counter;
        target.classList.toggle('is-active', response.status === 'upvoted');
      });
    },

    load_posts: (trigger, response, action, status) => {
      const element = document.querySelector(`[data-action-element=${action}]`);

      if (element) {
        if (status == 'success') {
          element.insertAdjacentHTML('beforeend', response);
          trigger.dataset.page = parseInt(trigger.dataset.page) + 1;
        } else {
          trigger.parentNode.insertAdjacentHTML('beforeend', `<p class="text_center">${response}</p>`);
          trigger.parentNode.removeChild(trigger);
        }

        // Rebind actions listeners
        Actions.init(element);
      }
    },
  },
};

export default Actions;
