'use strict';

var $ = require('jquery');

var Tabs = {
  $trigger: $('[data-tabs]'),

  init: function () {
    var _this = this;
    
    if (this.$trigger.length) {
      this.$trigger.each(function () {
        var $triggers = $(this).find('[data-tabs-toggle]');
        var $panels = $(this).find('[data-tabs-panel]');
        
        _this.bind($triggers, $panels);
      });
    }
  },
  
  bind: function ($triggers, $panels) {
    var _this = this;
    
    return $triggers.on('click', function () {
      return _this.show($(this).index(), $triggers, $panels);
    });
  },
  
  show: function (index, $triggers, $panels) {
    var activePanel, activeTab;

    $triggers.removeClass('active');
    activeTab = $triggers.get(index);
    $(activeTab).addClass('active');

    $panels.removeClass('active');
    activePanel = $panels.get(index);
    $(activePanel).addClass('active');

    $(document).trigger('shown.tab');
  }
};

module.exports = Tabs;
