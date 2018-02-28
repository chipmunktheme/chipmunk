const $ = require('jquery');

require('select2')();
require('slick-carousel');

const Extras = {
  init() {
    // Custom select
    $('select').each(function () {
      $(this).select2({
        minimumResultsForSearch: Infinity,
        dropdownParent: $(this).parent(),
      });
    });

    // Resources carousel
    $('[data-resource-slider]').slick({
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
      $('[data-resource-slider]').slick('setPosition');
    });
  },
};

export default Extras;
