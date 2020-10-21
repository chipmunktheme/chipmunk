const Expander = {
  init(element = document) {
    this.triggers = element.querySelectorAll('[data-expand]');

    if (this.triggers.length) {
      [].forEach.call(this.triggers, trigger => {
        trigger.addEventListener('click', this.handleExpander);
      });
    }
  },

  handleExpander(ev) {
    ev.preventDefault();

    const target = document.querySelector(ev.currentTarget.dataset.expand);

    if (target) {
      target.classList.toggle('is-expanded');
    }
  },
};

export default Expander;
