/*!
** Project: Chipmunk Theme
** Author: Piotr Kulpinski, Jan Wennesland
** --------------------------------
**/

import 'custom-event-polyfill';

import toggle from './modules/toggle';
import popup from './modules/popup';
import validate from './modules/validate';
import filter from './modules/filter';
import tabs from './modules/tabs';
import dynamicRows from './modules/dynamic-rows';
import fitvids from './modules/fitvids';
import carousel from './modules/carousel';
import extras from './modules/extras';
import actions from './modules/actions';

(function () {
  toggle.init();
  popup.init();
  validate.init();
  filter.init();
  tabs.init();
  dynamicRows.init();
  fitvids.init();
  carousel.init();
  extras.init();
  actions.init();
})();

window.closePanels = () => {
  const bodyClasses = ['has-nav-open', 'has-search-open', 'has-popup-open'];

  document.body.classList.remove(...bodyClasses);
  window.dispatchEvent(new Event('panels:close'));
};

const listener = ev => {
  const pattern = /popup($|\s)/;

  if (pattern.test(ev.target.className)) {
    window.closePanels();
  }
};

document.addEventListener('keyup', ev => {
  if (ev.keyCode === 27) {
    window.closePanels();
  }
});

document.addEventListener('click', listener);
document.addEventListener('touchend', listener);
