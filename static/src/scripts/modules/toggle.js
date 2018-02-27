const $ = require('jquery');

const Toggle = {
  element: '[data-toggle]',

  init() {
    this.triggers =  document.querySelectorAll(this.element);

    if (this.triggers.length) {
      [].forEach.call(this.triggers, trigger => trigger.addEventListener('click', this.handleToggle.bind(this)));
    }
  },

  handleToggle(ev) {
    ev.preventDefault();
    document.body.classList.toggle(`has-${ev.currentTarget.dataset.toggle}-open`);

    // Scroll page to the top
    $('html, body').animate({ scrollTop: 0 }, 500);
  },
};

export default Toggle;
