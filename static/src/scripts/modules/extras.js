'use strict';

var $ = require('jquery');

require('select2')();
require('slick-carousel');

var Extras = function () {
  // Custom select
  $('select').each(function () {
    $(this).select2({
      minimumResultsForSearch: Infinity,
      dropdownParent: $(this).parent()
    });
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

  $(document).on('shown.tab', function () {
    $('[data-resource-slider]').slick('setPosition');
  });

  // Update the textarea height based on the content
  $('[data-update-rows]').on('keyup', function () {
    var lineHeight = parseInt($(this).css('lineHeight'));
    var padding = parseInt($(this).css('paddingTop')) + parseInt($(this).css('paddingBottom'));
    var lines = parseInt(($(this)[0].scrollHeight - padding) / lineHeight);

    if (lines > 10) {
      lines = 10;
    }

    $(this).attr('rows', lines);
  });
};

module.exports = Extras;
