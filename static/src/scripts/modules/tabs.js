'use strict';

var Tabs = function (tabsClass) {
  this.el = $(tabsClass);
  this.tabs = this.el.find('[data-tabs-toggle]');
  this.panels = this.el.find('[data-tabs-panel]');

  this.bind();
};

Tabs.prototype.show = function(index) {
  var activePanel, activeTab;

  this.tabs.removeClass('active');
  activeTab = this.tabs.get(index);
  $(activeTab).addClass('active');

  this.panels.removeClass('active');
  activePanel = this.panels.get(index);
  $(activePanel).addClass('active');

  $(document).trigger('shown.tab');
};

Tabs.prototype.bind = function() {
  var _this = this;
  return this.tabs.on('click', function(e) {
    return _this.show($(e.currentTarget).index());
  });
};

module.exports = Tabs;
