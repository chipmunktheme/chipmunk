/*!
** Project: Chipmunk Theme
** Author: Piotr Kulpinski, Jan Wennesland
** --------------------------------
**/

'use strict';

var $ = require('jquery');
window.$ = $;
window.jQuery = $;
require('bootstrap/dist/js/umd/tab');

(function () {
  require('./modules/nav')();
  require('./modules/search')();
  require('./modules/popup')();
  require('./modules/extras')();
})();

var closePanels = function () {
  $(document.body).removeClass('has-search-open has-popup-open has-nav-open');
};

document.addEventListener('keyup', function (ev) {
  if (ev.keyCode === 27) {
    closePanels();
  }
});

document.addEventListener('click', function (ev) {
  if (ev.target.className === 'popup') {
    closePanels();
  }
});
