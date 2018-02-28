const Tabs = {
  element: '[data-tabs]',

  init() {
    this.tabs = document.querySelectorAll(this.element);

    if (this.tabs.length) {
      [].forEach.call(this.tabs, tab => {
        const toggles = tab.querySelectorAll('[data-tabs-toggle]');
        const panels = tab.querySelectorAll('[data-tabs-panel]');

        this.bind(toggles, panels);
      });
    }
  },

  bind(toggles, panels) {
    [].forEach.call(toggles, (toggle, index) => {
      toggle.addEventListener('click', () => {
        this.show(index, toggles, panels);
      });
    });
  },

  show(index, toggles, panels) {
    [].forEach.call(toggles, toggle => {
      toggle.classList.remove('active');
    });

    [].forEach.call(panels, panel => {
      panel.classList.remove('active');
    });

    toggles[index].classList.add('active');
    panels[index].classList.add('active');

    window.dispatchEvent(new CustomEvent('tabs:show'));
  }
};

export default Tabs;
