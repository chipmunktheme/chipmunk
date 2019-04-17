const Sticky = {
  options: { threshold: [0, 1] },

  init(element = document) {
    if ('IntersectionObserver' in window) {
      // Create an intersection observers
      this.observeIntersections(element);
    }

    // Watch for sticky-change events
    document.addEventListener('sticky-change', e => {
      const { target, state, force } = e.detail;

      if (target) {
        target.classList.toggle(state, force);
      }
    });
  },

  observeIntersections(element) {
    this.sections = element.querySelectorAll('[data-sticky]');

    const observer = new IntersectionObserver((entries) => {
      for (const entry of entries) {
        const boundingRect = entry.boundingClientRect;
        const section = document.querySelector(`[data-sticky="#${entry.target.id}"]`);

        if (section) {
          this.fireEvent(section, 'is-sticky', (boundingRect.top < 0));
          this.fireEvent(section, 'is-condensed', (boundingRect.top * -1 > boundingRect.height));
        }
      }
    }, this.options);

    if (this.sections.length) {
      [].forEach.call(this.sections, section => observer.observe(document.querySelector(section.dataset.sticky)));
    }
  },

  fireEvent(target, state, force) {
    const e = new CustomEvent('sticky-change', { detail: { target, state, force } });
    document.dispatchEvent(e);
  },
};

export default Sticky;
