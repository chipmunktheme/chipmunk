import throttle from 'lodash.throttle';

const Events = {
  heightCalculated: false,

  init() {
    window.onload = () => setTimeout(this.handleLoad(), 250);
    window.onresize = throttle(this.handleResize, 200);
    window.onscroll = throttle(this.handleScroll, 50);
  },

  handleLoad() {
    Events.calculatePlaceholderHeight();
    Events.calculateScrollbarWidth();
    Events.handleScrollStatus();
  },

  handleResize() {
    Events.calculateScrollbarWidth();

    if (document.documentElement.scrollTop === 0) {
      Events.calculatePlaceholderHeight();
    }
  },

  handleScroll() {
    Events.handleScrollStatus();
  },

  /* Private functions */
  calculatePlaceholderHeight() {
    const root = document.documentElement;
    const objects = Array.from(document.querySelectorAll('[data-placehold-height]'));

    objects.forEach((object) => {
      const name = object.dataset.placeholdHeight;
      root.style.setProperty(`--${name}-height`, `${object.clientHeight}px`);

      if (object.classList.contains('is-sticky')) {
        object.style.setProperty('position', 'fixed');
      }
    });

    this.heightCalculated = true;
  },

  calculateScrollbarWidth() {
    const root = document.documentElement;
    root.style.setProperty('--scrollbar-width', `${window.innerWidth - root.clientWidth}px`);
  },

  handleScrollStatus() {
    if (!this.heightCalculated) {
      return;
    }

    const body = document.documentElement;
    const scrolledClass = 'is-condensed';
    const offset = 50;
    const currentScroll = body.scrollTop;

    body.classList.toggle(scrolledClass, currentScroll > offset);
  },
};

export default Events;
