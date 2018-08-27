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

    // Toggle the body class
    document.body.classList.toggle(`has-${ev.currentTarget.dataset.toggle}-open`);
  },
};

export default Toggle;
