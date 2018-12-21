const axios = require('axios');

axios.interceptors.request.use(config => {
  // Prefix the action name
  config.data.set('action', 'chipmunk_' + config.data.get('action'));

  return config;
}, error => Promise.reject(error));

const Actions = {
  triggers: [],

  init(element = document) {
    const triggers = element.querySelectorAll('[data-action]');

    if (triggers.length) {
      this.triggers = triggers;
    }

    if (this.triggers.length) {
      [].forEach.call(this.triggers, (trigger) => {
        if (trigger.hasAttribute('action')) {
          trigger.addEventListener('submit', this.handleEvent.bind(this));
        } else {
          trigger.addEventListener('click', this.handleEvent.bind(this));
        }
      });
    }
  },

  handleEvent(ev, trigger) {
    if (ev) {
      if (!trigger) {
        trigger = ev.currentTarget;
      }

      if (trigger.getAttribute('action') === '#') {
        ev.preventDefault();
        ev.stopPropagation();
      }
    }

    this.runActions(trigger, [{ data: trigger.dataset }]);
  },

  runActions(trigger, actions) {
    const requests = [];

    if (actions && actions.length) {
      // Enable loading indicator
      trigger.classList.add('is-loading');

      // Disable the current trigger
      trigger.setAttribute('disabled', true);

      // Loop through the actions provided
      actions.forEach(action => {
        const formData = new FormData(trigger.hasAttribute('action') ? trigger : document.createElement('form'));

        // Extend formData with trigger data attributes
        Object.keys(action.data).forEach((key) => {
          formData.append(key, action.data[key]);
        });

        // Assign callback function
        action.callback = action.callback || this.callbacks[action.data.action] || (() => {});

        // Assign new request
        requests.push(axios.post(document.body.dataset.ajaxSource, formData));
      });

      // Run concurrent action
      axios.all(requests)
        .then(axios.spread((...args) => {
          args.forEach((arg, index) => {
            setTimeout(() => {
              actions[index].callback(trigger, arg.data, actions[index].data.action);

              // Disable loading indicator
              trigger.classList.remove('is-loading');

              // Enable the current trigger
              trigger.removeAttribute('disabled');
            }, 250);
          });
        }));
    }
  },

  callbacks: {
    submit_resource: (trigger, { success, data }, action) => {
      const element = trigger.querySelector(`[data-action-element=${action}]`);
      const message = trigger.querySelector(`[data-action-message=${action}]`);

      if (message) {
        message.style.display = 'block';
        message.dataset.status = success ? 'success' : 'error';
        message.innerHTML = data;

        if (success) {
          element.style.display = 'none';
        }
      }
    },

    toggle_bookmark: (trigger, { success, data }) => {
      if (success) {
        var targets = document.querySelectorAll(`[data-action-post-id="${data.post}"]`);

        [].forEach.call(targets, target => {
          target.classList.toggle('is-active', data.status === 'bookmarked');
          target.innerHTML = data.icon;
        });
      } else {
        const loginUrl = document.body.dataset.loginUrl;

        if (loginUrl) {
          window.location = loginUrl;
        }
      }
    },

    submit_upvote: (trigger, { success, data }) => {
      if (success) {
        var targets = document.querySelectorAll(`[data-post-id="${data.post}"]`);

        [].forEach.call(targets, (target) => {
          target.innerHTML = data.counter;
          target.classList.toggle('is-active', data.status === 'upvoted');
        });
      }
    },

    load_posts: (trigger, { success, data }, action) => {
      const element = document.querySelector(`[data-action-element=${action}]`);

      if (element) {
        if (success) {
          element.insertAdjacentHTML('beforeend', data);
          trigger.dataset.page = parseInt(trigger.dataset.page) + 1;
        } else {
          trigger.parentNode.insertAdjacentHTML('beforeend', `<p class="text_center">${data}</p>`);
          trigger.parentNode.removeChild(trigger);
        }

        // Rebind actions listeners
        Actions.init(element);
      }
    },
  },
};

export default Actions;
