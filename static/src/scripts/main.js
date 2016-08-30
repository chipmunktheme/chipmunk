/*!
** Project: Chipmunk Theme
** Author: Piotr Kulpinski, Jan Wennesland
** --------------------------------
**/

'use strict';

(function () {
  require('./modules/search')();
  require('./modules/popup')();
  require('./modules/extras')();
})();

var closePanels = function () {
  $(document.body).removeClass('has-search-open has-popup-open');
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
