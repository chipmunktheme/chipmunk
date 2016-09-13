/*!
** Project: Chipmunk Theme
** Author: Piotr Kulpinski, Jan Wennesland
** --------------------------------
**/

'use strict';

var $ = require('jquery');
window.$ = $;
window.jQuery = $;

(function () {
  require('./modules/nav')();
  require('./modules/search')();
  require('./modules/popup')();
  require('./modules/extras')();
  require('./modules/remote-form').init();

  var Tabs = require('./modules/tabs');
  new Tabs('[data-tabs]');
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
