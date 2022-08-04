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
    const objects = Array.from(document.querySelectorAll('[data-placehold-height]'));

    objects.forEach((object) => {
      const name = object.dataset.placeholdHeight;
      document.body.style.setProperty(`--${name}-height`, `${object.clientHeight}px`);

      if (object.matches('[class*="sticky"]')) {
        object.style.setProperty('position', 'fixed');
      }
    });

    this.heightCalculated = true;
  },

  calculateScrollbarWidth() {
    document.body.style.setProperty('--scrollbar-width', `${window.innerWidth - document.documentElement.clientWidth}px`);
  },

  handleScrollStatus() {
    if (!this.heightCalculated) {
      return;
    }

    const scrolledClass = 'is-condensed';
    const offset = 50;
    const currentScroll = document.documentElement.scrollTop;

    document.body.classList.toggle(scrolledClass, currentScroll > offset);
  },
};

export default Events;
