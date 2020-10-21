/*!
** Project:      Chipmunk Theme
** Author:       Made by Less
** Author URI:   https://madebyless.com
** ------------------------------------
**/

import 'intersection-observer';
import 'custom-event-polyfill';

import toggle from './modules/toggle';
import dropdown from './modules/dropdown';
import expander from './modules/expander';
import popup from './modules/popup';
import validate from './modules/validate';
import filter from './modules/filter';
import tabs from './modules/tabs';
import consents from './modules/consents';
import dynamicRows from './modules/dynamic-rows';
import carousel from './modules/carousel';
import sticky from './modules/sticky';
import viewTrigger from './modules/view-trigger';
import animations from './modules/animations';
import extras from './modules/extras';
import actions from './modules/actions';

import panels from './utils/panels';

(function () {
  toggle.init();
  dropdown.init();
  expander.init();
  popup.init();
  validate.init();
  filter.init();
  tabs.init();
  consents.init();
  dynamicRows.init();
  carousel.init();
  sticky.init();
  viewTrigger.init();
  animations.init();
  extras.init();
  actions.init();

  // Utils
  panels.init();
})();
