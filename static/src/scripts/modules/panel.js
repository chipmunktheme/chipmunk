const Panel = {
  init(element = document) {
    this.triggers = Array.from(element.querySelectorAll('[data-panel]'));

    this.triggers.forEach((trigger) => {
      trigger.addEventListener('click', this.handlePanel);
    });

    document.addEventListener('panel:close', this.closePanels.bind(this));
  },

  handlePanel(ev) {
    ev.preventDefault();
    const trigger = ev.currentTarget.dataset.panel;

    document.documentElement.classList.toggle(`has-${trigger}-open`);
  },

  closePanels() {
    this.triggers.forEach((trigger) => {
      const triggerPanel = trigger.dataset.panel;
      const documentClasses = document.documentElement.classList;

      if (documentClasses.contains(`has-${triggerPanel}-open`)) {
        documentClasses.remove(`has-${triggerPanel}-open`);
      }
    });
  },
};

export default Panel;
