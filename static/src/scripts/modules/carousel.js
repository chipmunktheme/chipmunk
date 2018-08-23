const $ = require('jquery');
require('slick-carousel');

const Carousel = {
  triggers: document.querySelectorAll('[data-carousel]'),

  init() {
    if (this.triggers.length) {
      [].forEach.call(this.triggers, trigger => {
        $(trigger).slick({
          infinite: false,
          rows: 0,
          slidesToShow: 3,
          slidesToScroll: 3,
          responsive: [
            {
              breakpoint: 980,
              settings: {
                slidesToShow: 2,
                slidesToScroll: 2,
              },
            },
            {
              breakpoint: 680,
              settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
              },
            },
          ],
        });

        window.addEventListener('tabs:show', () => {
          $(trigger).slick('setPosition');
        });
      });
    }
  },
};

module.exports = Carousel;
