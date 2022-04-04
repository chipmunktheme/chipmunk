/** *** */ (function() { // webpackBootstrap
/** *** */ 	const __webpack_modules__ = ({

/***/ "./src/advanced-custom-fields-pro/assets/src/js/pro/_acf-setting-clone.js":
/*! ********************************************************************************!*\
  !*** ./src/advanced-custom-fields-pro/assets/src/js/pro/_acf-setting-clone.js ***!
  \******************************************************************************* */
/***/ (function() {

(function ($) {
  /**
   *  CloneDisplayFieldSetting
   *
   *  Extra logic for this field setting
   *
   *  @date	18/4/18
   *  @since	5.6.9
   *
   *  @param	void
   *  @return	void
   */
  const CloneDisplayFieldSetting = acf.FieldSetting.extend({
    type: 'clone',
    name: 'display',
    render () {
      // vars
      const display = this.field.val(); // set data attribute used by CSS to hide/show

      this.$fieldObject.attr('data-display', display);
    }
  });
  acf.registerFieldSetting(CloneDisplayFieldSetting);
  /**
   *  ClonePrefixLabelFieldSetting
   *
   *  Extra logic for this field setting
   *
   *  @date	18/4/18
   *  @since	5.6.9
   *
   *  @param	void
   *  @return	void
   */

  const ClonePrefixLabelFieldSetting = acf.FieldSetting.extend({
    type: 'clone',
    name: 'prefix_label',
    render () {
      // vars
      let prefix = ''; // if checked

      if (this.field.val()) {
        prefix = `${this.fieldObject.prop('label')  } `;
      } // update HTML


      this.$('code').html(`${prefix  }%field_label%`);
    }
  });
  acf.registerFieldSetting(ClonePrefixLabelFieldSetting);
  /**
   *  ClonePrefixNameFieldSetting
   *
   *  Extra logic for this field setting
   *
   *  @date	18/4/18
   *  @since	5.6.9
   *
   *  @param	void
   *  @return	void
   */

  const ClonePrefixNameFieldSetting = acf.FieldSetting.extend({
    type: 'clone',
    name: 'prefix_name',
    render () {
      // vars
      let prefix = ''; // if checked

      if (this.field.val()) {
        prefix = `${this.fieldObject.prop('name')  }_`;
      } // update HTML


      this.$('code').html(`${prefix  }%field_name%`);
    }
  });
  acf.registerFieldSetting(ClonePrefixNameFieldSetting);
  /**
   *  cloneFieldSelectHelper
   *
   *  Customizes the clone field setting Select2 isntance
   *
   *  @date	18/4/18
   *  @since	5.6.9
   *
   *  @param	void
   *  @return	void
   */

  const cloneFieldSelectHelper = new acf.Model({
    filters: {
      select2_args: 'select2Args'
    },
    select2Args (options, $select, data, $el, instance) {
      // check
      if (data.ajaxAction == 'acf/fields/clone/query') {
        // remain open on select
        options.closeOnSelect = false; // customize ajaxData function

        instance.data.ajaxData = this.ajaxData;
      } // return


      return options;
    },
    ajaxData (data) {
      // find current fields
      data.fields = {}; // loop

      acf.getFieldObjects().map(function (fieldObject) {
        // append
        data.fields[fieldObject.prop('key')] = {
          key: fieldObject.prop('key'),
          type: fieldObject.prop('type'),
          label: fieldObject.prop('label'),
          ancestors: fieldObject.getParents().length
        };
      }); // append title

      data.title = $('#title').val(); // return

      return data;
    }
  });
})(jQuery);

/***/ }),

/***/ "./src/advanced-custom-fields-pro/assets/src/js/pro/_acf-setting-flexible-content.js":
/*! *******************************************************************************************!*\
  !*** ./src/advanced-custom-fields-pro/assets/src/js/pro/_acf-setting-flexible-content.js ***!
  \****************************************************************************************** */
/***/ (function() {

(function ($) {
  /**
   *  CloneDisplayFieldSetting
   *
   *  Extra logic for this field setting
   *
   *  @date	18/4/18
   *  @since	5.6.9
   *
   *  @param	void
   *  @return	void
   */
  const FlexibleContentLayoutFieldSetting = acf.FieldSetting.extend({
    type: 'flexible_content',
    name: 'fc_layout',
    events: {
      'blur .layout-label': 'onChangeLabel',
      'click .add-layout': 'onClickAdd',
      'click .duplicate-layout': 'onClickDuplicate',
      'click .delete-layout': 'onClickDelete'
    },
    $input (name) {
      return $(`#${  this.getInputId()  }-${  name}`);
    },
    $list () {
      return this.$('.acf-field-list:first');
    },
    getInputId () {
      return `${this.fieldObject.getInputId()  }-layouts-${  this.field.get('id')}`;
    },
    // get all sub fields
    getFields () {
      return acf.getFieldObjects({
        parent: this.$el
      });
    },
    // get imediate children
    getChildren () {
      return acf.getFieldObjects({
        list: this.$list()
      });
    },
    initialize () {
      // add sortable
      const $tbody = this.$el.parent();

      if (!$tbody.hasClass('ui-sortable')) {
        $tbody.sortable({
          items: '> .acf-field-setting-fc_layout',
          handle: '.reorder-layout',
          forceHelperSize: true,
          forcePlaceholderSize: true,
          scroll: true,
          stop: this.proxy(function (event, ui) {
            this.fieldObject.save();
          })
        });
      } // add meta to sub fields


      this.updateFieldLayouts();
    },
    updateFieldLayouts () {
      this.getChildren().map(this.updateFieldLayout, this);
    },
    updateFieldLayout (field) {
      field.prop('parent_layout', this.get('id'));
    },
    onChangeLabel (e, $el) {
      // vars
      const label = $el.val();
      const $name = this.$input('name'); // render name

      if ($name.val() == '') {
        acf.val($name, acf.strSanitize(label));
      }
    },
    onClickAdd (e, $el) {
      // vars
      const prevKey = this.get('id');
      const newKey = acf.uniqid('layout_'); // duplicate

      $layout = acf.duplicate({
        $el: this.$el,
        search: prevKey,
        replace: newKey,
        after ($el, $el2) {
          // vars
          const $list = $el2.find('.acf-field-list:first'); // remove sub fields

          $list.children('.acf-field-object').remove(); // show empty

          $list.addClass('-empty'); // reset layout meta values

          $el2.find('.acf-fc-meta input').val('');
        }
      }); // get layout

      const layout = acf.getFieldSetting($layout); // update hidden input

      layout.$input('key').val(newKey); // save

      this.fieldObject.save();
    },
    onClickDuplicate (e, $el) {
      // vars
      const prevKey = this.get('id');
      const newKey = acf.uniqid('layout_'); // duplicate

      $layout = acf.duplicate({
        $el: this.$el,
        search: prevKey,
        replace: newKey
      }); // get all fields in new layout similar to fieldManager.onDuplicateField().
      // important to run field.wipe() before making any changes to the "parent_layout" prop
      // to ensure the correct input is modified.

      const children = acf.getFieldObjects({
        parent: $layout
      });

      if (children.length) {
        // loop
        children.map(function (child) {
          // wipe field
          child.wipe(); // update parent

          child.updateParent();
        }); // action

        acf.doAction('duplicate_field_objects', children, this.fieldObject, this.fieldObject);
      } // get layout


      const layout = acf.getFieldSetting($layout); // update hidden input

      layout.$input('key').val(newKey); // save

      this.fieldObject.save();
    },
    onClickDelete (e, $el) {
      // Bypass confirmation when holding down "shift" key.
      if (e.shiftKey) {
        return this.delete();
      } // add class


      this.$el.addClass('-hover'); // add tooltip

      const tooltip = acf.newTooltip({
        confirmRemove: true,
        target: $el,
        context: this,
        confirm () {
          this.delete();
        },
        cancel () {
          this.$el.removeClass('-hover');
        }
      });
    },
    delete () {
      // vars
      const $siblings = this.$el.siblings('.acf-field-setting-fc_layout'); // validate

      if (!$siblings.length) {
        alert(acf.__('Flexible Content requires at least 1 layout'));
        return false;
      } // delete sub fields


      this.getFields().map(function (child) {
        child.delete({
          animate: false
        });
      }); // remove tr

      acf.remove(this.$el); // save

      this.fieldObject.save();
    }
  });
  acf.registerFieldSetting(FlexibleContentLayoutFieldSetting);
  /**
   *  flexibleContentHelper
   *
   *  description
   *
   *  @date	19/4/18
   *  @since	5.6.9
   *
   *  @param	type $var Description. Default.
   *  @return	type Description.
   */

  const flexibleContentHelper = new acf.Model({
    actions: {
      sortstop_field_object: 'updateParentLayout',
      change_field_object_parent: 'updateParentLayout'
    },
    updateParentLayout (fieldObject) {
      // vars
      const parent = fieldObject.getParent(); // delete meta

      if (!parent || parent.prop('type') !== 'flexible_content') {
        fieldObject.prop('parent_layout', null);
        return;
      } // get layout


      const $layout = fieldObject.$el.closest('.acf-field-setting-fc_layout');
      const layout = acf.getFieldSetting($layout); // check if previous prop exists
      // - if not, set prop to allow following code to trigger 'change' and save the field

      if (!fieldObject.has('parent_layout')) {
        fieldObject.prop('parent_layout', 0);
      } // update meta


      fieldObject.prop('parent_layout', layout.get('id'));
    }
  });
})(jQuery);

/***/ }),

/***/ "./src/advanced-custom-fields-pro/assets/src/js/pro/_acf-setting-repeater.js":
/*! ***********************************************************************************!*\
  !*** ./src/advanced-custom-fields-pro/assets/src/js/pro/_acf-setting-repeater.js ***!
  \********************************************************************************** */
/***/ (function() {

(function ($) {
  /*
   *  Repeater
   *
   *  This field type requires some extra logic for its settings
   *
   *  @type	function
   *  @date	24/10/13
   *  @since	5.0.0
   *
   *  @param	n/a
   *  @return	n/a
   */
  const RepeaterCollapsedFieldSetting = acf.FieldSetting.extend({
    type: 'repeater',
    name: 'collapsed',
    events: {
      'focus select': 'onFocus'
    },
    onFocus (e, $el) {
      // vars
      const $select = $el; // collapsed

      const choices = []; // keep 'null' choice

      choices.push({
        label: $select.find('option[value=""]').text(),
        value: ''
      }); // find sub fields

      const $list = this.fieldObject.$('.acf-field-list:first');
      const fields = acf.getFieldObjects({
        list: $list
      }); // loop

      fields.map(function (field) {
        choices.push({
          label: field.prop('label'),
          value: field.prop('key')
        });
      }); // render

      acf.renderSelect($select, choices);
    }
  });
  acf.registerFieldSetting(RepeaterCollapsedFieldSetting);
})(jQuery);

/***/ })

/** *** */ 	});
/** ********************************************************************* */
/** *** */ 	// The module cache
/** *** */ 	const __webpack_module_cache__ = {};
/** *** */ 	
/** *** */ 	// The require function
/** *** */ 	function __webpack_require__(moduleId) {
/** *** */ 		// Check if module is in cache
/** *** */ 		const cachedModule = __webpack_module_cache__[moduleId];
/** *** */ 		if (cachedModule !== undefined) {
/** *** */ 			return cachedModule.exports;
/** *** */ 		}
/** *** */ 		// Create a new module (and put it into the cache)
/** *** */ 		const module = __webpack_module_cache__[moduleId] = {
/** *** */ 			// no module.id needed
/** *** */ 			// no module.loaded needed
/** *** */ 			exports: {}
/** *** */ 		};
/** *** */ 	
/** *** */ 		// Execute the module function
/** *** */ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/** *** */ 	
/** *** */ 		// Return the exports of the module
/** *** */ 		return module.exports;
/** *** */ 	}
/** *** */ 	
/** ********************************************************************* */
/** *** */ 	/* webpack/runtime/compat get default export */
/** *** */ 	!function() {
/** *** */ 		// getDefaultExport function for compatibility with non-harmony modules
/** *** */ 		__webpack_require__.n = function(module) {
/** *** */ 			const getter = module && module.__esModule ?
/** *** */ 				function() { return module.default; } :
/** *** */ 				function() { return module; };
/** *** */ 			__webpack_require__.d(getter, { a: getter });
/** *** */ 			return getter;
/** *** */ 		};
/** *** */ 	}();
/** *** */ 	
/** *** */ 	/* webpack/runtime/define property getters */
/** *** */ 	!function() {
/** *** */ 		// define getter functions for harmony exports
/** *** */ 		__webpack_require__.d = function(exports, definition) {
/** *** */ 			for(const key in definition) {
/** *** */ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/** *** */ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/** *** */ 				}
/** *** */ 			}
/** *** */ 		};
/** *** */ 	}();
/** *** */ 	
/** *** */ 	/* webpack/runtime/hasOwnProperty shorthand */
/** *** */ 	!function() {
/** *** */ 		__webpack_require__.o = function(obj, prop) { return Object.prototype.hasOwnProperty.call(obj, prop); }
/** *** */ 	}();
/** *** */ 	
/** *** */ 	/* webpack/runtime/make namespace object */
/** *** */ 	!function() {
/** *** */ 		// define __esModule on exports
/** *** */ 		__webpack_require__.r = function(exports) {
/** *** */ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/** *** */ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/** *** */ 			}
/** *** */ 			Object.defineProperty(exports, '__esModule', { value: true });
/** *** */ 		};
/** *** */ 	}();
/** *** */ 	
/** ********************************************************************* */
const __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be in strict mode.
!function() {

/*! *********************************************************************************!*\
  !*** ./src/advanced-custom-fields-pro/assets/src/js/pro/acf-pro-field-group.js ***!
  \******************************************************************************** */
__webpack_require__.r(__webpack_exports__);
/* harmony import */ const _acf_setting_repeater_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./_acf-setting-repeater.js */ "./src/advanced-custom-fields-pro/assets/src/js/pro/_acf-setting-repeater.js");
/* harmony import */ const _acf_setting_repeater_js__WEBPACK_IMPORTED_MODULE_0___default = /* #__PURE__ */__webpack_require__.n(_acf_setting_repeater_js__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ const _acf_setting_flexible_content_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./_acf-setting-flexible-content.js */ "./src/advanced-custom-fields-pro/assets/src/js/pro/_acf-setting-flexible-content.js");
/* harmony import */ const _acf_setting_flexible_content_js__WEBPACK_IMPORTED_MODULE_1___default = /* #__PURE__ */__webpack_require__.n(_acf_setting_flexible_content_js__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ const _acf_setting_clone_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./_acf-setting-clone.js */ "./src/advanced-custom-fields-pro/assets/src/js/pro/_acf-setting-clone.js");
/* harmony import */ const _acf_setting_clone_js__WEBPACK_IMPORTED_MODULE_2___default = /* #__PURE__ */__webpack_require__.n(_acf_setting_clone_js__WEBPACK_IMPORTED_MODULE_2__);



}();
/** *** */ })()
;
// # sourceMappingURL=acf-pro-field-group.js.map