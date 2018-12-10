const $ = require('jquery');

const ViewTrigger = {
  options: { threshold: [1] },

  init(element = document) {
    if ('IntersectionObserver' in window && 'IntersectionObserverEntry' in window && 'intersectionRatio' in window.IntersectionObserverEntry.prototype) {
      // Create an intersection observers
      this.observeIntersections(element);
    }
  },

  observeIntersections(element) {
    this.triggers = element.querySelectorAll('[data-view-trigger]');

    const observer = new IntersectionObserver((entries) => {
      for (const entry of entries) {
        const trigger = entry.target;
        const event = entry.target.dataset.viewTrigger;

        if (entry && entry.isIntersecting) {
          $(trigger).trigger(event);
        }
      }
    }, this.options);

    if (this.triggers.length) {
      [].forEach.call(this.triggers, trigger => observer.observe(trigger));
    }
  },
};

export default ViewTrigger;
