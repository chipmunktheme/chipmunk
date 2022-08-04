import Flickity from 'flickity';

const Carousel = {
  defaults: {
    cellAlign: 'left',
    draggable: true,
    contain: true,
    groupCells: true,
    pageDots: false,
    arrowShape:
      'M43.536 11.464a5 5 0 0 1 .415 6.6l-.415.472L17.075 45H95a5 5 0 0 1 .583 9.966L95 55H17.075l26.46 26.464a5 5 0 0 1-6.6 7.487l-.47-.415-35-35a5.04 5.04 0 0 1-.483-.56l-.359-.556-.267-.563-.177-.527-.145-.743L0 50l.014-.376.087-.628.148-.557.22-.555.261-.488.335-.481.4-.45 35-35a5 5 0 0 1 7.07 0Z',
  },

  init(element = document) {
    const carousels = Array.from(element.querySelectorAll('[data-carousel]'));

    // Defer initializing the carousel to make sure the fonts and images are loaded
    window.addEventListener('load', () => {
      carousels.forEach((carousel) => {
        this.initCarousel(carousel, carousel.dataset.carousel ? JSON.parse(carousel.dataset.carousel) : {});
      });
    });

    // Refresh carousel on tab change
    window.addEventListener('tabs:show', (ev) => {
      const { hash } = ev.detail;

      if (hash) {
        const flkty = Flickity.data(`${hash} [data-carousel]`);

        if (flkty) {
          flkty.resize();
        }
      }
    });

    /* eslint no-underscore-dangle: 0 */
    /* eslint func-names: 'off' */
    Flickity.prototype._createResizeClass = function () {
      this.element.classList.add('flickity-resize');
    };

    Flickity.createMethods.push('_createResizeClass');

    const { resize } = Flickity.prototype;
    Flickity.prototype.resize = function () {
      this.element.classList.remove('flickity-resize');
      resize.call(this);
      this.element.classList.add('flickity-resize');
    };
  },

  initCarousel(carousel, options = {}) {
    if (carousel.childElementCount > 1) {
      new Flickity(carousel, {
        ...Carousel.defaults,
        ...options,
      });
    }
  },
};

export default Carousel;
