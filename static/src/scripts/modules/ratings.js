const Ratings = {
  init(element = document) {
    this.triggers = Array.from(element.querySelectorAll('[data-rating]'));

    this.triggers.forEach((trigger) => {
      trigger.addEventListener('click', this.handleClick);
    });
  },

  handleClick(ev) {
    const button = ev.currentTarget;
    const parent = button.parentNode;
    const children = Array.from(parent.children);

    children.forEach((el) => {
      el.classList.toggle('is-active', el === button);
    });

    parent.classList.add('is-active');

    ev.preventDefault();
  },
};

export default Ratings;
