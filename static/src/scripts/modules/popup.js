const Popup = {
  triggers: document.querySelectorAll('[data-popup]'),

  init() {
    if (this.triggers.length) {
      [].forEach.call(this.triggers, trigger =>
        trigger.addEventListener('click', this.openPopup.bind(this)),
      );

      window.addEventListener('load', this.hashHandler.bind(this), false);
      window.addEventListener('hashchange', this.hashHandler.bind(this), false);
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
    history.pushState(null, null, location.pathname);
  },

  hashHandler() {
    if (location.hash === "#submit") {
      this.openPopup();
    }
  },
};

export default Popup;
