const ViewTrigger = {
  options: { threshold: [1] },

  init(element = document) {
    if ('IntersectionObserver' in window) {
      // Create an intersection observers
      this.observeIntersections(element);
    }
  },

  observeIntersections(element) {
    this.triggers = element.querySelectorAll('[data-view-trigger]');

    const observer = new IntersectionObserver((entries) => {
      entries.forEach((entry) => {
        const trigger = entry.target;
        const event = entry.target.dataset.viewTrigger;

        if (entry && entry.isIntersecting) {
          trigger.dispatchEvent(new Event(event));
        }
      });
    }, this.options);

    if (this.triggers.length) {
      this.triggers.forEach((trigger) => observer.observe(trigger));
    }
  },
};

export default ViewTrigger;
