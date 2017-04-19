'use strict';

var $ = require('jquery');

var Tabs = {
  $trigger: $('[data-tabs-toggle]'),

  init: function () {
    var _this = this;
    
    if (this.$trigger.length) {
      this.$trigger.on('click', function () {
        _this.show($(this));
      });
    }
  },
  
  show: function ($element) {
    var $tabs = $element.closest('[data-tabs]');
    var $triggers = $tabs.find('[data-tabs-toggle]');
    var $panels = $tabs.find('[data-tabs-panel]');
    
    var activePanel, activeTab;

    $triggers.removeClass('active');
    activeTab = $triggers.get($element.index());
    $(activeTab).addClass('active');

    $panels.removeClass('active');
    activePanel = $panels.get($element.index());
    $(activePanel).addClass('active');

    $(document).trigger('shown.tab');
  }
};

module.exports = Tabs;
