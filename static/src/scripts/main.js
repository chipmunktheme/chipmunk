/*!
** Project: Chipmunk Theme
** Author: Piotr Kulpinski, Jan Wennesland
** --------------------------------
**/

'use strict';

(function () {
  require('./modules/nav')();
  require('./modules/search')();
  require('./modules/popup')();
  require('./modules/extras')();
  require('./modules/validate')();
  require('./modules/sort')();
  require('./modules/actions').init();
  require('./modules/remote-form').init();
  require('./modules/tabs').init();
})();

var closePanels = function () {
  document.body.classList.remove('has-search-open', 'has-popup-open', 'has-nav-open');
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
