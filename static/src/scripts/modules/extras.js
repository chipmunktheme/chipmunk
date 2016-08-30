'use strict';

var $ = require('jquery');
window.$ = $;
window.jQuery = $;

require('select2');
require('slick-carousel');

var Extras = function () {
  // Custom select
  $('.custom-select').select2({
    minimumResultsForSearch: Infinity
  });

  // Resources carousel
  $('[data-resource-slider]').slick({
    infinite: false,
    slidesToShow: 3,
    slidesToScroll: 3,
    responsive: [
      {
        breakpoint: 980,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2
        }
      },
      {
        breakpoint: 680,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      }
    ]
  });

  // Tabs
  $('[data-tab-toggle]').on('click', function (ev) {
    ev.preventDefault();
    $(this).tab('show');
  });

  $('[data-tab-toggle]').on('shown.bs.tab', function () {
    $('[data-resource-slider]').slick('setPosition');
  });
};

module.exports = Extras;
