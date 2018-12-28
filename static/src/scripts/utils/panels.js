const Panels = {
  event: new Event('panels:close'),

  init() {
    window.closePanels = () => {
      const bodyClasses = ['has-nav-open', 'has-search-open', 'has-popup-open'];

      document.body.classList.remove(...bodyClasses);
      document.dispatchEvent(this.event);
    };

    const listener = ev => {
      const name = 'dropdown';
      const path = ev.path || (ev.composedPath && ev.composedPath());

      if (path) {
        let matched = path.some(element => {
          return (element instanceof HTMLElement && element.className && element.className.includes(name)) || (element.dataset && element.dataset[name]);
        });

        if (!matched) {
          document.dispatchEvent(this.event);
        }
      }
    };

    document.addEventListener('keyup', ev => {
      if (ev.keyCode === 27) {
        window.closePanels();
      }
    });

    document.addEventListener('click', listener);
    document.addEventListener('touchend', listener);
  },
};

export default Panels;
