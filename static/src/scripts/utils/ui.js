import panel from '../modules/panel';
import dropdown from '../modules/dropdown';
import expander from '../modules/expander';
import carousel from '../modules/carousel';
import popup from '../modules/popup';
import validate from '../modules/validate';
import filter from '../modules/filter';
import tabs from '../modules/tabs';
import consents from '../modules/consents';
import dynamicRows from '../modules/dynamic-rows';
import viewTrigger from '../modules/view-trigger';
import ratings from '../modules/ratings';
import actions from '../modules/actions';
import events from '../modules/events';

const Ui = {
  init(element) {
    panel.init(element);
    dropdown.init(element);
    expander.init(element);
    carousel.init(element);
    popup.init(element);
    validate.init(element);
    filter.init(element);
    tabs.init(element);
    consents.init(element);
    dynamicRows.init(element);
    viewTrigger.init(element);
    ratings.init(element);
    actions.init(element);
    events.init(element);
  },
};

export default Ui;
