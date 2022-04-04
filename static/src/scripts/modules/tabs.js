/* eslint-disable no-param-reassign */

const Tabs = {
  tabs: [],

  init(element = document) {
    this.tabs = Array.from(element.querySelectorAll('[data-tabs]'));

    this.tabs.forEach((tabs) => {
      tabs.toggles = Array.from(tabs.querySelectorAll('[data-tabs-toggle]'));
      tabs.panels = Array.from(tabs.querySelectorAll('[data-tabs-panel]'));

      this.bindTabs(tabs);
    });

    if (this.tabs.length === 1) {
      window.addEventListener('hashchange', () => {
        if (window.location.hash) {
          this.showTab(this.tabs[0], window.location.hash);
        }
      });

      window.addEventListener('tabs:show', (e) => {
        if (window.history.pushState && e.detail.hash) {
          window.history.pushState(null, null, e.detail.hash);
        }
      });

      if (window.location.hash) {
        window.addEventListener('load', this.showTab(this.tabs[0], window.location.hash), false);
      }
    }
  },

  bindTabs(tabs) {
    tabs.toggles.forEach((toggle) => {
      toggle.addEventListener('click', (ev) => {
        ev.preventDefault();

        this.showTab(tabs, ev.currentTarget.getAttribute('href'));
      });
    });
  },

  showTab(tabs, hash) {
    const toggles = tabs.querySelectorAll(`[href='${hash}']`);
    const panel = tabs.querySelector(hash);

    if (toggles && panel) {
      tabs.toggles.forEach((el) => {
        el.classList.remove('is-active');
      });

      tabs.panels.forEach((el) => {
        el.classList.remove('is-active');
      });

      toggles.forEach((el) => {
        el.classList.add('is-active');
      });

      panel.classList.add('is-active');

      if (window.dispatchEvent) {
        window.dispatchEvent(new CustomEvent('tabs:show', { detail: { hash } }));
      }
    }
  },
};

export default Tabs;
