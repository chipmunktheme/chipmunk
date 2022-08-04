const Panels = {
  init() {
    document.addEventListener('panels:close', () => {
      const bodyClasses = ['has-nav-open', 'has-search-open', 'has-popup-open'];

      document.documentElement.classList.remove(...bodyClasses);

      document.dispatchEvent(new CustomEvent('dropdown:close'));
      document.dispatchEvent(new CustomEvent('popup:close'));
    });

    document.addEventListener('keyup', this.keyListener);
    document.addEventListener('click', this.clickListener);
    document.addEventListener('touchend', this.clickListener);
  },

  keyListener(ev) {
    if (ev.keyCode === 27) {
      document.dispatchEvent(new CustomEvent('panels:close'));
    }
  },

  clickListener(ev) {
    const target = [ev.target];
    const path = ev.path || (ev.composedPath && ev.composedPath());

    if (path) {
      if (!Panels.listenerMatcher(path, ['dropdown', 'dropdown-content'])) {
        document.dispatchEvent(new CustomEvent('dropdown:close'));
      }
    }

    if (target) {
      if (Panels.listenerMatcher(target, /popup($|\s)/)) {
        document.dispatchEvent(new CustomEvent('popup:close'));
      }
    }
  },

  listenerMatcher(path, keyword) {
    return path.some((element) => {
      const isRegExp = keyword instanceof RegExp;
      const matchClass =
        element instanceof HTMLElement &&
        element.className &&
        (isRegExp ? keyword.test(element.className) : element.className.includes(keyword));
      const matchDataset =
        element instanceof HTMLElement &&
        element.dataset &&
        (Array.isArray(keyword) ? keyword.some((word) => word in element.dataset) : keyword in element.dataset);

      return isRegExp ? matchClass : matchClass || matchDataset;
    });
  },
};

export default Panels;
