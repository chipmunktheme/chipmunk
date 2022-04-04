const Dropdown = {
  init(element = document) {
    this.triggers = Array.from(element.querySelectorAll('[data-dropdown]'));

    this.triggers.forEach((trigger) => {
      const event = trigger.dataset.dropdown;

      if (event === 'click') {
        trigger.addEventListener(event, (ev) => this.handleDropdown.call(this, ev, ev.currentTarget.parentNode), false);
      } else {
        trigger.addEventListener(
          'mouseover',
          (ev) => this.handleDropdown.call(this, ev, ev.currentTarget, 'add'),
          false,
        );
        trigger.addEventListener(
          'mouseout',
          (ev) => this.handleDropdown.call(this, ev, ev.currentTarget, 'remove'),
          false,
        );
      }
    });

    element.addEventListener('dropdown:close', this.closeDropdowns.bind(this), false);
  },

  handleDropdown(ev, element, method = 'toggle') {
    if (ev) {
      ev.preventDefault();

      // Close other dropdowns
      this.closeDropdowns(element);
    }

    // Update dropdown class
    element.classList[method]('is-open');
  },

  closeDropdowns(exclude) {
    this.triggers.forEach((trigger) => {
      if (trigger !== exclude && trigger.parentNode !== exclude) {
        this.handleDropdown(null, trigger, 'remove');
        this.handleDropdown(null, trigger.parentNode, 'remove');
      }
    });
  },
};

export default Dropdown;
