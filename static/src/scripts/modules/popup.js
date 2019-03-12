const Popup = {
  triggers: document.querySelectorAll('[data-popup]'),

  init() {
    if (this.triggers.length) {
      [].forEach.call(this.triggers, trigger =>
        trigger.addEventListener('click', this.openPopup.bind(this)),
      );

      window.addEventListener('load', this.hashHandler.bind(this), false);
      window.addEventListener('panels:close', this.closePopup.bind(this), false);
    }
  },

  openPopup(ev) {
    if (ev) {
      ev.preventDefault();
    }

    // Scroll page to the top
    window.scroll({ top: 0, left: 0, behavior: 'smooth' });

    // Toggle body class
    document.body.classList.add('has-popup-open');

    // Add location hash
    history.pushState(null, null, '#submit');
  },

  closePopup() {
    // Remove location hash
    history.pushState(null, null, location.pathname + location.search);

    // Clear form
    setTimeout(() => this.clearForm(), 500);
  },

  hashHandler() {
    if (location.hash === "#submit") {
      this.openPopup();
    }
  },

  clearForm() {
    const popup = document.querySelector('[data-popup-content]');

    if (popup) {
      const form = popup.querySelector('[data-action]');
      const element = popup.querySelector('[data-action-element]');
      const message = popup.querySelector('[data-action-message]');

      if (form && element && message && message.innerHTML) {
        // Clear form
        form.reset();

        // Show form fields
        element.style.display = 'block';

        // Clear message
        message.innerHTML = '';
      }
    }
  },
};

export default Popup;
