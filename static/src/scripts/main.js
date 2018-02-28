/*!
** Project: Chipmunk Theme
** Author: Piotr Kulpinski, Jan Wennesland
** --------------------------------
**/

import 'custom-event-polyfill';

import toggle from './modules/toggle';
import validate from './modules/validate';
import filter from './modules/filter';
import tabs from './modules/tabs';
import dynamicRows from './modules/dynamic-rows';
import fitvids from './modules/fitvids';
import extras from './modules/extras';
import actions from './modules/actions';
import remoteForm from './modules/remote-form';

(function () {
  toggle.init();
  validate.init();
  filter.init();
  tabs.init();
  dynamicRows.init();
  fitvids.init();
  extras.init();
  actions.init();
  remoteForm.init();
})();

window.closePanels = function () {
  const bodyClasses = ['has-nav-open', 'has-search-open', 'has-popup-open'];

  document.body.classList.remove(...bodyClasses);
  document.body.dispatchEvent(new Event('panels:close'));
};

document.addEventListener('keyup', ev => {
  if (ev.keyCode === 27) {
    closePanels();
  }
});

document.addEventListener('click', ev => {
  const pattern = /popup($|\s)/;

  if (pattern.test(ev.target.className)) {
    closePanels();
  }
});
