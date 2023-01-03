import axios from 'axios';

const Actions = {
  http: null,

  init(element = document) {
    const { ajaxUrl, loginUrl } = window;

    this.settings = { ajaxUrl, loginUrl };
    this.triggers = Array.from(element.querySelectorAll('[data-action]:not([data-type])'));

    this.http = axios.create({
      transformRequest: [
        (data) => {
          // Prefix the action name
          data.set('action', `chipmunk_${data.get('action')}`);

          return data;
        },
      ],
    });

    this.triggers.forEach((trigger) => {
      if (!trigger.dataset.listening) {
        if (trigger.hasAttribute('action')) {
          trigger.addEventListener('submit', this.handleEvent.bind(this));
        } else {
          trigger.addEventListener('click', this.handleEvent.bind(this));
        }

        // Only bind the event once on this element
        trigger.dataset.listening = true;
      }
    });
  },

  handleEvent(ev, trigger) {
    if (ev) {
      if (!trigger) {
        trigger = ev.currentTarget;
      }

      ev.preventDefault();
      ev.stopPropagation();
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
      actions.forEach((action) => {
        const formData = new FormData(trigger.hasAttribute('action') ? trigger : document.createElement('form'));

        // Extend formData with trigger data attributes
        Object.keys(action.data).forEach((key) => {
          formData.append(key, action.data[key]);
        });

        // Assign callback function
        action.callback = action.callback || this.callbacks[action.data.action] || (() => {});

        // Assign new request
        requests.push(this.http.post(this.settings.ajaxUrl, formData));
      });

      // Run concurrent action
      axios.all(requests).then(
        axios.spread((...args) => {
          args.forEach((arg, index) => {
            setTimeout(() => {
              actions[index].callback(trigger, arg.data, actions[index].data.action);

              // Disable loading indicator
              trigger.classList.remove('is-loading');

              // Enable the current trigger
              trigger.removeAttribute('disabled');
            }, 250);
          });
        }),
      );
    }
  },

  handlers: {
    toggle: (trigger, { success, data }, action) => {
      if (success) {
        const targets = document.querySelectorAll(`[data-action="${action}"][data-action-post-id="${data.post}"]`);

        targets.forEach((target) => {
          target.classList[data.status]('is-active');
          target.innerHTML = data.content;
        });
      } else {
        if (this.settings.loginUrl) {
          window.location = this.settings.loginUrl;
        }
      }
    },
  },

  callbacks: {
    submit_resource: (trigger, { success, data }, action) => {
      const element = trigger.querySelector(`[data-action-element=${action}]`);
      const message = trigger.querySelector(`[data-action-message=${action}]`);

      if (message) {
        message.style.display = null;
        message.dataset.status = success ? 'success' : 'error';
        message.innerHTML = data;

        if (success) {
          element.style.display = 'none';
        }
      }
    },

    load_posts: (trigger, { success, data }, action) => {
      const element = document.querySelector(`[data-action-element=${action}]`);

      if (element) {
        if (success) {
          element.insertAdjacentHTML('beforeend', data);
          trigger.dataset.page = parseInt(trigger.dataset.page, 10) + 1;
        } else {
          trigger.parentNode.insertAdjacentHTML('beforeend', `<p class="l-header__copy">${data}</p>`);
          trigger.parentNode.removeChild(trigger);
        }

        // Rebind actions listeners
        Actions.init(element);
      }
    },

    toggle_bookmark: (trigger, response, action) => {
      Actions.handlers.toggle(trigger, response, action);
    },

    toggle_upvote: (trigger, response, action) => {
      Actions.handlers.toggle(trigger, response, action);
    },

    submit_rating: (trigger, { success, data }) => {
      const element = document.querySelector(`[data-action-rating="${data.post}"]`);

      if (element) {
        if (success) {
          element.innerHTML = data.content;
        }
      }
    },
  },
};

export default Actions;
