import helpers from '../utils/helpers';

const Dropdown = {
  blockClosing: false,

  init(element = document) {
    this.triggers = Array.from(element.querySelectorAll('[data-dropdown]'));

    this.triggers.forEach((trigger) => {
      const event = trigger.dataset.dropdown;

      switch (event) {
        case 'click':
          this.handleListener(trigger, event);
          break;
        case 'responsive':
          this.handleListener(trigger, this.isTouchDevice() || helpers.getBreakpoint() !== 'lg' ? 'click' : 'hover');
          break;
        default:
          this.handleListener(trigger, 'hover');
      }
    });

    element.addEventListener('dropdown:close', () => this.closeDropdowns(null, true), false);
  },

  handleListener(trigger, event) {
    if (event === 'click') {
      trigger.addEventListener(event, (ev) => {
        this.handleDropdown(ev, trigger.parentNode);
      });
    }

    if (event === 'hover') {
      trigger.parentNode.addEventListener('mouseenter', (ev) => {
        trigger.style.pointerEvents = 'none';
        this.handleDropdown(ev, trigger.parentNode, 'add');
        this.blockClosing = true;
      });

      trigger.parentNode.addEventListener('mouseleave', (ev) => {
        trigger.style.pointerEvents = 'all';
        this.handleDropdown(ev, trigger.parentNode, 'remove');
        this.blockClosing = false;
      });
    }
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

  closeDropdowns(exclude = null, force = false) {
    if (this.blockClosing && !force) {
      return;
    }

    this.triggers.forEach((trigger) => {
      if (force || (!exclude || trigger.parentNode !== exclude) && !trigger.dataset.dropdownBlock) {
        this.handleDropdown(null, trigger.parentNode, 'remove');
      }
    });
  },

  isTouchDevice() {
    return (('ontouchstart' in window) ||
       (navigator.maxTouchPoints > 0) ||
       (navigator.msMaxTouchPoints > 0));
  },
};

export default Dropdown;
