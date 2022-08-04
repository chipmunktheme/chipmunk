const Popup = {
  init(element = document) {
    this.triggers = Array.from(element.querySelectorAll('[data-popup]'));

    this.triggers.forEach((trigger) => {
      trigger.removeEventListener('click', this.handlePopup);
      trigger.addEventListener('click', this.handlePopup);
    });

    window.addEventListener('load', this.handleHash.bind(this), false);
    document.addEventListener('popup:close', this.closePopup.bind(this));
  },

  handlePopup(ev, instance = null) {
    ev.preventDefault();

    const trigger = ev.currentTarget;
    const target = instance || trigger.dataset.popup;

    if (trigger && target) {
      Popup.openPopup();
    } else {
      Popup.closePopup();
    }
  },

  openPopup(ev) {
    if (ev) {
      ev.preventDefault();
    }

    // Add popup class
    document.body.classList.add('has-popup-open');

    // Add location hash
    window.history.pushState(null, null, '#submit');
  },

  closePopup() {
    // Remove popup class
    document.body.classList.remove('has-popup-open');

    // Remove location hash
    window.history.pushState(null, null, ' ');

    // Clear form
    setTimeout(() => this.clearForm(), 500);
  },

  handleHash() {
    if (window.location.hash === '#submit') {
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
        element.style.display = null;

        // Clear message
        message.innerHTML = '';
      }
    }
  },
};

export default Popup;
